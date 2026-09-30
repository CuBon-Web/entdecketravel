@extends('layouts.main.master')
@section('title')
Destination's {{$setting->company}}
@endsection
@section('description')
Destination's {{$setting->company}}
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
            <h1 class="text-40 md:text-25 fw-600 text-white">Destinations</h1>
            <div class="col-auto">
               <div class="text-center x-gap-10 y-gap-5 items-center text-14 text-light-1" style="display: inline-flex;">
                 <div class="col-auto">
                   <div class="text-white">Home</div>
                 </div>
                 <div class="col-auto">
                   <div class="text-white">&gt;</div>
                 </div>
                 <div class="col-auto">
                   <div class="text-white">Destinations</div>
                 </div>
               </div>
             </div>
         </div>
      </div>
   </div>
</section>
<section class="layout-pt-md layout-pb-md">
   <div data-anim-wrap class="container">
     <div class="row y-gap-20 pt-40">
      @foreach ($categoryhome as $key => $item)
      <div data-anim-child="slide-left delay-{{$key+3}}" class="col-lg-6 col-sm-6">
         <a href="{{route('allListProCate',['danhmuc'=>$item->slug])}}" class="citiesCard -type-3 d-block rounded-4 ">
            <div class="citiesCard__image ratio ratio-1:1">
              <img class="img-ratio js-lazy" src="#" data-src="{{$item->imagehome}}" alt="image">
            </div>
            <div class="citiesCard__content px-30 py-30">
              <h4 class="text-26 fw-600 text-white">{{languageName($item->name)}}</h4>
              <div class="text-15 text-white">{{count($item->product)}} Tour</div>
            </div>
          </a>
       </div>
      @endforeach
     </div>
   </div>
 </section>
@endsection