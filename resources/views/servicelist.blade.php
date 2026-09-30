@extends('layouts.main.master')
@section('title')
{{languageName($cateService->name)}}
@endsection
@section('description')
{{$cateService->description}}
@endsection
@section('image')
{{url('frontend/images/12.jpg')}}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<div class="breadcrumb-section" style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%), url({{url('frontend/img/inner-banner-bg.png')}});">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 d-flex justify-content-center">
            <div class="banner-content">
               <h1>{{languageName($cateService->name)}}</h1>
               <ul class="breadcrumb-list">
                  <li><a href="{{route('home')}}">Home</a></li>
                  <li>{{languageName($cateService->name)}}</li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="package-grid-section pt-60 mb-60">
   <div class="container">
      <div class="row gy-5 mb-70">
       @if (count($list) > 0)
       @foreach ($list as $item)
           <div class="col-lg-3 col-md-6">
               <div class="destination-card2">
                   <a href="{{route('serviceDetail',['danhmuc'=>$item->cate_slug,'slug'=>$item->slug])}}" class="destination-card-img">
                      <img class="lazy loaded" src="{{$item->image}}" data-src="{{$item->image}}" alt="img" data-was-processed="true">
                   </a>
                   <div class="destination-card2-content">
                      <h4><a href="{{route('serviceDetail',['danhmuc'=>$item->cate_slug,'slug'=>$item->slug])}}">{{languageName($item->name)}}</a></h4>
                   </div>
                </div>
           </div>
       @endforeach
       @else 
           <h5>Nội dung đang cập nhật</h5>
       @endif
      </div>
      <div class="row">
         <div class="col-lg-12">
            <nav class="inner-pagination-area">
               {{$list->links()}}
            </nav>
         </div>
      </div>
   </div>
</div>

@endsection