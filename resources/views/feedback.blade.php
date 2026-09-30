@extends('layouts.main.master')
@section('title')
Feedback | {{$setting->company}}
@endsection
@section('description')
Feedback | {{$setting->webname}}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<div class="page-content">

  <!-- INNER PAGE BANNER -->
  <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image: url({{$setting->GA ?? url('frontend/images/inr-banner.jpg')}});">
      <div class="overlay-main innr-bnr-olay"></div>
      <div class="wt-bnr-inr-entry">
          <div class="banner-title-outer">
              <div class="banner-title-name">
                  <h2 class="wt-title">Testimonial</h2>
              </div>
              <!-- BREADCRUMB ROW -->                            
              <div>
                  <ul class="wt-breadcrumb breadcrumb-style-2">
                      <li><a href="{{route('home')}}">Home</a></li>
                      <li>Testimonial</li>
                  </ul>
              </div>
          </div>
          <!-- BREADCRUMB ROW END -->                        
      </div>
  </div>
  <!-- INNER PAGE BANNER END -->

  <div class="section-full trv-testimonial-st1-wrap tvr-hot-ballon-wrap">
    <div class="container">
        <!-- TITLE START-->
        <div class="section-head trv-head-title-wrap center-position">
            <h2 class="trv-head-title">Our Client <span class="site-text-yellow">Says! </span></h2>
            <div class="trv-head-discription">Destinations worth exploring! Here are a few popular spots</div>
            <div class="trv-head-title-image">
                <img src="{{url('frontend/images/Title-Separator.png')}}" alt="Image">
            </div>
        </div>
        <!-- TITLE END-->
        <div class="section-content">
            <div class="row">
              @foreach ($data as $item)
              <div class="col-lg-6 col-md-6">
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
                                <span class="trv-testimonial-position">{{languageName($item->position)}}</span>
                            </div>
                            <div class="right-part">
                                <img src="{{url('frontend/images/Quote.png')}}"  alt="image">
                            </div>
                        </div>
                        <p>
                            {!!languageName($item->content)!!}
                        </p>
                    </div>
                </div>
            </div>
              @endforeach
                <!--Box1-->
               
            </div>
        </div>
    </div>
</div>


</div>
@endsection