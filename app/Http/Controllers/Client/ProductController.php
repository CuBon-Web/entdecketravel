<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\product\Product;
use App\models\product\Category;
use App\models\blog\Blog;
use App\models\product\TypeProduct;
use App\models\construction\Construction;
use  App\models\product\TypeProductTwo;
use Session;
use App\models\tag\Tags;
use App\models\tag\TagCate;
use App\models\VariantSkuValue;
use App\models\ServiceCate;
use App\models\Services;
use App\models\BillTour;
use App\models\website\Setting;
use App\Mail\TourBookingMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\models\PageContent;
use App\Services\SimpleCaptchaService;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    private function applyListFilters(Request $request, $product)
    {
        if ($request->filled('fillter')) {
            $product = $product->where(function ($query) use ($request) {
                $selectedTags = array_values(array_filter(array_map(function ($item) {
                    return trim((string) $item);
                }, array_unique((array) $request->fillter))));
                foreach ($selectedTags as $index => $item) {
                    if ($index === 0) {
                        $query->whereJsonContains('tags', $item);
                    } else {
                        $query->orWhereJsonContains('tags', $item);
                    }
                }
            });
        }
        if ($request->filled('tag')) {
            $tag = $request->tag;
            $product = $product->where(function ($query) use ($tag) {
                $query->whereJsonContains('tags', $tag)
                    ->orWhere('tags', 'LIKE', '%"'.$tag.'"%');
            });
        }
        // dd($request->cate);
        // cate_filter is explicit UI choice from GET form.
        // If cate_filter exists but is empty => "all categories", do not fallback to hidden cate.
        if ($request->has('cate_filter')) {
            if (trim((string) $request->cate_filter) !== '') {
                $product = $product->where('cate_slug', $request->cate_filter);
            }
        } elseif ($request->filled('cate')) {
            // dd(123);
            $product = $product->where('cate_slug', $request->cate);
        }
        // if ($request->filled('cate')){
        //     // dd($request->cate);
        //     $product = $product->where('cate_slug', $request->cate);
        // }
        if ($request->filled('type')) {
            $product = $product->where('type_slug', $request->type);
        }
        if ($request->filled('typetwo')) {
            $product = $product->where('type_two_slug', $request->typetwo);
        }

        if ($request->filled('duration_range')) {
            $durationExpr = "CAST(REGEXP_SUBSTR(hang_muc, '[0-9]+') AS UNSIGNED)";
            if ($request->duration_range === '1-3') {
                $product = $product->whereRaw("$durationExpr BETWEEN 1 AND 3");
            } elseif ($request->duration_range === '3-5') {
                $product = $product->whereRaw("$durationExpr BETWEEN 3 AND 5");
            } elseif ($request->duration_range === '5-7') {
                $product = $product->whereRaw("$durationExpr BETWEEN 5 AND 7");
            } elseif ($request->duration_range === '7-10') {
                $product = $product->whereRaw("$durationExpr BETWEEN 7 AND 10");
            } elseif ($request->duration_range === '10+') {
                $product = $product->whereRaw("$durationExpr > 10");
            } elseif ($request->duration_range === '30+') {
                $product = $product->whereRaw("$durationExpr > 30");
            }
        }

        if ($request->sortby === "price-asc") {
            $product = $product->orderBy('price', 'ASC');
        } elseif ($request->sortby === "price-desc") {
            $product = $product->orderBy('price', 'DESC');
        } else {
            $product = $product->orderBy('id', 'DESC');
        }

        return $product;
    }

    public function allProduct(Request $request)
    {
        $product = Product::where('status',1)
            ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','status_variant','variant','hang_muc','origin','thickness','description');
        $data['list'] = $this->applyListFilters($request, $product)->paginate(12)->appends($request->query());
        $data['title'] = "All Tour";
        $data['content'] = 'none';
        $data['cate_slug'] = '';
        $data['type_slug'] = '';
        $data['type_two_slug'] = '';
        $data['filter'] = TagCate::with(['tags'])->where('status_filter', 1)->get();
        return view('product.list',$data);
    }
    public function Destination(){
        return view('product.destination');
    }
    public function searchTour(Request $request){
        $product = Product::query();
        if( isset($request->diemden) ){
            $product = $product->where('category', $request->diemden);
        }
        if( isset($request->keyword) ){
            $product = $product->where('name', 'LIKE', '%'.$request->keyword.'%');
        }
        $product = $product->where('status',1)->paginate(20);
        return view('product.serchtour',compact('product'));
    }
    public function searchService(Request $request) {
        $service = Services::query();
        if( isset($request->service) ){
            $service = $service->where('cate_id', $request->service);
        }
        if( isset($request->keyword) ){
            $service = $service->where('name', 'LIKE', '%'.$request->keyword.'%');
        }
        $service = $service->where('status',1)->paginate(20);
        return view('product.serchservice',compact('service'));
    }
    public function bookTour(Request $request){
        $data['request'] = $request->all();
        if($request->exists('service_id')){
            $data['servicelist'] = Services::whereIn('id', $request->service_id)->get();
            $data['servicereqest'] = $request->service_id;
        }
        $data['tour'] = Product::where('id',$request->tour_id)->first();
        return view('product.booktour',$data);
    }
    public function postBookTour(Request $request){
        $isQuote = $request->input('form_type') === 'quote';
        $errorKey = $isQuote ? 'quote_error' : 'error';

        if ($request->filled('website')) {
            return back()->with($errorKey, 'Booking failed');
        }

        if ($request->has('captcha_code')
            && ! SimpleCaptchaService::verify($request->input('captcha_code'), $isQuote ? 'quote' : null)) {
            return back()
                ->withInput($request->except('captcha_code'))
                ->with($errorKey, 'Verification code is incorrect. Please try again.');
        }

        $rules = [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'email_confirm' => 'required|same:email',
            'phone' => 'required|string|max:30',
            'phone_code' => ['required', 'regex:/^\+\d{1,6}$/'],
            'hotel_category' => 'required|in:2 Stars,3 Stars,4 Stars,5 Stars,Cruise',
            'travellers' => 'required|integer|min:1|max:20',
        ];
        $messages = [
            'email_confirm.same' => 'Email addresses do not match.',
            'hotel_category.required' => 'Please choose a hotel category.',
            'travellers.required' => 'Please choose how many people are travelling.',
        ];
        if ($isQuote) {
            $rules['date_type'] = 'required|in:specific,flexible';
            $rules['travel_date'] = 'nullable|required_if:date_type,specific|date';
            $messages['travel_date.required_if'] = 'Please choose a specific travel date.';
        } else {
            $rules['travel_date'] = 'required|date';
            $rules['nationality'] = 'required|string|max:100';
            $rules['note'] = 'nullable|string|max:5000';
            $messages['travel_date.required'] = 'Please choose a travel date.';
            $messages['nationality.required'] = 'Please choose a nationality.';
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withInput()->with($errorKey, $validator->errors()->first());
        }

        $flexibleDate = $isQuote && $request->date_type === 'flexible';
        $data = new BillTour();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->tour_id = $request->tour_id;
        $data->service_id = $request->service_id;
        $data->total = $request->total ?: 0;
        $data->phone_code = $request->phone_code;
        $data->phone = trim($request->phone_code . ' ' . preg_replace('/\s+/', ' ', trim((string) $request->phone)));
        $data->hotel_category = $request->hotel_category;
        $data->travel_date = $flexibleDate ? null : $request->travel_date;
        $data->date_type = $isQuote ? $request->date_type : 'specific';
        $data->nationality = $isQuote ? null : $request->nationality;
        $data->request_type = $isQuote ? 'quote' : 'enquiry';
        $data->nguoilon = (int) $request->travellers;
        $data->treem = 0;
        $data->note = $isQuote ? null : $request->note;
        $data->save();
        if ($data) {
            $setting = Setting::first();
            $tour = Product::find($request->tour_id);
            $tourTitle = $tour ? languageName($tour->name) : ('Tour #' . (int) $request->tour_id);
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
                        Mail::to($to)->send(new TourBookingMail($data, $tourTitle, false));
                    }
                }
                $customerEmail = trim((string) $request->email);
                if ($customerEmail !== '' && filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
                    Mail::to($customerEmail)->send(new TourBookingMail($data, $tourTitle, true));
                }
            } catch (\Throwable $e) {
                Log::error('Tour booking email failed: ' . $e->getMessage(), [
                    'bill_id' => $data->id,
                    'exception' => $e,
                ]);
            }

            return view('product.booktoursuccess', compact('data'));
        }
    }
    public function flashSale()  {
        $data['list'] = Product::where(['status'=>1,'discountStatus'=>1])
        ->orderBy('id','DESC')
        ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','description','status_variant','variant')
        ->paginate(20);
        return view('product.flash_sale',$data);
    }
    public function allListCate($danhmuc, Request $request)
    {
        $product = Product::where('status', 1)
            ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','description','status_variant','variant','hang_muc','origin','thickness');

        // Default on category page: keep current category unless user explicitly submitted cate_filter in URL/form.
        if (!$request->has('cate_filter')) {
            $product = $product->where('cate_slug', $danhmuc);
        }

        $data['list'] = $this->applyListFilters($request, $product)->paginate(12)->appends($request->query());
        $data['cateno'] = Category::where('slug',$danhmuc)->first(['id','name','avatar','content','slug']);
        
        $data['bannerPage'] = $data['cateno']->avatar ?? '';
        $data['title'] = languageName($data['cateno']->name);
        $data['content'] = $data['cateno']->content;
        $data['cate_slug'] = $data['cateno']->slug;
        $data['type_slug'] = '';
        $data['type_two_slug'] = '';
        $data['filter'] = TagCate::with(['tags'])->get();
        return view('product.list',$data);
    }
    public function allListType($danhmuc,$loaidanhmuc, Request $request){
        $product = Product::where(['status'=>1,'cate_slug'=>$danhmuc,'type_slug'=>$loaidanhmuc])
            ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','description','status_variant','variant','hang_muc','origin','thickness');
        $data['list'] = $this->applyListFilters($request, $product)->paginate(20)->appends($request->query());
        $data['type'] = TypeProduct::where('slug',$loaidanhmuc)->first(['id','name','cate_id','content','slug']);
        $cate_id = $data['type']->cate_id;
        $data['cateno'] = Category::where('slug',$danhmuc)->first(['id','name','avatar','content','slug']);
        $data['filter'] = TagCate::with(['tags'])->get();
        
        $data['cate_slug'] = $data['cateno']->slug;
        $data['type_slug'] = $data['type']->slug;
        $data['type_two_slug'] = "";

        $data['title'] = languageName($data['type']->name);
        $data['content'] = $data['type']->content;
        return view('product.list',$data);
    }
    public function allListTypeTwo($danhmuc,$loaidanhmuc,$thuonghieu, Request $request){
        $product = Product::where(['status'=>1,'cate_slug'=>$danhmuc,'type_slug'=>$loaidanhmuc,'type_two_slug'=>$thuonghieu])
            ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','description','status_variant','variant','hang_muc','origin','thickness');
        $data['list'] = $this->applyListFilters($request, $product)->paginate(20)->appends($request->query());
        $data['typetwo'] = TypeProductTwo::where('slug',$thuonghieu)->first(['id','name','cate_id','content','slug']);
        $data['cateno'] = Category::where('slug',$danhmuc)->first(['id','name','avatar','content','slug']);
        $data['type'] = TypeProduct::where('slug',$loaidanhmuc)->first(['id','name','cate_id','content','slug']);

        $data['cate_slug'] = $data['cateno']->slug;
        $data['type_slug'] = $data['type']->slug;
        $data['type_two_slug'] = $data['typetwo']->slug;
        $data['filter'] = TagCate::with(['tags'])->get();
        $data['title'] = languageName($data['typetwo']->name);
        $data['content'] = $data['typetwo']->content;
        return view('product.list',$data);
    }
    public function tag($tag, Request $request)
    {
            $product = Product::where('status',1)
            ->whereJsonContains('tags', $tag)
            ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','description','status_variant','variant','hang_muc','origin','thickness');
            $data['list'] = $this->applyListFilters($request, $product)->paginate(12)->appends($request->query());
            
            $tag = Tags::where('slug',$tag)->first();
            $data['cateno'] = Category::where('id',$tag->cate_product_id)->first(['id','name','avatar','content','slug']);
            // $cate_id = $data['cateno']->id;
            // $data['cateid'] = $cate_id;
            $data['title'] = $tag->name;
            $data['content'] = $data['cateno']->content ?? 'none';
            $data['bannerPage'] = $tag->image ?? '';
            $data['cate_slug'] = $data['cateno']->slug ?? '';
            $data['type_slug'] = '';
            $data['type_two_slug'] = '';
            $data['filter'] = TagCate::with(['tags'])->get();
        return view('product.list',$data);
    }
    public function CateProList($cate)
    {
        $data['list'] = Product::with('customer','cate')
        ->where('category',$cate)
        ->orderBy('id','ASC')
        ->paginate(12);
        $data['cate'] = Category::where('id',$cate)->first();
        return view('product.list',$data);
    }
    public function TypeProList($type)
    {
        $data['list'] = Product::with('customer','cate')
        ->where('type_cate',$type)
        ->orderBy('id','ASC')
        ->paginate(12);
        $cate = TypeProduct::where('id',$type)->first();
        $data['title_page'] = languageName($cate->name);
        return view('product.list',$data);
    }
    public function getproajax(Request $request)
    {
        if($request->cate == "all"){
            $product = Product::where([
                ['status', '=', 1]
            ])->limit(9)->orderBy('id','ASC')->get(['id','name','discount','price','images','status_variant','variant']);
        }else{
            $product =  Product::where(['status'=>1,'category'=>$request->cate])
            ->orderBy('id','DESC')
            ->select('id','category','name','discount','price','images')
            ->get();
        }
        $view = view("layouts.product.getproajax",compact('product'))->render();
        return response()->json(['html'=>$view]);
    }
    public function filterProduct(Request $request)
    {
        $product = Product::query();

        if( isset($request->fillter) ){
            foreach($request->fillter as $item){
                $product = $product->orWhereJsonContains('tags', $item);
            }
        }

        // if(isset($request->pricemin) && isset($request->pricemax)){
        //     $product = $product->whereBetween('price', [$request->pricemin, $request->pricemax]);
        // }

        

        
        if(isset($request->sortby)){
            if($request->sortby == "price-asc"){
                $product = $product->orderBy('price','ASC');
            }elseif($request->sortby == "price-desc"){
                $product = $product->orderBy('price','DESC');
            }elseif($request->sortby =="created-asc"){
                $product = $product->orderBy('id','DESC');
            }else{
                $product = $product; 
            }
        }

        if($request->cate_filter){
            $product = $product->where('cate_slug',$request->cate_filter);
        }elseif($request->cate ){
            $product = $product->where('cate_slug',$request->cate);
        }
        if( $request->type != null ){
            // dd(1);
            $product = $product->where('type_slug',$request->type);
        }
        if($request->typetwo != null ){
            // dd(3);
            $product = $product->where('type_two_slug',$request->typetwo);
        }
        if($request->duration_range){
            $durationExpr = "CAST(REGEXP_SUBSTR(hang_muc, '[0-9]+') AS UNSIGNED)";
            if($request->duration_range === '1-3'){
                $product = $product->whereRaw("$durationExpr BETWEEN 1 AND 3");
            }elseif($request->duration_range === '3-5'){
                $product = $product->whereRaw("$durationExpr BETWEEN 3 AND 5");
            }elseif($request->duration_range === '5-7'){
                $product = $product->whereRaw("$durationExpr BETWEEN 5 AND 7");
            }elseif($request->duration_range === '7-10'){
                $product = $product->whereRaw("$durationExpr BETWEEN 7 AND 10");
            }elseif($request->duration_range === '10+'){
                $product = $product->whereRaw("$durationExpr > 10");
            }elseif($request->duration_range === '30+'){
                $product = $product->whereRaw("$durationExpr > 30");
            }
        }


        $product = $product->where('status',1)->paginate(20);
        
        $view = view("layouts.product.filter_item",compact('product'))->render();
        // dd($product->count());
        return response()->json([
            'html'=>$view
        ]);
    }
    public function removeWishList(Request $request){
        if($request->pro_id) {
            $wishlist = session()->get('wishlist');
            if(isset($wishlist[$request->pro_id])) {
                unset($wishlist[$request->pro_id]);
                session()->put('wishlist', $wishlist);
            }
            return response()->json($wishlist);
        }
    }
    public function addWishList(Request $request){
        // $request->session()->forget('wishlist');
        $oldProduct = session()->get('wishlist', []);
        if (!isset($oldProduct[$request->pro_id])) {
            $product = Product::where('id',$request->pro_id)->first();
            $oldProduct[$request->pro_id] = [
                'id'=> $request->pro_id,
                'image'=> json_decode($product->images)[0],
                'name'=>$product->name,
                'slug'=>$product->slug,
                'status_variant'=> $product->status_variant,
                'price'=>$product->price,
                'discount'=>$product->discount,
                'cate_slug'=>$product->cate_slug,
                'type_slug'=>$product->type_slug
            ];
            session()->put('wishlist', $oldProduct);
            
        }
        return response()->json($oldProduct);
    }
    public function listWishList(){
        return view('product.wishlist');
    }
    public function detail_product($cate,$type,$id)
    {
        
        $data['serviceCat'] = ServiceCate::with(['services'])->get();
        $data['product'] = Product::with([
            'cate' => function ($query) {
                $query->where('status',1)->limit(5)->select('id','name','avatar','slug'); 
            },
        ])->where('slug',$id)->first();
       $data['terms'] = PageContent::where(['slug'=>'booking-terms-conditions','language'=>'vi'])->first(['id','title','content']);
        // $data['goiy'] = Product::where('status',1)->limit(8)->get(['id','name','images','discount','price','slug','cate_slug','type_slug']);
        $data['productlq'] = Product::where('category',$data['product']->category)->limit(8)->get(['id','category','name','status_variant','discount','price','images','slug','cate_slug','type_slug','description']);
        // $data['news'] = Blog::where('status',1)->limit(8)->get();
        return view('product.detail',$data);
    }
    public function autosearchcomplete(Request $request)
    {
        $data = Product::where("name","LIKE",'%'.$request->keyword.'%')->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','description','status_variant')->orderBy('id','DESC')
                  ->limit(8)->get();
        $view = view("layouts.product.search_render",compact('data'))->render();
        return response()->json([
            'html'=>$view
        ]);
    }
    public function compare(Request $request)
    {
        // session()->forget('compareProduct');
        $id = $request->id;
        $data['product'] = Product::where('id',$id)->first(['id','name','images','category','discount','price','size','cate_slug','status_variant','type_slug','slug']);
        $compare = session()->get('compareProduct', []);
        if(isset($compare[$id])) {
            session()->put('compareProduct', $compare);
            return response()->json([
                'message' => 'exist'
            ]);
        }
        else {
            if(empty($compare)){
                $compare[$id] = [
                    "idpro" => $id,
                    "name" => $data['product']->name,
                    'image'=> json_decode($data['product']->images)[0],
                    'status_variant'=> $data['product']->status_variant,
                    'price'=> $data['product']->price,
                    'size'=>json_decode($data['product']->size),
                    'discount'=> $data['product']->discount,
                    'cate_slug'=>$data['product']->cate_slug,
                    'type_slug'=>$data['product']->type_slug,
                    'pro_slug'=> $data['product']->slug,
                    'cate'=>$data['product']->category
                ];
            }else{
                foreach($compare as $val){
                    if($data['product']->category != $val['cate']){
                        return response()->json([
                            'data'=> [],
                            'message' => 'error'
                        ]);
                    }
                }
                if(count($compare) == 2){
                    return response()->json([
                        'data'=> [],
                        'message' => 'limit3'
                    ]);
                }else{
                    $compare[$id] = [
                        "idpro" => $id,
                        "name" => $data['product']->name,
                        'image'=> json_decode($data['product']->images)[0],
                        'status_variant'=> $data['product']->status_variant,
                        'price'=> $data['product']->price,
                        'size'=>json_decode($data['product']->size),
                        'discount'=> $data['product']->discount,
                        'cate_slug'=>$data['product']->cate_slug,
                        'type_slug'=>$data['product']->type_slug,
                        'pro_slug'=> $data['product']->slug,
                        'cate'=>$data['product']->category
                    ];
                }
                
            }
            session()->put('compareProduct', $compare);
            $compareProduct = session()->get('compareProduct', []);
            
            return response()->json([
                'data'=> $compareProduct,
                'qty'=> count($compareProduct),
                'message' => 'success'
            ]);
            
        }
        
    }
    public function removeCompare(Request $request)
    {
        if($request->id) {
            $compare = session()->get('compareProduct');
            if(isset($compare[$request->id])) {
                unset($compare[$request->id]);
                session()->put('compareProduct', $compare);
            }
            $list = session()->get('compareProduct', []);
            $view = view("layouts.product.compare",compact('list'))->render();
            return response()->json(['html'=>$view]);
        }

        
    }
    public function compareList()
    {
        $data['list'] = session()->get('compareProduct', []);
        return view('compare.product',$data);
    }
    public function searchResult(Request $request)
    {
        $keyword = $request->keywordsearch;
         $data['product'] = Product::where('name', 'LIKE', '%'.$keyword.'%')->where('status',1)
         ->paginate(18);
         $data['keyword'] = $keyword;
         return view('product.search_result',$data);
    }
    public function getSku(Request $request)
    {
        $data = VariantSkuValue::where(['product_id'=>$request->id,'version'=>$request->value])->first();
        return response()->json([
            'data'=> $data,
            'message' => 'success'
        ]);
    }
}
