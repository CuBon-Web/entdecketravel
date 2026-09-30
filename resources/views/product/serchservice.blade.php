@extends('layouts.main.master')
@section('title')
Kết Quả Tìm Kiếm Dịch vụ
@endsection
@section('description')
Danh sách Kết Quả Tìm Kiếm Dịch Vụ
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('js')
@endsection
@section('css')
@endsection
@section('content')
<div class="breadcrumb-section" style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%), url({{url('frontend/img/inner-banner-bg.png')}});">
    <div class="container">
       <div class="row">
          <div class="col-lg-12 d-flex justify-content-center">
             <div class="banner-content">
                <h1>Kết Quả Tìm Kiếm Tour</h1>
                <ul class="breadcrumb-list">
                   <li>Có {{count($service)}} kết quả phù hợp</li>
                </ul>
             </div>
          </div>
       </div>
    </div>
 </div>
 <div class="package-grid-section pt-60 mb-60">
    <div class="container">
       <div class="row gy-5 mb-70">
        @if (count($service) > 0)
        @foreach ($service as $item)
            <div class="col-lg-3 col-md-6">
                <div class="destination-card2">
                    <a href="{{route('serviceDetail',['danhmuc'=>$item->cate_slug,'slug'=>$item->slug])}}" class="destination-card-img">
                       <img class="lazy loaded" src="{{$item->image}}" data-src="{{$item->image}}" alt="img" data-was-processed="true">
                    </a>
                    <div class="destination-card2-content">
                       <h4><a href="{{route('serviceDetail',['danhmuc'=>$item->cate_slug,'slug'=>$item->slug])}}">{{$item->name}}</a></h4>
                    </div>
                 </div>
            </div>
        @endforeach
        @else 
            <h5>Không tìm thấy kết quả phù hợp...</h5>
        @endif
       </div>
       <div class="row">
          <div class="col-lg-12">
             <nav class="inner-pagination-area">
                {{$service->links()}}
             </nav>
          </div>
       </div>
    </div>
 </div>
@endsection