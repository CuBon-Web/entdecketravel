<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\models\blog\Blog;
use App\models\product\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = trim((string) $request->get('q', ''));

        if ($keyword === '') {
            $tours = new LengthAwarePaginator([], 0, 12, 1, [
                'path' => $request->url(),
                'pageName' => 'tour_page',
            ]);
            $blogs = new LengthAwarePaginator([], 0, 12, 1, [
                'path' => $request->url(),
                'pageName' => 'blog_page',
            ]);
        } else {
            $like = '%' . addcslashes($keyword, '%_\\') . '%';

            $tours = Product::query()
                ->where('status', 1)
                ->with('cate')
                ->where(function ($query) use ($like) {
                    $query->where('name', 'like', $like)
                        ->orWhere('slug', 'like', $like)
                        ->orWhere('description', 'like', $like);
                })
                ->orderBy('id', 'DESC')
                ->select([
                    'id', 'category', 'name', 'discount', 'price', 'images', 'slug',
                    'cate_slug', 'type_slug', 'status_variant', 'variant', 'hang_muc',
                    'origin', 'thickness', 'description',
                ])
                ->paginate(12, ['*'], 'tour_page')
                ->withQueryString();

            $blogs = Blog::query()
                ->where('status', 1)
                ->where(function ($query) use ($like) {
                    $query->where('title', 'like', $like)
                        ->orWhere('description', 'like', $like)
                        ->orWhere('slug', 'like', $like)
                        ->orWhere('content', 'like', $like);
                })
                ->orderBy('id', 'DESC')
                ->select(['id', 'title', 'image', 'description', 'created_at', 'slug'])
                ->paginate(12, ['*'], 'blog_page')
                ->withQueryString();
        }

        return view('search.index', [
            'keyword' => $keyword,
            'tours' => $tours,
            'blogs' => $blogs,
            'title' => $keyword !== '' ? 'Kết quả tìm kiếm: ' . $keyword : 'Tìm kiếm',
        ]);
    }
}
