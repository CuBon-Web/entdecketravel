@extends('layouts.main.master')
@section('title')
    {{ $setting->company }}
@endsection
@section('description')
    {{ $setting->webname }}
@endsection
@section('image')
    {{ url('' . $banner[0]->image) }}
@endsection
@section('schema')
    <script type="application/ld+json">
{!! json_encode([
   '@context' => 'https://schema.org',
   '@type' => 'WebPage',
   'name' => $setting->company,
   'url' => url()->current(),
   'description' => $setting->webname,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
@endsection
@section('css')
@endsection
@section('js')
    {{-- <script>
        $(function() {
            $(document).on('change', '.js-auto-filter', function() {
                $('#product-filter-form').submit();
            });
            $(document).on('click', '.trv-filter-btn[data-target]', function() {
                var target = $(this).attr('data-target');
                var $el = $('#' + target);
                if ($el.length) {
                    $el.slideToggle(150);
                }
            });
            $(document).on('click', '.js-reset-filter', function(e) {
                e.preventDefault();
                window.location.href = window.location.pathname;
            });
        });
    </script> --}}
@endsection
@section('content')
    <!-- CONTENT START -->
    <div class="page-content">

        <!-- Banner Style One -->
        <div class="swiper trv_d-slider">
            <div class="swiper-wrapper">
                @forelse ($banner as $item)
                    <div class="swiper-slide">
                        <div class="trv-banner-1-wrap">
                            {{-- <div class="trv-banner-1-rain-effect">
                                <div class="rain front-row"></div>
                                <div class="rain back-row"></div>
                            </div> --}}
                            <div class="trv-vid-full"
                                style="background-image:url('{{ url($item->image) }}'); background-size:cover; background-position:center;"></div>

                            <div class="trv-banner-1-overlay">
                                <div class="trv-banner-1-text">
                                    <span class="trv-banner-1-text-small" data-swiper-parallax="-180"
                                        data-swiper-parallax-duration="900">{{ $item->subtitle ? $item->subtitle : 'Welcome to Vietnam' }}</span>
                                    <div class="trv-banner-1-text-mid">
                                        <h1 class="trv-banner-1-text-large"
                                            data-swiper-parallax="-260" data-swiper-parallax-duration="1000"
                                            title="{!! $item->title ? $item->title : 'Vietnam' !!}">
                                            {!! $item->title ? $item->title : 'Vietnam' !!}
                                            {{-- <img loading="lazy" class="trv-btrfly" src="/frontend/images/butterfly.gif"
                                                alt="image"> --}}
                                        </h1>
                                        {{-- <h1 class="trv-banner-1-text-large-outline"
                                            data-swiper-parallax="-320" data-swiper-parallax-duration="1050"
                                            title="{{ $item->title ?: getLanguage('vietnam') }}">
                                            {{ $item->title ?: getLanguage('vietnam') }}</h1> --}}
                                    </div>
                                    {{-- <span class="trv-banner-rock-pic" data-swiper-parallax="-120"
                                        data-swiper-parallax-duration="1100">
                                        <img loading="lazy" src="/frontend/images/Rock.png" alt="Image">
                                    </span> --}}
                                    <div class="trv-banner-text-detail" data-swiper-parallax="-200"
                                        data-swiper-parallax-duration="1150">
                                        {{ $item->description ?: "The Safety of our customers at all stages" }}
                                    </div>
                                    <div class="trv-banner-btn" data-swiper-parallax="-260"
                                        data-swiper-parallax-duration="1200">
                                        <a href="{{ $item->link ?: route('allProduct') }}"
                                            class="site-button butn-bg-shape">Get In Touch</a>
                                    </div>
                                </div>

                                <div class="trv-banner-1-social">
                                    <span>Follow Us</span>
                                    <ul>
                                        <li><a href="javascript:;"><i class="feather feather-facebook"></i></a></li>
                                        <li><a href="javascript:;"><i class="feather feather-linkedin"></i></a></li>
                                        <li><a href="javascript:;"><i class="feather feather-instagram"></i></a></li>
                                        <li><a href="javascript:;"><i class="bi bi-twitter-x"></i></a></li>
                                    </ul>
                                </div>

                                {{-- <div class="twm-img-bg-circle-area">
                                    <div class="twm-img-bg-circle1-wrap">
                                        <div class="twm-img-bg-circle1 rotate-center"><span></span></div>
                                    </div>
                                    <div class="twm-img-bg-circle2-wrap">
                                        <div class="twm-img-bg-circle2 rotate-center-reverse"><span></span></div>
                                    </div>
                                    <div class="twm-img-bg-circle3-wrap">
                                        <div class="twm-img-bg-circle3 rotate-center"><span></span></div>
                                    </div>
                                </div> --}}
                            </div>

                            {{-- <div class="tvr-banner-1-bottom-left">
                                <div class="media">
                                    <img loading="lazy" src="/frontend/images/lizard.png" alt="Image" class="lizard">
                                    <img loading="lazy" src="/frontend/images/li-eye.gif" alt="image" class="lizard-eye">
                                </div>
                            </div>
                            <div class="trv-cloud-1">
                                <div class="marquee-hm1-cloud1">
                                    <img loading="lazy" src="/frontend/images/cloud-1.png" alt="Image">
                                </div>
                            </div>
                            <div class="trv-cloud-2">
                                <div class="marquee-hm1-cloud2">
                                    <img loading="lazy" src="/frontend/images/cloud-2.png" alt="Image">
                                </div>
                            </div> --}}
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide">
                        <div class="trv-banner-1-wrap">
                            <video muted autoplay playsinline loop class="trv-vid-full">
                                <source src="/frontend/images/video-1.mp4" type="video/mp4">
                            </video>
                        </div>
                    </div>
                @endforelse
            </div>
            {{-- <div class="swiper-pagination"></div> --}}
        </div>
        <!-- Banner Style One End -->

        <!-- SEARCH BAR START-->
        <div class="trv-search-st1-wrap">
            <div class="trv-search-st1">
                <div class="trv-search-st1-bg">
                    <form id="product-filter-form" method="GET" action="{{ route('allProduct') }}">
                        <div class="trv-search-st1-column-wrap">
                            <div class="trv-search-st1-column">
                                <div class="form-group">
                                    <label><i><img loading="lazy" src="/frontend/images/icon1.png"
                                                alt="Image"></i>Destinations</label>
                                    <select class="form-select form-control js-auto-filter" aria-label="Default select example"
                                        name="cate_filter">
                                        <option value="">All</option>
                                        @foreach ($categoryhome as $item)
                                            <option value="{{ $item->slug }}" {{ request('cate_filter') == $item->slug ? 'selected' : '' }}>
                                                {{ languageName($item->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="trv-search-st1-column">
                                <div class="form-group form-group-2column-wrap twm-input-with-icon">
                                    <label><i><img loading="lazy" src="/frontend/images/icon3.png"
                                                alt="Image"></i>Duration</label>
                                    <select class="form-select form-control js-auto-filter" aria-label="Default select example"
                                        name="duration_range">
                                        <option value="">All</option>
                                        <option value="1-3" {{ request('duration_range') == '1-3' ? 'selected' : '' }}>1-3 days</option>
                                        <option value="4-7" {{ request('duration_range') == '4-7' ? 'selected' : '' }}>4-7 days</option>
                                        <option value="8-11" {{ request('duration_range') == '8-11' ? 'selected' : '' }}>8-11 days</option>
                                        <option value="12-15" {{ request('duration_range') == '12-15' ? 'selected' : '' }}>12-15 days</option>
                                        <option value="16-20" {{ request('duration_range') == '16-20' ? 'selected' : '' }}>16-20 days</option>
                                        <option value="21-23" {{ request('duration_range') == '21-23' ? 'selected' : '' }}>21-23 days</option>
                                        <option value="24-27" {{ request('duration_range') == '24-27' ? 'selected' : '' }}>24-27 days</option>
                                        <option value="28-31" {{ request('duration_range') == '28-31' ? 'selected' : '' }}>28-31 days</option>
                                        <option value="32+" {{ request('duration_range') == '32+' ? 'selected' : '' }}>32+ days</option>
                                    </select>
                                </div>
                            </div>
                            @if (!empty($filter) && count($filter) > 0)
                                @foreach ($filter as $filterItem)
                                    @if (!empty($filterItem->tags) && count($filterItem->tags) > 0)
                                        <div class="trv-search-st1-column">
                                            <div class="form-group">
                                                <label><i><img loading="lazy" src="/frontend/images/travelstyle.png" alt="Image"></i>{{ languageName($filterItem->name) }}</label>
                                                <select class="form-select form-control js-auto-filter" aria-label="Default select example" name="fillter[]">
                                                    <option value="">All</option>
                                                    @foreach ($filterItem->tags as $tag)
                                                        <option value="{{ $tag->slug }}" {{ in_array($tag->slug, (array) request('fillter', [])) ? 'selected' : '' }}>
                                                            {{ languageName($tag->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
 
                            <div class="trv-search-st1-column-last">
                                <div class="trv-search-st1-search-btn">
                                    <button type="submit" class="srch-btn"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
        <!-- SEARCH BAR END-->

        <!--POPULAR DESTINATION SECTION START-->
        <div class="section-full p-t40 p-b90 trv-popular-destination tvr-hot-ballon-wrap"
            style="background-image: url(/frontend/images/Cloud-bg.png)">
            <div class="container">
                <!-- TITLE START-->
                <div class="section-head trv-head-title-wrap center-position">
                    <h2 class="trv-head-title"><span class="site-text-yellow">{{getLanguage('featured')}}
                        </span>{{getLanguage('destinations')}}</h2>
                    <div class="trv-head-discription">{{getLanguage('destinations_description')}}</div>
                    <div class="trv-head-title-image">
                        <img loading="lazy" src="/frontend/images/Title-Separator.png" alt="Image">
                    </div>
                </div>
                <!-- TITLE END-->

                <div class="section-content">

                    <div class="swiper trv-popular-destination-row trv-pop-des-st1-carousal swiper-nav-center-bottom">
                        <div class="swiper-wrapper">
                            @foreach ($categoryhome as $item)
                                <div class="swiper-slide">
                                    <div class="trv-destination-bx1">
                                        <div class="trv-media">
                                            <a href="{{route('allListProCate', ['danhmuc' => $item->slug])}}"><img loading="lazy" src="{{ $item->imagehome }}"
                                                    alt="Image"></a>
                                        </div>
                                        <div class="trv-content">
                                            <h3 class="trv-title"><a
                                                    href="{{ route('allListProCate', ['danhmuc' => $item->slug]) }}">{{ languageName($item->name) }}</a>
                                            </h3>
                                        </div>
                                        <div class="trv-on-hover">
                                            <img loading="lazy" src="/frontend/images/hotballon-right.png" alt="image">
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                </div>

            </div>


        </div>
        <!--POPULAR DESTINATION SECTION END-->
        <div class="section-full trv-most-fav-tour-wrap">
         <div class="trv-most-fav-tour-mid">
             <div class="trv-most-fav-tour-top">
                 <div class="trv-most-fav-tour-t-left">
                     <div class="section-head trv-head-title-wrap left-position with-bg-dark">
                         <h2 class="trv-head-title"><span class="site-text-yellow">{{getLanguage('most_favorite')}}</span> {{getLanguage('tour_places')}}!</h2>
                         <div class="trv-head-discription">{{getLanguage('tour_places_description')}}</div>
                     </div>
                 </div>
                 <div class="trv-most-fav-title">
                     <span>{{getLanguage('explore')}}</span> 
                     {{getLanguage('featured_tours')}}
                 </div>
             </div>

             <div class="trv-most-fav-tour-bot">
                 
                 <div class="trv-most-fav-tour-row">
                     <div class="swiper trv-mf-tour-carousal">
                         <div class="swiper-wrapper">
                           @foreach ($homePro as $item)
                           <div class="swiper-slide">
                               @include('layouts.product.item', ['pro' => $item])
                           </div>
                       @endforeach
                             
                         </div>
                         <div class="swiper-button-next"></div>
                         <div class="swiper-button-prev"></div>
                     </div> 
                 </div>

             </div>

             {{-- <div class="trv-most-fav-media">
                <img loading="lazy" src="/frontend/images/man-rock.png" alt="Image">
             </div> --}}
         </div>
     </div>
     {{-- {{dd($tagCate)}} --}}
     @foreach ($tagCate as $tagcate)
         @if (count($tagcate->product) > 0 && $tagcate->status == 1)
             <!--WE RECOMMEND SECTION START-->
        <div class="section-full p-t40 p-b0 trv-we-recommend">
         <div class="container-fluid">
             <!-- TITLE START-->
             <div class="section-head trv-head-title-wrap center-position">
                 <h2 class="trv-head-title"><span class="site-text-yellow"> {{($tagcate->name)}}</span> Tours!</h2>
                 <div class="trv-head-discription">{{languageName($tagcate->description)}}</div>
                 <div class="trv-head-title-image">
                    <img loading="lazy" src="/frontend/images/Title-Separator.png" alt="Image">
                 </div>
             </div>
             <!-- TITLE END-->

             <div class="section-content">

                 <div class="swiper trv-popular-tours-row trv-tours-st1-carousal swiper-nav-center-bottom">
                     <div class="swiper-wrapper">
                         @foreach ($tagcate->product as $item)
                         {{-- {{dd($item->tags)}} --}}
                             <div class="swiper-slide">
                                 @include('layouts.product.item', ['pro' => $item, 'tagcateContext' => $tagcate])
                             </div>
                         @endforeach
                     </div>
                     <div class="swiper-button-next"></div>
                     <div class="swiper-button-prev"></div>
                 </div>

             </div>

         </div>

     </div>
     <!--WE RECOMMEND SECTION END-->
         @endif
     @endforeach
        

        <!-- CLIENT LOGO SECTION START -->
        <div class="section-full trv-client-section">
            <div class="trv-client-row">
                <div class="container">
                    <div class="section-content">
                        <div class="trv-client-carousel">
                            <div class="row">
                                <div class="col-xl-2 col-lg-12 col-md-12">
                                    <div class="trv-client-titlesection">
                                        <h2 class="trv-head-title"><span class="site-text-yellow">Brands
                                        </span> Trust
                                            Us</h2>
                                    </div>
                                </div>
                                <div class="col-xl-10 col-lg-12 col-md-12">
                                    <div class="owl-carousel home-client-carousel">
                                       @foreach ($partner as $item)
                                       <div class="item">
                                        <div class="ow-client-logo">
                                            <div class="client-logo client-logo-media">
                                                <a href="{{$item->link}}"><img loading="lazy" src="{{$item->image}}" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CLIENT LOGO  SECTION End -->


        <!--3 STEP SECTION START-->
        
        <!--3 STEP SECTION END-->

        <!--TESTIMONIAL SECTION START-->
        <div class="section-full trv-testimonial-st2-wrap tvr-hot-ballon-wrap">
            <div class="container">
                <!-- TITLE START-->
                <div class="section-head trv-head-title-wrap center-position">
                    <h2 class="trv-head-title"> <span class="site-text-yellow">{{getLanguage('our_client')}}</span> {{getLanguage('says')}}!</h2>
                    <div class="trv-head-discription">{{getLanguage('our_client_says_des')}}</div>
                    <div class="trv-head-title-image">
                        <img loading="lazy" src="/frontend/images/Title-Separator.png" alt="Image">
                    </div>
                </div>
                <!-- TITLE END-->
                <div class="section-content">
                    {{-- <div class="trv-gradi-text">
                        Testimonials
                        <img loading="lazy" src="/frontend/images/airplane-takeoff1.png" alt="Image">
                    </div> --}}
                    <div class="swiper trv-trv-t-monial-row trv-t-monial-carousal swiper-nav-center-bottom">
                        <div class="swiper-wrapper">
                            <!--BOX-1-->
                            @foreach ($ReviewCus as $item)
                            <div class="swiper-slide">
                                <div class="trv-testimo-bx1">
                                    {{-- <div class="media">
                                        <img src="{{$item->avatar}}" alt="image">

                                        <div class="rating">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div> --}}
                                    <div class="info">
                                        <div class="trv-testimo-head">
                                            <div class="left-part">
                                                <h4 class="trv-testimonial-name">{{languageName($item->name)}}</h4>
                                                <span class="trv-testimonial-position">{{languageName($item->position) ?? 'Tourist'}}</span>
                                            </div>
                                            <div class="right-part">
                                                <img src="{{url('frontend/images/Quote.png')}}" alt="image">
                                            </div>
                                        </div>
                                        <p>
                                            {!!languageName($item->content)!!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                           

                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!--TESTIMONIAL SECTION End-->

        <!--ALL BLOGS SECTION START-->
        <div class="trv-blog-all-style p-t40 p-b90">
            <div class="container">
                <!-- TITLE START-->
                <div class="row trv-column-style-head">
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="section-head trv-head-title-wrap left-position">
                            <h2 class="trv-head-title">{{getLanguage('explore')}}<span class="site-text-yellow"> {{getLanguage('latest_news')}}</span></h2>
                            <div class="trv-head-discription">{{getLanguage('latest_news_des')}}</div>
                        </div>
                    </div>
                </div>
                <!-- TITLE END-->

                <div class="section-content">

                    @php
                        $news = $hotnews->values();
                        $news1 = $news->get(0);
                        $news2 = $news->get(1);
                        $news3 = $news->get(2);
                        $news4 = $news->get(3);
                        $news5 = $news->get(4);
                        $news6 = $news->get(5);
                    @endphp
                    <div class="row d-flex justify-content-center">

                        <div class="col-xl-4 col-lg-6 col-md-6">
                            @if ($news1)
                                <div class="trv-blog-st1">
                                    <div class="trv-post-media">
                                        <a href="{{ route('detailBlog', ['slug' => $news1->slug]) }}"><img loading="lazy" src="{{ $news1->image }}"
                                                alt="{{ languageName($news1->title) }}"></a>
                                    </div>

                                    <div class="post-date"><span>{{ optional($news1->created_at)->format('d') }}</span>{{ optional($news1->created_at)->format('M') }}</div>
                                    <div class="trv-post-info">
                                        <div class="post-category">News</div>
                                        <div class="trv-post-title ">
                                            <h5 class="post-title"><a href="{{ route('detailBlog', ['slug' => $news1->slug]) }}">{{ languageName($news1->title) }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($news2)
                                <div class="trv-blog-st1">
                                    <div class="trv-post-media">
                                        <a href="{{ route('detailBlog', ['slug' => $news2->slug]) }}"><img loading="lazy" src="{{ $news2->image }}"
                                                alt="{{ languageName($news2->title) }}"></a>
                                    </div>

                                    <div class="post-date"><span>{{ optional($news2->created_at)->format('d') }}</span>{{ optional($news2->created_at)->format('M') }}</div>
                                    <div class="trv-post-info">
                                        <div class="post-category">News</div>
                                        <div class="trv-post-title ">
                                            <h5 class="post-title"><a href="{{ route('detailBlog', ['slug' => $news2->slug]) }}">{{ languageName($news2->title) }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($news3)
                                <div class="trv-blog-st1">
                                    <div class="trv-post-media">
                                        <a href="{{ route('detailBlog', ['slug' => $news3->slug]) }}"><img loading="lazy" src="{{ $news3->image }}"
                                                alt="{{ languageName($news3->title) }}"></a>
                                    </div>

                                    <div class="post-date"><span>{{ optional($news3->created_at)->format('d') }}</span>{{ optional($news3->created_at)->format('M') }}</div>
                                    <div class="trv-post-info">
                                        <div class="post-category">News</div>
                                        <div class="trv-post-title ">
                                            <h5 class="post-title"><a href="{{ route('detailBlog', ['slug' => $news3->slug]) }}">{{ languageName($news3->title) }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-6">
                            @if ($news4)
                                <div class="trv-blog-st1">
                                    <div class="trv-post-media">
                                        <a href="{{ route('detailBlog', ['slug' => $news4->slug]) }}"><img loading="lazy" src="{{ $news4->image }}"
                                                alt="{{ languageName($news4->title) }}"></a>
                                    </div>

                                    <div class="post-date"><span>{{ optional($news4->created_at)->format('d') }}</span>{{ optional($news4->created_at)->format('M') }}</div>
                                    <div class="trv-post-info">
                                        <div class="post-category">News</div>
                                        <div class="trv-post-title ">
                                            <h5 class="post-title"><a href="{{ route('detailBlog', ['slug' => $news4->slug]) }}">{{ languageName($news4->title) }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            @if ($news5)
                                <div class="trv-blog-st2">
                                    <div class="trv-post-media">
                                        <a href="{{ route('detailBlog', ['slug' => $news5->slug]) }}"><img loading="lazy" src="{{ $news5->image }}"
                                                alt="{{ languageName($news5->title) }}"></a>
                                    </div>

                                    <div class="post-date"><span>{{ optional($news5->created_at)->format('d') }}</span>{{ optional($news5->created_at)->format('M') }}</div>
                                    <div class="trv-post-info">
                                        <div class="post-category">News</div>
                                        <div class="trv-post-title ">
                                            <h5 class="post-title"><a href="{{ route('detailBlog', ['slug' => $news5->slug]) }}">{{ languageName($news5->title) }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endif


                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-6">

                            @if ($news6)
                                <div class="trv-blog-st3">
                                    <div class="trv-post-media">
                                        <a href="{{ route('detailBlog', ['slug' => $news6->slug]) }}"><img loading="lazy" src="{{ $news6->image }}"
                                                alt="{{ languageName($news6->title) }}"></a>
                                    </div>

                                    <div class="post-date"><span>{{ optional($news6->created_at)->format('d') }}</span>{{ optional($news6->created_at)->format('M') }}</div>
                                    <div class="trv-post-info">
                                        <div class="post-category">News</div>
                                        <div class="trv-post-title ">
                                            <h3 class="post-title"><a href="{{ route('detailBlog', ['slug' => $news6->slug]) }}">{{ languageName($news6->title) }}</a></h3>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                    </div>

                </div>

            </div>
        </div>
        <!--ALL BLOGS SECTION END-->


    </div>
    <!-- CONTENT END -->
@endsection
