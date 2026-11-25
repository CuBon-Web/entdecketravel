<?php

namespace App\models\blog;

use Illuminate\Database\Eloquent\Model;
use App\models\blog\Blog;
use App\models\blog\BlogCategory;

class BlogTypeCate extends Model
{
    protected $table = "blog_type_category";
    public function listBlog()
    {
        return $this->hasMany(Blog::class,'type_cate','slug')->orderBy('id','DESC');
    }
    public function cateBlog()
    {
        return $this->hasOne(BlogCategory::class,'slug','category_slug')->orderBy('id','DESC');
    }
    public function saveTypeCate($request)
    {
        $id = $request->id;
        if($id != "" ){
            $query = BlogTypeCate::where([
                'id' => $id
             ])->first();
            if ($query) {
                // $file= str_replace('http://localhost:8080','',$query->avatar);
                // $filename = public_path().$file;
                // if(file_exists( public_path().$file ) ){
                //     \File::delete($filename);
                // }
                $oldSlug = $query->slug;
                $query->name = json_encode($request->name);
                $query->slug = to_slug($request->name[0]['content']);
                if ($oldSlug && $oldSlug !== $query->slug) {
                    \App\Services\UrlRedirectService::remember(
                        \App\Services\UrlRedirectService::blogTypePath($oldSlug),
                        \App\Services\UrlRedirectService::blogTypePath($query->slug)
                    );
                    \App\models\blog\Blog::where('type_cate', $oldSlug)->update(['type_cate' => $query->slug]);
                }
                $query->status = $request->status;
                $query->avatar = $request->avatar;
                $query->category_slug = $request->category_slug;
                $query->save();
            }else{
                $query = new BlogTypeCate();
                $query->name = json_encode($request->name);
                $query->slug = to_slug($request->name[0]['content']);
                $query->status = $request->status;
                $query->avatar = $request->avatar;
                $query->category_slug = $request->category_slug;
                $query->save();
            }
            
        }else{
                $query = new BlogTypeCate();
                $query->name = json_encode($request->name);
                $query->slug = to_slug($request->name[0]['content']);
                $query->status = $request->status;
                $query->avatar = $request->avatar;
                $query->category_slug = $request->category_slug;
                $query->save();
        }
        return $query;
    }
}
