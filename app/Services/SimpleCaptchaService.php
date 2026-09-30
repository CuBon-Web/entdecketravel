<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SimpleCaptchaService
{
    const SESSION_KEY = 'contact_captcha_hash';

    public static function sessionKey(?string $scope = null): string
    {
        $scope = preg_replace('/[^a-z0-9_-]/i', '', (string) $scope);

        return $scope === '' ? self::SESSION_KEY : self::SESSION_KEY . '_' . $scope;
    }

    public static function generate(?string $scope = null): string
    {
        $code = str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        Session::put(self::sessionKey($scope), Hash::make($code));

        return $code;
    }

    public static function verify(?string $input, ?string $scope = null): bool
    {
        $hash = Session::get(self::sessionKey($scope));

        if (! $hash || $input === null || trim($input) === '') {
            return false;
        }

        $digits = preg_replace('/\D/', '', $input);
        if (strlen($digits) !== 4) {
            return false;
        }

        $valid = Hash::check($digits, $hash);
        if ($valid) {
            Session::forget(self::sessionKey($scope));
        }

        return $valid;
    }

    public static function imageResponse(?string $scope = null): Response
    {
        if (! function_exists('imagecreatetruecolor')) {
            abort(500, 'GD extension is required for captcha.');
        }

        $code = self::generate($scope);
        $width = 160;
        $height = 56;
        $image = imagecreatetruecolor($width, $height);

        $bg = imagecolorallocate($image, random_int(235, 255), random_int(235, 255), random_int(235, 255));
        imagefilledrectangle($image, 0, 0, $width, $height, $bg);

        for ($i = 0; $i < 6; $i++) {
            $noiseColor = imagecolorallocate(
                $image,
                random_int(170, 220),
                random_int(170, 220),
                random_int(170, 220)
            );
            imagefilledellipse(
                $image,
                random_int(0, $width),
                random_int(0, $height),
                random_int(8, 22),
                random_int(8, 22),
                $noiseColor
            );
        }

        for ($i = 0; $i < 120; $i++) {
            $dotColor = imagecolorallocate(
                $image,
                random_int(120, 200),
                random_int(120, 200),
                random_int(120, 200)
            );
            imagesetpixel($image, random_int(0, $width - 1), random_int(0, $height - 1), $dotColor);
        }

        for ($i = 0; $i < 5; $i++) {
            $lineColor = imagecolorallocate(
                $image,
                random_int(100, 170),
                random_int(100, 170),
                random_int(100, 170)
            );
            imageline(
                $image,
                random_int(0, $width),
                random_int(0, $height),
                random_int(0, $width),
                random_int(0, $height),
                $lineColor
            );
        }

        $x = 12;
        foreach (str_split($code) as $char) {
            $charWidth = 34;
            $charHeight = 42;
            $charImage = imagecreatetruecolor($charWidth, $charHeight);
            $transparent = imagecolorallocate($charImage, 255, 255, 255);
            imagefilledrectangle($charImage, 0, 0, $charWidth, $charHeight, $transparent);
            imagecolortransparent($charImage, $transparent);

            $textColor = imagecolorallocate(
                $charImage,
                random_int(20, 90),
                random_int(20, 90),
                random_int(20, 90)
            );
            imagestring($charImage, 5, random_int(4, 8), random_int(8, 14), $char, $textColor);

            $angle = random_int(-28, 28);
            $rotated = imagerotate($charImage, $angle, $transparent);
            imagealphablending($image, true);
            imagecopy(
                $image,
                $rotated,
                $x + random_int(-2, 2),
                random_int(4, 10),
                0,
                0,
                imagesx($rotated),
                imagesy($rotated)
            );

            imagedestroy($charImage);
            imagedestroy($rotated);
            $x += 34;
        }

        $distorted = self::applyWaveDistortion($image, $width, $height);
        imagedestroy($image);

        ob_start();
        imagepng($distorted);
        $png = ob_get_clean();
        imagedestroy($distorted);

        return response($png, 200, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
        ]);
    }

    private static function applyWaveDistortion($source, int $width, int $height)
    {
        $target = imagecreatetruecolor($width, $height);
        $bg = imagecolorallocate($target, 245, 245, 245);
        imagefilledrectangle($target, 0, 0, $width, $height, $bg);

        for ($y = 0; $y < $height; $y++) {
            $shift = (int) round(sin($y / 6.5) * 3);
            for ($x = 0; $x < $width; $x++) {
                $srcX = $x + $shift;
                if ($srcX >= 0 && $srcX < $width) {
                    $color = imagecolorat($source, $srcX, $y);
                    imagesetpixel($target, $x, $y, $color);
                }
            }
        }

        return $target;
    }
}
