@extends('layouts.main.master')
@section('title')
Gallery
@endsection
@section('description')
Gallery - Our activities
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('js')
@endsection
@section('css')
@endsection
@section('content')
<div class="page-content">

   <!-- INNER PAGE BANNER -->
   <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image: url({{$setting->facebook ?? url('frontend/images/inr-banner.jpg')}});">
       <div class="overlay-main innr-bnr-olay"></div>
       <div class="wt-bnr-inr-entry">
           <div class="banner-title-outer">
               <div class="banner-title-name">
                   <h2 class="wt-title">Gallery</h2>
               </div>
               <!-- BREADCRUMB ROW -->                            
               <div>
                   <ul class="wt-breadcrumb breadcrumb-style-2">
                       <li><a href="{{route('home')}}">Home</a></li>
                       <li>Gallery</li>
                   </ul>
               </div>
           </div>
           <!-- BREADCRUMB ROW END -->                        
       </div>
   </div>
   <!-- INNER PAGE BANNER END -->

   <!--GALLERY SECTION START-->
   <div class="section-full trv-gallery-wrap p-t60 p-b40">
       <div class="container">

           <!-- TITLE START-->
               <div class="section-head trv-head-title-wrap center-position">
                   <h2 class="trv-head-title"><span class="site-text-yellow">Best Memorable</span> Gallery!</h2>
                   <div class="trv-head-discription">Destinations worth exploring! Here are a few popular spots</div>
                   <div class="trv-head-title-image">
                       <img src="{{url('frontend/images/Title-Separator.png')}}" alt="Image">
                   </div>
               </div>
           <!-- TITLE END-->

           <div class="section-content">

               <div class="trv-gallery-section row">

                   @foreach($list as $item)
                   @php
                       $__albumImgs = $item->gallery_images;
                       $__thumb = count($__albumImgs) ? $__albumImgs[0] : null;
                   @endphp
                   <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
                       <div class="trv-gallery-st1 l-pic">
                           @if($__thumb)
                           <div class="trv-gallery-st1-media">
                               <img src="{{ url($__thumb) }}" alt="{{ $item->name }}">
                               <a class="elem trv-gallery-st1-btn" href="{{ url($__thumb) }}" title="{{ $item->name }}" data-lcl-txt="" data-lcl-author="" data-lcl-thumb="{{ url($__thumb) }}" data-lcl-group="album-{{ $item->id }}"><i class="bi bi-arrows-fullscreen"></i>
                               </a>
                               @foreach(array_slice($__albumImgs, 1) as $__extraImg)
                               <a class="elem" href="{{ url($__extraImg) }}" style="display:none;" title="{{ $item->name }}" data-lcl-txt="" data-lcl-author="" data-lcl-thumb="{{ url($__extraImg) }}" data-lcl-group="album-{{ $item->id }}"></a>
                               @endforeach
                               <h3 class="text-white" style="padding: 6px 0;">{{ $item->name }}</h3>
                           </div>
                           @else
                           <div class="trv-gallery-st1-media">
                               <p style="color: #999;">Chưa có ảnh</p>
                           </div>
                           @endif
                       </div>
                   </div>
                   @endforeach
                   
               </div>

                   
           </div> 

       </div>
   </div>
   <!--GALLERY TOUR SECTION END-->


</div>
@endsection

