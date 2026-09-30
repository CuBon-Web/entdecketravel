<!-- HEADER START -->
<header class="sticky-header site-header header-style-1 mobile-sider-drawer-menu">
   <div class="main-bar-wraper  navbar-expand-lg">
       <div class="main-bar">  
                                   
           <!-- NAV Toggle Button -->
           <button id="mobile-side-drawer" data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggler collapsed">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar icon-bar-first"></span>
               <span class="icon-bar icon-bar-two"></span>
               <span class="icon-bar icon-bar-three"></span>
           </button>

           <div class="logo-header">
               <div class="logo-header-inner logo-header-one">
                   <a href="{{route('home')}}">
                   <img src="{{$setting->logo}}" alt="{{$setting->logo}}">
                   </a>
               </div>
           </div>

           <!-- MAIN Vav -->
           <div class="nav-animation header-nav navbar-collapse collapse d-flex justify-content-end">
       
               <ul class=" nav navbar-nav">
                   <li><a href="{{route('home')}}">Home</a>
                   </li>
                   <li class="has-child">
                     <a href="javascript:;">About Us</a>
                     <ul class="sub-menu">
                        <li><a href="{{route('aboutUs')}}">About Us</a></li>
                        <li><a href="{{route('fags')}}">FAQs</a></li>
                        <li><a href="{{route('feedback')}}">Feedback</a></li>
                     </ul>
                  </li>
                   <li class="has-child has-mega"><a href="javascript:;">Destinations</a>
                       <ul class="sub-menu mega-menu">
                           @foreach ($categoryhome as $item)
                           <li class="mega-col">
                               <a class="mega-heading" href="{{ route('allListProCate', ['danhmuc' => $item->slug]) }}">{{ languageName($item->name) }}</a>
                               <ul class="mega-links">
                                   @foreach ($item->typeCate->sortBy('id') as $type)
                                   <li>
                                       <a href="{{ route('allListType', ['danhmuc' => $item->slug, 'loaidanhmuc' => $type->slug]) }}">{{ languageName($type->name) }}</a>
                                   </li>
                                   @endforeach
                               </ul>
                           </li>
                           @endforeach
                       </ul>
                   </li>
                   @foreach ($tagCate as $item)
                   <li class="has-child"><a href="javascript:;">{{$item->name}}</a>
                       <ul class="sub-menu">
                           @foreach ($item->tags as $tag)
                           <li><a href="{{route('allListTags',['tag'=>$tag->slug])}}">{{$tag->name}}</a></li>
                           @endforeach
                       </ul>                                                                 
                   </li>
                   @endforeach
                   <li><a href="{{route('gallery')}}">Gallery</a></li>
           
                   <li class="has-child"><a href="javascript:;">Blogs</a>
                       <ul class="sub-menu">
                           @foreach ($blogCate as $item)
                           <li><a href="{{route('listCateBlog',['slug'=>$item->slug])}}">{{languageName($item->name)}}</a></li>
                           @endforeach
                       </ul>
                   </li>
                   <li><a href="{{route('lienHe')}}">Contact Us</a></li>
               </ul>

           </div>

           <!-- Header Right Section-->
           <div class="extra-nav header-1-nav">
            <div class="extra-cell one">
               <div class="trv-hdr-1-social">
                  @php
                    // Site default content is English: lock translation source to avoid wrong auto inference.
                    $gtSourceLang = 'en';
                  @endphp
                  <div id="google_translate_element" style="display:none;"></div>
                <ul class="gt-lang-dropdown" style="list-style:none; margin:0; padding:0; position:relative;">
                  <li>
                    <a href="javascript:;" class="gt-lang-toggle" aria-label="Language switcher" style="display:inline-flex; align-items:center; justify-content:space-between; min-width:60px; height:30px; border:2px solid #d8d8d8; border-radius:6px; color:#ffffff; padding:0 12px; font-size:12px;">
                      <span class="gt-lang-current">
                        <img width="20" height="20" src="{{url('frontend/images/flags/en.png')}}" alt="EN">
                      </span>
                      <span style="margin-left:0px; font-size:11px; color:#ffffff;">&#9662;</span>
                    </a>
                    <ul class="gt-lang-menu" style="display:none; list-style:none; margin:6px 0 0; padding:4px 0; position:absolute; top:100%; left:70px; min-width:45px; border:2px solid #d8d8d8; border-radius:6px; z-index:1000; background-color: #000000;">
                     
                      <li><a href="javascript:;" data-lang="en" style="display:block; padding:6px 12px; color:#ffffff;"><img width="20" height="20" src="{{url('frontend/images/flags/en.png')}}" alt="EN"></a></li>
                      <li><a href="javascript:;" data-lang="vi" style="display:block; padding:6px 12px; color:#ffffff;"><img width="20" height="20" src="{{url('frontend/images/flags/vi.png')}}" alt="VI"> </a></li>
                      <li><a href="javascript:;" data-lang="fr" style="display:block; padding:6px 12px; color:#ffffff;"><img width="20" height="20" src="{{url('frontend/images/flags/fr.png')}}" alt="FR"></a></li>
                      <li><a href="javascript:;" data-lang="de" style="display:block; padding:6px 12px; color:#ffffff;"><img width="20" height="20" src="{{url('frontend/images/flags/de.png')}}" alt="DE"></a></li>
                      <li><a href="javascript:;" data-lang="it" style="display:block; padding:6px 12px; color:#ffffff;"><img width="20" height="20" src="{{url('frontend/images/flags/it.png')}}" alt="IT"></a></li>
                      <li><a href="javascript:;" data-lang="es" style="display:block; padding:6px 12px; color:#ffffff;"><img width="20" height="20" src="{{url('frontend/images/flags/es.png')}}" alt="ES"></a></li>
                      <li><a href="javascript:;" data-lang="cs" style="display:block; padding:6px 12px; color:#ffffff;"><img width="20" height="20" src="{{url('frontend/images/flags/cs.png')}}" alt="CZ"></a></li>
                    </ul>
                  </li>
                </ul>
                  <script>
                    (function(){
                      if (!window.googleTranslateElementInit) {
                        window.googleTranslateElementInit = function() {
                          try {
                            new google.translate.TranslateElement({pageLanguage: '{{ $gtSourceLang }}', autoDisplay: false}, 'google_translate_element');
                          } catch(e){}
                        };
                        var s = document.createElement('script');
                        s.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
                        s.async = true;
                        document.head.appendChild(s);
                      }
                      window.gtSwitchLang = function(lang) {
                        function setCookie(name, value) {
                          var host = window.location.hostname;
                          document.cookie = name + '=' + value + '; path=/';
                          document.cookie = name + '=' + value + '; domain=' + host + '; path=/';
                        }
                        setCookie('googtrans', '/{{ $gtSourceLang }}/' + lang);
                        setCookie('googtrans', '/{{ $gtSourceLang }}/' + lang);
                        function apply() {
                          var sel = document.querySelector('select.goog-te-combo');
                          if (sel) { sel.value = lang; sel.dispatchEvent(new Event('change')); return true; }
                          return false;
                        }
                        if (!apply()) {
                          if (typeof google === 'object' && google.translate && google.translate.TranslateElement) {
                            googleTranslateElementInit();
                          }
                          setTimeout(apply, 300);
                        }
                      };
                      var langDropdown = document.querySelector('.gt-lang-dropdown');
                      if (langDropdown) {
                        var toggle = langDropdown.querySelector('.gt-lang-toggle');
                        var menu = langDropdown.querySelector('.gt-lang-menu');
                        var current = langDropdown.querySelector('.gt-lang-current');
                        if (toggle && menu && current) {
                          toggle.addEventListener('click', function(e){
                            e.preventDefault();
                            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                          });
                          menu.addEventListener('click', function(e){
                            var link = e.target.closest('a[data-lang]');
                            if (!link) return;
                            e.preventDefault();
                            var lang = link.getAttribute('data-lang');
                            var flagMap = {
                              en: { src: "{{url('frontend/images/flags/en.png')}}", alt: "EN" },
                              vi: { src: "{{url('frontend/images/flags/vi.png')}}", alt: "VI" },
                              fr: { src: "{{url('frontend/images/flags/fr.png')}}", alt: "FR" },
                              de: { src: "{{url('frontend/images/flags/de.png')}}", alt: "DE" },
                              it: { src: "{{url('frontend/images/flags/it.png')}}", alt: "IT" },
                              es: { src: "{{url('frontend/images/flags/es.png')}}", alt: "ES" },
                              cs: { src: "{{url('frontend/images/flags/cs.png')}}", alt: "CZ" }
                            };
                            var flag = flagMap[lang] || flagMap.en;
                            current.innerHTML = '<img width="20" height="20" src="' + flag.src + '" alt="' + flag.alt + '">';
                            menu.style.display = 'none';
                            gtSwitchLang(lang);
                          });
                          document.addEventListener('click', function(e){
                            if (!langDropdown.contains(e.target)) {
                              menu.style.display = 'none';
                            }
                          });
                        }
                      }
                    })();
                  </script>
               </div>                         
           </div>
               <div class="extra-cell one">
                   <div class="header-search">
                       <a href="#search" class="header-search-icon"><i class="bi bi-search"></i></a>
                   </div>                                
               </div>
           </div>

           
           <!-- SITE Search -->
           <div id="search"> 
               <span class="close-btn">X</span>
               <form role="search" id="searchform" action="{{ route('globalSearch') }}" method="get" class="radius-xl">
                   <div class="input-group">
                       <input class="form-control" value="{{ request('q') }}" name="q" type="search" placeholder="Search tour, blog...">
                       <span class="input-group-append">
                           <button type="submit" class="search-btn" aria-label="Search">
                               <i class="bi bi-search"></i>
                           </button>
                       </span>
                   </div> 
               </form>
           </div> 
       
       </div>
   </div>
   <!-- Sidebar popup Item -->
   <div class="xs-sidebar-group info-group">
       <div class="xs-overlay xs-bg-black"></div>
       <div class="xs-sidebar-widget">

           <div class="sidebar-widget-container">
               <div class="widget-heading">
                   <a href="#" class="close-side-widget">
                       <i class="bi bi-x-square-fill"></i>
                   </a>
               </div>

               <div class="sidebar-textwidget">

                   <!-- Sidebar Info Content -->
                   <div class="sidebar-info-contents">
                       <div class="content-inner">
                           <div class="content-box">

                               <div class="trv-side-pnl-info">
                                   <div class="trv-side-pnl-logo">
                                       <img src="{{$setting->logo}}" alt="Image">
                                   </div>
                                   <div class="trv-side-pnl-content">

                                       <div class="trv-side-pnl-content-mid">
                                           <h3 class="trv-sm-title">{{$setting->webname}}</h3>
                                           <h3 class="trv-lg-title">{{$setting->company}}</h3>
                                           <p>{{$setting->description}}</p>   
                                       </div>
                                       </ul>

                                       <ul class="social-icons">
                                           <li><a href="https://www.x.com"><i class="bi bi-twitter-x"></i></a></li>
                                           <li><a href="https://www.facebook.com "><i class="bi bi-facebook"></i></a></li>
                                           <li><a href="https://www.instagram.com"><i class="bi bi-instagram"></i></a></li>
                                           <li><a href="https://www.pinterest.com/"><i class="bi bi-pinterest"></i></a></li>
                                       </ul>


                                   </div>
                               </div>
                               
                           </div>
                       </div>
                   </div>

               </div>

           </div>
       </div>
   </div>
   <!--End Sidebar popup Item -->
</header>
<!-- HEADER END -->
<style>
@media (min-width: 992px) {
    .header-style-1 .header-nav .nav > li.has-mega {
        position: static;
    }
    .header-style-1 .header-nav .nav > li.has-mega > .mega-menu {
        left: 50%;
        right: auto;
        width: min(980px, calc(100vw - 40px));
        transform: translateX(-50%);
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 8px 28px;
        margin: 8px 0 0;
        padding: 26px 28px 18px;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 16px 40px rgba(16, 24, 40, 0.12);
        z-index: 30;
    }
    .header-style-1 .header-nav .nav > li.has-mega:hover > .mega-menu {
        margin-top: 8px;
        transform: translateX(-50%);
    }
}
.header-style-1 .header-nav .nav > li.has-mega > .mega-menu > .mega-col {
    border: 0;
    min-width: 0;
}
.header-style-1 .header-nav .nav > li.has-mega .mega-heading {
    display: block;
    margin: 0 0 12px;
    padding: 0;
    color: #1e3a4c;
    font-size: 15px;
    font-weight: 700;
    line-height: 1.35;
}
.header-style-1 .header-nav .nav > li.has-mega .mega-heading:hover {
    color: #85D200;
}
.header-style-1 .header-nav .nav > li.has-mega .mega-links {
    list-style: none;
    margin: 0;
    padding: 0;
}
.header-style-1 .header-nav .nav > li.has-mega .mega-links li {
    border: 0;
}
.header-style-1 .header-nav .nav > li.has-mega .mega-links a {
    display: block;
    padding: 4px 0;
    color: #3d4a50;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.45;
}
.header-style-1 .header-nav .nav > li.has-mega .mega-links a:hover,
.header-style-1 .header-nav.nav-animation .nav > li.has-mega:hover > ul.mega-menu .mega-links li:hover > a,
.header-style-1 .header-nav .nav > li.has-mega > .mega-menu .mega-links li:hover > a {
    padding-left: 0;
    color: #85D200;
}
.header-style-1 .header-nav.nav-animation .nav > li.has-mega:hover > ul.mega-menu .mega-heading:hover {
    padding-left: 0;
}
@media (max-width: 991px) {
    .header-style-1 .header-nav .nav > li.has-mega > .mega-menu {
        padding: 4px 0 10px;
        background: #f7f8f8;
        box-shadow: none;
    }
    .header-style-1 .header-nav .nav > li.has-mega .mega-links {
        display: block;
        position: static;
        visibility: visible;
        width: auto;
        margin: 0;
        padding: 0;
        background: transparent;
        opacity: 1;
    }
    .header-style-1 .header-nav .nav > li.has-mega .mega-col {
        border-bottom: 0;
    }
    .header-style-1 .header-nav .nav > li.has-mega .mega-heading {
        padding: 12px 18px 4px;
        margin: 0;
        font-size: 14px;
    }
    .header-style-1 .header-nav .nav > li.has-mega .mega-links a {
        padding: 7px 18px 7px 28px;
        font-size: 14px;
    }
    .header-style-1 .header-nav .nav > li.has-mega .mega-links a:hover,
    .header-style-1 .header-nav.nav-animation .nav > li.has-mega:hover > ul.mega-menu .mega-links li:hover > a,
    .header-style-1 .header-nav .nav > li.has-mega > .mega-menu .mega-links li:hover > a {
        padding-left: 28px;
    }
}
</style>