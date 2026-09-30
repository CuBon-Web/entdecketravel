@extends('layouts.main.master')
@section('title')
{{languageName($blog_detail->title)}}
@endsection
@section('description')
{{languageName($blog_detail->description)}}
@endsection
@section('image')
{{url(''.$blog_detail->image)}}
@endsection
@section('schema')
<script type="application/ld+json">
{!! json_encode([
   '@context' => 'https://schema.org',
   '@type' => 'BlogPosting',
   'headline' => languageName($blog_detail->title),
   'description' => strip_tags(languageName($blog_detail->description)),
   'image' => [url('' . $blog_detail->image)],
   'datePublished' => optional($blog_detail->created_at)->toIso8601String(),
   'dateModified' => optional($blog_detail->updated_at)->toIso8601String(),
   'mainEntityOfPage' => url()->current(),
   'author' => [
      '@type' => 'Organization',
      'name' => config('app.name'),
   ],
   'publisher' => [
      '@type' => 'Organization',
      'name' => config('app.name'),
      'logo' => [
         '@type' => 'ImageObject',
         'url' => url('' . $setting->logo),
      ],
   ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<div class="page-content">

  <!-- INNER PAGE BANNER -->
  <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image: url({{$blog_detail->image ?? url('frontend/images/inr-banner.jpg')}});">
      <div class="overlay-main innr-bnr-olay"></div>
      <div class="wt-bnr-inr-entry">
          <div class="banner-title-outer">
              <div class="banner-title-name">
                  <h2 class="wt-title"> {{languageName($blog_detail->title)}}</h2>
              </div>
              <!-- BREADCRUMB ROW -->                            
              <div>
                  <ul class="wt-breadcrumb breadcrumb-style-2">
                      <li><a href="{{route('home')}}">Home</a></li>
                      <li><a href="{{route('allListBlog')}}">Blog</a></li>
                      <li>{{languageName($blog_detail->title)}}</li>
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
              
                  <div class="col-xl-8 col-lg-8 col-md-12 m-b30">
                      <div class="trv-detail-main-wrap">
                          <!--Top Image-->
                          <div class="trv-detail-media">
                              <img src="{{$blog_detail->image}}" alt="image">
                          </div>
                          <!--Info Image-->
                          <div class="trv-detail-bx-wrap">
                              <ul class="trv-post-meta">
                                  <li class="post-author">by Entdecken Travel</li>
                                  <li class="post-comment">{{date_format($blog_detail->created_at,'d/m/Y')}}</li>
                                  <li class="post-time">Tour Guide</li>
                              </ul>
                              <h1 class="trv-inner-title-lg">{{languageName($blog_detail->title)}}</h1>
                              <div class="trv-inr-para content">
                                {!!languageName($blog_detail->content)!!}
                              </div>



                          </div>
                      </div> 
                  </div> 
                  
                  <!-- SIDE BAR START -->
                  <div class="col-xl-4 col-lg-4 col-md-12 rightSidebar  m-b30">
                  
                      <aside  class="side-bar">


                          <!-- RECENT POSTS -->
                          <div class="widget trv-recent-posts">
                              <div class="m-b20">
                                  <h4 class="widget-title">Recent Posts</h4>
                              </div>
                              <div class="trv-recent-posts-bx">
                                @foreach ($blognew as $item)
                                  <div class="trv-rc-po-st1">
                                      <div class="post-date"><span>{{date_format($item->created_at,'d')}}</span>{{date_format($item->created_at,'M')}}</div>                                        
                                      <div class="trv-post-info">
                                          {{-- <div class="post-category">by Entdecken Travel</div> --}}
                                          <div class="trv-post-title ">
                                              <h5 class="post-title"><a href="{{route('detailBlog',['slug'=>$item->slug])}}">{{languageName($item->title)}}</a></h5>
                                          </div>
                                      </div>                                
                                  </div>
                                @endforeach
                              </div>
                              
                          </div>

                          <!-- Top Destinations -->   
                          <div class="widget widget_services">
                              <div class="m-b20">
                                  <h4 class="widget-title">Top Destinations</h4>
                              </div>
                              <ul>
                                @foreach ($categoryhome as $item)
                                <li><a href="{{route('listCateBlog',['slug'=>$item->slug])}}">{{languageName($item->name)}}</a><span class="badge">( {{count($item->product)}} Listing )</span></li>
                                @endforeach
                              </ul>
                          </div>  

                          <!-- GALLERY -->
                          <div class="widget widget_gallery">
                              <div class="m-b20">
                                  <h4 class="widget-title">Gallery</h4>
                              </div>
                              <div class="tw-sidebar-gallery">
                                  <ul>
                                    @foreach ($gallery as $item)
                                      @php $__gimgs = $item->gallery_images; @endphp
                                      @if(count($__gimgs))
                                      <li>
                                          <div class="tw-service-gallery-thumb">
                                              <a class="elem" href="{{ url($__gimgs[0]) }}" title="{{ $item->name }}" data-lcl-author="" data-lcl-thumb="{{ url($__gimgs[0]) }}" data-lcl-group="sidebar-album-{{ $item->id }}">
                                                  <img src="{{ url($__gimgs[0]) }}" alt="">
                                                  <i class="fa fa-file-image"></i>
                                              </a>
                                              @foreach(array_slice($__gimgs, 1) as $imgPath)
                                              <a class="elem" href="{{ url($imgPath) }}" style="display:none;" title="{{ $item->name }}" data-lcl-author="" data-lcl-thumb="{{ url($imgPath) }}" data-lcl-group="sidebar-album-{{ $item->id }}"></a>
                                              @endforeach
                                          </div>
                                      </li>
                                      @endif
                                      @endforeach 
                                      
                                  </ul>
                              </div> 
                          </div> 

                          

                      </aside>

                  </div>
                  <!-- SIDE BAR END -->                          
                                              
              </div>

          </div>
          
      </div>
      
  </div> 
</div>  
@endsection