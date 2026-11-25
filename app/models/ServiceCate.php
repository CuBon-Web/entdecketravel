<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\models\Services;
class ServiceCate extends Model
{
    protected $table = "service_category";
    public function services()
    {
        return $this->hasMany(Services::class,'cate_id','id')->where('home_status',1)->orderBy('id','DESC');
    }
    public function saveCate($request)
    {
        $id = $request->id;
        if($id != "" ){
            $query = ServiceCate::where([
                'id' => $id
             ])->first();
            if ($query) {
                $oldSlug = $query->slug;
                $query->name = json_encode($request->name);
                $query->slug = to_slug($request->name[0]['content']);
                if ($oldSlug && $oldSlug !== $query->slug) {
                    \App\Services\UrlRedirectService::remember(
                        \App\Services\UrlRedirectService::serviceListPath($oldSlug),
                        \App\Services\UrlRedirectService::serviceListPath($query->slug)
                    );
                    \App\models\Services::where('cate_id', $query->id)->orderBy('id')->chunk(50, function ($services) use ($query) {
                        foreach ($services as $service) {
                            if (!$service->slug) {
                                continue;
                            }
                            $from = \App\Services\UrlRedirectService::serviceDetailPath($service->cate_slug, $service->slug);
                            $service->cate_slug = $query->slug;
                            $service->save();
                            \App\Services\UrlRedirectService::remember($from, \App\Services\UrlRedirectService::serviceDetailPath($service->cate_slug, $service->slug));
                        }
                    });
                }
                $query->content = json_encode($request->content);
                $query->description = $request->description;
                $query->status = $request->status;
                $query->image = $request->image;
                $query->save();
            }else{
                $query = new ServiceCate();
                $query->name = json_encode($request->name);
                $query->slug = to_slug($request->name[0]['content']);
                $query->content = json_encode($request->content);
                $query->description = $request->description;
                $query->status = $request->status;
                $query->image = $request->image;
                $query->save();
            }
            
        }else{
            $query = new ServiceCate();
            $query->name = json_encode($request->name);
            $query->slug = to_slug($request->name[0]['content']);
            $query->content = json_encode($request->content);
            $query->description = $request->description;
            $query->status = $request->status;
            $query->image = $request->image;
            $query->save();
            
        }
        return $query;
    }
}
