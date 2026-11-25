<?php

namespace App\models\blog;

use Illuminate\Database\Eloquent\Model;
use App\models\language\Language;
use App\models\blog\Blog;
use App\models\blog\BlogTypeCate;
class BlogCategory extends Model
{
    protected $table = "blog_category";
    public function listBlog()
    {
        return $this->hasMany(Blog::class,'category','slug')->orderBy('id','DESC');
    }
    public function typeCate()
    {
        return $this->hasMany(BlogTypeCate::class,'category_slug','slug');
    }
    public function saveCate($request)
    {
        $id = $request->id;
        if($id != "" ){
            $query = BlogCategory::where([
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
                $query->path = $request->path;
                fillSlug($query, $request->name[0]['content']);
                assignSeoFields($query, $request);
                $query->status = $request->status;
                $query->avatar = $request->avatar;
                if ($oldSlug && $oldSlug !== $query->slug) {
                    \App\Services\UrlRedirectService::remember(
                        \App\Services\UrlRedirectService::blogCategoryPath($oldSlug),
                        \App\Services\UrlRedirectService::blogCategoryPath($query->slug)
                    );
                    \App\models\blog\Blog::where('category', $oldSlug)->update(['category' => $query->slug]);
                }
                $query->save();
            }else{
                $query = new BlogCategory();
                $query->name = json_encode($request->name);
                $query->path = $request->path;
                $query->status = $request->status;
                fillSlug($query, $request->name[0]['content']);
                assignSeoFields($query, $request);
                $query->avatar = $request->avatar;
                $query->save();
            }
            
        }else{
                $query = new BlogCategory();
                $query->name = json_encode($request->name);
                $query->path = $request->path;
                fillSlug($query, $request->name[0]['content']);
                assignSeoFields($query, $request);
                $query->status = $request->status;
                $query->avatar = $request->avatar;
                $query->save();
        }
        return $query;
    }
}
