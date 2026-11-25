<?php

namespace App\models\product;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use File;
use App\models\language\Language;
use App\models\product\Product;
use App\models\product\TypeProduct;
use App\models\tag\TagCate;

class Category extends Model
{
    protected $table = "product_category";
    public function rule()
    {
        return [
            
        ];
    }
    public function typeCate()
    {
        return $this->hasMany(TypeProduct::class,'cate_id','id')->where('status',1);
    }
    public function product()
    {
        return $this->hasMany(Product::class,'category','id')->where('home_status',1)->orderBy('id','DESC');
    }
    public function tagCate()
    {
        return $this->hasMany(TagCate::class,'cate_product_id','id');
    }
    public function saveCate($request)
    {
        $id = $request->id;
        if($id != "" ){
            $query = Category::where([
                'id' => $id
             ])->first();
            if ($query) {
                $oldSlug = $query->slug;
                $query->name = json_encode($request->name);
                fillSlug($query, $request->name[0]['content']);
                assignSeoFields($query, $request);
                if ($oldSlug && $oldSlug !== $query->slug) {
                    \App\Services\UrlRedirectService::remember(
                        \App\Services\UrlRedirectService::categoryPath($oldSlug),
                        \App\Services\UrlRedirectService::categoryPath($query->slug)
                    );
                    \App\models\product\Product::where('category', $query->id)->orderBy('id')->chunk(50, function ($products) use ($query) {
                        foreach ($products as $product) {
                            if (!$product->slug) {
                                continue;
                            }
                            $from = \App\Services\UrlRedirectService::productPath($product->cate_slug, $product->type_slug, $product->slug);
                            $product->cate_slug = $query->slug;
                            $product->save();
                            \App\Services\UrlRedirectService::remember($from, \App\Services\UrlRedirectService::productPath($product->cate_slug, $product->type_slug, $product->slug));
                        }
                    });
                    \App\models\product\TypeProduct::where('cate_id', $query->id)->orderBy('id')->chunk(50, function ($types) use ($query) {
                        foreach ($types as $type) {
                            $from = \App\Services\UrlRedirectService::typePath($type->cate_slug, $type->slug);
                            $type->cate_slug = $query->slug;
                            $type->save();
                            \App\Services\UrlRedirectService::remember($from, \App\Services\UrlRedirectService::typePath($type->cate_slug, $type->slug));
                        }
                    });
                }
                $query->content = $request->content;
                $query->status = $request->status;
                $query->avatar = $request->avatar;
                $query->imagehome = $request->imagehome;
                $query->save();
            }else{
                $query = new Category();
                $query->quiz_id = 0;
                $query->language = 0;
                $query->name = json_encode($request->name);
                fillSlug($query, $request->name[0]['content']);
                assignSeoFields($query, $request);
                $query->content = $request->content;
                $query->status = $request->status;
                $query->avatar = $request->avatar;
                $query->imagehome = $request->imagehome;
                $query->save();
            }
            
        }else{
            $query = new Category();
            $query->quiz_id = 0;
            $query->language = 0;
            $query->name = json_encode($request->name);
            fillSlug($query, $request->name[0]['content']);
            assignSeoFields($query, $request);
            $query->content = $request->content;
            $query->status = $request->status;
            $query->avatar = $request->avatar;
            $query->imagehome = $request->imagehome;
            $query->save();
            
        }
        return $query;
    }
}
