@extends('layouts.main.master')
@section('title')
{{$pagecontentdetail->title}}
@endsection
@section('description')
{{$pagecontentdetail->title}}
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<div class="page-content">

   <!-- INNER PAGE BANNER -->
   <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image: url({{url('frontend/images/inr-banner.jpg')}});">
       <div class="overlay-main innr-bnr-olay"></div>
       <div class="wt-bnr-inr-entry">
           <div class="banner-title-outer">
               <div class="banner-title-name">
                   <h2 class="wt-title"> {{($pagecontentdetail->title)}}</h2>
               </div>
               <!-- BREADCRUMB ROW -->                            
               <div>
                   <ul class="wt-breadcrumb breadcrumb-style-2">
                       <li><a href="{{route('home')}}">Home</a></li>
                       <li>{{($pagecontentdetail->title)}}</li>
                   </ul>
               </div>
           </div>
           <!-- BREADCRUMB ROW END -->                        
       </div>
   </div>
   <!-- INNER PAGE BANNER END -->
 
   <!-- SECTION START -->
   <div class="section-full  p-t120 p-b90">
       <div class="container">
       
           <!-- BLOG SECTION START -->
           <div class="section-content">
               <div class="row d-flex justify-content-center">
               
                   <div class="col-xl-12 col-lg-12 col-md-12 m-b30">
                       <div class="trv-detail-main-wrap">
                         
                           <div class="trv-detail-bx-wrap">
                               <h1 class="trv-inner-title-lg">{{($pagecontentdetail->title)}}</h1>
                               <div class="trv-inr-para content">
                                 {!!($pagecontentdetail->content)!!}
                               </div>
 
 
 
                           </div>
                       </div> 
                   </div> 
                                         
                                               
               </div>
 
           </div>
           
       </div>
       
   </div> 
 </div>  
@endsection