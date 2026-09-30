<!-- FOOTER START -->
<footer class="site-footer footer-dark">
   @php
      $footerLogo = $setting->logo ?: $setting->logo;
      $companyName = $setting->company ?: config('app.name');
      $copyrightYear = now()->year;
   @endphp
   <div class="trv-subscribe-nl">
       <div class="container">
           <div class="trv-left-section">
           <div class="trv-nl-large-text"><span>Subscribe</span> Now!</div>
               <div class="trv-nl-title">
                   Sign up to searing weekly newsletter to get the latest updates. 
               </div>  
           </div>
           <div class="trv-nl-section">
               <form>
                   <div class="ftr-nw-form">
                       <input name="news-letter" class="form-control" placeholder="Email address..." type="email">
                       <button class="ftr-nw-subcribe-btn" type="button"><i class="bi bi-search"></i></button>
                   </div>
               </form>
           </div>
       </div>
   </div>
   
   <!-- FOOTER BLOCKES START -->  
   <div class="container">
       <div class="footer-top">
           <div class="row">

               <div class="col-xl-3 col-lg-6 col-md-12">
                   
                   <div class="widget widget_about">
                       <div class="logo-footer clearfix">
                           <a href="{{ route('home') }}"><img src="{{ $footerLogo }}" alt="{{ $companyName }}"></a>
                       </div>
                       <p>{{ $setting->webname }}</p>
                       
                       <ul class="social-icons">
                           @if (!empty($setting->google))
                           <li><a href="{{ $setting->google }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-twitter-x"></i></a></li>
                           @endif
                           @if (!empty($setting->facebook))
                           <li><a href="{{ $setting->facebook }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i></a></li>
                           @endif
                       </ul>

                   </div>                            
                   
               </div>

               <div class="col-xl-2 col-lg-3 col-md-6 col-sm-4 col-4 m-b20">
                   <div class="widget widget_services">
                       <h3 class="widget-title">Explore</h3>
                       <ul>
                           <li><a href="{{ route('aboutUs') }}">About us</a></li>
                           
                           <li><a href="{{ route('feedback') }}">Feedback</a></li>
                           <li><a href="{{ route('gallery') }}">Gallery</a></li>
                           @foreach ($blogCate->take(5) as $item)
                           <li><a href="{{ route('listCateBlog', ['slug' => $item->slug]) }}">{{ languageName($item->name) }}</a></li>
                           @endforeach
                           <li><a href="{{ route('lienHe') }}">Contact Us</a></li>
                       </ul>
                   </div>
               </div>

               <div class="col-xl-2 col-lg-3 col-md-6 col-sm-4 col-4 m-b20">
                   <div class="widget widget_services">
                       <h3 class="widget-title">Destinations</h3>
                       <ul>
                           @foreach ($categoryhome->take(5) as $item)
                           <li><a href="{{ route('allListProCate', ['danhmuc' => $item->slug]) }}">{{ languageName($item->name) }}</a></li>
                           @endforeach
                       </ul>
                   </div>
               </div>

               <div class="col-xl-2 col-lg-6 col-md-6 col-sm-4 col-4 m-b20">
                   <div class="widget widget_services">
                       <h3 class="widget-title">Support</h3>
                       <ul>
                           {{-- @foreach ($blogCate->take(5) as $item)
                           <li><a href="{{ route('listCateBlog', ['slug' => $item->slug]) }}">{{ languageName($item->name) }}</a></li>
                           @endforeach --}}
                           <li><a href="{{ route('fags') }}">FAQs</a></li>
                           @foreach ($pageContent as $item)
                           @if ($item->type == 'ho-tro-khanh-hang')
                           <li><a href="{{ route('pagecontent', ['slug' => $item->slug]) }}">{{ ($item->title) }}</a></li>
                           @endif
                           @endforeach
                           {{-- <li><a href="{{ route('fags') }}">FAQ's</a></li> --}}
                       </ul>
                   </div>
               </div>
                                   
               <div class="col-xl-3 col-lg-6 col-md-6">
                   <div class="widget f-top-space">
                       <ul class="widget_address"> 
                           <li>
                               <div class="trv-icon"><i class="bi bi-telephone"></i></div>
                               <a href="tel:{{ $setting->phone1 }}"><span class="trv-contact">{{ $setting->phone1 }}</span></a>
                           </li>
                       
                           <li>
                               <div class="trv-icon"><i class="bi bi-envelope"></i></div>
                               <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                           </li>
                           <li>
                               <div class="trv-icon"><i class="bi bi-house-door"></i></div>
                               <span>{{ $setting->address1 }}</span>
                           </li>
                       </ul>  
                   </div>
               </div>

           </div>
       </div>
       <div class="footer-bottom">
           <div class="container text-center">
            <i>ENTDECKEN TRAVEL Tour operator for tour groups with high quality services</i>
               <div class="copyrights-text">© {{ $copyrightYear }} All Rights Reserved.</div>
           </div>   
       </div>   
   </div>
   <!-- FOOTER COPYRIGHT -->

</footer>
<!-- FOOTER END -->