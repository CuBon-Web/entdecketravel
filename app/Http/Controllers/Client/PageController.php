<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\product\Product;
use Session;
use App\models\product\Category;
use App\models\product\TypeProduct;
use DB,stdClass,File;
use App\models\District;
use Goutte\Client;
use App\models\blog\Blog;
use App\models\MessContact;
use App\models\website\Setting;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\models\Services;
use App\models\ServiceCate;
use App\models\website\Prize;
use App\models\website\Founder;
use App\models\website\Partner;
use App\models\PageContent;
use App\models\Project;
use App\models\website\Video;
use App\models\website\AlbumAffter;
use App\Services\SimpleCaptchaService;
use App\models\ReviewCus;
class PageController extends Controller
{
    public function orderNow()
    { 
        return view('orderNow');
    }
    public function baogia()
    {
        return view('baogia');
    }
    public function bookATrrip(){
        return view('bookatrip');
    }
    public function videoReview() {
        $data['video'] = Video::where('status',1)->paginate(20);
        return view('video',$data);
    }
    public function menu()
    {
        
        $data['allproduct'] = Product::where([
            ['status', '=', 1]
        ])->limit(9)->orderBy('id','DESC')->get(['id','name','discount','price','images','slug']);
        $data['hotnews'] = Blog::where([
            ['status','=',1],
            ['type_news','=','tin-hot']
        ])->orderBy('id','DESC')->limit(7)->get(['id','title','slug','created_at','image']);
        return view('menu',$data);
    }
    
    public function quickview(Request $request){
        $pro = Founder::where('id',$request->id)->first();
        $view = view("layouts.product.quickview",compact('pro'))->render();
        // dd($product->count());
        return response()->json([
            'html'=>$view
        ]);
    }
    public function aboutUs(){
        $data['partner'] = Partner::where(['status'=>1])->get(['id','image','name','link']);
        $data['founder'] = Founder::where(['status'=>1])->get(['id','name','position','image','description']);
        $data['album'] = Prize::where(['status'=>1])->get(['id','name','image']);
        $data['gioithieu'] = PageContent::where(['slug'=>'gioi-thieu','language'=>'vi'])->first(['id','title','content','image']);
        $data['ReviewCus'] = ReviewCus::where('status',1)->get(); 
        $data['services'] = Services::where([
            ['status','=',1]
        ])->orderBy('id','DESC')->limit(6)->get(['id','name','slug','description','image']);
        return view('aboutus',$data);
    }
    public function contact()
    {
        $data['ReviewCus '] = ReviewCus::where('status',1)->get();

        return view('contactus',$data);
    }

    public function contactCaptcha(Request $request)
    {
        $scope = $request->query('scope');

        return SimpleCaptchaService::imageResponse(is_string($scope) ? $scope : null);
    }
    public function getPostInfor()
    {
        $data['category_product'] = Category::where('status',1)->get();
        return view('post_info.index',$data);
    }
    public function postPostInfor(Request $request,Product $product )
    {
        $data = $product->createClient($request);
        $data['category'] = Category::where(['status'=> 1])->orderBy('id','ASC')->get();
        $data['categoryFirst'] = Category::where(['status'=> 1])->orderBy('id','ASC')->first();
        $productNewFirstTab = Product::where([
            'category'=> $data['categoryFirst'] ? $data['categoryFirst']->id : 0,
            'status' => 0
        ])->with('customer')
        ->orderBy('id','ASC')
        ->limit(10)->get()->toArray();
        $data['productNewFirstTab'] = array_chunk($productNewFirstTab,2);
        return view('home',$data)->with('success','Tin của bạn đang được xét duyệt!');
    }
    public function typeproduct($id)
    {
        $arr = [];
        $data = TypeProduct::where('cate_id',$id)->get();
        $lang = Session::get('locale');
        foreach($data as $item){
            $obj = new stdClass();
            $obj->name = languageName($item->name);
            $obj->id = $item->id;
            $arr[] = $obj;
        }
        return response()->json([
    		'message' => 'get data Success',
    		'data'=> $arr
    	],200);
    }
    public function district($id)
    {
        $data = District::where('_province_id',$id)->get();
        return response()->json([
    		'message' => 'get data Success',
    		'data'=> $data
    	],200);
    }
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $code = Session::get('locale');
        $arr = [];
        $arrb = [];
        $arrOpt = [];
        //search option
        $productOpt =  Product::with('cate')
        ->where('status',1)
        ->get()
        ->toArray();
        foreach($productOpt as $key => $item){
            $fielName = json_decode($item['name']);
            foreach($fielName as $i){
                if(strpos(strtolower(stripVN($i->content)), strtolower(stripVN($keyword))) !== false && $i->lang_code == $code){
                    array_push($arr,$productOpt[$key]);
                }
            }
        }
        $data['keyword'] = $request->keyword;
        $data['countproduct'] = count($arr);
        $data['resultPro'] = $arr;
        return view('search_result',$data);
    }
    public function postcontact(Request $request){
        if ($request->filled('website')) {
            return back()->with('error', 'Gửi tin thất bại');
        }

        if ($request->has('captcha_code')
            && ! SimpleCaptchaService::verify($request->input('captcha_code'))) {
            return back()
                ->withInput($request->except('captcha_code'))
                ->with('error', 'Mã xác minh không đúng. Vui lòng thử lại.');
        }

        $data = new MessContact();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->mess = $request->mess;
        $data->save();
        if ($data) {
            $setting = Setting::first();
            try {
                $notifyRaw = [];
                if ($setting) {
                    if (! empty($setting->email)) {
                        $notifyRaw[] = (string) $setting->email;
                    }
                    if (! empty($setting->fax)) {
                        $notifyRaw[] = (string) $setting->fax;
                    }
                }

                $notifyEmails = array_unique(array_filter(array_map('trim', explode(',', implode(',', $notifyRaw)))));
                foreach ($notifyEmails as $to) {
                    if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
                        Mail::to($to)->send(new ContactMessageMail($data, false));
                    }
                }
                $customerEmail = trim((string) $request->email);
                if ($customerEmail !== '' && filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
                    Mail::to($customerEmail)->send(new ContactMessageMail($data, true));
                }
            } catch (\Throwable $e) {
                Log::error('Contact form email failed: ' . $e->getMessage(), [
                    'mess_contact_id' => $data->id,
                    'exception' => $e,
                ]);
            }

            return \Redirect::to('/')->with('success', 'Gửi tin thành công');
        }

        return back()->with('error', 'Gửi tin thất bại');
    }
    public function serviceDetail($danhmuc, $slug)
    {
        $data['detail_service'] = Services::where(['cate_slug'=>$danhmuc, 'slug'=>$slug])->first();
        $data['servicelq'] = Services::where(['cate_slug'=>$danhmuc])->get();
        $data['servicelqcate'] = ServiceCate::where(['slug'=>$danhmuc])->first();
        $data['productlq'] = Product::where('service_id',$data['servicelqcate']->id)->get();
        return view('servicedetail',$data);
    }
    public function serviceList($slug)
    {
        $data['list'] = Services::where('cate_slug',$slug)->paginate(9);
        $data['cateService'] = ServiceCate::where('slug',$slug)->first();
        
        return view('servicelist',$data);
    }
    public function fags() {
        return view('fag');
    }
    public function feedback() {
        $data['data'] = ReviewCus::where('status',1)->get();
        return view('feedback',$data);
    }
    public function gallery()
    {
        $data['list'] = AlbumAffter::where('status',1)->paginate(12);
        return view('album',$data);
    }
    public function duanTieuBieuDetail($slug)
    {
        $data['detail'] = Project::where('slug',$slug)->first();
        return view('detailProject',$data);
    }
}
