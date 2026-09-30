<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class SeoPingService
{
    public static function pingSitemap()
    {
        $sitemapUrl = url('/sitemap.xml');

        $endpoints = [
            'google' => 'https://www.google.com/ping?sitemap=' . urlencode($sitemapUrl),
            'bing' => 'https://www.bing.com/ping?sitemap=' . urlencode($sitemapUrl),
        ];

        foreach ($endpoints as $engine => $endpoint) {
            self::fireAndForgetGet($endpoint, $engine);
        }
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
