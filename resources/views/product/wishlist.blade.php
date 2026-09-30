@extends('layouts.main.master')
@section('title')
{{getLanguage('danhsachyeuthich')}}
@endsection
@section('description')
{{getLanguage('danhsachyeuthich')}}
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('js')
@endsection
@section('css')
@endsection
@section('content')
<section class="section-bg layout-pt-lg layout-pb-lg">
   <div class="section-bg__item col-12">
      <img src="{{url('frontend/img/about.png')}}" alt="image">
   </div>
   <div class="container">
      <div class="row justify-center text-center">
         <div class="col-xl-6 col-lg-8 col-md-10">
            <h1 class="text-40 md:text-25 fw-600 text-white">{{getLanguage('danhsachyeuthich')}}</h1>
            <div class="col-auto">
               <div class="text-center x-gap-10 y-gap-5 items-center text-14 text-light-1" style="display: inline-flex;">
                 <div class="col-auto">
                   <div class="text-white">Home</div>
                 </div>
                 <div class="col-auto">
                   <div class="text-white">&gt;</div>
                 </div>
                 <div class="col-auto">
                   <div class="text-white">{{getLanguage('danhsachyeuthich')}}</div>
                 </div>
               </div>
             </div>
         </div>
      </div>
   </div>
</section>
<section class="layout-pt-md layout-pb-lg">
   <div class="container">
      <div class="row y-gap-30">
         <div class="col-xl-12 col-lg-12">
            <div class="row y-gap-30">
               @if (count($wishlist) > 0)
               @foreach ($wishlist as $item)
               <div class="col-lg-3 col-sm-6">
                  <a href="{{route('detailProduct',['cate'=>$item['cate_slug'],'type'=>$item['type_slug'] ? $item['type_slug'] : 'type','id'=>$item['slug']])}}" class="rentalCard -type-1 rounded-4 ">
                     <div class="rentalCard__image">
                        <div class="cardImage ratio ratio-1:1">
                           <div class="cardImage__content">
                              <img class="rounded-4 col-12" src="{{$item['image']}}" alt="image">
                           </div>
                        </div>
                     </div>
                     <div class="rentalCard__content mt-10">
                        <h4 class="rentalCard__title text-dark-1 text-18 lh-16 fw-500">
                           <span>{{$item['name']}}</span>
                        </h4>
                        <p class="text-light-1 lh-14 text-13 mt-5"></p>
                        <div class="row justify-between items-center pt-15">
                         <div class="col-auto">
                           <div class="d-flex items-center">
                             <div class="d-flex items-center x-gap-5">
                               <a class="button -md h-30 bg-blue-1 text-white" href="javascript:;" onclick="removeWishlist({{$item['id']}})">{{getLanguage('delete')}}</a>
                             </div>
                           </div>
                         </div>
                  
                         <div class="col-auto">
                           <div class="text-14 text-light-1">
                              {{getLanguage('StartingForm')}}
                             <span class="text-16 fw-500 text-dark-1"> {{number_format(languageName($item['price']))}}{{getLanguage('tiente')}}</span>
                           </div>
                         </div>
                       </div>
                     </div>
                  </a>
                  
               </div>
               @endforeach
              
               @else 
               <h5>The content is being updated...</h5>
               @endif
            </div>
         </div>
      </div>
   </div>
</section>



@endsection