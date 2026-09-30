@extends('layouts.main.master')
@section('title')
{{$title_page}} 
@endsection
@section('description')
Tin tức cập nhật
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('css')
@endsection
@section('content')

<div class="banner-wrapper no_background">
   <div class="banner-wrapper-inner">
      <nav class="akasha-breadcrumb">
         <a href="{{route('home')}}">Home</a>
         <i class="fa fa-angle-right"></i>
         <a href="#">Tin tức</a>
      </nav>
   </div>
</div>
<div class="banner-wrappers">
   <div class="banner-wrapper-inners">
       <h1 class="page-titles">Tin tức</h1>
   </div>
</div>
<div class="link-bar">
   <div class="container">
      <div class="link-bar__wrapper">
         <span class="link-bar__title heading heading--small text--subdued">View</span>
         <div class="link-bar__scroller hide-scrollbar">
            <ul class="link-bar__linklist list--unstyled" role="list">
               <li class="link-bar__link-item link-bar__link-item--selected" style="scroll-snap-align: none;">
                  <a href="{{route('allListBlog')}}" class="link-bar__link link--animated text--underlined">Tất cả</a>
               </li>
               @foreach ($blogCate as $item)
               <li class="link-bar__link-item ">
                  <a href="{{route('listCateBlog',['slug'=>$item->slug])}}" class="link-bar__link link--animated " title="{{languageName($item->name)}}">{{languageName($item->name)}}</a>
               </li>
               @endforeach
            </ul>
         </div>
      </div>
   </div>
</div>

<div class="main-container no-sidebar">
   <!-- POST LAYOUT -->
   <div class="container">
       <div class="row">
           <div class="main-content col-md-12 col-sm-12">
               <div class="blog-grid auto-clear content-post row">
                  @if (count($blog) > 0)
                     @foreach ($blog as $item)
                     <article class="post-item post-grid col-bg-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-ts-12 post-195 post type-post status-publish format-standard has-post-thumbnail hentry category-light category-table category-life-style tag-light tag-life-style">
                        <div class="post-inner">
                            <div class="post-thumb">
                                <a href="{{route('detailBlog',['slug'=>$item->slug])}}">
                                    <img src="{{$item->image}}" class="img-responsive attachment-370x330 size-370x330" alt="img"> 
                                 </a>
                            </div>
                            <div class="post-content">
                                <div class="post-meta">
                                    <div class="post-author">
                                        By:<a href="#">
                                        admin </a>
                                    </div>
                                    <div class="post-comment-icon">
                                        <a href="#">
                                          {{date_format($item->created_at,'d/m/Y')}}</a>
                                    </div>
                                </div>
                                <div class="post-info equal-elem">
                                    <h2 class="post-title"><a href="{{route('detailBlog',['slug'=>$item->slug])}}">{{languageName($item->title)}}</a></h2>
                                    <div class="line_3">{{languageName($item->description)}}</div>
                                </div>
                            </div>
                        </div>
                    </article>
                     @endforeach
                  @else  
                    <h3>Nội dung đang cập nhật...</h3>
                  @endif
               </div>
               <nav class="navigation pagination">
                   {{$blog->links()}}
               </nav>
           </div>
       </div>
   </div>
</div>
@endsection