<?php

namespace App\Services;

use App\models\UrlRedirect;

class UrlRedirectService
{
    public static function remember($from, $to)
    {
        $from = self::normalize($from);
        $to = self::normalize($to);
        if ($from === '' || $to === '' || $from === $to) {
            return;
        }

        $final = self::resolve($to);
        if ($final && $final !== $from) {
            $to = $final;
        }
        if ($from === $to) {
            UrlRedirect::where('from_path', $from)->delete();
            return;
        }

        UrlRedirect::where('to_path', $from)->where('from_path', '!=', $to)->update(['to_path' => $to]);
        UrlRedirect::where('from_path', $to)->delete();

        $row = UrlRedirect::firstOrNew(['from_path' => $from]);
        $row->to_path = $to;
        $row->save();
    }

    public static function resolve($path)
    {
        $current = self::normalize($path);
        $seen = [];
        $found = false;

        for ($hop = 0; $hop < 5; $hop++) {
            if (isset($seen[$current])) {
                break;
            }
            $seen[$current] = true;
            $next = UrlRedirect::where('from_path', $current)->value('to_path');
            if (!$next) {
                break;
            }
            $found = true;
            $current = self::normalize($next);
        }

        return $found ? $current : null;
    }

    public static function normalize($path)
    {
        $path = trim((string) $path);
        if ($path === '') {
            return '';
        }
        if (strpos($path, '://') !== false) {
            $path = (string) parse_url($path, PHP_URL_PATH);
        }

        return trim($path, '/');
    }

    public static function productPath($cate, $type, $slug)
    {
        return 'tour-detail/' . ($cate ?: 'tour') . '/' . ($type ?: 'type') . '/' . $slug . '.html';
    }

    public static function categoryPath($slug)
    {
        return $slug . '.html';
    }

    public static function typePath($cate, $slug)
    {
        return trim($cate . '/' . $slug, '/') . '.html';
    }

    public static function typeTwoPath($cate, $type, $slug)
    {
        return trim($cate . '/' . $type . '/' . $slug, '/') . '.html';
    }

    public static function blogPath($slug)
    {
        return 'news/detail/' . $slug . '.html';
    }

    public static function blogCategoryPath($slug)
    {
        return 'news/category/' . $slug . '.html';
    }

    public static function blogTypePath($slug)
    {
        return 'news/type-category/' . $slug . '.html';
    }

    public static function tagPath($slug)
    {
        return 'tag/' . $slug . '.html';
    }

    public static function serviceListPath($slug)
    {
        return 'service/' . $slug . '.html';
    }

    public static function serviceDetailPath($cate, $slug)
    {
        return 'service/' . $cate . '/' . $slug . '.html';
    }

    public static function solutionPath($slug)
    {
        return 'giai-phap/' . $slug . '.html';
    }
}
