@extends('layouts.main.master')
@section('title')
Contact
@endsection
@section('description')
Contact Us
@endsection
@section('image')
{{url(''.$setting->logo)}}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<div class="page-content">

	<!-- INNER PAGE BANNER -->
	<div class="wt-bnr-inr overlay-wraper bg-center" style="background-image: url({{$setting->linkpopup ?? url('frontend/images/inr-banner.jpg')}});">
		<div class="overlay-main innr-bnr-olay"></div>
		<div class="wt-bnr-inr-entry">
			<div class="banner-title-outer">
				<div class="banner-title-name">
					<h2 class="wt-title">Contact Us</h2>
				</div>
				<!-- BREADCRUMB ROW -->                            
				<div>
					<ul class="wt-breadcrumb breadcrumb-style-2">
						<li><a href="{{route('home')}}">Home</a></li>
						<li>Contact Us</li>
					</ul>
				</div>
			</div>
			<!-- BREADCRUMB ROW END -->                        
		</div>
	</div>
	<!-- INNER PAGE BANNER END -->

	<!--CONTACT US SECTION START-->
	<div class="trv-contact-us-wrap">
		<div class="trv-contact-us-mid">
			<div class="row">
				<div class="col-xxl-6 col-xl-5 col-lg-5 col-md-12">
					<div class="trv-form">
						<!-- TITLE START-->
						<div class="section-head trv-head-title-wrap left-position">
							<h2 class="trv-head-title"><span class="site-text-yellow">Reach</span> & Get in Touch With Us!</h2>
							<div class="trv-head-discription">We’love to hear from you. Our friendly team is always here to help you</div>
						</div>
						<!-- TITLE END-->
						@if(session('success'))
						<div class="alert alert-success">{{ session('success') }}</div>
						@endif
						@if(session('error'))
						<div class="alert alert-danger">{{ session('error') }}</div>
						@endif
						<form class="trv-cons-contact-form" method="post" action="{{route('postcontact')}}">
							@csrf
							<input type="text" name="website" value="" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;height:0;width:0;opacity:0;" aria-hidden="true">
							<div class="form-group">
								<input class="form-control" name="name" required type="text" placeholder="Enter Your Name" value="{{ old('name') }}">
							</div>
							<div class="form-group">
								<input class="form-control" name="email" type="email" placeholder="Enter Email Address" value="{{ old('email') }}">
							</div>
							<div class="form-group">
								<input class="form-control" name="phone" required type="text" placeholder="Enter Phone Number" value="{{ old('phone') }}">
							</div>
							<div class="form-group">
								<textarea class="form-control" name="mess" placeholder="Message">{{ old('mess') }}</textarea>
							</div>
							@include('layouts.partials.simple-captcha')
							<button type="submit" class="site-button butn-bg-shape">Send Message</button>
						</form>
						
					</div>
				</div>
				<div class="col-xxl-6 col-xl-7 col-lg-7 col-md-12">
					<div class="trv-contact-us-detail-wrap">
						<div class="trv-contact-us-detail">
							<!-- TITLE START-->
							<div class="section-head trv-head-title-wrap left-position">
								<h2 class="trv-head-title">Contact Us</h2>
								<div class="trv-head-discription">
									Travlla is a multi-award-winning strategy and content creation agency that specializes in travel marketing. 
								</div>
							</div>
							<!-- TITLE END-->

							<ul class="trv-contact-list">
								<li>
									<div class="trv-contact-info">
										<div class="media">
											<div class="white-circle">
												<i class="feather feather-phone-call"></i>
											</div>
										</div>
										<div class="info">
											<span class="title">Phone</span>
											<h6 class="text">{{$setting->phone1}}</h6>
										</div>
									</div>
								</li>
								<li>
									<div class="trv-contact-info icon-2">
										<div class="media">
											<div class="white-circle">
												<i class="feather feather-mail"></i>
											</div>
										</div>
										<div class="info">
											<span class="title">Email</span>
											<h6 class="text"><a href="mailto:{{$setting->email}}">{{$setting->email}}</a></h6>
											<h6 class="text"><a href="mailto:{{$setting->fax}}">{{$setting->fax}}</a></h6>
										</div>
									</div>
								</li>
								<li>
									<div class="trv-contact-info icon-3">
										<div class="media">
											<div class="white-circle">
												<i class="feather feather-home"></i>
											</div>
										</div>
										<div class="info">
											<span class="title">Address</span>
											<h6 class="text">{{$setting->address1}}</h6>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<img src="/frontend/images/Image-cont.png" alt="Image" class="trv-con-pic">
					</div>
				</div>
			</div>
			<!-- GOOGLE MAP -->
			<div class="g-map-wrap m-t50">
				<div class="gmap-outline">
					<div class="google-map">
						<div style="width: 100%">
							{!!$setting->iframe_map!!}
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<!--CONTACT US SECTION END-->
</div>
@endsection