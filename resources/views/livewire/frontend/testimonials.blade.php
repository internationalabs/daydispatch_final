@extends('layouts.master')

@section('content')
<style>
    .font-size-34 {
        font-size: 34px!important;
    }

.about__3-content-left {
    padding-right: 100px;
}
/*=========  second section style ============*/
h2 i.fas.fa-quote-left {
    float: right;
    padding-right: 7rem;
}
.section__title .title {
    font-size: 36px;
    margin-bottom: 0;
    position: relative;
    z-index: 0;
}
h2 i.fas.fa-quote-left {
    float: right;
    padding-right: 7rem;
    font-size: 120px;
    position: absolute;
    z-index: 0;
    top: 92px;
    right: 0;
    color: #fff3f3;
}
.rating {
        margin-bottom: 16px;
}
.rating i.fas.fa-star {
    color: #bc101c;
    font-size: 23px;
}
.testimonial__icon.rate.rates-icon i {
    font-size: 20px;
    margin-right: 3px;
}
.about__3-content-btn .skew-btn.blue-btn::before {
    background: var(--clr-common-heading)!important;
}
.about__3-content-btn .skew-btn.blue-btn {
        color: var(--clr-common-white);
}
.about__3-content-btn .skew-btn.blue-btn:hover::before {
    background:var(--clr-common-white)!important;
}
.about__3-content-btn .skew-btn.blue-btn:hover {
        color: var(--clr-common-heading)!important;
}
.about__3.about__gray-bg::before {
    position: unset;
    top: 0;
    left: 0;
    width: 500px;
    height: 500px;
    background: var(--clr-bg-gray-4);
    content: "";
}
.approach__img img {
    width: 90%;
}
.padding {
    padding:0px;
}
.approach__area {
        display: flex;
        flex-direction: row-reverse;
        flex-direction: row-reverse;
        flex-wrap: wrap !important;
        row-gap: 26px;
}
/*=========  second section style ============*/
</style>

<!-- page title area  -->
<section class="page-title-area breadcrumb-spacing"
         data-background="{{ asset('frontend/img/breadcrumb-bg.webp') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="page-title-wrapper text-center">
                    <h3 class="page-title mb-25">Testimonials</h3>
                    <div class="breadcrumb-menu">
                        <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                            <ul class="trail-items">
                                <li class="trail-item trail-begin"><a
                                        href="{{ route('Frontend.index') }}"><span>Home</span></a></li>
                                <li class="trail-item trail-end"><span>Testimonials</span></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page title area end -->


<!-- testimonial-area-start -->
<section class="testimonial-area testimonial-space pb-100 pt-120 bg-css"
         data-background="{{ asset('frontend/img/testimonial/testimonial-bg.png') }}">
    <div class="container">
        <div class="row justify-content-center wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
            <div class="col-xl-5">
                <div class="section__title text-center mb-35">
                    <span class="sub-title">testimonials</span>
                    <h2 class="title">user feedbacks</h2>
                </div>
            </div>
        </div>
        <!-- Slider main container -->
        <div class="testimonial-box wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".5s">
            <div class="swiper-container testimonial-active testimonial-one">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <div class="testimonial-shadow">
                            <div class="testimonial-items">
                                <div class="testimonial__icon rate ">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="testimonial__text">
                                    <p>“ I recently used Day Dispatch for my transportation needs, and I must say, it
                                        was a game-changer. As a broker, I used to struggle to find reliable carriers
                                        for my deliveries, wasting hours and sometimes ending up with unsatisfactory
                                        services...”
                                    </p>
                                </div>
                                <div class="testimonial__auth">
                                    <div class="testimonial__auth-img f-left mr-20">
                                        <img src="{{asset('frontend/img/avatar.jpg')}}" alt="Testimonial">
                                    </div>
                                    <div class="testimonial__auth-text fix">
                                        <h4>Oliver D. Drummer</h4>
                                        <!--<span>General manager</span>-->
                                    </div>
                                </div>
                                <div class="testimonial__quote-icon quote">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-shadow">
                            <div class="testimonial-items">
                                <div class="testimonial__icon rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="testimonial__text">
                                    <p>“Day Dispatch Transportation is incredibly efficient and affordable. I
                                        immediately had access to a wide range of carriers. The ability to review and
                                        rate the carrier's services was a great feature as it allowed me to make
                                        informed decisions.
                                        Five stars from me!”
                                    </p>
                                </div>
                                <div class="testimonial__auth">
                                    <div class="testimonial__auth-img f-left mr-20">
                                        <img src="{{asset('frontend/img/avatar.jpg')}}" alt="Testimonial">
                                    </div>
                                    <div class="testimonial__auth-text fix">
                                        <h4>Miranda Nelson</h4>
                                        <!--<span>Head Of Idea</span>-->
                                    </div>
                                </div>
                                <div class="testimonial__quote-icon quote">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-shadow">
                            <div class="testimonial-items">
                                <div class="testimonial__icon rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div> 
                                <div class="testimonial__text">
                                    <p>“It is an excellent method , what impressed me the most was the level of
                                        transparency and authenticity provided by Day Dispatch.
                                        They ensured that the carriers on their platform had US DOT-licensed information
                                        and genuine profiles...”
                                    </p>
                                </div>
                                <div class="testimonial__auth">
                                    <div class="testimonial__auth-img f-left mr-20">
                                        <img src="{{asset('frontend/img/avatar.jpg')}}" alt="Testimonial">
                                    </div>
                                    <div class="testimonial__auth-text fix">
                                        <h4>Dewey M. Lewis</h4>
                                        <!--<span>ceo</span>-->
                                    </div>
                                </div>
                                <div class="testimonial__quote-icon quote">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-shadow">
                            <div class="testimonial-items">
                                <div class="testimonial__icon rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="testimonial__text">
                                    <p>“The customer service provided by Day Dispatch was top-notch. Their competent
                                        customer agents were available 24/7 and were always ready to assist. Whether I
                                        needed to call or chat, They were prompt, knowledgeable, and made my experience
                                        hassle-free.”
                                    </p>
                                </div>
                                <div class="testimonial__auth">
                                    <div class="testimonial__auth-img f-left mr-20">
                                        <img src="{{asset('frontend/img/avatar.jpg')}}" alt="Testimonial">
                                    </div>
                                    <div class="testimonial__auth-text fix">
                                        <h4>Lious M. Peter</h4>
                                        <!--<span>ceo</span>-->
                                    </div>
                                </div>
                                <div class="testimonial__quote-icon quote">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-shadow">
                            <div class="testimonial-items">
                                <div class="testimonial__icon rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="testimonial__text">
                                    <p>“I highly recommend Day Dispatch to anyone in need of dispatching and
                                        transportation services. Their platform, authentic carriers, transparency, and
                                        customer service exceeded my expectations. They have truly made my life easier...”
                                    </p>
                                </div>
                                <div class="testimonial__auth">
                                    <div class="testimonial__auth-img f-left mr-20">
                                        <img src="{{asset('frontend/img/avatar.jpg')}}" alt="Testimonial">
                                    </div>
                                    <div class="testimonial__auth-text fix">
                                        <h4>David Smith</h4>
                                        <!--<span>General Manager</span>-->
                                    </div>
                                </div>
                                <div class="testimonial__quote-icon quote">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-shadow">
                            <div class="testimonial-items">
                                <div class="testimonial__icon rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="testimonial__text">
                                    <p>“I found Day Dispatch unparalleled. They offer a wide range of
                                        carriers for delivering vehicles, heavy hauls, and more. I was just wondering
                                        how they are having such reliable shipping for roads! I appreciate their
                                        personalized approach!”
                                    </p>
                                </div>
                                <div class="testimonial__auth">
                                    <div class="testimonial__auth-img f-left mr-20">
                                        <img src="{{asset('frontend/img/avatar.jpg')}}" alt="Testimonial">
                                    </div>
                                    <div class="testimonial__auth-text fix">
                                        <h4>Json Smith</h4>
                                        <!--<span>Head of Company</span>-->
                                    </div>
                                </div>
                                <div class="testimonial__quote-icon quote">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonial Area End Here -->

<!-- About Us 3 Area Start Here -->
<section class="about__3 about__gray-bg p-relative pt-120 pb-60 wow fadeInUp" data-wow-duration="1.5s"
         data-wow-delay=".3s">
    <div class="container"> 
                        <div class="section__title text-center mb-35">
                    <h2 class="title">see what CARRIER are saying about us</h2>
                </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-5 col-lg-6">
                <div class="about__3-img-wrapper p-relative mb-60">
                    <div class="about__3-top w-img">
                        <img src="{{ asset('frontend/img/about/about-3-1.webp') }}" decoding="async" width="100%" height="100%" loading="lazy" alt="About">
                    </div>
                    <div class="about__3-main w-img">
                        <img src="{{ asset('frontend/img/about/about-carrier.jpeg') }}" decoding="async" width="100%" height="100%" loading="lazy" alt="About">
                    </div>
                    <div class="about__3-text clip-box-sm">
                        <!--<span><i class="far fa-trophy-alt"></i></span>-->
                        <!--<h4 class="about__3-title"> Years of experience</h4>-->
                           <div class="testimonial__icon rate rates-icon">
                                    <i class="fas fa-star"></i>
                                    <h4 class="about__3-title"> CARRIERS EXPERIENCE </h4>
                                </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="about__3-content mb-60">
                    <div class="section__title mb-30">
                                <div class="testimonial__icon rate rating" >
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>

                        <h2 class="title">unparalleled convenience and efficiency <i class="fas fa-quote-left"></i></h2>
                        
                    </div>
                    <div class="about__3-content-inner p-relative">
                        <div class="about__3-content-left padding ">
                            <p class="mb-15 text-justify">Day Dispatch has revolutionized the way carriers like myself operate in the transportation industry.
                            </p>
                            <p class="text-justify"> This platform serves as an vital tool for finding loads for vehicles, heavy equipment, and Freight shipments, offering unparalleled convenience and efficiency.
                            </p> 
                            <div class="about__3-content-btn mt-35">
                                <a href="https://daydispatch.com/Load-Board" class="skew-btn blue-btn">LoadBoard</a>
                                <a href="https://daydispatch.com/Authentication/Register-User" class="skew-btn">Signup</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us 3 Area End Here -->

       <div class="section__title text-center mb-35">
                    <h2 class="title">see what BROKER are saying about us</h2>
                </div>
    <section class="approach__area fix grey-bg-4" >

    <div class="approach__img m-img">
        <img src="https://daydispatch.com/frontend/img/approach/approch-img.webp" decoding="async" width="90%" height="100%" loading="lazy" alt="approach">
    </div>
    <div class="container">
        <div class="row g-0">
         <div class="col-xl-6 col-lg-6 pt-60">
                <div class="about__3-content mb-60">
                    <div class="section__title mb-30">
                        <div class="testimonial__icon rate rating" >
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>

                        <h2 class="title">Experience was generally good. <i class="fas fa-quote-left"></i></h2>
                        
                    </div>
                    <div class="about__3-content-inner p-relative">
                        <div class="about__3-content-left padding ">
                            <p class="mb-15 text-justify">As a broker operating in the competitive transportation industry, finding reliable Carrier is paramount to ensuring smooth operations and satisfied clients. 
                            </p>
                            <p class="text-justify">Day Dispatch offers thousand of carriers for vehicles, heavy equipment, and freight shipments, and my experience with it has been largely positive.
                            </p> 
                            <div class="about__3-content-btn mt-35">
                                <a href="https://daydispatch.com/Load-Board" class="skew-btn blue-btn">LoadBoard</a>
                                <a href="https://daydispatch.com/Authentication/Register-User" class="skew-btn">Signup</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- About Us 3 Area Start Here -->
<section class="about__3 about__gray-bg p-relative pt-120 pb-60 wow fadeInUp" data-wow-duration="1.5s"
         data-wow-delay=".3s">
    <div class="container"> 
                <div class="section__title text-center mb-35">
                    <h2 class="title">see what SHIPPER are saying about us</h2>
                </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-5 col-lg-6">
                <div class="about__3-img-wrapper p-relative mb-60">
                    <div class="about__3-top w-img">
                        <img src="{{ asset('frontend/img/about/about-3-1.webp') }}" decoding="async" width="100%" height="100%" loading="lazy" alt="About">
                    </div>
                    <div class="about__3-main w-img">
                        <img src="{{ asset('frontend/img/about/about-page-1.webp') }}" decoding="async" width="100%" height="100%" loading="lazy" alt="About">
                    </div>
                    <div class="about__3-text clip-box-sm">
                        <!--<span><i class="far fa-trophy-alt"></i></span>-->
                        <!--<h4 class="about__3-title"> Years of experience</h4>-->
                           <div class="testimonial__icon rate rates-icon">
                                    <i class="fas fa-star"></i>
                                    <h4 class="about__3-title"> SHIPPER EXPERIENCE </h4>
                          </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="about__3-content mb-60">
                    <div class="section__title mb-30">
                        <div class="testimonial__icon rate rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>

                        <h2 class="title">maximize productivity with Daydispatch <i class="fas fa-quote-left"></i></h2>
                        
                    </div>
                    <div class="about__3-content-inner p-relative">
                        <div class="about__3-content-left padding ">
                            <p class="mb-15 text-justify">In the fast-paced world of transportation and logistics, efficiency is key. Day Dispatch emerges as a beacon of efficiency, offering a comprehensive platform for vehicles, heavy equipment, and freight shipments . 
                            </p>
                            <p class="text-justify">As a user of this platform,
                             I have found it to be a game-changer in terms of streamlining operations and maximizing productivity.
                            </p> 
                            <div class="about__3-content-btn mt-35">
                                <a href="https://daydispatch.com/Load-Board" class="skew-btn blue-btn">LoadBoard</a>
                                <a href="https://daydispatch.com/Authentication/Register-User" class="skew-btn">Signup</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us 3 Area End Here -->


@endsection