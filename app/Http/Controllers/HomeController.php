<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\product\Category;
use App\models\product\Product;
use App\models\blog\Blog;
use Session;
use App\models\website\Partner;
use App\models\blog\BlogCategory;
use App\models\BannerAds;
use App\models\website\Video;
use App\models\website\Founder;
use App\models\website\Prize;
use App\models\website\AlbumAffter;
use App\models\ReviewCus;
use App\models\PageContent;
use App\models\ServiceCate;
use App\models\tag\TagCate;
class HomeController extends Controller
{
    public function home()
    {
        $data['hotnews'] = Blog::where('status', 1)
            ->where(function ($q) {
                $q->where('home_status', 1)->orWhereNull('home_status');
            })
            ->orderBy('id', 'DESC')
            ->limit(6)
            ->get(['id', 'title', 'slug', 'created_at', 'image', 'description']);
        $data['ReviewCus'] = ReviewCus::where('status', 1)->where('show_on_home', 1)->get();
        $data['servicecatehome'] = ServiceCate::where('status',1)->orderBy('id','ASC')->get()->map(function ($query) {
            $query->setRelation('services', $query->services);
            return $query;
        });
        $data['filter'] = TagCate::with(['tags'])->get();
        $data['partner'] = Partner::where(['status'=>1])->get();
        $data['bannerads'] = BannerAds::where(['status_show'=>'banner_ads','status'=>1])->get();
        $data['whychoise'] = BannerAds::where(['status_show'=>'banner_slogan','status'=>1])->get();
        $data['founder'] = Founder::where(['status'=>1])->get();
        $data['gioithieu'] = PageContent::where(['slug'=>'gioi-thieu','language'=>'vi'])->first(['id','title','content','image']);
        $data['homePro'] = Product::where(['status'=>1,'discountStatus'=>1])
            ->orderBy('id','DESC')
            ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','description','status_variant','variant','origin','thickness','hang_muc')
            ->limit(8)->get();
        return view('home',$data);
    }
}
