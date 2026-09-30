<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Session,View;
use App\models\website\Setting;
use App\models\website\Banner;
use Cart,Auth;
use App\models\PageContent;
use Laravel\Dusk\DuskServiceProvider;
use App\models\product\Category;
use App\models\language\Language;
use App\models\blog\BlogCategory;
use App\models\product\Product;
use App\models\ServiceCate;
use App\models\tag\TagCate;     

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) 
        {
            if(Auth::guard('customer')->user() != null){
                $profile = Auth::guard('customer')->user();
            }else{
                $profile = "";
            }
            $language_current = Session::get('locale');
            
            $setting = Setting::first();
            $lang = Language::get();
            $cateServices = ServiceCate::where('status',1)->orderBy('id','ASC')->get();
            $pageContent = PageContent::where(['language'=>$language_current,'status'=> 1])->get();
            $categoryhome = Category::with([
                'typeCate' => function ($query) {
                    $query->with(['typetwo'])->where('status',1)->orderBy('id','DESC')->select('cate_id','id', 'name','avatar','slug','cate_slug'); 
                }
            ])->where('status',1)->orderBy('id','ASC')->get(['id','name','imagehome','avatar','slug','content'])->map(function ($query) {
                $query->setRelation('product', $query->product);
                return $query;
            });
            $hottour = Product::with(['cate'])->where(['status'=>1,'discountStatus'=>1])
            ->orderBy('id','DESC')
            ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','description','status_variant','variant','origin','thickness','description')
            ->limit(6)->get();
            $banner = Banner::where(['status'=>1])->get(['id','image','link','title','description','subtitle']);
            $cartcontent = session()->get('cart', []);
            $blogCate = BlogCategory::with([
                'typeCate' => function ($query){
                    $query->select('id','slug','name','avatar','category_slug');
                }
            ])
            ->where('status',1)
            ->orderBy('id','DESC')
            ->get(['id','name','slug','avatar']);
            $wishlist = session()->get('wishlist', []);
            $tagCate = TagCate::with(['tags','product'])->where('status',1)->orderBy('id','ASC')->get();
            $view->with([
                'cateServices'=>$cateServices,
                'setting' => $setting,
                'pageContent' => $pageContent,
                'lang' => $lang,
                'banner'=>$banner,
                'profile' =>$profile,
                'categoryhome'=> $categoryhome,
                'wishlist'=>$wishlist,
                'cartcontent'=>$cartcontent,
                'blogCate'=>$blogCate,
               'hottour' => $hottour,
               'tagCate' => $tagCate
                ]);    
        });  
    }
}
