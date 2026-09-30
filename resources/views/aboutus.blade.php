@extends('layouts.main.master')
@section('title')
About {{$setting->company}}
@endsection
@section('description')
About {{$setting->company}}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<div class="page-content">

	<!-- INNER PAGE BANNER -->
	<div class="wt-bnr-inr overlay-wraper bg-center" style="background-image: url({{$setting->logo_footer ?? url('frontend/images/inr-banner.jpg')}});">
		<div class="overlay-main innr-bnr-olay"></div>
		<div class="wt-bnr-inr-entry">
			<div class="banner-title-outer">
				<div class="banner-title-name">
					<h2 class="wt-title">About Us</h2>
				</div>
				<!-- BREADCRUMB ROW -->                            
				<div>
					<ul class="wt-breadcrumb breadcrumb-style-2">
						<li><a href="{{route('home')}}">Home</a></li>
						<li>About Us</li>
					</ul>
				</div>
			</div>
			<!-- BREADCRUMB ROW END -->                        
		</div>
	</div>
	<!-- INNER PAGE BANNER END -->

	<!--WE RECOMMEND SECTION START-->
	<div class="section-full p-t120 p-b0 trv-we-recommend2">
		<div class="container">
			<div class="section-content">
				<div class="trv-we-recommend2-row">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="trv-we-recommend-content">
								<!-- TITLE START-->
								<div class="section-head trv-head-title-wrap left-position">
									<h2 class="trv-head-title">{{$setting->company}}</h2>
									<div class="trv-head-discription">{!!$gioithieu->content!!}</div>
								</div>
								<!-- TITLE END-->

							</div>
						</div>
					</div>
				</div>
			</div> 
		</div>
	</div>
	<!--WE RECOMMEND SECTION END-->
	<div class="section-full trv-guide-bx1-wrap">
		<div class="trv-guide-bx1-section">
			<div class="container">
				<!-- TITLE START-->
				<div class="section-head trv-head-title-wrap center-position">
					<h2 class="trv-head-title"><span class="site-text-yellow">Meet With</span> Tour Guide</h2>
					<div class="trv-head-discription">Destinations worth exploring! Here are a few popular spots</div>
					<div class="trv-head-title-image">
						<img src="{{url('frontend/images/Title-Separator.png')}}" alt="Image">
					</div>
				</div>
				<!-- TITLE END-->

				<div class="section-content">
				
					<!--tv tour guide style 1-->
					<div class="row">
						@foreach ($founder as $item)
						<div class="col-xl-3 col-lg-6 col-md-6">
							<div class="trv-guide-bx1">
								<div class="media">
									<img src="{{$item->image}}" alt="image">
								</div>
								<h3 class="trv-guide-name">
									<a href="#"> {{$item->name}}</a>
								</h3>
								<span>{{$item->position ?? 'Tourist Guide'}}</span>
							</div>
						</div>
						@endforeach
					</div>
					
				</div> 

			</div>
		</div>
	</div>
	<div class="section-full trv-testimonial-st2-wrap tvr-hot-ballon-wrap">
		<div class="container">
			<!-- TITLE START-->
			<div class="section-head trv-head-title-wrap center-position">
				<h2 class="trv-head-title">Our Client <span class="site-text-yellow">Says! </span></h2>
				<div class="trv-head-discription">Destinations worth exploring! Here are a few popular spots</div>
				<div class="trv-head-title-image">
					<img loading="lazy" src="/frontend/images/Title-Separator.png" alt="Image">
				</div>
			</div>
			<!-- TITLE END-->
			<div class="section-content">
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
	<div class="section-full p-t120 p-b90 trv-popular-destination tvr-hot-ballon-wrap"
            style="background-image: url(/frontend/images/Cloud-bg.png)">
            <div class="container">
                <!-- TITLE START-->
                <div class="section-head trv-head-title-wrap center-position">
                    <h2 class="trv-head-title"><span class="site-text-yellow">Featured
                        </span>Destinations</h2>
                    <div class="trv-head-discription">Destinations worth exploring! Here are a few popular spots</div>
                    <div class="trv-head-title-image">
                        <img src="/frontend/images/Title-Separator.png" alt="Image">
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
                                            <a href="destination-detail.html"><img src="{{ $item->imagehome }}"
                                                    alt="Image"></a>
                                        </div>
                                        <div class="trv-content">
                                            <h3 class="trv-title"><a
                                                    href="{{ route('allListProCate', ['danhmuc' => $item->slug]) }}">{{ languageName($item->name) }}</a>
                                            </h3>
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




	<!--TESTIMONIAL SECTION START-->

	

</div>
@endsection