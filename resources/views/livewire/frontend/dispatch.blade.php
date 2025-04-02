@extends('layouts.master')

@section('content')
<style>
    .services__3-item-icon img {
        width : 12%!important;
    }
    /*=============== why choose us ==========*/
    i.fa.fa-question-circle {
    font-size: 21px;
    color: #bc101c;
    cursor: pointer;
    margin-left: 15px;
    }
    #myTabContent.li {
    width: 266px.
    text-align: center; 
    }
    #myTabContent .li div {
        text-align: center!important; 
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
    /*=============== why choose us ==========*/
    .fa.fa-check {
    color: #23bd23;
    font-size: 25px;
    }
    /*.card-bg {*/
    /*        background: #012863;*/
    /*        color: white; */
    /*}*/
    /*.price-bg {*/
    /*              background: linear-gradient(197deg, #e54f4f, transparent);*/
    /*                  color: #fff4f4;*/
    /*}*/
    /*table#table-2 {*/
    /*    zoom: 85%;*/
    /*    display: block;*/
    /*    width: -webkit-fill-available;*/
        /*overflow-x: scroll;*/
    /*    margin: auto;*/
    /*}*/
    /*.container.table2 {*/
    /*        width: 84%;*/
    /*    overflow: hidden;*/
    /*}*/
    
    @media screen and (max-width: 986px) {
        .zoom-media { 
            zoom: 100%!important;
        }
         table#table-2 {
            overflow-x: scroll;
        }
    }

    .z-index {
            line-height: 1;
            z-index: 222;
        position: relative;
        color: white;
        z-index: 222;
        position: relative;
        color: white;
        font-size: 40px;
        font-weight: bold;
        text-align: center;
    
    }
    .broker-img,
    .carriers-img,
    .shipper-img,
    .dispatch-img {
        position: relative;
    }
    {
            flex-direction: column;
        row-gap: 10px;
        align-items: baseline;
    }
    .d-flex.inline-block.mb-3 {
        width: 313px;
    }
    
    h5.mb-1 {
            background: linear-gradient(197deg, #e54f4f, transparent);
        clip-path: polygon(12% 0, 100% 0, 88% 100%, 0 100%);
        padding: 6px 19px;
            width: fit-content;
            color: white!important;
        border-bottom: 1px solid white;
    
    }
    .fa.fa-times {
        color: red;
        font-size: 25px;
    }
    
    .align-center {
        text-align: center !important;
    }
    .align-self-center {
        vertical-align: middle;
    }
    .approach_style {
        display: flex;
        flex-direction: row-reverse;
        flex-direction: row-reverse;
        flex-wrap: wrap !important;
        row-gap: 26px;
}
    /*.card.pricing-box.card-bg {*/
    /*    width: 350px;*/
    /*}*/
    /*.dispatch-img {*/
    /*    background-image: url(https://daydispatch.com/frontend/img/plan-img/plan-dispatch.jpeg)!important;*/
    /*    object-fit: cover;*/
    /*    background-size: cover;*/
    /*    background-repeat: no-repeat;*/
    /*        background-position: center;*/
    /*}*/
    /*.ribbon-box .ribbon-two {*/
    /*    position: absolute;*/
    /*    left: 274px;*/
    /*    top: -1px;*/
    /*    z-index: 1;*/
    /*    overflow: hidden;*/
    /*    width: 75px;*/
    /*    height: 75px;*/
    /*    text-align: right;*/
    /*}*/
    /*.ribbon-box .ribbon-two span {*/
    /*    font-size: 13px;*/
    /*    color: #fff;*/
    /*    text-align: center;*/
    /*    line-height: 20px;*/
    /*    -webkit-transform: rotate(-45deg);*/
    /*    transform: rotate(-45deg);*/
    /*    width: 100px;*/
    /*    display: block;*/
    /*    -webkit-box-shadow: 0 0 8px 0 rgba(0,0,0,.06),0 1px 0 0 rgba(0,0,0,.02);*/
    /*    box-shadow: 0 0 8px 0 rgba(0,0,0,.06),0 1px 0 0 rgba(0,0,0,.02);*/
    /*    position: absolute;*/
    /*    top: 19px;*/
    /*    left: -21px;*/
    /*    font-weight: 500;*/
    /*}*/
    /*.ribbon-box .ribbon-two-danger span {*/
    /*    background: #ed5e5e;*/
    /*}*/
    /*.ribbon-box.right.ribbon-box .ribbon-two span {*/
    /*    left: auto;*/
    /*    right: -21px;*/
    /*    -webkit-transform: rotate(45deg);*/
    /*    transform: rotate(45deg);*/
    /*}*/
</style>
<!-- page title area  -->
<section class="page-title-area breadcrumb-spacing"
         data-background="{{ asset('frontend/img/breadcrumb-bg.webp') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="page-title-wrapper text-center">
                    <h3 class="page-title mb-25">Dispatch</h3>
                    <div class="breadcrumb-menu">
                        <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                            <ul class="trail-items">
                                <li class="trail-item trail-begin"><a
                                        href="{{ route('Frontend.index') }}"><span>Home</span></a></li>
                                <li class="trail-item trail-end"><span>Dispatch</span></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page title area end -->

<section class="services__3 grey-bg-4 pt-120 pb-90">
    <div class="container">
        <div class="row justify-content-center wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
            <div class="col-md-8">
                <div class="section__title mb-55 text-center">
                    <span class="sub-title">Your Partner in Your Thrive!</span>
                    <h2 class="title">Introducing Dispatch Center</h2>
                    <p>Welcome to Day Dispatch where we’re a revolutionary transportation organization with our 
                    trusted and professional Dispatch Centerfeature.
                      Whether you are a hefty logistic company handling complex dispatching operations or
                      small logistic enterprises looking after a fleet of vehicles, Day Dispatch is smartly 
                      designed to boost and streamline your logistics operations efficiently.
                        
                        </p>
                </div>
            </div>
        </div>
        <!--<div class="row wow fadeInUp justify-content-center" data-wow-duration="1.5s" data-wow-delay=".5s">-->
        <!--    <div class="col-xl-6 col-md-6">-->
        <!--        <div class="services__3-item mb-30">-->
        <!--            <div class="services__3-item-num">-->
        <!--                <h3>01</h3>-->
        <!--            </div>-->
        <!--            <div class="services__3-item-icon">-->
                        <!--<i class="flaticon-boat"></i>-->
        <!--                <img class="dealer" src="{{ asset('frontend/img/Isitforme/Dealer.png') }}">-->
        <!--            </div>-->
        <!--            <h3 class="services__3-item-title"><a href="JavaScript:void(0);">How will you do this? </a></h3>-->
        <!--            <p class="services__3-item-text">It’s really easy to do! Just click on search for the shipments-->
        <!--                 and be ready to fill the truck. The vehicle shipment post will consist of the pickup -->
        <!--                 location, delivery location, and payment method. Once you are finished with the required-->
        <!--                  information time to bid with the shippers, deal with them directly and move forward to-->
        <!--                   the successful journey with him with the following 4 steps:  -->
 
        <!--            </p>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="col-xl-6 col-md-6">-->
        <!--        <div class="services__3-item mb-30">-->
        <!--            <div class="services__3-item-num">-->
        <!--                <h3>02</h3>-->
        <!--            </div>-->
        <!--            <div class="services__3-item-icon">-->
                        <!--<i class="flaticon-plane"></i>-->
        <!--                <img class="broker" src="{{ asset('frontend/img/Isitforme/Broker.png') }}">-->
        <!--            </div>-->
        <!--            <h3 class="services__3-item-title"><a href="JavaScript:void(0);">Searching for vehicles on Day Dispatch </a></h3>-->
        <!--            <p class="services__3-item-text"> Click on the search bar and find out available shippers-->
        <!--                 to your routes contact them using this website. If the shipper is ready to move with -->
        <!--                 you, congratulations then! Provide your information to the shipper ad move to the next-->
        <!--                  step, -->

        <!--            </p>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="col-xl-6 col-md-6">-->
        <!--        <div class="services__3-item mb-30">-->
        <!--            <div class="services__3-item-num">-->
        <!--                <h3>03</h3>-->
        <!--            </div>-->
        <!--            <div class="services__3-item-icon">-->
                        <!--<i class="flaticon-frontal-truck"></i>-->
        <!--                <img class="Carrier" src="{{ asset('frontend/img/Isitforme/Carrier.png') }}">-->

        <!--            </div>-->
        <!--            <h3 class="services__3-item-title"><a href="JavaScript:void(0);">Coordinating with the broker directly for pickup </a></h3>-->
        <!--            <p class="services__3-item-text"> We know that you are proficient enough to make deal -->
        <!--                with the shipper that’s why we offer you this opportunity to coordinate with the broker -->
        <!--                directly for pickup. Now it’s time to make the deal!-->


        <!--            </p>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="col-xl-6 col-md-6">-->
        <!--        <div class="services__3-item mb-30">-->
        <!--            <div class="services__3-item-num">-->
        <!--                <h3>04</h3>-->
        <!--            </div>-->
        <!--            <div class="services__3-item-icon">-->
                        <!--<i class="flaticon-train"></i>-->
        <!--            <img class="Import and Export" src="{{ asset('frontend/img/Isitforme/Import and Export.png') }}">-->

        <!--            </div>-->
        <!--            <h3 class="services__3-item-title"><a href="JavaScript:void(0);">Shipper acceptance of your request</a></h3>-->
        <!--            <p class="services__3-item-text">When the shipper agreed to your deal/ request then you will -->
        <!--                get your shipment accepted and ready to deliver with assistance with the day dispatch.-->
                    
        <!--            </p>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="col-xl-6 col-md-6">-->
        <!--        <div class="services__3-item mb-30">-->
        <!--            <div class="services__3-item-num">-->
        <!--                <h3>05</h3>-->
        <!--            </div>-->
        <!--            <div class="services__3-item-icon">-->
                        <!--<i class="flaticon-train"></i>-->
        <!--            <img class="Import and Export" src="{{ asset('frontend/img/Isitforme/Import and Export.png') }}">-->

        <!--            </div>-->
        <!--            <h3 class="services__3-item-title"><a href="JavaScript:void(0);">Time to Deliver! </a></h3>-->
        <!--            <p class="services__3-item-text">As the delivery is made, if the payment is COD collect your-->
        <!--                 payment. It is not stopped here, you can rate the shipper based on your experience. -->

        <!--                So start searching and grow richer!-->
                        
                    
        <!--            </p>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
    </div>
</section>




<!-- About Us 3 Area End Here -->

    <div class="section__title text-center mb-35 pt-60">
        <span class="sub-title text-center">DISPATCH CENTER</span> 
        <h2 class="title text-center">DISPATCH CENTER for DISPATCHING</h2> 
    </div>
    
    <section class="approach__area fix approach_style " >

    <div class="approach__img m-img">
        <img src="https://daydispatch.com/frontend/img/approach/approch-img.webp" decoding="async" width="90%" height="100%" loading="lazy" alt="approach">
    </div>
    <div class="container">
        <div class="row g-0">
         <div class="col-xl-6 col-lg-6 pt-60">
                <div class="about__3-content mb-60">
                    <div class="section__title mb-30">
                        <!--<div class="testimonial__icon rate rating" >-->
                        <!--            <i class="fas fa-star"></i>-->
                        <!--            <i class="fas fa-star"></i>-->
                        <!--            <i class="fas fa-star"></i>-->
                        <!--            <i class="fas fa-star"></i>-->
                        <!--            <i class="fas fa-star"></i>-->
                        <!--        </div>-->
                        <!--<i class="fas fa-quote-left"></i>-->
                        <h3 class="title">DISPATCH CENTER for Shipper</h3>
                        
                    </div>
                    <div class="about__3-content-inner p-relative">
                        <div class="about__3-content-left padding ">
                            <p class="mb-15 text-justify">As a broker operating in the competitive transportation industry, finding reliable Carrier is paramount to ensuring smooth operations and satisfied clients. 
                            </p>
                            <p class="text-justify">Day Dispatch offers thousand of carriers for vehicles, heavy equipment, and freight shipments, and my experience with it has been largely positive.
                            </p> 
                            <div class="about__3-content-btn mt-35">
                                <a href="https://daydispatch.com/Load-Board" class="skew-btn blue-btn">View Detail</a>
                                <!--<a href="https://daydispatch.com/Authentication/Register-User" class="skew-btn">Signup</a>-->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 <section class="approach__area  fix grey-bg-4">
    <div class="approach__img m-img">
        <img src="https://daydispatch.com/frontend/img/about/our-mission-about.jpeg" decoding="async" width="100%" height="100%" loading="lazy" alt="approach">
    </div>
    <div class="container">
        <div class="row g-0 justify-content-end">
            <div class="col-lg-6">
                <div class="approach__content wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s" style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.3s; animation-name: fadeInUp;">
                    <div class="section__title mb-35">
                        <!--<span class="sub-title">Day Dispatch</span>-->
                        <h2 class="title">DISPATCH CENTER for Broker</h2>
                    </div>
                    <div class="approach__text">
                        <p>
                            At Day Dispatch, our mission is simple; to provide top-notch vehicle transportation &amp; logistics solutions for both bulk and single deliveries. 
                             We understand the challenges individuals (Shippers) and brokers face when searching for reliable carriers. That's why we've created a platform that bridges the gap between shippers and carriers, ensuring affordability, speed, and peace of mind throughout the process.
                        </p>
                         <div class="about__3-content-btn mt-35">
                                <a href="https://daydispatch.com/Load-Board" class="skew-btn blue-btn">View Detail</a>
                                <!--<a href="https://daydispatch.com/Authentication/Register-User" class="skew-btn">Signup</a>-->
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <section class="approach__area fix approach_style " >

    <div class="approach__img m-img">
        <img src="https://daydispatch.com/frontend/img/approach/approch-img.webp" decoding="async" width="90%" height="100%" loading="lazy" alt="approach">
    </div>
    <div class="container">
        <div class="row g-0">
         <div class="col-xl-6 col-lg-6 pt-60">
                <div class="about__3-content mb-60">
                    <div class="section__title mb-30">
                        <!--<div class="testimonial__icon rate rating" >-->
                        <!--            <i class="fas fa-star"></i>-->
                        <!--            <i class="fas fa-star"></i>-->
                        <!--            <i class="fas fa-star"></i>-->
                        <!--            <i class="fas fa-star"></i>-->
                        <!--            <i class="fas fa-star"></i>-->
                        <!--        </div>-->
                        <!--<i class="fas fa-quote-left"></i>-->
                        <h3 class="title">DISPATCH CENTER for carrier</h3>
                        
                    </div>
                    <div class="about__3-content-inner p-relative">
                        <div class="about__3-content-left padding ">
                            <p class="mb-15 text-justify">As a broker operating in the competitive transportation industry, finding reliable Carrier is paramount to ensuring smooth operations and satisfied clients. 
                            </p>
                            <p class="text-justify">Day Dispatch offers thousand of carriers for vehicles, heavy equipment, and freight shipments, and my experience with it has been largely positive.
                            </p> 
                            <div class="about__3-content-btn mt-35">
                                <a href="https://daydispatch.com/Load-Board" class="skew-btn blue-btn">View Detail</a>
                                <!--<a href="https://daydispatch.com/Authentication/Register-User" class="skew-btn">Signup</a>-->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- About Us 3 Area Start Here -->

<!--<div class="container table2">-->
<!--       <div class="section__title mb-50 mt-50">-->
<!--                        <span class="sub-title text-center">DISPATCH CENTER</span> -->
<!--                        <h2 class="title text-center">DISPATCH CENTER for DISPATCHING</h2> -->
<!--                    </div>-->

<!--</div>-->









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
                                        data-bs-target="#approch" type="button" role="tab" aria-controls="approch"
                                        aria-selected="true">Effortless Dispatch Management:
                                </button>
                               <div class="tab-pane fade show active" id="approch" role="tabpanel"
                                 aria-labelledby="approch-tab">
                                <p class="text-center">Our efficient Dispatch Center allows you to smoothly manage your transportation operations from one centralized platform means no hassle at any step like handling manual processes and managing
                                spreadsheets. This rationalized approach not only saves time but also minimizes the risk of errors and 
                                ensures smoother operations of complex logistics. 
                                The in-built interface empowers you to efficiently allocate resources, disperse drivers to routes, and
                                monitor deliveries in real-time.
                                </p>
                            </div>
                            
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link clip-lg-btn" id="goal-tab" data-bs-toggle="tab"
                                        data-bs-target="#goal" type="button" role="tab" aria-controls="goal"
                                        aria-selected="false">Optimized Resource Allocation:
                                </button>
                                  <div class="tab-pane fade show active" id="goal" role="tabpanel" aria-labelledby="goal-tab">
                                <p class="text-center">By using our Dispatch Center, you can employ advanced algorithms in simple ways,
                                which not only help to determine the most efficient routes but also aid in minimizing fuel consumption,
                                reducing operational costs, managing and scheduling deliveries, and handling pickups efficiently and quickly. 
                                The feature enables clients to pre-manage factors in traffic conditions, weather patterns, and delivery priorities.
                                The client appointment feature makes your work easier and ensures that the resources are allocated efficiently and 
                                strategically with minimized waste and greater chances of profitability. 
 
                                </p>
                            </div>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link clip-lg-btn" id="mision-tab" data-bs-toggle="tab"
                                        data-bs-target="#mision" type="button" role="tab" aria-controls="mision"
                                         aria-selected="false">Real-Time Tracking and Monitoring: 

                                </button>
                                 <div class="tab-pane fade show active" id="mision" role="tabpanel" aria-labelledby="mision-tab">
                                <p class="text-center">The Real-Time Tracking and Monitoring feature helps you to check on vehicles'
                                locations, monitor delivery status and prompt updates on any deviations from the planned route. Not 
                                only this can fix and manage traffic congestion or unexpected delays, ensuring that your deliveries are
                                completed on time and your clients remain satisfied. In a few clicks, you can make data-driven decisions 
                                as our strong tracking system provides actionable understandings to address any mishappening that occurs
                                during delivery and enables you to deal with it to ensure timely deliveries with no fuss.

                                </p>
                                 </div>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link clip-lg-btn" id="review-tab" data-bs-toggle="tab"
                                        data-bs-target="#review" type="button" role="tab" aria-controls="review"
                                        aria-selected="false">Smart Client Management: 
                                </button>
                                <div class="tab-pane fade show active"  id="review" role="tabpanel" aria-labelledby="review-tab">
                                <p class="text-center">From maintenance of detailed client profiles to contact information, delivery schedules 
                                to personalization each feature help to keep the client is informed and receives exceptional services every time.
                                    This wide-ranging database enables you to provide custom-made services to each client, anticipate their needs,
                                    and exceed their expectations. With customizable notifications and automated alerts, you can retain your clients 
                                    by keeping them informed every step of the way.

                                </p>
                                 </div>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link clip-lg-btn" id="block-tab" data-bs-toggle="tab"
                                        data-bs-target="#block" type="button" role="tab" aria-controls="block"
                                        aria-selected="false">Customizable Reporting and Analytics: 


                                </button>
                                 <div class="tab-pane fade show active" id="block" role="tabpanel" aria-labelledby="block-tab">
                                <p class="text-center">It’s never been as easy to rationally identify trends, analyze historical data,
                                and track key performance indicators with us with customizable reporting and analytics tools. 
                                    These comprehensive reporting capabilities help in managing operations through optimized routes, 
                                    reduction in delivery times and enhancement in overall efficiency.
                                    You can identify opportunities for optimization, monitor and improve driver’s performance and seek
                                    consistent improvement within a few clicks. 
                                </p>
                            </div>
                            </div>
                            </li>

                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us 2 Area End Here  -->
@endsection