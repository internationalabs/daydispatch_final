<style>
    .font-size-34 {
        font-size: 34px !important;
    }

    #myTabContent.li {
        width: 266px. text-align: center;
    }

    #myTabContent .li div {
        text-align: center !important;
    }

    #myTabContent {
        width: 70%;
    }

    #myTab {
        justify-content: center !important;
        width: 100%;
        column-gap: 55px;
        align-items: baseline;
        margin: auto;
        row-gap: 25px;
        flex-direction: unset;
    }

    .nav-link.clip-lg-btn {
        margin: auto;
        margin-bottom: 20px;
    }
</style>
<!-- page title area  -->
<section class="page-title-area breadcrumb-spacing" decoding="async"
    data-background="{{ asset('frontend/img/Daydispatch-about-banner.webp') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="page-title-wrapper text-center">
                    <h3 class="page-title mb-25">About Us</h3>
                    <div class="breadcrumb-menu">
                        <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                            <ul class="trail-items">
                                <li class="trail-item trail-begin"><a
                                        href="{{ route('Frontend.index') }}"><span>Home</span></a></li>
                                <li class="trail-item trail-end"><span>About Us</span></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page title area end -->

<!-- Services 3 Area Start Here  -->
<section class="services__3 grey-bg-4  pt-120 pb-90">
    <div class="container">
        <div class="row justify-content-center wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
            <div class="col-md-8">
                <div class="section__title mb-55 text-center">
                    <span class="sub-title">Day Dispatch</span>
                    <h2 class="title">About Us</h2>
                    <p>Welcome to Day Dispatch, your trusted platform in logistics operation. We specialize in
                        connecting shippers with a vast network of carriers, making your shipment easier and more
                        efficient than ever before.
                    </p>
                </div>
            </div>
        </div>

        <!-- approach area start  -->
        <section class="approach__area  fix grey-bg-4">
            <div class="approach__img m-img">
                <img src="{{ asset('frontend/img/about/our-mission-about.jpeg') }}" decoding="async" width="100%"
                    height="100%" loading="lazy" alt="approach">
            </div>
            <div class="container">
                <div class="row g-0 justify-content-end">
                    <div class="col-lg-6">
                        <div class="approach__content wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                            <div class="section__title mb-35">
                                <span class="sub-title">Day Dispatch</span>
                                <h2 class="title">Our Mission
                                </h2>
                            </div>
                            <div class="approach__text">
                                <p>
                                    At Day Dispatch, our mission is simple; to provide top-notch vehicle transportation
                                    & logistics solutions for both bulk and single deliveries.
                                    We understand the challenges individuals (Shippers) and brokers face when searching
                                    for reliable carriers. That's why we've created a platform that bridges the gap
                                    between shippers and carriers, ensuring affordability, speed, and peace of mind
                                    throughout the process.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- approach area end -->
        <div class="section__title  mb-50 mt-70">
            <span class="sub-title text-center">Explore</span>
            <h2 class="title text-center">Services We Offer</h2>
        </div>

        <div class="row wow justify-content-center  fadeInUp" data-wow-duration="1.5s" data-wow-delay=".5s">
            <div class="col-xl-6 col-md-6">
                <div class="services__3-item mb-30">
                    <div class="services__3-item-num">
                        <h3>01</h3>
                    </div>
                    <div class="services__3-item-icon">
                        <!--<i class="flaticon-boat"></i>-->
                        <img class="dealer" width="20%"
                            src="{{ asset('frontend/img/icons/Vehicle Transportation Icon.png') }}" alt="Dealer">
                    </div>
                    <h3 class="services__3-item-title"><a href="JavaScript:void(0);">Vehicle Transportation</a></h3>
                    <p class="services__3-item-text">Whether you're transporting for primary vehicles,
                        ATVs, UTVs, motorcycles, our platform offers a wide range of carriers for on-road logistics. We
                        tailor transportation services to meet your specific delivery requirements.
                    </p>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="services__3-item mb-30">
                    <div class="services__3-item-num">
                        <h3>02</h3>
                    </div>
                    <div class="services__3-item-icon">
                        <!--<i class="flaticon-boat"></i>-->
                        <img class="dealer" width="20%"
                            src="{{ asset('frontend/img/icons/Heavy Equipment Transportation Icon.png') }}"
                            alt="Dealer">
                    </div>
                    <h3 class="services__3-item-title"><a href="JavaScript:void(0);">Heavy Transportation</a></h3>
                    <p class="services__3-item-text">When you need to move heavy machinery, construction equipment, farm
                        equipment, trust Day Dispatch for reliable and efficient heavy equipment transportation
                        solutions. our platform offers a wide range of carriers for on-road logistics.

                    </p>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="services__3-item mb-30">
                    <div class="services__3-item-num">
                        <h3>03</h3>
                    </div>
                    <div class="services__3-item-icon">
                        <!--<i class="flaticon-boat"></i>-->
                        <img class="dealer" width="20%"
                            src="{{ asset('frontend/img/icons/Dry Van Frieght Icon.png') }}" alt="Dealer">
                    </div>
                    <h3 class="services__3-item-title"><a href="JavaScript:void(0);">Freight Transportation</a></h3>
                    <p class="services__3-item-text">For secure and versatile cargo transportation, explore Day
                        Dispatch's top-tier dry van services. We make the reallocation so easy as we are expert and
                        experienced in handling the transportation. With our careful vigilance there are very less
                        chances to miss out or break any items during deliveries.

                    </p>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="services__3-item mb-30">
                    <div class="services__3-item-num">
                        <h3>04</h3>
                    </div>
                    <div class="services__3-item-icon">
                        <!--<i class="flaticon-boat"></i>-->
                        <img class="dealer" width="20%"
                            src="{{ asset('frontend/img/icons/Full Truck Load Icon.png') }}" alt="Dealer">
                    </div>
                    <h3 class="services__3-item-title"><a href="JavaScript:void(0);">FTL
                            (FULL TRUCK LOAD)</a></h3>
                    <p class="services__3-item-text">Unlock the Day Dispatch features are made especially for dealers to
                        make their work most easy. By connecting with carriers already locating I’m your area with open
                        space on their trucks for the sake of faster delivery.
                        not just this you can
                        ship a Partial Load or deliver an entire loaded truck
                    </p>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="services__3-item mb-30">
                    <div class="services__3-item-num">
                        <h3>05</h3>
                    </div>
                    <div class="services__3-item-icon">
                        <!--<i class="flaticon-boat"></i>-->
                        <img class="dealer" width="20%"
                            src="{{ asset('frontend/img/icons/Less%20Than%20Truck%20load%20Icon%20(1).png') }}"
                            alt="Dealer">
                    </div>
                    <h3 class="services__3-item-title"><a href="JavaScript:void(0);">LTL
                            (LESS THAN TRUCK LOAD)</a></h3>
                    <p class="services__3-item-text">Unlock the Day Dispatch features are made especially for dealers
                        to
                        make their work most easy. By connecting with carriers already locating I’m your area with open
                        space on their trucks for the sake of faster delivery.
                        not just this you can
                        ship a single vehicle, Partial Freight Load or deliver an entire loaded truck
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Us 3 Area Start Here -->
<section class="about__3 about__gray-bg p-relative pt-120 pb-60 wow fadeInUp" data-wow-duration="1.5s"
    data-wow-delay=".3s">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6">
                <div class="about__3-img-wrapper p-relative mb-60">
                    <div class="about__3-top w-img">
                        <img src="{{ asset('frontend/img/about/about-3-1.webp') }}" decoding="async" width="100%"
                            height="100%" loading="lazy" alt="About">
                    </div>
                    <div class="about__3-main w-img">
                        <img src="{{ asset('frontend/img/about/about-page-1.webp') }}" decoding="async"
                            width="100%" height="100%" loading="lazy" alt="About">
                    </div>
                    <div class="about__3-text clip-box-sm">
                        <span><i class="far fa-trophy-alt"></i></span>
                        <h4 class="about__3-title"> Years of experience</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="about__3-content mb-60">
                    <div class="section__title mb-30">
                        <span class="sub-title">about us</span>
                        <!--<h2 class="title">A company involved in <br> servicing, maintenance.</h2>-->
                        <h2 class="title">Day Dispatch</h2>
                    </div>
                    <div class="about__3-content-inner p-relative">
                        <div class="about__3-content-left">
                            <p class="mb-15 text-justify">Customers struggled to find reliable carriers for their
                                deliveries, leading
                                to wasted time, high charges, unsatisfactory service, shipment delays, safety concerns,
                                and regulatory issues.
                            </p>
                            <p class="text-justify">Day Dispatch: One-stop solution for finding reliable carriers
                                quickly.
                            </p>
                            <div class="about__3-content-btn mt-35">
                                <a href="{{ route('Frontend.contact.us') }}" class="skew-btn">Contact Us</a>
                            </div>
                        </div>
                        <div class="about__3-content-right">
                            <div class="about__3-shadow">
                                <div class="about__3-content-num">
                                    <h2 class="font-size-34">21268</h2>
                                    <h6>Carriers</h6>
                                </div>
                            </div>
                            <div class="about__3-shadow">
                                <div class="about__3-content-num">
                                    <h2 class="font-size-34">152399</h2>
                                    <h6>Shippers</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us 3 Area End Here -->



<!-- About Us 2 Area Start Here  -->
{{-- <section class="about__area-2 pt-120 pb-60 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 col-xl-12">
                <div class="about__content-2 mb-60 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay=".5s">
                    <div class="section__title mb-50">
                        <span class="sub-title text-center">Why Choose Us?</span>
                        <h2 class="title text-center">A company involved in servicing, maintenance.</h2>
                    </div>
                    <div class="about__content-tab-2 mt-40">
                        <ul class="nav mb-5 d-flex justify-content-center" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active clip-lg-btn" id="approch-tab" data-bs-toggle="tab"
                                        data-bs-target="#approch" type="button" role="tab" aria-controls="approch"
                                        aria-selected="true">Single Vehicle Delivery
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link clip-lg-btn" id="goal-tab" data-bs-toggle="tab"
                                        data-bs-target="#goal" type="button" role="tab" aria-controls="goal"
                                        aria-selected="false">Affordability
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link clip-lg-btn" id="mision-tab" data-bs-toggle="tab"
                                        data-bs-target="#mision" type="button" role="tab" aria-controls="mision"
                                        aria-selected="false">Fast Services
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link clip-lg-btn" id="review-tab" data-bs-toggle="tab"
                                        data-bs-target="#review" type="button" role="tab" aria-controls="review"
                                        aria-selected="false">Review the Carrier
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link clip-lg-btn" id="block-tab" data-bs-toggle="tab"
                                        data-bs-target="#block" type="button" role="tab" aria-controls="block"
                                        aria-selected="false">Block the Carrier
                                </button>
                            </li>

                        </ul>
                        <div class="tab-content d-flex justify-content-center" id="myTabContent">
                            <div class="tab-pane fade show active" id="approch" role="tabpanel"
                                 aria-labelledby="approch-tab">
                                <p>With us, you will have the freedom to ship a single vehicle. Yes! No need to be a
                                    professional auto dealer we give you an opportunity to deliver a single vehicle.
                                </p>
                            </div>
                            <div class="tab-pane fade" id="goal" role="tabpanel" aria-labelledby="goal-tab">
                                <p>Will it be expensive? Not at all. We keep your ease and affordability ahead of
                                    anything. This means you can deliver with ease, negotiate with the carrier and
                                    deliver your vehicle safely and sound.</p>
                            </div>
                            <div class="tab-pane fade" id="mision" role="tabpanel" aria-labelledby="mision-tab">
                                <p>You might be worried about the extended delivery days of your single vehicle so don’t
                                    worry that your vehicle will be shipped as earlier as it can be with the same care
                                    and handling as the bulk one.</p>
                            </div>
                            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                <p>Though we strive hard to give you full details of the carriers but if you are still
                                    not happy with the service review the carrier on the website, our automated and
                                    efficient system keep the bad reviewed stay out of the website so that our valued
                                    and respected shippers don’t get contact with them.</p>
                            </div>
                            <div class="tab-pane fade" id="block" role="tabpanel" aria-labelledby="block-tab">
                                <p>We give you full freedom the block the undesired carriers so that you can easily
                                    filter and search the best one without ruining your mood. We want you to stay our
                                    happy customer always! </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
{{-- About Us 2 Area End Here   --}}

<!-- About Us 2 Area Start Here  -->
<section class="about__area-2 pt-120 pb-60 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 col-xl-12">
                <div class="about__content-2 mb-60 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay=".5s">
                    <div class="section__title mb-50">
                        <span class="sub-title text-center">Explore</span>
                        <h2 class="title text-center">Why Choose Us?</h2>
                    </div>
                    <div class="about__content-tab-2 mt-40">
                        <ul class="nav mb-5 " id="myTab" role="tablist">
                            <div class="tab-content  justify-content-center" id="myTabContent">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active clip-lg-btn" id="approch-tab" data-bs-toggle="tab"
                                        data-bs-target="#approch" type="button" role="tab"
                                        aria-controls="approch" aria-selected="true">Single Vehicles and Freight
                                        Delivery:
                                    </button>
                                    <div class="tab-pane fade show active" id="approch" role="tabpanel"
                                        aria-labelledby="approch-tab">
                                        <p class="text-center">We offer the freedom to ship a single vehicle, Heavy
                                            Equipment and Partial Freight load whether you're a seasoned professional or
                                            a first-time shipper. No need to worry about complex logistics; Day Dispatch
                                            has a solution for all.

                                        </p>
                                    </div>

                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link clip-lg-btn" id="goal-tab" data-bs-toggle="tab"
                                        data-bs-target="#goal" type="button" role="tab" aria-controls="goal"
                                        aria-selected="false">Authorised And Experienced:
                                    </button>
                                    <div class="tab-pane fade show active" id="goal" role="tabpanel"
                                        aria-labelledby="goal-tab">
                                        <p class="text-center">We Have authorised and experienced to transport Vehicle
                                            , heavy equipment and freight load professionally within the state or out of
                                            the country. We have verified and trained Carrier to manage all the Vehicle
                                            , heavy equipment and freight transportation requirements along with its
                                            safety.


                                        </p>
                                    </div>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link clip-lg-btn" id="mision-tab" data-bs-toggle="tab"
                                        data-bs-target="#mision" type="button" role="tab"
                                        aria-controls="mision" aria-selected="false">Secure:

                                    </button>
                                    <div class="tab-pane fade show active" id="mision" role="tabpanel"
                                        aria-labelledby="mision-tab">
                                        <p class="text-center">For secure and versatile cargo transportation, explore
                                            Day Dispatch's top-tier freight shipping services. We make the reallocation
                                            so easy as we are expert and experienced in handling the transportation.


                                        </p>
                                    </div>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link clip-lg-btn" id="review-tab" data-bs-toggle="tab"
                                        data-bs-target="#review" type="button" role="tab"
                                        aria-controls="review" aria-selected="false">Safety and Regulatory Compliance:
                                    </button>
                                    <div class="tab-pane fade show active" id="review" role="tabpanel"
                                        aria-labelledby="review-tab">
                                        <p class="text-center">We provide authentic U.S. DOT licence information for
                                            carriers, guaranteeing the safety and regulatory compliance of the services
                                            offered.

                                        </p>
                                    </div>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link clip-lg-btn" id="block-tab" data-bs-toggle="tab"
                                        data-bs-target="#block" type="button" role="tab" aria-controls="block"
                                        aria-selected="false">Fast Services:


                                    </button>
                                    <div class="tab-pane fade show active" id="block" role="tabpanel"
                                        aria-labelledby="block-tab">
                                        <p class="text-center">We prioritise your ease and affordability.<br> Our
                                            platform allows you to negotiate with Shippers, ensuring your vehicle ,
                                            Equipment or Cargo reaches its destination safely without breaking the users
                                            bank.
                                        </p>
                                    </div>

                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link clip-lg-btn" id="review-tab" data-bs-toggle="tab"
                                        data-bs-target="#review" type="button" role="tab"
                                        aria-controls="review" aria-selected="false">Review the Carrier:
                                    </button>
                                    <div class="tab-pane fade show active" id="review" role="tabpanel"
                                        aria-labelledby="review-tab">
                                        <p class="text-center">We strive to provide comprehensive carrier information,
                                            but if you're not satisfied, our platform enables you to review carriers'
                                            services. We ensure that only reputable carriers stay on our platform to
                                            protect our valued shippers.

                                        </p>
                                    </div>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link clip-lg-btn" id="review-tab" data-bs-toggle="tab"
                                        data-bs-target="#review" type="button" role="tab"
                                        aria-controls="review" aria-selected="false">Register Free:
                                    </button>
                                    <div class="tab-pane fade show active" id="review" role="tabpanel"
                                        aria-labelledby="review-tab">
                                        <p class="text-center">Signing up is simple, and it won't cost you anything.
                                            You can access our services anytime and easily without any complicated
                                            steps.


                                        </p>
                                    </div>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link clip-lg-btn" id="block-tab" data-bs-toggle="tab"
                                        data-bs-target="#block" type="button" role="tab" aria-controls="block"
                                        aria-selected="false">Affordability:


                                    </button>
                                    <div class="tab-pane fade show active" id="block" role="tabpanel"
                                        aria-labelledby="block-tab">
                                        <p class="text-center">We prioritise your ease and affordability. Our platform
                                            allows you to negotiate with carriers, ensuring your vehicle reaches its
                                            destination safely without breaking the users bank.
                                        </p>
                                    </div>
                            </div>
                            </li>
                    </div>

                    </ul>

                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- About Us 2 Area End Here  -->
<!-- mission area start  -->
<section class="mission__area p-relative fix grey-bg-4">
    <div class="mission__img m-img">
        <img src="{{ asset('frontend/img/slider-3.webp') }}" decoding="async" width="100%" height="100%" loading="lazy" alt="mission">
    </div>
    <div class="container">
        <div class="row g-0">
            <div class="col-lg-6">
                <div class="mission__content wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                    <div class="section__title mb-35">
                        <span class="sub-title">Our Vision</span>
                        <h2 class="title">Our Mission
                        </h2>
                    </div>
                    <div class="mission__text">
                        <p>Day Dispatch provides innovative services to carriers, connecting them with a large pool of
                            shippers quickly. With millions of cargoes listed on their website, they help carriers
                            thrive by keeping their trucks filled. Their products promote efficient work from drivers
                            and dispatchers, benefiting both parties.
                        </p>
                        <div class="mission__text-inner">
                            <img src="{{ asset('frontend/img/mission/mission-contact-img.jpg') }}"  decoding="async" width="80" height="80" loading="lazy" alt="mission">
                            <div class="mission__text-contact">
                                <div class="single-contact-info d-flex align-items-center">
                                    <div class="contact-info-icon">
                                        <a href="#" aria-label="About Us"><i class="flaticon-envelope"></i></a>
                                    </div>
                                    <div class="contact-info-text">
                                        <span>send email</span>
                                        <h5><a href="/cdn-cgi/l/email-protection#670e090108271002050308104904080a"><span
                                                    class="__cf_email__"
                                                    data-cfemail="1d74737b725d6a787f79726a337e7270">support@daydispatch.com</span></a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- mission area end -->

<!-- Brand Area Start Here  -->
<div class="brand white-bg two border-tb wow fadeInUp mb-120" data-wow-duration="1.5s" data-wow-delay=".3s">
    <div class="container-fluid p-0">
        <div class="swiper-container brand-active-2">
            {{-- Additional required wrapper  --}}
            <div class="swiper-wrapper text-center">
                <!-- Slides -->
                <div class="swiper-slide">
                    <div class="brand-items-2">
                        <a href="#"><img src="{{ asset('frontend/img/brand/bc1.png') }}" alt="Brand"></a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="brand-items-2">
                        <a href="#"><img src="{{ asset('frontend/img/brand/bc2.png') }}" alt="Brand"></a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="brand-items-2">
                        <a href="#"><img src="{{ asset('frontend/img/brand/bc3.png') }}" alt="Brand"></a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="brand-items-2">
                        <a href="#"><img src="{{ asset('frontend/img/brand/bc4.png') }}" alt="Brand"></a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="brand-items-2">
                        <a href="#"><img src="{{ asset('frontend/img/brand/bc5.png') }}" alt="Brand"></a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="brand-items-2">
                        <a href="#"><img src="{{ asset('frontend/img/brand/bc6.png') }}" alt="Brand"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Brand Area End Here  -->
