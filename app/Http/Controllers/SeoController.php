<?php

namespace App\Http\Controllers;

use App\models\blog\Blog;
use App\models\blog\BlogCategory;
use App\models\blog\BlogTypeCate;
use App\models\PageContent;
use App\models\product\Category;
use App\models\product\Product;
use App\models\product\TypeProduct;
use App\models\product\TypeProductTwo;
use App\models\ServiceCate;
use App\models\Services;
use App\models\Solution;
use App\models\tag\Tags;
use Carbon\Carbon;

class SeoController extends Controller
{
    private $urls = [];

    public function sitemap()
    {
        $this->urls = [];

        $this->addStaticPages();
        $this->addTourPages();
        $this->addBlogPages();
        $this->addContentPages();

        $xml = $this->buildSitemapXml($this->urls);

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
            'Disallow: /search',
            'Allow: /',
            '',
            'Sitemap: ' . $this->httpsUrl(url('/sitemap.xml')),
        ]) . "\n";

        return response($content, 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
        ]);
    }

    private function addStaticPages()
    {
        $pages = [
            ['home', 'daily', '1.0'],
            ['allProduct', 'daily', '0.9'],
            ['aboutUs', 'monthly', '0.6'],
            ['lienHe', 'monthly', '0.6'],
            ['gallery', 'weekly', '0.5'],
            ['fags', 'monthly', '0.5'],
            ['feedback', 'weekly', '0.5'],
            ['bookATrrip', 'monthly', '0.6'],
            ['destination', 'weekly', '0.6'],
            ['allListBlog', 'daily', '0.8'],
            ['videoReview', 'monthly', '0.4'],
            ['flashSale', 'weekly', '0.5'],
        ];

        foreach ($pages as $page) {
            $this->addUrl(route($page[0]), now(), $page[1], $page[2]);
        }
    }

    private function addTourPages()
    {
        $categories = Category::query()
            ->where('status', 1)
            ->get(['slug', 'updated_at']);

        $categorySlugs = [];
        foreach ($categories as $category) {
            if (!$this->validSlug($category->slug)) {
                continue;
            }
            $categorySlugs[$category->slug] = true;
            $this->addUrl(
                route('allListProCate', ['danhmuc' => $category->slug]),
                $category->updated_at ?: now(),
                'weekly',
                '0.8'
            );
        }

        $types = TypeProduct::query()
            ->where('status', 1)
            ->get(['slug', 'cate_slug', 'updated_at']);

        $typeKeys = [];
        foreach ($types as $type) {
            if (!$this->validSlug($type->slug) || !$this->validSlug($type->cate_slug) || !isset($categorySlugs[$type->cate_slug])) {
                continue;
            }
            $typeKeys[$type->cate_slug . '/' . $type->slug] = true;
            $this->addUrl(
                route('allListType', [
                    'danhmuc' => $type->cate_slug,
                    'loaidanhmuc' => $type->slug,
                ]),
                $type->updated_at ?: now(),
                'weekly',
                '0.7'
            );
        }

        $typeTwos = TypeProductTwo::query()
            ->where('status', 1)
            ->get(['slug', 'updated_at', 'type_slug', 'cate_slug']);

        foreach ($typeTwos as $typeTwo) {
            if (!$this->validSlug($typeTwo->slug) || !$this->validSlug($typeTwo->cate_slug) || !$this->validSlug($typeTwo->type_slug)) {
                continue;
            }
            if (!isset($typeKeys[$typeTwo->cate_slug . '/' . $typeTwo->type_slug])) {
                continue;
            }
            $this->addUrl(
                route('allListTypeTwo', [
                    'danhmuc' => $typeTwo->cate_slug,
                    'loaidanhmuc' => $typeTwo->type_slug,
                    'loai2' => $typeTwo->slug,
                ]),
                $typeTwo->updated_at ?: now(),
                'weekly',
                '0.6'
            );
        }

        $tags = Tags::query()
            ->where('status', 1)
            ->get(['slug', 'updated_at']);

        foreach ($tags as $tag) {
            if (!$this->validSlug($tag->slug)) {
                continue;
            }
            $this->addUrl(
                route('allListTags', ['tag' => $tag->slug]),
                $tag->updated_at ?: now(),
                'weekly',
                '0.6'
            );
        }

        $products = Product::query()
            ->where('status', 1)
            ->get(['slug', 'cate_slug', 'type_slug', 'images', 'updated_at']);

        foreach ($products as $product) {
            if (!$this->validSlug($product->slug) || !$this->hasRenderableImage($product->images)) {
                continue;
            }
            $cate = $this->validSlug($product->cate_slug) ? $product->cate_slug : 'tour';
            $type = $this->validSlug($product->type_slug) ? $product->type_slug : 'type';
            $this->addUrl(
                route('detailProduct', [
                    'cate' => $cate,
                    'type' => $type,
                    'id' => $product->slug,
                ]),
                $product->updated_at ?: now(),
                'weekly',
                '0.8'
            );
        }
    }

    private function addBlogPages()
    {
        $blogCategories = BlogCategory::query()
            ->where('status', 1)
            ->get(['slug', 'updated_at']);

        foreach ($blogCategories as $blogCategory) {
            if (!$this->validSlug($blogCategory->slug)) {
                continue;
            }
            $this->addUrl(
                route('listCateBlog', ['slug' => $blogCategory->slug]),
                $blogCategory->updated_at ?: now(),
                'weekly',
                '0.7'
            );
        }

        $blogTypes = BlogTypeCate::query()
            ->where('status', 1)
            ->get(['slug', 'updated_at']);

        foreach ($blogTypes as $blogType) {
            if (!$this->validSlug($blogType->slug)) {
                continue;
            }
            $this->addUrl(
                route('listTypeBlog', ['slug' => $blogType->slug]),
                $blogType->updated_at ?: now(),
                'weekly',
                '0.6'
            );
        }

        $blogs = Blog::query()
            ->where('status', 1)
            ->get(['slug', 'updated_at']);

        foreach ($blogs as $blog) {
            if (!$this->validSlug($blog->slug)) {
                continue;
            }
            $this->addUrl(
                route('detailBlog', ['slug' => $blog->slug]),
                $blog->updated_at ?: now(),
                'weekly',
                '0.7'
            );
        }
    }

    private function addContentPages()
    {
        $pages = PageContent::query()
            ->where('status', 1)
            ->where('language', config('app.locale'))
            ->get(['slug', 'updated_at']);

        foreach ($pages as $page) {
            if (!$this->validSlug($page->slug)) {
                continue;
            }
            $this->addUrl(
                route('pagecontent', ['slug' => $page->slug]),
                $page->updated_at ?: now(),
                'monthly',
                '0.4'
            );
        }

        $serviceCategories = ServiceCate::query()
            ->where('status', 1)
            ->get(['slug', 'updated_at']);

        $serviceCategorySlugs = [];
        foreach ($serviceCategories as $serviceCategory) {
            if (!$this->validSlug($serviceCategory->slug)) {
                continue;
            }
            $serviceCategorySlugs[$serviceCategory->slug] = true;
            $this->addUrl(
                route('serviceList', ['slug' => $serviceCategory->slug]),
                $serviceCategory->updated_at ?: now(),
                'monthly',
                '0.4'
            );
        }

        $services = Services::query()
            ->where('status', 1)
            ->get(['slug', 'cate_slug', 'updated_at']);

        foreach ($services as $service) {
            if (!$this->validSlug($service->slug) || !$this->validSlug($service->cate_slug) || !isset($serviceCategorySlugs[$service->cate_slug])) {
                continue;
            }
            $this->addUrl(
                route('serviceDetail', [
                    'danhmuc' => $service->cate_slug,
                    'slug' => $service->slug,
                ]),
                $service->updated_at ?: now(),
                'monthly',
                '0.4'
            );
        }

        $solutions = Solution::query()
            ->where('status', 1)
            ->get(['slug', 'updated_at']);

        foreach ($solutions as $solution) {
            if (!$this->validSlug($solution->slug)) {
                continue;
            }
            $this->addUrl(
                route('detailSolution', ['slug' => $solution->slug]),
                $solution->updated_at ?: now(),
                'monthly',
                '0.4'
            );
        }
    }

    private function addUrl($loc, $lastmod, $changefreq, $priority)
    {
        $loc = $this->httpsUrl($loc);
        if ($loc === '' || isset($this->urls[$loc])) {
            return;
        }

        $this->urls[$loc] = [
            'loc' => $loc,
            'lastmod' => $lastmod ?: now(),
            'changefreq' => $changefreq,
            'priority' => $priority,
        ];
    }

    private function httpsUrl($url)
    {
        $url = (string) $url;
        $host = strtolower((string) parse_url($url, PHP_URL_HOST));
        if ($host === '' || $this->isLocalHost($host)) {
            return $url;
        }

        return preg_replace('#^http://#i', 'https://', $url);
    }

    private function isLocalHost($host)
    {
        return $host === 'localhost'
            || $host === '127.0.0.1'
            || substr($host, -5) === '.test'
            || substr($host, -6) === '.local';
    }

    private function validSlug($slug)
    {
        return is_string($slug) && preg_match('/^[A-Za-z0-9\-]+$/', $slug) === 1;
    }

    private function hasRenderableImage($images)
    {
        $decoded = json_decode($images, true);
        return is_array($decoded) && isset($decoded[0]) && is_string($decoded[0]) && $decoded[0] !== '';
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
