@extends('layouts.main.master')
@section('title')
Kết Quả Tìm Kiếm Tour
@endsection
@section('description')
Danh sách Kết Quả Tìm Kiếm Tour
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
            <h1 class="text-40 md:text-25 fw-600 text-white">Kết Quả Tìm Kiếm Tour</h1>
            <div class="col-auto">
               <div class="text-center x-gap-10 y-gap-5 items-center text-14 text-light-1" style="display: inline-flex;">
                 <div class="col-auto">
                   <div class="text-white">Home</div>
                 </div>
                 <div class="col-auto">
                   <div class="text-white">&gt;</div>
                 </div>
                 <div class="col-auto">
                   <div class="text-white">Kết Quả Tìm Kiếm Tour</div>
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
               @if (count($product) > 0)
               @foreach ($product as $item)
               <div class="col-lg-3 col-sm-6">
                  @include('layouts.product.item',['pro'=>$item])
               </div>
               @endforeach
              
               @else 
               <h5>The content is being updated...</h5>
               @endif
            </div>
            <div class="border-top-light mt-30 pt-30">
               {{$product->links()}}
            </div>
         </div>
      </div>
   </div>
</section>




@endsection