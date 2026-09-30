<!-- https://creativelayers.net/themes/gotrip-html/home-7.html -->
<!DOCTYPE html>
<html lang="vi" data-x="html" data-x-toggle="html-overflow-hidden">
   <head>
      @php
         $seoTitle = strip_tags(trim($__env->yieldContent('title', config('app.name'))));
         $seoDescriptionRaw = trim($__env->yieldContent('description', config('app.name')));
         $seoDescription = \Illuminate\Support\Str::limit(strip_tags($seoDescriptionRaw), 160, '');
         $seoImage = trim($__env->yieldContent('image', url('' . $setting->favicon)));
         $seoCanonical = trim($__env->yieldContent('canonical', url()->current()));
         $seoRobots = trim($__env->yieldContent('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'));
      @endphp
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>{{ $seoTitle }}</title>
      <meta name="description" content="{{ $seoDescription }}" />
      <meta name="robots" content="{{ $seoRobots }}" />
      <meta name="googlebot" content="{{ $seoRobots }}" />
      <meta name="theme-color" content="#ed3235" />
      <meta name="author" content="{{ config('app.name') }}" />
      <meta name="application-name" content="{{ config('app.name') }}" />
      <meta http-equiv="Content-Language" content="vi" />
      <link rel="canonical" href="{{ $seoCanonical }}" />
      <link rel="alternate" href="{{ $seoCanonical }}" hreflang="vi-VN" />
      <link rel="alternate" href="{{ $seoCanonical }}" hreflang="x-default" />

      <meta property="og:type" content="website" />
      <meta property="og:locale" content="vi_VN" />
      <meta property="og:url" content="{{ $seoCanonical }}" />
      <meta property="og:title" content="{{ $seoTitle }}" />
      <meta property="og:description" content="{{ $seoDescription }}" />
      <meta property="og:image" content="{{ $seoImage }}" />
      <meta property="og:image:secure_url" content="{{ $seoImage }}" />
      <meta property="og:image:alt" content="{{ $seoTitle }}" />
      <meta property="og:site_name" content="{{ config('app.name') }}" />

      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:title" content="{{ $seoTitle }}" />
      <meta name="twitter:description" content="{{ $seoDescription }}" />
      <meta name="twitter:image" content="{{ $seoImage }}" />
      <meta name="twitter:url" content="{{ $seoCanonical }}" />

      <meta itemprop="name" content="{{ $seoTitle }}" />
      <meta itemprop="description" content="{{ $seoDescription }}" />
      <meta itemprop="image" content="{{ $seoImage }}" />
      <meta itemprop="url" content="{{ $seoCanonical }}" />
    <!-- <link rel="amphtml" href="amp/" /> -->
    <link rel="image_src" href="{{ $seoImage }}" />
    <script type="application/ld+json">
      {!! json_encode([
         '@context' => 'https://schema.org',
         '@type' => 'Organization',
         'name' => config('app.name'),
         'url' => url('/'),
         'logo' => url('' . $setting->logo),
      ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>
    <script type="application/ld+json">
      {!! json_encode([
         '@context' => 'https://schema.org',
         '@type' => 'WebSite',
         'name' => config('app.name'),
         'url' => url('/'),
         'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => url('/') . '?q={search_term_string}',
            'query-input' => 'required name=search_term_string',
         ],
      ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>
    @yield('schema')
    <link rel="shortcut icon" href="{{url(''.$setting->favicon)}}" type="image/x-icon">
    <link rel="icon" href="{{url(''.$setting->favicon)}}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
      <!-- Google fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Commissioner:wght@100..900&display=swap" rel="stylesheet">
      <!-- Stylesheets -->
      <link rel="preload" as="style" href="/frontend/css/bootstrap.min.css">
      <link rel="stylesheet"  href="/frontend/css/bootstrap.min.css"><!-- BOOTSTRAP STYLE SHEET -->
      <link rel="stylesheet"  href="/frontend/css/bootstrap-select.min.css"><!-- BOOTSTRAP SELECT BOX CSS -->
      <link rel="stylesheet"  href="/frontend/css/font-awesome.min.css"><!-- FONTAWESOME STYLE SHEET -->
      <link rel="stylesheet"  href="/frontend/css/feather.css"><!-- FEATHER ICON SHEET -->
      <link rel="stylesheet"  href="/frontend/css/owl.carousel.min.css"><!-- OWL CAROUSEL STYLE SHEET -->
      <link rel="stylesheet"  href="/frontend/css/magnific-popup.min.css"><!-- MAGNIFIC POPUP STYLE SHEET -->
      <link rel="stylesheet"  href="/frontend/css/swiper-bundle.min.css"><!-- Link Swiper's CSS -->  
      <link rel="preload" as="style" href="/frontend/css/style.css">
      <link rel="stylesheet"  href="/frontend/css/style.css"><!-- MAIN STYLE SHEET -->
      <link rel="stylesheet"  href="/frontend/css/bootstrap-datetimepicker.css"><!-- DATEPICKER STYLE SHEET -->  
      <link rel="stylesheet"  href="/frontend/css/bootstrap-icons.css"><!-- BOOTSTRAP ICON STYLE SHEET -->
      <link rel="stylesheet"  href="/frontend/css/lc_lightbox.css"><!-- Lc light box popup -->
      <link rel="stylesheet"  href="/frontend/css/bootstrap-slider.min.css"><!-- Price Range Slider -->  
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      @yield('css')
      <style>
         .goog-te-banner-frame.skiptranslate{display:none !important;}
         iframe.goog-te-banner-frame{display:none !important;}
         .skiptranslate{display:none !important;}
         #goog-gt-tt, .goog-te-balloon-frame{display:none !important;}
         .goog-logo-link, .goog-te-gadget span{display:none !important;}
         .goog-te-gadget{color:transparent !important;}
         html{margin-top:0 !important;}
         body{top:0 !important;}
      </style>
   </head>
   <body>
      <!-- LOADING AREA START ===== -->
      <div class="loading-area">
          <div class="loading-box"></div>
          <div class="loading-pic">
              <figure class="loader">
                  <div class="dot white"></div>
                  <div class="dot"></div>
                  <div class="dot"></div>
                  <div class="dot"></div>
                  <div class="dot"></div>
              </figure>
          </div>
      </div>
      <!-- LOADING AREA  END ====== -->
      
      
      @include('layouts.header.index')
           
      <div class="page-wraper">
          
         @yield('content')
      
      
          @include('layouts.footer.index')
      
         <!-- SMART CONTACT START -->
         @php
             $hotlineNumber = $setting->phone1 ?? '';
             $emailAddress = $setting->email ?? (config('mail.from.address') ?? '');
             $waNumber = preg_replace('/\D+/', '', $hotlineNumber);
             if (!empty($waNumber) && substr($waNumber, 0, 1) === '0') {
                 $waNumber = '84' . substr($waNumber, 1);
             }
         @endphp
         <div class="smart-contact" style="position:fixed; right:20px; bottom:20px; z-index:1050;">
             <style>
                 .smart-contact .smart-actions{
                     display:flex; flex-direction:column; align-items:flex-end; gap:10px;
                     margin-bottom:10px; text-align:right;
                     opacity:0; transform:translateY(8px); transition:opacity .25s ease, transform .25s ease;
                     pointer-events:none;
                 }
                 .smart-contact .smart-actions.is-open{
                     opacity:1; transform:translateY(0); pointer-events:auto;
                 }
                 .smart-contact .smart-btn{ transition:transform .2s ease, box-shadow .2s ease; }
                 .smart-contact .smart-btn:hover{ transform:translateY(-2px) scale(1.03); box-shadow:0 10px 22px rgba(0,0,0,0.18) !important; }
                 .smart-contact .smart-toggle{
                     animation:pulseGlow 1.8s ease-in-out infinite;
                 }
                 .smart-contact .smart-toggle.is-open{
                     animation:none;
                 }
                 @keyframes pulseGlow{
                     0%{ transform:scale(1); box-shadow:0 8px 20px rgba(0,0,0,0.20), 0 0 0 0 rgba(22,119,255,0.35); }
                     50%{ transform:scale(1.06); box-shadow:0 12px 26px rgba(0,0,0,0.22), 0 0 0 10px rgba(22,119,255,0.08); }
                     100%{ transform:scale(1); box-shadow:0 8px 20px rgba(0,0,0,0.20), 0 0 0 0 rgba(22,119,255,0.0); }
                 }
             </style>
             <div class="smart-actions" style="display:none;">
                 <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener"
                     class="smart-btn" aria-label="WhatsApp"
                     style="display:inline-flex; align-items:center; justify-content:center; width:48px; height:48px; border-radius:50%; background:#25D366; color:#fff; box-shadow:0 6px 16px rgba(0,0,0,0.15);">
                     <i class="bi bi-whatsapp" style="font-size:22px;"></i>
                 </a>
                 <a href="tel:{{ preg_replace('/\s+/', '', $hotlineNumber) }}"
                     class="smart-btn" aria-label="Hotline"
                     style="display:inline-flex; align-items:center; justify-content:center; width:48px; height:48px; border-radius:50%; background:#ff4d4f; color:#fff; box-shadow:0 6px 16px rgba(0,0,0,0.15);">
                     <i class="bi bi-telephone" style="font-size:20px;"></i>
                 </a>
                 <a href="mailto:{{ $setting->email }}"
                     class="smart-btn" aria-label="Email"
                     style="display:inline-flex; align-items:center; justify-content:center; width:48px; height:48px; border-radius:50%; background:#1677ff; color:#fff; box-shadow:0 6px 16px rgba(0,0,0,0.15);">
                     <i class="bi bi-envelope" style="font-size:20px;"></i>
                 </a>
             </div>
             <button type="button" class="smart-toggle"
                 aria-label="Open contact options"
                 onclick="(function(btn){var box=btn.parentNode.querySelector('.smart-actions'); var isOpen=box.classList.contains('is-open'); if(!isOpen){ box.style.display='flex'; setTimeout(function(){ box.classList.add('is-open'); }, 10); btn.classList.add('is-open'); btn.innerHTML='<i class=&quot;bi bi-x&quot; style=&quot;font-size:20px;&quot;></i>'; } else { box.classList.remove('is-open'); btn.classList.remove('is-open'); setTimeout(function(){ box.style.display='none'; }, 220); btn.innerHTML='<i class=&quot;bi bi-chat-dots&quot; style=&quot;font-size:20px;&quot;></i>'; }})(this)"
                 style="display:inline-flex; align-items:center; justify-content:center; width:56px; height:56px; border-radius:50%; background:#111827; color:#fff; box-shadow:0 8px 20px rgba(0,0,0,0.2); border:none;">
                 <i class="bi bi-chat-dots" style="font-size:20px;"></i>
             </button>
         </div>
         <!-- SMART CONTACT END -->
      
      </div>
      
      
      
      <!-- JAVASCRIPT  FILES ========================================= --> 
      <script src="/frontend/js/jquery-3.7.1.min.js"></script><!-- JQUERY.MIN JS -->
      <script defer src="/frontend/js/popper.min.js"></script><!-- POPPER.MIN JS -->
      <script defer src="/frontend/js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
      <script defer src="/frontend/js/bootstrap-select.min.js"></script><!-- BOOTSTRAP SELECT.MIN JS -->
      <script defer src="/frontend/js/magnific-popup.min.js"></script><!-- MAGNIFIC-POPUP JS -->
      <script defer src="/frontend/js/waypoints.min.js"></script><!-- WAYPOINTS JS -->
      <script defer src="/frontend/js/counterup.min.js"></script><!-- COUNTERUP JS -->
      <script defer src="/frontend/js/isotope.pkgd.min.js"></script><!-- MASONRY  -->
      <script defer src="/frontend/js/imagesloaded.pkgd.min.js"></script><!-- MASONRY  -->
      <script defer src="/frontend/js/owl.carousel.min.js"></script><!-- OWL  SLIDER  -->
      <script defer src="/frontend/js/theia-sticky-sidebar.js"></script><!-- STICKY SIDEBAR  -->
      <script defer src="/frontend/js/jquery.bootstrap-touchspin.js"></script><!-- FORM JS -->
      <script defer src="/frontend/js/lc_lightbox.lite.js" ></script><!-- IMAGE POPUP -->
      <script defer src="/frontend/js/bootstrap-slider.min.js"></script><!-- Form js -->
      <script defer src="/frontend/js/swiper-bundle.min.js"></script> <!-- Swiper JS -->
      <script defer src="/frontend/js/img-parallax.js"></script><!-- Image Parallax -->
      
      <script defer src="/frontend/js/gsap.min.js"></script><!-- CURSOR -->
      <script defer src="/frontend/js/custom.js"></script><!-- CUSTOM FUCTIONS  -->
      <script defer src="/frontend/js/moment.min.js"></script>
      <script defer src="/frontend/js/bootstrap-datetimepicker.min.js"></script><!-- BOOTSTRAP DATEPICKER -->
      @yield('js')
      <script>
         (function(){
           function hideGBar(){
             try{
               var f1 = document.querySelector('iframe.goog-te-banner-frame');
               if(f1){ f1.style.display = 'none'; }
               var f2 = document.querySelector('.goog-te-banner-frame');
               if(f2){ f2.style.display = 'none'; }
               document.documentElement.style.setProperty('margin-top','0','important');
               document.body.style.setProperty('top','0','important');
             }catch(e){}
           }
           hideGBar();
           window.addEventListener('load', hideGBar);
           var mo = new MutationObserver(function(){ hideGBar(); });
           mo.observe(document.documentElement, { childList:true, subtree:true });
         })();
      </script>
      
      
      </body>
</html>