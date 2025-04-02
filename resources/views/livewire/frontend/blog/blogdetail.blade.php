<?php //echo $slot; die();

 $client = new \GuzzleHttp\Client();
$response = $client->request('GET', "https://blog.daydispatch.com/public/api/$id");
$data = json_decode($response->getBody());

?>
                   
                    
                    
<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Day Dispatch | <?=$data[0]->meta_title;?></title>
    <meta name="description" content="<?=$data[0]->meta_description;?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="dwlNH_KoCtphxr8_X75_OXA-nxdZWfmnrCrJssvnPO4" />
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/logo/logo.png') }}">
    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('frontend/css/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/backToTop.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/ui-range-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontAwesome5Pro.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    
    
    

<!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-N4GGWBB0YZ"></script>
    <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'G-N4GGWBB0YZ');
   </script>  
<!-- Google tag (gtag.js) -->
</head>
<style>
    ul.dropdown-menu.bg-danger.show li {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0px 8px;
        width: 100%;
    }

    .btn-font {
    font-size: 16px;
    color: var(--clr-common-white);
    padding: 17px 0;
    display: block;
    text-transform: uppercase;
    font-weight: 600;
    font-family: oswald, sans-serif;
}
.column-gap {
        column-gap: 40px;
}
.hover:hover {
    color: #db1c29;
}
h4.hover {
    cursor: pointer;
}
 .recent-post-img {
     float: left;
    max-width: 100px;
    margin-right: 12px;
    height: auto;
    opacity: 1;
    transition: opacity 350ms;
    border-radius: 5px;
 }
 
 .set_margin {
     margin-bottom: 60px;
 }
</style>
{{--onload="zoom()"--}}
<body>
    <!--dev AYK (SE)-->
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->
<!-- Preloader start -->
<div class="preloader">
    <img src="{{ asset('frontend/img/logo/preloader-icon.gif') }}" alt="preloader-icon">
</div>
<!-- Preloader end -->

<!-- header area start  -->
<header>
    <div class="header__top header__pad d-none d-md-block">
        <div class="container">
            <div class="row g-0 align-items-center">
                <div class="col-xl-5 col-md-5">
                    <div class="header__text">
                            <span class="uppercase">We’re more than just transport. <b><a
                                        href="{{ route('Frontend.contact.us') }}">Free
                                        Consultancy</a></b> </span>
                    </div>
                </div>
                <div class="col-xl-7 col-md-7 d-flex justify-content-end">
                    <div class="header__text">
                            <span class="uppercase">
                            <marquee>
                                Day Dispatch offers completely free account for both brokers, and carriers. To publish or accept a load,
                            </marquee>
                                </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header__bottom-wrapper white-bg pb-15">
        <div class="container">
            <div class="header__bottom p-relative">
                <div class="header__bottom-info">
                    <div class="row align-items-center">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-3">
                            <div class="logo logo-transform">
                                <a href="{{ route('Frontend.index') }}"><img
                                        src="{{ asset('frontend/img/logo/logo.png') }}"  width="80" height="54" alt="Logo"></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10 col-9">
                            <div class="text-end d-xl-none">
                                <div class="header__toggle-btn sidebar-toggle-btn">
                                    <div class="header__bar">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>

                            </div>
                            <div class="d-none d-xl-block">
                                <div class="header__info">
                                    <div class="d-inline-flex column-gap">  
                                        <h3> </h3>
                                        <h3> </h3>
                                        <h3> </h3>
                                        <h3> </h3>
                                        <h3> </h3>
                                        <h3> </h3>
                                        <a href="{{ route('Frontend.Shipper') }}">
                                        <h4 class="hover"> <i class="fas fa-shipping-fast"> </i> Shipper</h4>
                                        </a>
                                        <a href="{{ route('Frontend.Broker') }}">
                                        <h4 class="hover"> <i class="fas fa-user"> </i> broker</h4>
                                        </a>
                                        <a href="{{ route('Frontend.Carrier') }}">
                                        <h4 class="hover"> <i class="fas fa-truck"> </i> Carrier</h4>
                                        </a>
                                    </div>
                                      <div class="d-inline-flex">  
                                    <div class="header__info-item">
                                        <div class="header__info-icon">
                                         <a href="https://www.facebook.com/profile.php?id=61550689836975" target="_blank">
                                            <i class="flaticon-facebook hover"></i>
                                          </a>
                                        </div>
                                    </div>
                                    <div class="header__info-item">
                                        <div class="header__info-icon">
                                          <a href="https://www.instagram.com/daydispatch/" target="_blank">
                                            <i class="fab fa-instagram hover"></i>
                                          </a>
                                        </div>
                                    </div>
                                    <div class="header__info-item">
                                        <div class="header__info-icon">
                                          <a href="https://twitter.com/daydispatch101" target="_blank">
                                             <i class="fab fa-twitter hover"></i>
                                          </a>
                                        </div>  
                                    </div> 
                                    <div class="header__info-item">
                                       <div class="header__info-icon">
                                         <a href="https://www.linkedin.com/in/day-dispatch-53023428b/" target="_blank">
                                            <i class="fab fa-linkedin hover"></i>
                                         </a>
                                       </div> 
                                    </div> 
                                    <div class="header__info-item">
                                      <div class="header__info-icon">
                                       <a href="https://www.youtube.com/@DayDispatch1" target="_blank"> 
                                            <i class="fab fa-youtube hover"></i>
                                       </a>
                                      </div> 
                                    </div> 
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu-area position d-none d-xl-block p-absolute"> 
                    <div class="row d-flex justify-content-end align-items-center">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo d-none">
                                <a href="{{ route('Frontend.index') }}"><img
                                        src="{{ asset('frontend/img/logo/logo.png') }}" alt="Logo"></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">
                            <div class="menu-wrapper menu-bg d-flex justify-content-between">
                                <div class="main-menu main-menu-1">
                                    <nav id="mobile-menu">
                                        <ul> 
                                            <li><a href="{{ route('Frontend.index') }}">Home</a></li>
                                            <li><a href="{{ route('Frontend.about.us') }}">About Us</a></li>
                                            <li><a href="{{ route('Frontend.loadboard') }}">LoadBoard</a></li>
                                            <li><a href="{{ route('Frontend.is.me') }}">Is it For Me?</a></li>
                                            <!--<li><a href="{{ route('Frontend.contact.us') }}">Contact Us</a></li>-->
                                                          
                                              <li class="dropdown-toggle d-inline-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                  <a href="#">pricing</a>
                                              </li>
                                              <ul class="dropdown-menu menu-bg text-center" > 
                                                        <form action="{{ route('Frontend.Packages') }}" method="GET">
                                                            @csrf
                                                               <input type="hidden" name="type" value="Brokers"/>
                                                               <li><button type="subbmit" class="text-center text-white text-val btn-font" target="_blank" data-value="Brokers">Brokers</button></li>
                                                        </form>
                                                        <form action="{{ route('Frontend.Packages') }}" method="GET">
                                                            @csrf
                                                               <input type="hidden" name="type" value="Carriers"/>
                                                               <li><button type="subbmit" class="text-center text-white text-val btn-font" target="_blank" data-value="Carriers">Carriers</button></li>
                                                        </form>
                                                        {{--
                                                        <!--<form action="{{ route('Frontend.Packages') }}" method="GET">-->
                                                        <!--    @csrf-->
                                                        <!--       <input type="hidden" name="type" value="Dispatch"/>-->
                                                        <!--       <li><button type="subbmit" class="text-center text-white text-val btn-font" target="_blank" data-value="Dispatch">Dispatch</button></li>-->
                                                        <!--</form>-->
                                                        --}}
                                                        <form action="{{ route('Frontend.Packages') }}" method="GET">
                                                            @csrf
                                                               <input type="hidden" name="type" value="Shipper"/>
                                                               <li><button type="subbmit" class="text-center text-white text-val btn-font" target="_blank" data-value="Shipper">Shipper</button></li>
                                                        </form>
                                              </ul>
                                           
                                            <!--<li><a href="https://daydispatch.com/Blog">Blog</a>-->
                                            <li><a href="{{ route('Frontend.qoute.request') }}">get a quote</a>
                                            </li>
                                           
               
                                        </ul>
                                    </nav>
                                </div>
                                @if (!Auth::guard('Authorized')->user())
                                    <div class="menu-btn">
                                        <a href="{{ route('Auth.Forms') }}">LogIn</a>
                                    </div>
                                @else
                                    <div class="menu-btn">
                                        <a href="{{ route('User.Dashboard') }}">Dashboard</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sticky Menu Area Start Here  -->
    <div id="header-sticky" class="sticky-area menu-sticky menu-hidden">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-2 col-3">
                    <div class="logo">
                        <a href="{{ route('Frontend.index') }}"><img
                                src="{{ asset('frontend/img/logo/logo.png') }}" alt="Logo"></a>
                    </div>
                </div>
                <div class="col-xl-10 col-lg-10 col-9">
                    <div class="menu-wrapper menu-none d-flex align-items-center justify-content-between">
                        <div class="main-menu main-menu-1">
                            <nav>
                                <ul>
                                    <li><a href="{{ route('Frontend.index') }}">Home</a></li>
                                    <li><a href="{{ route('Frontend.about.us') }}" >About Us</a></li>
                                    <li><a href="{{ route('Frontend.loadboard') }}">LoadBoard</a></li>
                                    <li><a href="{{ route('Frontend.is.me') }}">Is it For Me?</a></li>
                                    <!--<li><a href="{{ route('Frontend.contact.us') }}">Contact Us</a></li> -->
                                             
                                    <li class="dropdown-toggle d-inline-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false"><a href="#">pricing</a></li>
                                              <ul class="dropdown-menu menu-bg text-center" > 
                                                        <form action="{{ route('Frontend.Packages') }}" method="GET">
                                                            @csrf
                                                               <input type="hidden" name="type" value="Brokers"/>
                                                               <li><button type="subbmit" class="text-center text-white text-val btn-font" target="_blank" data-value="Brokers">Brokers</button></li>
                                                        </form>
                                                        <form action="{{ route('Frontend.Packages') }}" method="GET">
                                                            @csrf
                                                               <input type="hidden" name="type" value="Carriers"/>
                                                               <li><button type="subbmit" class="text-center text-white text-val btn-font" target="_blank" data-value="Carriers">Carriers</button></li>
                                                        </form>
                                                        {{--
                                                        <!--<form action="{{ route('Frontend.Packages') }}" method="GET">-->
                                                        <!--    @csrf-->
                                                        <!--       <input type="hidden" name="type" value="Dispatch"/>-->
                                                        <!--       <li><button type="subbmit" class="text-center text-white text-val btn-font" target="_blank" data-value="Dispatch">Dispatch</button></li>-->
                                                        <!--</form>-->
                                                        --}}
                                                        <form action="{{ route('Frontend.Packages') }}" method="GET">
                                                            @csrf
                                                               <input type="hidden" name="type" value="Shipper"/>
                                                               <li><button type="subbmit" class="text-center text-white text-val btn-font" target="_blank" data-value="Shipper">Shipper</button></li>
                                                        </form>
                                              </ul>
                                            
                                    <li><a href="{{ route('Frontend.qoute.request') }}">get a quote</a>
                                </ul>
                            </nav>
                        </div>
                        @if (!Auth::guard('Authorized')->user())
                            <div class="menu-btn">
                                <a class="clip-btn" href="{{ route('Auth.Forms') }}">LogIn</a>
                            </div>
                        @else
                            <div class="menu-btn">
                                <a class="clip-btn" href="{{ route('User.Dashboard') }}">Dashboard</a>
                            </div>
                        @endif
                    </div>
                    <div class="header__toggle-btn sidebar-toggle-btn text-end d-block d-lg-none">
                        <div class="header__bar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sticky Menu Area End Here  -->
    <!-- Sidebar Area Start Here  -->
    <div class="sidebar__area">
        <div class="sidebar__wrapper">
            <div class="sidebar__close">
                <button class="sidebar__close-btn" id="sidebar__close-btn" aria-label="Close Sidebar">
                    <i class="fal fa-times"></i>
                </button>
            </div>
            <div class="sidebar__content">
                <div class="sidebar__logo mb-40">
                    <a href="{{ route('Frontend.index') }}">
                        <img src="{{ asset('frontend/img/logo/logo.png') }}" alt="logo.png">
                    </a>
                </div>
                <div class="sidebar__search mb-25">
                    <form action="#">
                        <div class="single-input-field">
                            <input name="name" type="text" placeholder="Search Here">
                            <i class="fas fa-search"></i>
                        </div>
                    </form>
                </div>
                <div class="mobile-menu fix mb-10 mean-container">
                </div>
                <div class="sidebar__contact mt-30 mb-30">
                    <div class="sidebar__info fix">
                        <div class="sidebar__info-item">
                            <div class="sidebar__info-icon">
                                <i class="flaticon-telephone-call"></i>
                            </div>
                            <div class="sidebar__info-text">
                                <span>Call us now</span>
                                <h5><a href="tel:+14107184031">1 (410) 718-4031</a></h5>
                            </div>
                        </div>
                        <div class="sidebar__info-item">
                            <div class="sidebar__info-icon">
                                <i class="flaticon-envelope "></i>
                            </div>
                            <div class="sidebar__info-text">
                                <span>Email now</span>
                                <h5><a href="/cdn-cgi/l/email-protection#8ee7e0e8e1cef9ebeceae1f9a0ede1e3" class="hover"><span
                                            class="__cf_email__"
                                            data-cfemail="0a63646c654a7d6f686e657d24696567">support@daydispatch.com</span></a>
                                </h5>
                            </div>
                        </div>
                        <div class="sidebar__info-item">
                            <div class="sidebar__info-icon">
                                <i class="flaticon-pin "></i> 
                            </div>
                            <div class="sidebar__info-text"> 
                                <span>MD 21030</span>
                                <h5>Baltimore, united states</h5>
                            </div>
                        </div>
                              @if (!Auth::guard('Authorized')->user())
                                    <div class="menu-btn">
                                        <a href="{{ route('Auth.Forms') }}">LogIn</a>
                                    </div>
                                @else
                                    <div class="menu-btn">
                                        <a href="{{ route('User.Dashboard') }}">Dashboard</a>
                                    </div>
                                @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Sidebar Area Start Here  -->
    <div class="body-overlay"></div>
</header>
<main>
    
     
<div class="modal fade"  class="modal-dialog modal-lg" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel">Calculate Freight Class</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          @include('livewire.backend.extras.frieght-calculator')
      </div>
      <div class="modal-footer">
        <!--<button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Open second modal</button>-->
      </div>
    </div>
  </div>
</div>
</main>
<style>
    .about__3.about__gray-bg::before{
        display: none;
    }
    .recent-post-h5 {
        font-size: 14px;
        font-weight: 600;
    }
    .recent-post-img {
        width:100px;height:100px;
    }
</style>
<!-- page title area  -->
<section class="page-title-area breadcrumb-spacing" data-background="{{ asset('frontend/img/breadcrumb-bg.webp') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="page-title-wrapper text-center">
                    <h3 class="page-title mb-25"><?=$data[0]->post_name;?></h3>
                    <div class="breadcrumb-menu">
                        <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                            <ul class="trail-items">
                                <li class="trail-item trail-begin"><a
                                        href="{{ route('Frontend.index') }}"><span>Home</span></a></li>
                                <li class="trail-item trail-end"><span><?=$data[0]->post_name;?></span></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 
<!-- page title area end -->
<section class="about__3 about__gray-bg p-relative pt-120 pb-60 wow fadeInUp" data-wow-duration="1.5s"
         data-wow-delay=".3s">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="about__3-main w-img" >
                        <img src="https://blog.daydispatch.com/public/uploads/apifileregistration/<?=$data[0]->post_image;?>" alt="<?=$data[0]->post_name;?>" style="width: 60%;">
                    </div>
                <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="services__details-wrapper mb-60">
                    <div class="service__details-content mb-25">
                        <h4><?=$data[0]->post_name;?>:</h4>
                        <?=$data[0]->post_description;?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
						<div class="right-blog">
							<div class="recent">
								<h3 class="right-heading">Recent Posts</h3>
								
								<ul class="blog-recent">
                                    <?php  
                                    $client1 = new \GuzzleHttp\Client();
                                    $response1 = $client1->request('GET', "https://blog.daydispatch.com/public/api/resent_post"); // Corrected variable name $client1
                                    $data1 = json_decode($response1->getBody()); // Corrected variable name $response1
                                    //echo "<pre>";print_r($data1);
                                    foreach($data1 as $d1){
                                    ?>
                                    <li class="set_margin">
                                        <a href="https://daydispatch.com/Blog/<?= $d1->slug_name ?>">
                                            <img class="recent-post-img"  alt="<?= $d1->post_name ?>" src="https://blog.daydispatch.com/public/uploads/apifileregistration/<?= $d1->post_image ?>">
                                            <h5 style="font-size: 14px; font-weight: 600;"><?= $d1->post_name ?></h5>
                                            <p><?= strlen($d1->post_short_description) > 20 ? substr($d1->post_short_description, 0, 40) . '...' : $d1->post_short_description ?></p>
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>
								
							</div>
							<div class="blog-contact">
								<h3 class="right-heading">Contact Us</h3>
								<ul class="contact-list">
									<li style="margin-top:5px;">
										<i class="lni-phone-handset"></i>
									<a href="tel:+14107184031">	<span>Call Us : <strong>1(410) 718-4031</strong></span> </a>
									</li>
									<li style="margin-top:5px;">
										<i class="lni-envelope"></i>
										<span>Email : <a href="mailto:support@daydispatch.com">support@daydispatch.com</a></span>
									</li>
									<li style="margin-top:5px;">
										<i class="lni-alarm-clock"></i>
										<span>Mon - Sat: 8AM - 7PM </span>
									</li>
								</ul>
							</div>
						</div>
					</div>
            </div>
            
            
            
            
            
            
            
                        </div>
                    </div>
                    </section>
 
     
<div class="modal fade"  class="modal-dialog modal-lg" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel">Calculate Freight Class</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          @include('livewire.backend.extras.frieght-calculator')
      </div>
      <div class="modal-footer">
        <!--<button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Open second modal</button>-->
      </div>
    </div>
  </div>
</div>
</main>
<!-- footer area start  -->
<footer>
    <section class="footer-area footer-area1 footer-area1-bg pt-100 pb-90">
        <div class="container">
            <div class="row">
                <!--<div class="col-lg-4 col-xl-3 col-md-6 col-sm-6">-->
                <!--    <div class="footer-widget footer1-widget1 mb-50 pr-20">-->
                <!--        <div class="footer-widget-title">-->
                <!--            <h4>about us</h4>-->
                <!--        </div>-->
                <!--        <p class="mb-40">Customers struggled to find reliable carriers for their deliveries, leading to-->
                <!--            wasted time, high charges, unsatisfactory service, shipment delays, safety concerns, and-->
                <!--            regulatory issues.-->
                <!--        </p>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6">
                    <div class="footer-widget footer1-widget1 mb-50 pr-20">
                        <div class="footer-widget-title">
                            <h4>Contact us</h4>
                        </div>
                            <div class="d-none d-xl-block">
                                <div class="header__info flex-column text-white">
                                    <div class="header__info-item">
                                        <div class="header__info-icon">
                                            <i class="flaticon-telephone-call text-danger"></i>
                                        </div>
                                        <div class="header__info-text">
                                            <span>Call us now</span>
                                            <h5><a href="tel:+14107184031" class="hover">1(410) 718-4031</a></h5>
                                        </div>
                                    </div>
                                    <div class="header__info-item">
                                        <div class="header__info-icon">
                                            <i class="flaticon-envelope text-danger"></i>
                                        </div>
                                        <div class="header__info-text">
                                            <span>Email now</span>
                                            <h5><a
                                                    href="mailto:support@daydispatch.com"><span
                                                        class="__cf_email__ hover"
                                                        data-cfemail="c6afa8a0a986b1a3a4a2a9b1e8a5a9ab" >support@daydispatch.com</span></a>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="header__info-item">
                                        <div class="header__info-icon">
                                            <i class="flaticon-pin text-danger"></i>
                                        </div>
                                        <div class="header__info-text ">
                                            <span class="hover">1007 FREDERICK ROAD</span>
                                            <h5><a
                                                    href="https://maps.google.com/maps?q=1007+FREDERICK+ROAD+CATONSVILLE+MD+21228+UNITED+STATES">CATONSVILLE, MD, 21228 UNITED STATES</a></h5>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6">
                    <div class="footer-widget footer2-widget footer2-widget3 mb-50 pl-55">
                        <div class="footer-widget-title">
                            <h4>useful links</h4>
                        </div>
                        <ul class="footer-widget-link-2">
                            <li><i class="fas fa-truck"></i><a href="{{ route('Frontend.about.us') }}">About
                                    Us</a></li>
                            <li><i class="fas fa-clipboard"></i><a
                                    href="{{ route('Frontend.loadboard') }}">LoadBoard</a></li>
                            <li><i class="fas fa-box"></i><a href="{{ route('Frontend.is.me') }}">Is It For
                                    Me?</a></li>
                            <li><i class="fas fa-box"></i><a href="{{ route('Frontend.Testimonials') }}">Testimonials</a></li>
                            <li><i class="fa fa-bracket"></i><a href="{{ route('Auth.Forms') }}">Login</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6">
                    <div class="footer-widget footer2-widget footer2-widget3 mb-50 pl-55">
                        <div class="footer-widget-title">
                            <h4>Useful Services</h4>
                        </div>
                        <ul class="footer-widget-link-2">
                            <li><i class="fas fa-truck"></i><a href="{{ route('Frontend.Carrier') }}">Carriers</a></li>
                            <li><i class="fas fa-user"></i><a href="{{ route('Frontend.Broker') }}"> Brokers</a></li>
                            <li><i class="fas fa-shipping-fast"></i><a href="{{ route('Frontend.Shipper') }}">Shipper</a></li>
                            {{-- <li><i class="fa fa-truck"></i><a href="{{ route('Frontend.Dispatch') }}">Dispatch</a></li> --}}
                            <li><i class="fa fa-bracket"></i><a href="{{ route('Auth.New.User') }}">SignUp</a>
                           </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6">
                    <div class="footer-widget footer1-widget3 mb-50 pr-45">
                        <div class="footer-widget-title">
                            <h4>Subscribe us</h4>
                        </div>
                        <p class="mb-20">Subscribe us &amp; receive our office &amp; update in your inbox directly
                        </p>
                        <form action="#" class="subscribe-form subscribe-form-footer1">
                            <div class="s-clip p-relative s-input mb-10">
                                <input type="text" placeholder="Enter your email">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <button type="submit">Subscribe Now</button>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </section>
    <div class="footer__bottom-area copy-bg-1 p-relative">
        <div class="footer-menu-area position p-absolute">
            <div class="container">
                <div class="red-bg clip-box-xs">
                    <div class="footer-menu-box">
                        <div class="row align-items-center">
                            <div class="col-xxl-7 col-lg-5">
                                <div class="footer-menu mb-15">
                                    <nav>
                                        <ul>
                                            <li><a href="{{ route('Frontend.terms') }}">terms & conditions</a>
                                            </li>
                                            <li><a href="{{ route('Frontend.faq') }}">FAQ</a></li>
                                            <li><a href="{{ route('Frontend.privacy') }}">Privacy Policy</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <!--<div class="col-xxl-5 col-lg-7">-->
                            <!--    <div class="footer-brand m-img mb-15 text-center text-lg-end">-->
                            <!--        <img src="{{ asset('frontend/img/footer-icon-img.png') }}"-->
                            <!--            alt="footer icon">-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right-area">
            <div class="container">
                <div class="copy-right-text text-center">
                    @php
                        $lastYear = date('Y', strtotime('-1 year'));
                        $currentYear = date('Y');
                    @endphp
                    {{-- <p>Copyright & design by <a href="{{ route('Frontend.index') }}">@DayDispatch</a></p> --}}
                    <p>©<a href="{{ route('Frontend.index') }}"  class="text-decoration-underline" > DayDispatch</a> {{ $lastYear }}-{{ $currentYear }}. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end  -->
<!-- back to top start -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
    </svg>
</div>
<!-- back to top end -->
<!-- JS here -->

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="{{ asset('frontend/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/meanmenu.js') }}"></script>
<script src="{{ asset('frontend/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/js/parallax.min.js') }}"></script>
<script src="{{ asset('frontend/js/backToTop.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-ui-slider-range.js') }}"></script>
<script src="{{ asset('frontend/js/nice-select.min.js') }}"></script>
<script src="{{ asset('frontend/js/counterup.min.js') }}"></script>
<script src="{{ asset('frontend/js/ajax-form.js') }}"></script>
<script src="{{ asset('frontend/js/wow.min.js') }}"></script>
<script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/js/rangeslider-js.min.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<!--============sent to LoadBoard-Packages page of the selected value  create js page show the js link in both pages for accessing ==================-->
  <script>
    // $(document).ready(function() {
    //   $(".text-val").on("click", function() {
    //     let selectedValue = $(this).data("value");
    //     console.log(selectedValue);
    //     // You can use the selectedValue as needed
    //   });
    // });
  </script>
<!--============sent to LoadBoard-Packages page of the selected value==================-->
<script>
    $('.basic_quote_info').hide();
    $('.vehicle_quote_info').hide();
    $('.route_quote_info').hide();

    $('.vehicle_make').hide();
    $('.vehicle_model').hide();
    $('.vehicle_heading').hide();
    $('.vehicle_dimension').hide();
    $('.vehicle_additional').hide();
    $('.vehicle_carrier').hide();
    $('.vehicle_condition').hide();
    $('.vehicle_quote_info_Freight').hide();
    $('.vehicle_quote_info').hide();
    var showdryvanpopup = 0;
    
    
    
    $(document).ready(function () {
        $('.route_quote_info').show();
        $('#step_2').click(function () {
            if ($("#F_ZipCode").val() === '') {
                $("#F_ZipCode").attr("style", "border-color:red;");
            } else {
                $("#F_ZipCode").attr("style", "border-color:transparent;");
            }
            if ($("#T_ZipCode").val() === '') {
            $("#T_ZipCode").attr("style", "border-color:red;");
            } else {
                $("#T_ZipCode").attr("style", "border-color:transparent;");
            }
            if ($("#F_ZipCode").val() !== '' && $("#T_ZipCode").val() !== '') {
                $('.route_quote_info').hide();
                $('.vehicle_quote_info').show();
                $('.vehicle_quote_info_Freight').hide();
            }
        });
        $('.step_1').click(function () {
            $('.route_quote_info').show();
            $('.vehicle_quote_info').hide();
            $('.vehicle_quote_info_Freight').hide();
        });
        $('.step_1_goback').click(function(){
            $('.route_quote_info').hide();
            $('.vehicle_quote_info').show();
            $('.vehicle_quote_info_Freight').hide();
        })
        $("#showdryvan").click(function(){
            console.log('show Dry Van');
            $('.vehicle_quote_info_Freight').show();
            $('.route_quote_info').hide(); 
            $('.vehicle_quote_info').hide();
            
            
            showdryvanpopup = 1;
        })
        $('.vehicle_type select').change(function () {
            const type = $(this).val();
            if(type == 'DRYVAN'){
                $('#vehicleinfo').text('Freight shipping')
            }
            else if(type){
                $('#vehicleinfo').text(type)
            }
            else{
                $('#vehicleinfo').text("VEHICLE INFORMATION")
            } 
            if (type === 'Car') {
                $('.vehicle_make').show();
                $('.vehicle_model').show();
                $('.vehicle_carrier').show();
                $('.vehicle_condition').show();
                $('.vehicle_heading').hide();
                $('.vehicle_dimension').hide();
                $('.vehicle_additional').hide();
                
                // $('#selectvehicle').children('a').attr('id','step_3');
                $('#nextstepof').children('#first').show();
                $('#nextstepof').children('#second').hide();

            } else if (type === 'MotorCycle') {
                $('.vehicle_heading').show();
                $('.vehicle_additional').show();
                $('.vehicle_carrier').show();
                $('.vehicle_condition').show();
                $('.vehicle_make').hide();
                $('.vehicle_model').hide();
                $('.vehicle_dimension').hide();
                
                // $('#selectvehicle').children('a').attr('id','step_3');
                
                $('#nextstepof').children('#first').show();
                $('#nextstepof').children('#second').hide();
                
            } else if (type === 'Heavy Equipment') {
                $('.vehicle_heading').show();
                $('.vehicle_dimension').show();
                $('.vehicle_additional').show();
                $('.vehicle_make').hide();
                $('.vehicle_model').hide();
                $('.vehicle_carrier').hide();
                $('.vehicle_condition').hide();
                
                // $('#selectvehicle').children('a').attr('id','step_3');
                
                $('#nextstepof').children('#first').show();
                $('#nextstepof').children('#second').hide();
                
            } else if (type === 'Dryvan') {
                console.log('show')
                $('.vehicle_dimension').show();
                
                
                $('.vehicle_make').hide();
                $('.vehicle_model').hide();
                $('.vehicle_heading').hide();
                $('.vehicle_additional').hide();
                $('.vehicle_carrier').hide();
                $('.vehicle_condition').hide();
                
                // $('#selectvehicle').children('a').attr('id','showdryvan');
                
                
                $('#nextstepof').children('#first').hide();
                $('#nextstepof').children('#second').show();
            }else {
                $('.vehicle_make').hide();
                $('.vehicle_model').hide();
                $('.vehicle_heading').hide();
                $('.vehicle_dimension').hide();
                $('.vehicle_additional').hide();
                $('.vehicle_carrier').hide();
                $('.vehicle_condition').hide();
                
                // $('#selectvehicle').children('a').attr('id','step_3');
                
                $('#nextstepof').children('#first').show();
                $('#nextstepof').children('#second').hide();
            }
        });
        $('.step_3').click(function () {
            $('.route_quote_info').hide();
            $('.vehicle_quote_info').hide();
            $('.basic_quote_info').show();
            $('.vehicle_quote_info_Freight').hide();
                
             showdryvanpopup = 0;
        });
        $('.step_3_show').click(function () {
            $('.route_quote_info').hide();
            $('.vehicle_quote_info').hide();
            $('.basic_quote_info').show();
            $('.vehicle_quote_info_Freight').hide();
            
             showdryvanpopup = 1;
        });
        $('#prev_step_2').click(function () {
            console.log(showdryvanpopup)
            if(showdryvanpopup != 0){
                $('.route_quote_info').hide();
                $('.vehicle_quote_info').hide();
                $('.basic_quote_info').hide();
                $('.vehicle_quote_info_Freight').show();                
            }
            else{
                $('.route_quote_info').hide();
                $('.vehicle_quote_info').show();
                $('.basic_quote_info').hide();
                $('.vehicle_quote_info_Freight').hide();
            }
            
        });
    });
</script>
<script>
    const path = "{{ route('autocomplete') }}";
    $('.Dest_ZipCode.typeahead, .Origin_ZipCode.typeahead').typeahead({
        source: function (query, process) {
            return $.get(path, {query: query}, function (data) {
                return process(data);
            });
        }
    });

    const GetVehicleMake = '{{ route('Get.Vehcile.Make') }}';
    const GetVehicleModel = '{{ route('Get.Vehcile.Model') }}';
    $('input.make.typeahead').typeahead({
        source: function (query, process) {
            return $.get(GetVehicleMake, {query: query}, function (data) {
                return process(data);
            });
        }
    });

    $('input.model.typeahead').typeahead({
        source: function (query, process) {
            return $.get(GetVehicleModel, {query: query}, function (data) {
                return process(data);
            });
        }
    });
    
    function calculateFreight(){
       let x = document.getElementById('CarrierRequestLoad');
       x.style.display="block";
    }
    
    $('#firstrow').children('.col-lg-2').addClass('col-lg-6');
    $('.breadcrumb-area h1').remove();
    $('.breadcrumb .item:nth-child(2)').remove();
</script>
</body>

</html>
