<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\models\ServiceCate;
class Services extends Model
{
    protected $table = "services";
    public function cate()
    {
        return $this->hasOne(ServiceCate::class,'id','cate_id');
    }
    public function saveServices($request)
    {
    	$id = $request->id;
        $cate = ServiceCate::where([
            'id' => $request->cate_id
            ])->first();
        if($id != ""){
            $query = Services::where([
                'id' => $id
             ])->first();
            
            if ($query) {
                $query->name = json_encode($request->name);
                $query->slug = to_slug($request->name[0]['content']);
                $query->content = json_encode($request->content);
                $query->description = json_encode($request->description);
                $query->status = $request->status;
                $query->image = $request->image;
                $query->price = json_encode($request->price);
                $query->home_status = $request->home_status;
                $query->cate_id = $request->cate_id;
                $query->cate_slug = $cate->slug;
                $query->save();
            }else{
                $query = new Services();
                $query->name = json_encode($request->name);
                $query->slug = to_slug($request->name[0]['content']);
                $query->content = json_encode($request->content);
                $query->description = json_encode($request->description);
                $query->status = $request->status;
                $query->image = $request->image;
                $query->price = json_encode($request->price);
                $query->home_status = $request->home_status;
                $query->cate_id = $request->cate_id;
                $query->cate_slug = $cate->slug;
                $query->save();
            }
            
        }else{
                $query = new Services();
                $query->name = json_encode($request->name);
                $query->slug = to_slug($request->name[0]['content']);
                $query->content = json_encode($request->content);
                $query->description = json_encode($request->description);
                $query->status = $request->status;
                $query->image = $request->image;
                $query->price = json_encode($request->price);
                $query->home_status = $request->home_status;
                $query->cate_id = $request->cate_id;
                $query->cate_slug = $cate->slug;
                $query->save();
            
        }
        return $query;
    }
}
