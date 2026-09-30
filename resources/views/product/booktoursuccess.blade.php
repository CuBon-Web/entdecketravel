
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">    
    <meta name="description" content="">
    
    <!-- FAVICONS ICON -->
    <link rel="icon" href="{{$setting->favicon}}" type="image/x-icon">
    <link rel="shortcut icon" type="image/x-icon" href="{{$setting->favicon}}">
    
    <!-- PAGE TITLE HERE -->
    <title>Booking Success</title>
    
    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet"  href="/frontend/css/bootstrap.min.css"><!-- BOOTSTRAP STYLE SHEET -->
    <link rel="stylesheet"  href="/frontend/css/style.css"><!-- MAIN STYLE SHEET -->   
    
    
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

<!-- Curser Pointer -->
<div class="cursor"></div>
<div class="cursor2"></div>


<div class="page-wraper">

    <!-- CONTENT START -->
    <div class="page-content">

        <!-- Under Maintenance SECTION START -->
        <div class="section-full trv-under-main-wrap" style="background-image: url(/frontend/images/aaa.png);">
            
            <div class="container">
                    
                <div class="trv-under-main-Content">
                    <div class="trc-comi-logo">
                        <a href="{{route('home')}}"><img src="{{$setting->logo}}" alt="Logo"></a>    
                    </div>
                    <h4 class="trv-under-mainsm-title">Thank you for booking with us</h4>
                    <h2 class="trv-under-mainlg-title">Booking Success</h2>
                    <p class="trv-under-mainpara-text">We will contact you soon.</p>

                    
                    <ul class="social-icons">
                        <li><a href="{{route('home')}}">Back to Home</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<!-- JAVASCRIPT  FILES ========================================= --> 
<script  src="/frontend/js/jquery-3.7.1.min.js"></script><!-- JQUERY.MIN JS -->
<script  src="/frontend/js/popper.min.js"></script><!-- POPPER.MIN JS -->
<script  src="/frontend/js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script  src="/frontend/js/bootstrap-select.min.js"></script><!-- BOOTSTRAP SELECT.MIN JS -->
<script  src="/frontend/js/magnific-popup.min.js"></script><!-- MAGNIFIC-POPUP JS -->
<script  src="/frontend/js/waypoints.min.js"></script><!-- WAYPOINTS JS -->
<script  src="/frontend/js/counterup.min.js"></script><!-- COUNTERUP JS -->
<script  src="/frontend/js/isotope.pkgd.min.js"></script><!-- MASONRY  -->
<script  src="/frontend/js/imagesloaded.pkgd.min.js"></script><!-- MASONRY  -->
<script  src="/frontend/js/owl.carousel.min.js"></script><!-- OWL  SLIDER  -->
<script  src="/frontend/js/theia-sticky-sidebar.js"></script><!-- STICKY SIDEBAR  -->
<script  src="/frontend/js/jquery.bootstrap-touchspin.js"></script><!-- FORM JS -->
<script  src="/frontend/js/lc_lightbox.lite.js" ></script><!-- IMAGE POPUP -->
<script  src="/frontend/js/bootstrap-slider.min.js"></script><!-- Form js -->
<script  src="/frontend/js/swiper-bundle.min.js"></script> <!-- Swiper JS -->
<script  src="/frontend/js/img-parallax.js"></script><!-- Image Parallax -->

<script  src="/frontend/js/gsap.min.js"></script><!-- CURSOR -->
<script  src="/frontend/js/custom.js"></script><!-- CUSTOM FUCTIONS  -->
<script  src="/frontend/js/moment.min.js"></script>
<script  src="/frontend/js/bootstrap-datetimepicker.min.js"></script><!-- BOOTSTRAP DATEPICKER -->


</body>

</html>
