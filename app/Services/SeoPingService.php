<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class SeoPingService
{
    public static function pingSitemap()
    {
        $sitemapUrl = self::httpsUrl(url('/sitemap.xml'));

        $endpoints = [
            'google' => 'https://www.google.com/ping?sitemap=' . urlencode($sitemapUrl),
            'bing' => 'https://www.bing.com/ping?sitemap=' . urlencode($sitemapUrl),
        ];

        foreach ($endpoints as $engine => $endpoint) {
            self::fireAndForgetGet($endpoint, $engine);
        }
    }

    private static function httpsUrl($url)
    {
        $host = strtolower((string) parse_url($url, PHP_URL_HOST));
        $local = $host === ''
            || $host === 'localhost'
            || $host === '127.0.0.1'
            || substr($host, -5) === '.test'
            || substr($host, -6) === '.local';

        if ($local) {
            return $url;
        }

        return preg_replace('#^http://#i', 'https://', (string) $url);
    }

    private static function fireAndForgetGet($url, $engine)
    {
        try {
            if (function_exists('curl_init')) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 3);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_exec($ch);
                curl_close($ch);

                return;
            }

            @file_get_contents($url);
        } catch (\Throwable $e) {
            Log::warning('SEO ping failed: ' . $engine, [
                'url' => $url,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
