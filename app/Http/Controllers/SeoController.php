<?php

namespace App\Http\Controllers;

use App\models\blog\Blog;
use App\models\blog\BlogCategory;
use App\models\product\Category;
use App\models\product\Product;
use Carbon\Carbon;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap()
    {
        $urls = [];

        $urls[] = [
            'loc' => route('home'),
            'lastmod' => now(),
            'changefreq' => 'daily',
            'priority' => '1.0',
        ];

        $urls[] = [
            'loc' => route('allProduct'),
            'lastmod' => now(),
            'changefreq' => 'daily',
            'priority' => '0.9',
        ];

        $urls[] = [
            'loc' => route('allListBlog'),
            'lastmod' => now(),
            'changefreq' => 'daily',
            'priority' => '0.8',
        ];

        $categories = Category::query()
            ->where('status', 1)
            ->whereNotNull('slug')
            ->where('slug', '<>', '')
            ->get(['slug', 'updated_at']);

        foreach ($categories as $category) {
            $urls[] = [
                'loc' => route('allListProCate', ['danhmuc' => $category->slug]),
                'lastmod' => $category->updated_at ?: now(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }

        $products = Product::query()
            ->where('status', 1)
            ->whereNotNull('slug')
            ->where('slug', '<>', '')
            ->whereNotNull('cate_slug')
            ->where('cate_slug', '<>', '')
            ->get(['slug', 'cate_slug', 'type_slug', 'updated_at']);

        foreach ($products as $product) {
            $urls[] = [
                'loc' => route('detailProduct', [
                    'cate' => $product->cate_slug,
                    'type' => $product->type_slug ?: 'type',
                    'id' => $product->slug,
                ]),
                'lastmod' => $product->updated_at ?: now(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }

        $blogCategories = BlogCategory::query()
            ->where('status', 1)
            ->whereNotNull('slug')
            ->where('slug', '<>', '')
            ->get(['slug', 'updated_at']);

        foreach ($blogCategories as $blogCategory) {
            $urls[] = [
                'loc' => route('listCateBlog', ['slug' => $blogCategory->slug]),
                'lastmod' => $blogCategory->updated_at ?: now(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ];
        }

        $blogs = Blog::query()
            ->where('status', 1)
            ->whereNotNull('slug')
            ->where('slug', '<>', '')
            ->get(['slug', 'updated_at']);

        foreach ($blogs as $blog) {
            $urls[] = [
                'loc' => route('detailBlog', ['slug' => $blog->slug]),
                'lastmod' => $blog->updated_at ?: now(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ];
        }

        $xml = $this->buildSitemapXml($urls);

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }

    public function robots()
    {
        $content = implode("\n", [
            'User-agent: *',
            'Disallow: /*?*',
            'Disallow: /filter.html',
            'Disallow: /result-search',
            'Disallow: /search-tour',
            'Disallow: /search-service',
            'Allow: /',
            '',
            'Sitemap: ' . url('/sitemap.xml'),
        ]) . "\n";

        return response($content, 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
        ]);
    }

    private function buildSitemapXml(array $urls)
    {
        $lines = [
            '<?xml version="1.0" encoding="UTF-8"?>',
            '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">',
        ];

        foreach ($urls as $url) {
            $lastmod = $url['lastmod'] instanceof Carbon
                ? $url['lastmod']->toAtomString()
                : Carbon::parse($url['lastmod'])->toAtomString();

            $lines[] = '  <url>';
            $lines[] = '    <loc>' . htmlspecialchars($url['loc'], ENT_QUOTES, 'UTF-8') . '</loc>';
            $lines[] = '    <lastmod>' . $lastmod . '</lastmod>';
            $lines[] = '    <changefreq>' . $url['changefreq'] . '</changefreq>';
            $lines[] = '    <priority>' . $url['priority'] . '</priority>';
            $lines[] = '  </url>';
        }

        $lines[] = '</urlset>';

        return implode("\n", $lines);
    }
}
