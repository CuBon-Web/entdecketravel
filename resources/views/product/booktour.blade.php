@extends('layouts.main.master')
@section('title')
Hoàn Tất Đặt Tour
@endsection
@section('description')
Hoàn Tất Đặt Tour
@endsection
@section('image')
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<section class="section-bg layout-pt-lg layout-pb-lg">
	<div class="section-bg__item col-12">
	  <img src="{{url('frontend/img/about.png')}}" alt="image">
	</div>

	<div class="container">
	  <div class="row justify-center text-center">
		<div class="col-xl-6 col-lg-8 col-md-10">
		  <h1 class="text-40 md:text-25 fw-600 text-white">Hoàn Tất Đặt Tour </h1>
		  <div class="text-white mt-15">Home > Hoàn Tất Đặt Tour </div>
		</div>
	  </div>
	</div>
  </section>
  <section class="pt-40 layout-pb-md">
   <div class="container">
     <div class="row">
       <div class="col-xl-7 col-lg-8">
        

         <h2 class="text-22 fw-500 mt-40 md:mt-24">Let us know who you are</h2>
         <form action="{{route('postBookTour')}}" method="POST">
            @csrf
            <input type="text" hidden name="tour_id" value="{{$tour->id}}">
            <input type="text" hidden name="service_id" value="{{isset($servicereqest) ? json_encode($servicereqest) : ''}}">
            <input type="text" hidden name="nguoilon" value="{{(int)$request['nguoilon']}}">
            <input type="text" hidden name="treem" value="{{(int)$request['treem']}}">
            <input type="text" hidden name="total" value="{{number_format(((languageName($tour->price))*(int)$request['nguoilon']) + ((languageName($tour->price_chil))*(int)$request['treem']))}}">
            <div class="row x-gap-20 y-gap-20 pt-20">
               <div class="col-12">
    
                 <div class="form-input ">
                   <input type="text" name="name"   required="">
                   <label class="lh-1 text-16 text-light-1">Full Name *</label>
                 </div>
    
               </div>
               <div class="col-md-6">
    
                  <div class="form-input ">
                    <input type="text" name="phone"  required="">
                    <label class="lh-1 text-16 text-light-1">Phone *</label>
                  </div>
     
                </div>
               <div class="col-md-6">
    
                 <div class="form-input ">
                   <input type="text" type="email" name="email"  >
                   <label class="lh-1 text-16 text-light-1">Email</label>
                 </div>
    
               </div>
               
               <div class="col-12">
    
                 <div class="form-input ">
                   <input type="text" name="address">
                   <label class="lh-1 text-16 text-light-1">Address</label>
                 </div>
    
               </div>
               
    
               <div class="col-12">
    
                 <div class="form-input ">
                   <textarea name="note"  rows="6"></textarea>
                   <label class="lh-1 text-16 text-light-1">Note</label>
                 </div>
    
               </div>
    
               <div class="col-12">
                 <div class="row y-gap-20 items-center justify-between">
                  
    
                   <div class="col-auto">
    
                     <button type="submit" class="button h-60 px-24 -dark-1 bg-blue-1 text-white">
                        Book a Trip <div class="icon-arrow-top-right ml-15"></div>
                     </button>
    
                   </div>
                 </div>
               </div>
             </div>
         </form>
         

       </div>

       <div class="col-xl-5 col-lg-4">
         <div class="ml-80 lg:ml-40 md:ml-0">
           <div class="px-30 py-30 border-light rounded-4">
             <div class="text-20 fw-500 mb-30">Detail</div>
             @php
               $img = json_decode($tour->images);
            @endphp
             <div class="row x-gap-15 y-gap-20">
               <div class="col-auto">
                 <img src="{{$img[0]}}" alt="image" class="size-140 rounded-4 object-cover">
               </div>

               <div class="col">
                 <div class="d-flex x-gap-5 pb-10">

                   <i class="icon-star text-yellow-1 text-10"></i>

                   <i class="icon-star text-yellow-1 text-10"></i>

                   <i class="icon-star text-yellow-1 text-10"></i>

                   <i class="icon-star text-yellow-1 text-10"></i>

                   <i class="icon-star text-yellow-1 text-10"></i>

                 </div>

                 <div class="lh-17 fw-500">{{$tour->name}}</div>
                 <div class="text-14 lh-15 mt-5">{{languageName($tour->cate->name)}}</div>

                 <div class="row x-gap-10 y-gap-10 items-center pt-10">
                   <div class="col-auto">
                     <div class="d-flex items-center">
                       <div class="size-30 flex-center bg-blue-1 rounded-4">
                         <div class="text-12 fw-600 text-white">5.0</div>
                       </div>
                     </div>
                   </div>

                   <div class="col-auto">
                     <div class="text-14">3,014 reviews</div>
                   </div>
                 </div>
               </div>
             </div>

             <div class="border-top-light mt-30 mb-20"></div>

             <div class="">
               <div class="text-15">Total length of stay:</div>
               <div class="fw-500">{{$tour->hang_muc}}</div>
             </div>


           </div>

         </div>
       </div>
     </div>
   </div>
 </section>
@endsection