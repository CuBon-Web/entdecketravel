@extends('layouts.main.master')
@section('title')
Book a Trip | {{$setting->company}}
@endsection
@section('description')
Book a Trip | {{$setting->webname}}
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('frontend/css/step.css')}}">
@endsection
@section('js')
<script src="{{asset('frontend/js/step.js')}}"></script>
@endsection
@section('content')
<section data-anim-wrap class="masthead -type-1 z-5">
   <div data-anim-child="fade" class="masthead__bg">
      <img src="#" alt="image" data-src="https://creativelayers.net/themes/gotrip-html/img/masthead/1/bg.webp" class="js-lazy">
   </div>
   <form id="form_design_trip">

   
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="text-center">
               <h1 data-anim-child="slide-up delay-4" class="text-40 lg:text-40 md:text-30 text-white">STEP <span class="step-index">1</span> OF 3</h1>
               <hr class="text-white" style="height: 2px; background: white; opacity: 1;">
               <p data-anim-child="slide-up delay-5" class="text-white text-20 mt-6 md:mt-10">I Will Be Traveling*</p>
            </div>
            <div class="content-data" data-anim-child="slide-up delay-6">
               <div class="box-input active" id="box_1">
                  <ul class="nav nav-icons nav-icons-2 mb-6 d-flex" role="tablist">
                     <li class="nav-item" role="presentation">
                        <a class="nav-link text-white tab-couple" data-value="As a Couple" href="javascript:;" data-bs-toggle="tab" role="tab" aria-controls="tab-couple" aria-selected="false" tabindex="-1">
                        <img src="{{url('frontend/img/couple.png')}}" alt="" width="115">
                        As a Couple
                        </a>
                     </li>
                     <li class="nav-item" role="presentation">
                        <a class="nav-link text-white tab-family" data-value="With Family" href="javascript:;" data-bs-toggle="tab" role="tab" aria-controls="tab-family" aria-selected="true">
                        <img src="{{url('frontend/img/family.png')}}" alt=""  width="115">
                        With Family 
                        </a>
                     </li>
                     <li class="nav-item" role="presentation">
                        <a class="nav-link text-white tab-friends" data-value="With Friends" href="javascript:;" data-bs-toggle="tab" role="tab" aria-controls="tab-friends" aria-selected="false" tabindex="-1">
                        <img src="{{url('frontend/img/friend.png')}}" alt=""  width="115">
                        With Friends 
                        </a>
                     </li>
                     <li class="nav-item" role="presentation">
                        <a class="nav-link text-white tab-solo" data-value="Solo" href="javascript:;" data-bs-toggle="tab" role="tab" aria-controls="tab-solo" aria-selected="false" tabindex="-1">
                        <img src="{{url('frontend/img/solo.png')}}" alt=""  width="115">
                        Solo
                        </a>
                     </li>
                  </ul>
                  <input type="hidden" name="type" id="choose_type" value="With Family">
                  <div class="tab-content bg-white pt-50 pb-40 px-50 lg:pb-40 lg:px-20" id="tab-detail-content">
                     <h4 class="ff-base fw-5 text-center mb-5">Your Trip Detail</h4>
                     <div class="tab-pane fade" id="tab-couple" role="tabpanel">
                        <div class="panel-1 d-grid gap-6 form-primary-o-5">
                           <div class="mb-30">
                              <h5 class="mb-2">What's The Occasion?</h5>
                              <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                              <div class="row gy-4">
                                 <div class="col-md-3 col-6">
                                    <div class="form-check form-check-icon-xl mb-0">
                                       <input class="form-check-input" id="form-dt-tab-1-occasion-1" value="Just for leisure" type="checkbox" name="what_the_occasion[]" disabled="">
                                       <label class="lh-1 text-15 text-light-1 ml-5" for="form-dt-tab-1-occasion-1">Just for leisure</label>
                                    </div>
                                 </div>
                                 <div class="col-md-3 col-6">
                                    <div class="form-check form-check-icon-xl mb-0">
                                       <input class="form-check-input" value="Anniversary" id="form-dt-tab-1-occasion-3" type="checkbox" name="what_the_occasion[]" disabled="">
                                       <label class="lh-1 text-15 text-light-1 ml-5" for="form-dt-tab-1-occasion-3">Anniversary</label>
                                    </div>
                                 </div>
                                 <div class="col-md-3 col-6">
                                    <div class="form-check form-check-icon-xl mb-0">
                                       <input class="form-check-input" value="Honeymoon" id="form-dt-tab-1-occasion-2" type="checkbox" name="what_the_occasion[]" disabled="">
                                       <label class="lh-1 text-15 text-light-1 ml-5" for="form-dt-tab-1-occasion-2">Honeymoon</label>
                                    </div>
                                 </div>
                                 <div class="col-md-3 col-6">
                                    <div class="form-check form-check-icon-xl mb-0">
                                       <input class="form-check-input" id="form-dt-tab-1-occasion-4" type="checkbox" value="Other" name="what_the_occasion[]" disabled="">
                                       <label class="lh-1 text-15 text-light-1 ml-5" for="form-dt-tab-1-occasion-4">Other</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div>
                              <h5 class="mb-2">Age of Adults</h5>
                              <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                              <div class="row gy-4 box-parent-title">
                                 <div class="col-md-3 col-6">
                                    <div class="form-check form-check-icon-xl mb-0">
                                       <input class="form-check-input" name="age_of_travelers[]" id="form-dt-tab-1-age-0" type="checkbox" value="18-30" disabled="">
                                       <label class="lh-1 text-15 text-light-1 ml-5" for="form-dt-tab-1-age-0">18-30</label>
                                    </div>
                                 </div>
                                 <div class="col-md-3 col-6">
                                    <div class="form-check form-check-icon-xl mb-0">
                                       <input class="form-check-input" name="age_of_travelers[]" id="form-dt-tab-1-age-1" type="checkbox" value="31-50" disabled="">
                                       <label class="lh-1 text-15 text-light-1 ml-5" for="form-dt-tab-1-age-1">31-50</label>
                                    </div>
                                 </div>
                                 <div class="col-md-3 col-6">
                                    <div class="form-check form-check-icon-xl mb-0">
                                       <input class="form-check-input" name="age_of_travelers[]" id="form-dt-tab-1-age-2" type="checkbox" value="51-65" disabled="">
                                       <label class="lh-1 text-15 text-light-1 ml-5" for="form-dt-tab-1-age-2">51-65</label>
                                    </div>
                                 </div>
                                 <div class="col-md-3 col-6">
                                    <div class="form-check form-check-icon-xl mb-0">
                                       <input class="form-check-input" name="age_of_travelers[]" id="form-dt-tab-1-age-3" type="checkbox" value="65+" disabled="">
                                       <label class="lh-1 text-15 text-light-1 ml-5" for="form-dt-tab-1-age-3">65+</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane fade tab-parent" id="tab-family" role="tabpanel">
                        <div class="panel-1 d-grid gap-6 form-primary-o-5">
                           <div class="mb-30">
                              <h5 class="mb-2">Number of Adults *</h5>
                              <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                              <div class="row gy-4">
                                 <div class="col-md-6 col-12 form-parent">
                                    <select class="form-control total_people select2-hidden-accessible" name="number_of_adlts" data-plugin="select2" data-placeholder="Select" data-required="" data-options="{&quot;dropdownCssClass&quot;:&quot;select2-dropdown-panel-1&quot;}" aria-label="Select" data-select2-id="select2-data-3-qjto" tabindex="-1" aria-hidden="true">
                                       <option value="" data-select2-id="select2-data-5-rcp2">Select</option>
                                       <option value="1">1</option>
                                       <option value="2">2</option>
                                       <option value="3">3</option>
                                       <option value="4">4</option>
                                       <option value="5">5</option>
                                       <option value="6">6</option>
                                       <option value="7">7</option>
                                       <option value="8">8</option>
                                       <option value="9">9</option>
                                       <option value="10">10</option>
                                       <option value="11">11</option>
                                       <option value="12">12</option>
                                       <option value="13">13</option>
                                       <option value="14">14</option>
                                       <option value="15">15</option>
                                       <option value="16">16</option>
                                       <option value="17">17</option>
                                       <option value="18">18</option>
                                       <option value="19">19</option>
                                       <option value="20">20</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="mb-30">
                              <h5 class="mb-2">Age of Adults</h5>
                              <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                              <div class="row gy-4 box-parent-title">
                                 <div class="col-md-3 col-6">
                                    <div class="form-check form-check-icon-xl mb-0">
                                       <input class="form-check-input" id="form-family-tab-1-age-0" name="age_of_adult[]" type="checkbox" value="18-30">
                                       <label class="lh-1 text-15 text-light-1 ml-5" for="form-family-tab-1-age-0">18-30</label>
                                    </div>
                                 </div>
                                 <div class="col-md-3 col-6">
                                    <div class="form-check form-check-icon-xl mb-0">
                                       <input class="form-check-input" id="form-family-tab-1-age-1" name="age_of_adult[]" type="checkbox" value="31-50">
                                       <label class="lh-1 text-15 text-light-1 ml-5" for="form-family-tab-1-age-1">31-50</label>
                                    </div>
                                 </div>
                                 <div class="col-md-3 col-6">
                                    <div class="form-check form-check-icon-xl mb-0">
                                       <input class="form-check-input" id="form-family-tab-1-age-2" name="age_of_adult[]" type="checkbox" value="51-65">
                                       <label class="lh-1 text-15 text-light-1 ml-5" for="form-family-tab-1-age-2">51-65</label>
                                    </div>
                                 </div>
                                 <div class="col-md-3 col-6">
                                    <div class="form-check form-check-icon-xl mb-0">
                                       <input class="form-check-input" id="form-family-tab-1-age-3" name="age_of_adult[]" type="checkbox" value="65+">
                                       <label class="lh-1 text-15 text-light-1 ml-5" for="form-family-tab-1-age-3">65+</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="mb-30">
                              <div class="row ">
                                 <div class="col-lg-4 col-md-6 ">
                                    <h5 class="mb-2">Teenagers</h5>
                                    <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                                       <select class="form-control form-select select2-hidden-accessible" name="teenagers" data-plugin="select2" data-placeholder="Select" data-options="{&quot;dropdownCssClass&quot;:&quot;select2-dropdown-panel-1&quot;}" aria-label="Select" data-select2-id="select2-data-6-og4f" tabindex="-1" aria-hidden="true">
                                          <option data-select2-id="select2-data-8-a18p">Select</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                       </select>
                                 </div>
                                 <div class="col-lg-4 col-md-6 ">
                                    <h5 class="mb-2">Kids</h5>
                                    <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                                       <select class="form-control form-select select2-hidden-accessible" name="kids" data-plugin="select2" data-placeholder="Select" data-options="{&quot;dropdownCssClass&quot;:&quot;select2-dropdown-panel-1&quot;}" aria-label="Select" data-select2-id="select2-data-9-8z85" tabindex="-1" aria-hidden="true">
                                          <option data-select2-id="select2-data-11-rsft">Select</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                       </select>
                                 </div>
                                 <div class="col-lg-4 col-md-6 ">
                                    <h5 class="mb-2">Babies</h5>
                                    <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                                       <select class="form-control form-select select2-hidden-accessible" data-plugin="select2" name="babies" data-placeholder="Select" data-options="{&quot;dropdownCssClass&quot;:&quot;select2-dropdown-panel-1&quot;}" aria-label="Select" data-select2-id="select2-data-12-ftws" tabindex="-1" aria-hidden="true">
                                          <option data-select2-id="select2-data-14-j2vx">Select</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                       </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane fade tab-parent" id="tab-friends" role="tabpanel">
                        <div class="panel-1 d-grid gap-6 form-primary-o-5">
                           <div class="mb-30">
                              <h5 class="mb-2">Number of Adults *</h5>
                              <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                              <div class="row gy-4">
                                 <div class="col-md-6 col-12 form-parent">
                                    <select class="form-control form-select total_people select2-hidden-accessible" name="number_of_adlts" data-plugin="select2" data-placeholder="Select" data-required="" data-options="{&quot;dropdownCssClass&quot;:&quot;select2-dropdown-panel-1&quot;}" aria-label="Select" data-select2-id="select2-data-15-3wl8" tabindex="-1" aria-hidden="true">
                                       <option value="" readonly="" data-select2-id="select2-data-17-uwmb">Select
                                       </option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                          <option value="11">11</option>
                                          <option value="12">12</option>
                                          <option value="13">13</option>
                                          <option value="14">14</option>
                                          <option value="15">15</option>
                                          <option value="16">16</option>
                                          <option value="17">17</option>
                                          <option value="18">18</option>
                                          <option value="19">19</option>
                                          <option value="20">20</option>
                                       </select>
                                 </div>
                              </div>
                           </div>
                           <div class="mb-30">
                              <h5 class="mb-2">Age of Adults</h5>
                              <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                              <div class="row gy-4 box-parent-title">
                                 <div class="col-md-3 col-6">
                                    <div class="form-check form-check-icon-xl mb-0">
                                       <input class="form-check-input" id="form-family-tab-1-age-0" name="age_of_adult[]" type="checkbox" value="18-30">
                                       <label class="lh-1 text-15 text-light-1 ml-5" for="form-family-tab-1-age-0">18-30</label>
                                    </div>
                                 </div>
                                 <div class="col-md-3 col-6">
                                    <div class="form-check form-check-icon-xl mb-0">
                                       <input class="form-check-input" id="form-family-tab-1-age-1" name="age_of_adult[]" type="checkbox" value="31-50">
                                       <label class="lh-1 text-15 text-light-1 ml-5" for="form-family-tab-1-age-1">31-50</label>
                                    </div>
                                 </div>
                                 <div class="col-md-3 col-6">
                                    <div class="form-check form-check-icon-xl mb-0">
                                       <input class="form-check-input" id="form-family-tab-1-age-2" name="age_of_adult[]" type="checkbox" value="51-65">
                                       <label class="lh-1 text-15 text-light-1 ml-5" for="form-family-tab-1-age-2">51-65</label>
                                    </div>
                                 </div>
                                 <div class="col-md-3 col-6">
                                    <div class="form-check form-check-icon-xl mb-0">
                                       <input class="form-check-input" id="form-family-tab-1-age-3" name="age_of_adult[]" type="checkbox" value="65+">
                                       <label class="lh-1 text-15 text-light-1 ml-5" for="form-family-tab-1-age-3">65+</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="mb-30">
                              <div class="row ">
                                 <div class="col-lg-4 col-md-6 ">
                                    <h5 class="mb-2">Teenagers</h5>
                                    <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                                       <select class="form-control form-select select2-hidden-accessible" name="teenagers" data-plugin="select2" data-placeholder="Select" data-options="{&quot;dropdownCssClass&quot;:&quot;select2-dropdown-panel-1&quot;}" aria-label="Select" data-select2-id="select2-data-6-og4f" tabindex="-1" aria-hidden="true">
                                          <option data-select2-id="select2-data-8-a18p">Select</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                       </select>
                                 </div>
                                 <div class="col-lg-4 col-md-6 ">
                                    <h5 class="mb-2">Kids</h5>
                                    <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                                       <select class="form-control form-select select2-hidden-accessible" name="kids" data-plugin="select2" data-placeholder="Select" data-options="{&quot;dropdownCssClass&quot;:&quot;select2-dropdown-panel-1&quot;}" aria-label="Select" data-select2-id="select2-data-9-8z85" tabindex="-1" aria-hidden="true">
                                          <option data-select2-id="select2-data-11-rsft"></option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                       </select>
                                 </div>
                                 <div class="col-lg-4 col-md-6 ">
                                    <h5 class="mb-2">Babies</h5>
                                    <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                                       <select class="form-control form-select select2-hidden-accessible" data-plugin="select2" name="babies" data-placeholder="Select" data-options="{&quot;dropdownCssClass&quot;:&quot;select2-dropdown-panel-1&quot;}" aria-label="Select" data-select2-id="select2-data-12-ftws" tabindex="-1" aria-hidden="true">
                                          <option data-select2-id="select2-data-14-j2vx"></option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                       </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="tab-solo" role="tabpanel">
                        <div class="panel-1 form-primary-o-5">
                           <h5 class="mb-2">Your Age</h5>
                           <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                           <div class="row gy-4 box-parent-title">
                              <div class="col-md-3 col-6">
                                 <div class="form-check form-check-icon-xl mb-0">
                                    <input class="form-check-input" id="form-values_solo-tab-1-age-0" name="your_age[]" type="checkbox" value="18-30" disabled="">
                                    <label class="lh-1 text-15 text-light-1 ml-5" for="form-values_solo-tab-1-age-0">18-30</label>
                                 </div>
                              </div>
                              <div class="col-md-3 col-6">
                                 <div class="form-check form-check-icon-xl mb-0">
                                    <input class="form-check-input" id="form-values_solo-tab-1-age-1" name="your_age[]" type="checkbox" value="31-50" disabled="">
                                    <label class="lh-1 text-15 text-light-1 ml-5" for="form-values_solo-tab-1-age-1">31-50</label>
                                 </div>
                              </div>
                              <div class="col-md-3 col-6">
                                 <div class="form-check form-check-icon-xl mb-0">
                                    <input class="form-check-input" id="form-values_solo-tab-1-age-2" name="your_age[]" type="checkbox" value="51-65" disabled="">
                                    <label class="lh-1 text-15 text-light-1 ml-5" for="form-values_solo-tab-1-age-2">51-65</label>
                                 </div>
                              </div>
                              <div class="col-md-3 col-6">
                                 <div class="form-check form-check-icon-xl mb-0">
                                    <input class="form-check-input" id="form-values_solo-tab-1-age-3" name="your_age[]" type="checkbox" value="65+" disabled="">
                                    <label class="lh-1 text-15 text-light-1 ml-5" for="form-values_solo-tab-1-age-3">65+</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tab-bottom text-center mx-auto">
                        <div class="tab-bottom-buttons row g-3 gx-md-4 justify-content-center mt-30">
                           <div class="col-auto">
                              <a class="button px-30 fw-400 text-16 -blue-1 bg-dark-4 h-50 text-white btn-next" href="Javascript:void(0)" role="button" data-index="2">Next</a>
                           </div>
                        </div>
                        <p class="fst-italic mb-2">“This company knows how to treat first class travelers and offers up unique, high-end properties”</p>
                        
                     </div>
                  </div>
               </div>
               <div class="box-input bg-white pt-50 pb-40 px-50 lg:pb-40 lg:px-20" id="box_2">
                  <h3 class="h4 text-center mb-5"></h3>
                  <div class="panel-1 form-primary-o-5">
                     <div class="row g-xxl-5 gy-lg-5 gy-4">
                        <div class="col-lg-6 form-parent">
                           <div class="">
                              <h5 class="mb-2">Your desired destination(s)*</h5>
                              <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                              <div class="row gy-4 ">
                                 <div class="col-md-12 col-12 form-parent">
                                    <select class="form-control form-select total_people select2-hidden-accessible pt-10 pb-10" data-required="" name="destination">
                                       <option value="" data-select2-id="select2-data-5-5dmt">Select</option>
                                       @foreach ($categoryhome as $item)
                                       <option value="{{languageName($item->name)}}">{{languageName($item->name)}}</option>
                                       @endforeach
                                       
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-6 form-parent">
                           <h5 class="mb-2">When Will You Be Travelling? *</h5>
                           <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                           <input class="form-control" type="date" aria-label="" name="when_will_you_be_travelling" data-required=""  placeholder="dd.mm.yyyy" data-input="data-input">
                           
                        </div>
                        <div class="col-lg-6 form-parent">
                           <h5 class="mb-2">For How Many Days?*</h5>
                           <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                           <div class="row gy-4 ">
                              <div class="col-md-12 col-12 form-parent">
                                 <select class="form-control form-select total_people select2-hidden-accessible pt-10 pb-10" name="for_how_many_days" data-plugin="select2" data-required="" data-placeholder="Select" data-options="{&quot;dropdownCssClass&quot;:&quot;select2-dropdown-panel-1&quot;}" aria-label="Select" data-select2-id="select2-data-28-r0g6" tabindex="-1" aria-hidden="true">
                                    <option value="" data-select2-id="select2-data-30-0imd">Select
                                    </option>
                                    <option value="8">
                                       8
                                       days
                                    </option>
                                    <option value="9">
                                       9
                                       days
                                    </option>
                                    <option value="10">
                                       10
                                       days
                                    </option>
                                    <option value="11">
                                       11
                                       days
                                    </option>
                                    <option value="12">
                                       12
                                       days
                                    </option>
                                    <option value="13">
                                       13
                                       days
                                    </option>
                                    <option value="14">
                                       14
                                       days
                                    </option>
                                    <option value="15">
                                       15
                                       days
                                    </option>
                                    <option value="16">
                                       16
                                       days
                                    </option>
                                    <option value="17">
                                       17
                                       days
                                    </option>
                                    <option value="18">
                                       18
                                       days
                                    </option>
                                    <option value="19">
                                       19
                                       days
                                    </option>
                                    <option value="20">
                                       20
                                       days
                                    </option>
                                    <option value="21">
                                       21
                                       days
                                    </option>
                                    <option value="22">
                                       22
                                       days
                                    </option>
                                    <option value="23">
                                       23
                                       days
                                    </option>
                                    <option value="24">
                                       24
                                       days
                                    </option>
                                    <option value="25">
                                       25
                                       days
                                    </option>
                                    <option value="26">
                                       26
                                       days
                                    </option>
                                    <option value="27">
                                       27
                                       days
                                    </option>
                                    <option value="28">
                                       28
                                       days
                                    </option>
                                    <option value="29">
                                       29
                                       days
                                    </option>
                                    <option value="30">
                                       30
                                       days
                                    </option>
                                    <option value="31">
                                       31
                                       days
                                    </option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-12">
                           <h5 class="mb-2">Your approximate budget per person 
                              <span class="text-13 d-block mt-1">(not including international flights)**</span>
                           </h5>
                           <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                           <div class="row ">
                              <div class="col-lg-3 col-md-6 form-parent">
                                 <select class="form-control form-select select2-hidden-accessible pt-10 pb-10" data-plugin="select2" name="currency" data-required="" data-placeholder=" Currency*" data-options="{&quot;dropdownCssClass&quot;:&quot;select2-dropdown-panel-1&quot;}" aria-label=" Currency*" data-select2-id="select2-data-31-7ij1" tabindex="-1" aria-hidden="true">
                                    <option></option>
                                    <option value="USD" selected="" " data-curency="US$" data-select2-id="select2-data-33-pb3i">
                                       US DOLLAR
                                    </option>
                                    <option value="EUR" data-code="EUR" data-curency="€">
                                       EURO
                                    </option>
                                    <option value="GBP" data-code="GBP" data-curency="£">
                                       POUND STERLING
                                    </option>
                                    <option value="CAD" data-code="CAD"  data-curency="C$">
                                       CANADIAN DOLLAR
                                    </option>
                                    <option value="AUD" data-code="AUD" data-curency="A$">
                                       AUSTRALIAN DOLLAR
                                    </option>
                                 </select>
                               </div>
                              <div class="col-md-6 form-parent ">
                                 <select class="form-control form-select select2-hidden-accessible pt-10 pb-10" data-plugin="select2" data-required="" name="budget_per_person" id="budget_per_person" data-options="{&quot;dropdownCssClass&quot;:&quot;select2-dropdown-panel-1&quot;}" data-placeholder="Select" aria-label="Select" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-budget_per_person">
                                    <option value="" data-select2-id="select2-data-46-jxd4">Select</option>
                                    <option value="2,500 - 3,000">2,500 - 3,000</option>
                                    <option value="3,000 - 4,000">3,000 - 4,000</option>
                                    <option value="4,000 - 5,000">4,000 - 5,000</option>
                                    <option value="5,000 - 6,000">5,000 - 6,000</option>
                                    <option value="6,000 - 7,000">6,000 - 7,000</option>
                                    <option value="8,000 - 10,000">8,000 - 10,000</option>
                                    <option value="10,000 - 15,000">10,000 - 15,000</option>
                                    <option value="15,000 - 20,000">15,000 - 20,000</option>
                                    <option value="> 20,000">&gt; 20,000</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-12">
                           <h5 class="mb-2">Tell us what interest you*</h5>
                           <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                           <div class="row ">
                              <div class="col-md-12 col-12 form-parent">
                                 <textarea class="form-control" rows="6" aria-label="" data-required="" name="note" placeholder="Tell us some of your interests so we can create a trip that matches you. Are you into culture &amp; history or are you a foodie? Maybe you are an adrenaline junkie who looks for the most thrilling experience? Or maybe you just want to lie on the beach all day doing nothing, or you prefer a leisure pace with medium trekking &amp; cycling"></textarea>
                              </div>
                           </div>
                           
                        </div>
                     </div>
                  </div>
                  <div class="tab-bottom text-center mx-auto">
                     <div class="tab-bottom-buttons row g-3 gx-md-4 justify-content-center mb-5 mt-10">
                        <div class="col-auto">
                           <a class="button px-30 fw-400 text-16 -blue-1 bg-dark-4 h-50 text-white btn-prev" data-index="1" href="Javascript:void(0)" role="button">Prev</a>
                        </div>
                        <div class="col-auto">
                           <a class="button px-30 fw-400 text-16 -blue-1 bg-dark-4 h-50 text-white btn-next" data-index="3" href="Javascript:void(0)" role="button">Next</a>
                        </div>
                     </div>
                     <p class="fst-italic mb-2">“This company knows how to treat first class travelers and offers up unique, high-end properties”</p>
                     
                  </div>
               </div>
               <div class="box-input bg-white pt-50 pb-40 px-50 lg:pb-40 lg:px-20" id="box_3">
                  <h3 class="h4 text-center mb-5">What Would Make This Trip Ideal For You?</h3>
                  <div class="panel-1 form-primary-o-5">
                     <div class="row g-xxl-5 gy-lg-5 gy-4">
                        <div class="col-md-6 form-parent">
                           <h5 class="mb-3">First Name*</h5>
                           <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                           <input class="form-control" type="text" data-required="" name="first_name" aria-label="First Name" id="form-dt-first-name" placeholder="First Name">
                        </div>
                        <div class="col-lg-6 form-parent">
                           <h5 class="mb-3">Last Name*</h5>
                           <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                           <input class="form-control" type="text" data-required="" name="last_name" aria-label="Last Name" id="form-dt-last-name" placeholder="Last Name">
                        </div>
                        <div class="col-lg-12 form-parent">
                           <h5 class="mb-3">Your Email Address*</h5>
                           <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                           <input class="form-control" type="email" data-required="" name="email" aria-label="Your Email Address" id="form-dt-email" placeholder="Your Email Address">
                        </div>
                        <div class="w-100 m-0"></div>
                        <div class="col-lg-6 form-parent">
                           <h5 class="mb-3">Country of Residence*</h5>
                           <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                           <select class="form-control form-select select2-hidden-accessible" id="country" name="country" data-required="" data-placeholder="Country of Residence" aria-label="Country of Residence" data-select2-id="select2-data-country" tabindex="-1" aria-hidden="true">
                              <option value="" readonly="" data-select2-id="select2-data-2-ukzd">
                                 Country of Residence
                              </option>
                              <option value="AF">Afghanistan</option>
                              <option value="AX">Aland Islands</option>
                              <option value="AL">Albania</option>
                              <option value="DZ">Algeria</option>
                              <option value="AS">American Samoa</option>
                              <option value="AD">Andorra</option>
                              <option value="AO">Angola</option>
                              <option value="AI">Anguilla</option>
                              <option value="AQ">Antarctica</option>
                              <option value="AG">Antigua And Barbuda</option>
                              <option value="AR">Argentina</option>
                              <option value="AM">Armenia</option>
                              <option value="AW">Aruba</option>
                              <option value="AU">Australia</option>
                              <option value="AT">Austria</option>
                              <option value="AZ">Azerbaijan</option>
                              <option value="BS">Bahamas</option>
                              <option value="BH">Bahrain</option>
                              <option value="BD">Bangladesh</option>
                              <option value="BB">Barbados</option>
                              <option value="BY">Belarus</option>
                              <option value="BE">Belgium</option>
                              <option value="BZ">Belize</option>
                              <option value="BJ">Benin</option>
                              <option value="BM">Bermuda</option>
                              <option value="BT">Bhutan</option>
                              <option value="BO">Bolivia</option>
                              <option value="BA">Bosnia And Herzegovina</option>
                              <option value="BW">Botswana</option>
                              <option value="BV">Bouvet Island</option>
                              <option value="BR">Brazil</option>
                              <option value="IO">British Indian Ocean Territory</option>
                              <option value="BN">Brunei Darussalam</option>
                              <option value="BG">Bulgaria</option>
                              <option value="BF">Burkina Faso</option>
                              <option value="BI">Burundi</option>
                              <option value="KH">Cambodia</option>
                              <option value="CM">Cameroon</option>
                              <option value="CA">Canada</option>
                              <option value="CV">Cape Verde</option>
                              <option value="KY">Cayman Islands</option>
                              <option value="CF">Central African Republic</option>
                              <option value="TD">Chad</option>
                              <option value="CL">Chile</option>
                              <option value="CN">China</option>
                              <option value="CX">Christmas Island</option>
                              <option value="CC">Cocos (Keeling) Islands</option>
                              <option value="CO">Colombia</option>
                              <option value="KM">Comoros</option>
                              <option value="CG">Congo</option>
                              <option value="CD">Congo, Democratic Republic</option>
                              <option value="CK">Cook Islands</option>
                              <option value="CR">Costa Rica</option>
                              <option value="CI">Cote D'Ivoire</option>
                              <option value="HR">Croatia</option>
                              <option value="CU">Cuba</option>
                              <option value="CY">Cyprus</option>
                              <option value="CZ">Czech Republic</option>
                              <option value="DK">Denmark</option>
                              <option value="DJ">Djibouti</option>
                              <option value="DM">Dominica</option>
                              <option value="DO">Dominican Republic</option>
                              <option value="EC">Ecuador</option>
                              <option value="EG">Egypt</option>
                              <option value="SV">El Salvador</option>
                              <option value="GQ">Equatorial Guinea</option>
                              <option value="ER">Eritrea</option>
                              <option value="EE">Estonia</option>
                              <option value="ET">Ethiopia</option>
                              <option value="FK">Falkland Islands (Malvinas)</option>
                              <option value="FO">Faroe Islands</option>
                              <option value="FJ">Fiji</option>
                              <option value="FI">Finland</option>
                              <option value="FR">France</option>
                              <option value="GF">French Guiana</option>
                              <option value="PF">French Polynesia</option>
                              <option value="TF">French Southern Territories</option>
                              <option value="GA">Gabon</option>
                              <option value="GM">Gambia</option>
                              <option value="GE">Georgia</option>
                              <option value="DE">Germany</option>
                              <option value="GH">Ghana</option>
                              <option value="GI">Gibraltar</option>
                              <option value="GR">Greece</option>
                              <option value="GL">Greenland</option>
                              <option value="GD">Grenada</option>
                              <option value="GP">Guadeloupe</option>
                              <option value="GU">Guam</option>
                              <option value="GT">Guatemala</option>
                              <option value="GG">Guernsey</option>
                              <option value="GN">Guinea</option>
                              <option value="GW">Guinea-Bissau</option>
                              <option value="GY">Guyana</option>
                              <option value="HT">Haiti</option>
                              <option value="HM">Heard Island &amp; Mcdonald Islands</option>
                              <option value="VA">Holy See (Vatican City State)</option>
                              <option value="HN">Honduras</option>
                              <option value="HK">Hong Kong</option>
                              <option value="HU">Hungary</option>
                              <option value="IS">Iceland</option>
                              <option value="IN">India</option>
                              <option value="ID">Indonesia</option>
                              <option value="IR">Iran, Islamic Republic Of</option>
                              <option value="IQ">Iraq</option>
                              <option value="IE">Ireland</option>
                              <option value="IM">Isle Of Man</option>
                              <option value="IL">Israel</option>
                              <option value="IT">Italy</option>
                              <option value="JM">Jamaica</option>
                              <option value="JP">Japan</option>
                              <option value="JE">Jersey</option>
                              <option value="JO">Jordan</option>
                              <option value="KZ">Kazakhstan</option>
                              <option value="KE">Kenya</option>
                              <option value="KI">Kiribati</option>
                              <option value="KR">Korea</option>
                              <option value="KW">Kuwait</option>
                              <option value="KG">Kyrgyzstan</option>
                              <option value="LA">Lao People's Democratic Republic</option>
                              <option value="LV">Latvia</option>
                              <option value="LB">Lebanon</option>
                              <option value="LS">Lesotho</option>
                              <option value="LR">Liberia</option>
                              <option value="LY">Libyan Arab Jamahiriya</option>
                              <option value="LI">Liechtenstein</option>
                              <option value="LT">Lithuania</option>
                              <option value="LU">Luxembourg</option>
                              <option value="MO">Macao</option>
                              <option value="MK">Macedonia</option>
                              <option value="MG">Madagascar</option>
                              <option value="MW">Malawi</option>
                              <option value="MY">Malaysia</option>
                              <option value="MV">Maldives</option>
                              <option value="ML">Mali</option>
                              <option value="MT">Malta</option>
                              <option value="MH">Marshall Islands</option>
                              <option value="MQ">Martinique</option>
                              <option value="MR">Mauritania</option>
                              <option value="MU">Mauritius</option>
                              <option value="YT">Mayotte</option>
                              <option value="MX">Mexico</option>
                              <option value="FM">Micronesia, Federated States Of</option>
                              <option value="MD">Moldova</option>
                              <option value="MC">Monaco</option>
                              <option value="MN">Mongolia</option>
                              <option value="ME">Montenegro</option>
                              <option value="MS">Montserrat</option>
                              <option value="MA">Morocco</option>
                              <option value="MZ">Mozambique</option>
                              <option value="MM">Myanmar</option>
                              <option value="NA">Namibia</option>
                              <option value="NR">Nauru</option>
                              <option value="NP">Nepal</option>
                              <option value="NL">Netherlands</option>
                              <option value="AN">Netherlands Antilles</option>
                              <option value="NC">New Caledonia</option>
                              <option value="NZ">New Zealand</option>
                              <option value="NI">Nicaragua</option>
                              <option value="NE">Niger</option>
                              <option value="NG">Nigeria</option>
                              <option value="NU">Niue</option>
                              <option value="NF">Norfolk Island</option>
                              <option value="MP">Northern Mariana Islands</option>
                              <option value="NO">Norway</option>
                              <option value="OM">Oman</option>
                              <option value="PK">Pakistan</option>
                              <option value="PW">Palau</option>
                              <option value="PS">Palestinian Territory, Occupied</option>
                              <option value="PA">Panama</option>
                              <option value="PG">Papua New Guinea</option>
                              <option value="PY">Paraguay</option>
                              <option value="PE">Peru</option>
                              <option value="PH">Philippines</option>
                              <option value="PN">Pitcairn</option>
                              <option value="PL">Poland</option>
                              <option value="PT">Portugal</option>
                              <option value="PR">Puerto Rico</option>
                              <option value="QA">Qatar</option>
                              <option value="RE">Reunion</option>
                              <option value="RO">Romania</option>
                              <option value="RU">Russian Federation</option>
                              <option value="RW">Rwanda</option>
                              <option value="BL">Saint Barthelemy</option>
                              <option value="SH">Saint Helena</option>
                              <option value="KN">Saint Kitts And Nevis</option>
                              <option value="LC">Saint Lucia</option>
                              <option value="MF">Saint Martin</option>
                              <option value="PM">Saint Pierre And Miquelon</option>
                              <option value="VC">Saint Vincent And Grenadines</option>
                              <option value="WS">Samoa</option>
                              <option value="SM">San Marino</option>
                              <option value="ST">Sao Tome And Principe</option>
                              <option value="SA">Saudi Arabia</option>
                              <option value="SN">Senegal</option>
                              <option value="RS">Serbia</option>
                              <option value="SC">Seychelles</option>
                              <option value="SL">Sierra Leone</option>
                              <option value="SG">Singapore</option>
                              <option value="SK">Slovakia</option>
                              <option value="SI">Slovenia</option>
                              <option value="SB">Solomon Islands</option>
                              <option value="SO">Somalia</option>
                              <option value="ZA">South Africa</option>
                              <option value="GS">South Georgia And Sandwich Isl.</option>
                              <option value="ES">Spain</option>
                              <option value="LK">Sri Lanka</option>
                              <option value="SD">Sudan</option>
                              <option value="SR">Suriname</option>
                              <option value="SJ">Svalbard And Jan Mayen</option>
                              <option value="SZ">Swaziland</option>
                              <option value="SE">Sweden</option>
                              <option value="CH">Switzerland</option>
                              <option value="SY">Syrian Arab Republic</option>
                              <option value="TW">Taiwan</option>
                              <option value="TJ">Tajikistan</option>
                              <option value="TZ">Tanzania</option>
                              <option value="TH">Thailand</option>
                              <option value="TL">Timor-Leste</option>
                              <option value="TG">Togo</option>
                              <option value="TK">Tokelau</option>
                              <option value="TO">Tonga</option>
                              <option value="TT">Trinidad And Tobago</option>
                              <option value="TN">Tunisia</option>
                              <option value="TR">Turkey</option>
                              <option value="TM">Turkmenistan</option>
                              <option value="TC">Turks And Caicos Islands</option>
                              <option value="TV">Tuvalu</option>
                              <option value="UG">Uganda</option>
                              <option value="UA">Ukraine</option>
                              <option value="AE">United Arab Emirates</option>
                              <option value="GB">United Kingdom</option>
                              <option value="US">United States</option>
                              <option value="UM">United States Outlying Islands</option>
                              <option value="UY">Uruguay</option>
                              <option value="UZ">Uzbekistan</option>
                              <option value="VU">Vanuatu</option>
                              <option value="VE">Venezuela</option>
                              <option value="VN">Viet Nam</option>
                              <option value="VG">Virgin Islands, British</option>
                              <option value="VI">Virgin Islands, U.S.</option>
                              <option value="WF">Wallis And Futuna</option>
                              <option value="EH">Western Sahara</option>
                              <option value="YE">Yemen</option>
                              <option value="ZM">Zambia</option>
                              <option value="ZW">Zimbabwe</option>
                           </select>
                        </div>
                        <div class="col-lg-6 form-parent">
                           <h5 class="mb-3">Phone Number*</h5>
                           <hr class="divider divider-short divider-h-1px ms-0 mt-2">
                           <input class="form-control" type="text" data-required="" name="phone" aria-label="Phone Number" id="form-dt-phone-number" placeholder="Phone Number">
                        </div>
                     </div>
                  </div>
                  <div class="tab-bottom text-center mx-auto">
                     <div class="tab-bottom-buttons row g-3 gx-md-4 justify-content-center mb-5 mt-20">
                        <div class="col-auto">
                           <a class="button px-30 fw-400 text-16 -blue-1 bg-dark-4 h-50 text-white btn-prev" data-index="2" href="Javascript:void(0)" role="button">Prev</a>
                        </div>
                        <div class="col-auto">
                           <a id="submitBtn" class="button px-30 fw-400 text-16 -blue-1 bg-dark-4 h-50 text-white btn-next" data-index="4" href="Javascript:void(0)" role="button">Submit <span class="loader ml-15 spin-icon"></span></a>
                        </div>
                     </div>
                     <p class="fst-italic mb-2">An Asia-based tour operator has connected the dots on the wellsprings of the continent's most insightful doctrines to create an all-encompassing pilgrimage</p>
                     <p class="fst-italic mb-0">Luxury Travel Magazine</p>
                  </div>
               </div>
              
               
            </div>
         </div>
      </div>
   </div>
</form>
</section>
@endsection