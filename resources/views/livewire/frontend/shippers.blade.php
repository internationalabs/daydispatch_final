<link href="https://daydispatch.com/admin-backend/css/custom.min.css" rel="stylesheet" type="text/css">
<!-- Bootstrap CSS -->
<!--<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">-->

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<style>
    .services__3-item-icon img {
        width : 12%!important;
    }
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
    table#table-4 {
        zoom: 85%;
        display: block;
        width: -webkit-fill-available;
        /*overflow-x: scroll;*/
        margin: auto;
    }
     
    .container.table4 {
        width: 84%; 
    overflow: hidden;
    }
        .fa.fa-check {
    color: #23bd23;
    font-size: 25px;
    }
    .card-bg {
            background:#01286317;
            color: #012863; 
    }
    .price-bg {
                      background: linear-gradient(197deg, #012863, #47638e);
                      color: #fff4f4;
    }
        h5.mb-1 {
            background: linear-gradient(197deg, #012863, #47638e);
        clip-path: polygon(12% 0, 100% 0, 88% 100%, 0 100%);
        padding: 6px 19px;
            width: fit-content;
            color: white!important;
        border-bottom: 1px solid white;
    
    }
     @media screen and (max-width: 986px) {
        .zoom-media { 
            zoom: 100%!important;
        }
         table#table-4 {
            overflow-x: scroll;
        }
    }
    /*.broker-img {*/
    /*    background-image: url(https://daydispatch.com/frontend/img/plan-img/plan-broker.jpeg);*/
    /*    object-fit: cover;*/
    /*    background-size: cover;*/
    /*    background-repeat: no-repeat;*/
    /*        background-position: center;*/
    /*}*/
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
    .card.pricing-box.card-bg {
        width: 350px;
    }

    
    
        /*==============popular card name style card==============*/
                .ribbon-box .ribbon-two {
    position: absolute;
    left: 274px;
    top: -1px;
    z-index: 1;
    overflow: hidden;
    width: 75px;
    height: 75px;
    text-align: right;
}
.ribbon-box .ribbon-two span {
    font-size: 13px;
    color: #fff;
    text-align: center;
    line-height: 20px;
    -webkit-transform: rotate(-45deg);
    transform: rotate(-45deg);
    width: 100px;
    display: block;
    -webkit-box-shadow: 0 0 8px 0 rgba(0,0,0,.06),0 1px 0 0 rgba(0,0,0,.02);
    box-shadow: 0 0 8px 0 rgba(0,0,0,.06),0 1px 0 0 rgba(0,0,0,.02);
    position: absolute;
    top: 19px;
    left: -21px;
    font-weight: 500;
}
.ribbon-box .ribbon-two-danger span {
    background: #ed5e5e;
}
.ribbon-box.right.ribbon-box .ribbon-two span {
    left: auto;
    right: -21px;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
}
        /*==============popular card name style card==============*/
        
            .shipper-img {
        background-image: url(https://daydispatch.com/frontend/img/plan-img/plan-shipper.jpeg)!important;
        height: 354px;
        position: relative;
        background-size: cover;
    }
        
@media screen and (min-width: 1000px) and (max-width: 1400px) {
.zoom-media { 
            zoom: 75%!important;
        }
         table#table-4 {
            overflow-x: scroll;
            zoom: 75%;
        }
}
</style>
<!-- page title area  -->
<section class="page-title-area breadcrumb-spacing"
         data-background="{{ asset('frontend/img/shipper-banner.webp') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="page-title-wrapper text-center">
                    <h3 class="page-title mb-25">Shippers</h3>
                    <div class="breadcrumb-menu">
                        <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                            <ul class="trail-items">
                                <li class="trail-item trail-begin"><a
                                        href="{{ route('Frontend.index') }}"><span>Home</span></a></li>
                                <li class="trail-item trail-end"><span>Shippers</span></li>
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
                    <span class="sub-title">Shippers</span>
                    <h2 class="title">How do we work for Shippers?</h2>
                    <p>Day Dispatch is here to make your journey more feasible with our solutions not only inbound but also outbound services are efficiently being provided to our hundreds of happy customers. You may be thinking that if we are not a shipping company so who we are? We are the intermediate that provides service to connect you with thousands of carriers. You still may think that what we do, what are the benefits to choose us? The answer is if you want to save time choose us if you want to quickly ship choose us if you want to save your money choose us. Not stop here, if you want outstanding service, if you have doubts about the safety or if you feel tired with the hectic payment procedure so don’t wait to choose us! We provide authentic information along with the USDOT license information.  
                        You can experience our service with these 4 steps:
                        </p>
                </div>
            </div>
        </div>
        <div class="row wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".5s">
            <div class="col-xl-6 col-md-6">
                <div class="services__3-item mb-30">
                    <div class="services__3-item-num">
                        <h3>01</h3>
                    </div>
                    <div class="services__3-item-icon">
                        <!--<i class="flaticon-boat"></i>-->
                        <img class="dealer" src="{{ asset('frontend/img/Isitforme/Dealer.png') }}">
                    </div>
                    <h3 class="services__3-item-title"><a href="JavaScript:void(0);">Posting the Load</a></h3>
                    <p class="services__3-item-text">First of all, you just have to post the Load on Day Dispatch.
                         Where thousands of carriers may be ready to serve you, with our best-in-class services the 
                         interested carrier will come to respond to you and contact you as early as possible. 
                    </p>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="services__3-item mb-30">
                    <div class="services__3-item-num">
                        <h3>02</h3>
                    </div>
                    <div class="services__3-item-icon">
                        <!--<i class="flaticon-plane"></i>-->
                        <img class="broker" src="{{ asset('frontend/img/Isitforme/Broker.png') }}">
                    </div>
                    <h3 class="services__3-item-title"><a href="JavaScript:void(0);">Review the carrier </a></h3>
                    <p class="services__3-item-text"> Either that carrier safe or not? Is budget-friendly? Or is 
                        worth moving on? Or any information you may review to decide the matching criteria.
                         Our website provides complete information about the carrier and empowers you to decide
                          which one is the best fit for you. 
                    </p>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="services__3-item mb-30">
                    <div class="services__3-item-num">
                        <h3>03</h3>
                    </div>
                    <div class="services__3-item-icon">
                        <!--<i class="flaticon-frontal-truck"></i>-->
                        <img class="Carrier" src="{{ asset('frontend/img/Isitforme/Carrier.png') }}">

                    </div>
                    <h3 class="services__3-item-title"><a href="JavaScript:void(0);">Accepting the request  </a></h3>
                    <p class="services__3-item-text"> Found the perfect match? Good to go! You can accept
                         the request of the carrier and proceed to shipment with them. 
                         Call them and book now!

                    </p>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="services__3-item mb-30">
                    <div class="services__3-item-num">
                        <h3>04</h3>
                    </div>
                    <div class="services__3-item-icon">
                        <!--<i class="flaticon-train"></i>-->
                    <img class="Import and Export" src="{{ asset('frontend/img/Isitforme/Import and Export.png') }}">

                    </div>
                    <h3 class="services__3-item-title"><a href="JavaScript:void(0);">Delivery of the Shipment </a></h3>
                    <p class="services__3-item-text">Was not it easy? Yes, the wait is over your Load is ready to ship to
                         the desired destination or to you. Safely, quickly and affordably. You can rate them against your experience. 
                        We at Day Dispatch try our best to provide competent and unmatchable services.        
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services 3 Area End Here  -->


<div class="container table4 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s" >
       <div class="section__title mb-50 mt-50">
                        <span class="sub-title text-center">Payment Plan</span> 
                        <h2 class="title text-center">PAYMENT PLAN for Shipper</h2> 
       </div>
    <table id="table-4" class="table border" >
                <thead>
                    <tr>
                        <th scope="col" class="border text-lg h4 align-self-center shipper-img"><p class="z-index">Payment Plan Shipper</P></th>
                        <th scope="col" class="border">
                            <div class="">
                                <div class="card pricing-box card-bg">
                                    <div class="card-body p-4 m-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 fs-20">
                                                <h5 class="mb-1">Basic Plan</h5>
                                                <!--<p class="text-muted-color  mb-0">For Startup</p>-->
                                            </div>
                                            <div class="avatar-sm">
                                                <div class="avatar-title bg-light rounded-circle text-primary">
                                                    <i class="ri-book-mark-line fs-20"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-4">
                                            <h2 class="price-bg"><sup><small>$</small></sup>0 <span
                                                    class="fs-13 text-muted-color ">/Month</span></h2>
                                        </div>
                                        <hr class="my-4 text-muted-color ">
                                        <div>
                                             <br>
                                            <ul class="list-unstyled text-muted-color  vstack gap-3">
                                                <li>
                                                    <div class="d-flex align-items-baseline gap-2">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="fa fa-check fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-20">
                                                            Primary Vehicles
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex align-items-baseline gap-2">
                                                        <div class="flex-shrink-0 text-danger me-1">
                                                            <i class="fa fa-times fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-20">
                                                            <b>Heavy Equipment</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex align-items-baseline gap-2">
                                                        <div class="flex-shrink-0 text-danger me-1">
                                                            <i class="fa fa-times fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-20">
                                                            <b>Dry Van</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                             <br>
                                              <br> 
                                              
                                           <!--<div class="d-flex inline-block mb-3">-->
                                           <!--         <div class="form-check" style="margin-right: 9px;">-->
                                           <!--             <input class="form-check-input" type="radio"-->
                                           <!--                 name="Payment_Method" value="1" id="flexRadioDefault3">-->
                                           <!--             <label class="form-check-label" for="flexRadioDefault3">-->
                                           <!--                 Stripe Payment-->
                                           <!--             </label>-->
                                           <!--         </div>-->

                                           <!--         <div class="form-check" style="margin-left: 9px;">-->
                                           <!--             <input class="form-check-input" type="radio"-->
                                           <!--                 name="Payment_Method" value="2" id="flexRadioDefault4"-->
                                           <!--                 required>-->
                                           <!--             <label class="form-check-label" for="flexRadioDefault4">-->
                                           <!--                 PayPal Payment-->
                                           <!--             </label>-->
                                           <!--         </div>-->
                                           <!--     </div>-->
                                                <input type="hidden" name="Amount"
                                                    value="{{ $Pacakges->Dry_Van_Load_Amount }}">
                                                <input type="hidden" name="Name" value="123">
                                                <input type="hidden" name="Package_ID" value="3">
                                                <input type="hidden" name="Email" value="123">
                                                <input type="hidden" name="ID" value="123">
                                                <button type="submit"
                                                    class="btn btn-success w-100 waves-effect waves-light">Subscribe Now
                                                </button>
                                            </form>
                                            <div class="mt-4">
                                                <!--<button type="button" disabled-->
                                                <!--    class="btn btn-success w-100 waves-effect waves-light">Already-->
                                                <!--    Subscribed-->
                                                <!--</button>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </th>
                        <th align-center scope="col" class="border">
                            <!--end col-->
                            <div class="">
                                <div class="card pricing-box card-bg ribbon-box right">
                                    <div class="card-body p-4 m-2">
                                        <div class="ribbon-two ribbon-two-danger"><span>Popular</span></div>
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 fs-20">
                                                    <h5 class="mb-1">Pro Business</h5>
                                                    <!--<p class="text-muted-color  mb-0">Professional plans</p>-->
                                                </div>
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-light rounded-circle text-primary">
                                                        <i class="ri-medal-line fs-20"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pt-4">
                                                <h2 class="price-bg"><sup><small>$</small></sup> {{ $Pacakges->Heavy_Load_Amount }}<span
                                                        class="fs-13 text-muted-color ">/Month</span></h2>
                                            </div>
                                        </div>
                                        <hr class="my-4 text-muted-color ">
                                        <div>
                                             <br>
                                            <ul class="list-unstyled vstack gap-3 text-muted-color ">
                                                <li>
                                                    <div class="d-flex align-items-baseline gap-2">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="fa fa-check fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-20">
                                                            Primary Vehicles
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex align-items-baseline gap-2">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="fa fa-check fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-20">
                                                            <b>Heavy Equipment</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex align-items-baseline gap-2">
                                                        <div class="flex-shrink-0 text-danger me-1">
                                                            <i class="fa fa-times fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-20">
                                                            <b>Dry Van</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                             <br>
                                         
                                             
                                            <form action="{{ route('Subscribe.Package') }}" method="POST" class="mt-4">
                                                @csrf
                                                <!-- Base Radios -->
                                                <!--<div class="d-flex inline-block mb-3">-->
                                                <!--    <div class="form-check" style="margin-right: 9px;">-->
                                                <!--        <input class="form-check-input" type="radio"-->
                                                <!--            name="Payment_Method" id="flexRadioDefault1" value="0">-->
                                                <!--        <label class="form-check-label" for="flexRadioDefault1">-->
                                                <!--            Stripe Payment-->
                                                <!--        </label>-->
                                                <!--    </div>-->

                                                <!--    <div class="form-check" style="margin-left: 9px;">-->
                                                <!--        <input class="form-check-input" type="radio"-->
                                                <!--            name="Payment_Method" id="flexRadioDefault2" value="1"-->
                                                <!--            required>-->
                                                <!--        <label class="form-check-label" for="flexRadioDefault2">-->
                                                <!--            PayPal Payment-->
                                                <!--        </label>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                                <input type="hidden" name="Amount"
                                                    value="{{ $Pacakges->Heavy_Load_Amount }}">
                                                <input type="hidden" name="Package_ID" value="2">
                                                <input type="hidden" name="Name" value="123">
                                                <input type="hidden" name="Email" value="123">
                                                <input type="hidden" name="ID" value="123">
                                                <button type="submit"
                                                    class="btn btn-success w-100 waves-effect waves-light">Subscribe Now
                                                </button>
                                            </form>
                                            <div class="mt-4">
                                                <!--<button type="button" disabled-->
                                                <!--    class="btn btn-success w-100 waves-effect waves-light">Already-->
                                                <!--    Subscribed-->
                                                <!--</button>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </th>
                        <th align-center scope="col" class="border">
                            <!--start 3 col-->
                            <div class="">
                                <div class="card pricing-box card-bg">
                                    <div class="card-body p-4 m-2">
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 fs-20">
                                                    <h5 class="mb-1">Platinum Plan</h5>
                                                    <!--<p class="text-muted-color  mb-0">Enterprise Businesses</p>-->
                                                </div>
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-light rounded-circle text-primary">
                                                        <i class="ri-stack-line fs-20"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pt-4">
                                                <h2 class="price-bg"><sup><small>$</small></sup>
                                                    {{ $Pacakges->Dry_Van_Load_Amount }}<span
                                                        class="fs-13 text-muted-color ">/Month</span></h2>
                                            </div>
                                        </div>
                                        <hr class="my-4 text-muted-color ">
                                        <div>
                                             <br>
                                            <ul class="list-unstyled vstack gap-3 text-muted-color ">
                                                <li>
                                                    <div class="d-flex align-items-baseline gap-2">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="fa fa-check fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-20">
                                                            Primary Vehicles
                                                        </div>
                                                    </div> 
                                                </li>
                                                <li>
                                                    <div class="d-flex align-items-baseline gap-2">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="fa fa-check fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-20">
                                                            <b>Heavy Equipment</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex align-items-baseline gap-2">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="fa fa-check fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-20">
                                                            <b>Dry Van</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                             <br>
                                              
                                            <form action="{{ route('Subscribe.Package') }}" method="POST" class="mt-4">
                                                @csrf
                                                <!-- Base Radios -->
                                                <!--<div class="d-flex inline-block mb-3">-->
                                                <!--    <div class="form-check" style="margin-right: 9px;">-->
                                                <!--        <input class="form-check-input" type="radio"-->
                                                <!--            name="Payment_Method" value="1" id="flexRadioDefault3">-->
                                                <!--        <label class="form-check-label" for="flexRadioDefault3">-->
                                                <!--            Stripe Payment-->
                                                <!--        </label>-->
                                                <!--    </div>-->

                                                <!--    <div class="form-check" style="margin-left: 9px;">-->
                                                <!--        <input class="form-check-input" type="radio"-->
                                                <!--            name="Payment_Method" value="2" id="flexRadioDefault4"-->
                                                <!--            required>-->
                                                <!--        <label class="form-check-label" for="flexRadioDefault4">-->
                                                <!--            PayPal Payment-->
                                                <!--        </label>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                                <input type="hidden" name="Amount"
                                                    value="{{ $Pacakges->Dry_Van_Load_Amount }}">
                                                <input type="hidden" name="Name" value="123">
                                                <input type="hidden" name="Package_ID" value="3">
                                                <input type="hidden" name="Email" value="123">
                                                <input type="hidden" name="ID" value="123">
                                                <button type="submit"
                                                    class="btn btn-success w-100 waves-effect waves-light">Subscribe Now
                                                </button>
                                            </form>
                                            <div class="mt-4">
                                                <!--<button type="button" disabled-->
                                                <!--    class="btn btn-success w-100 waves-effect waves-light">Already-->
                                                <!--    Subscribed-->
                                                <!--</button>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end 3col-->

                        </th>
                        </ align-centertr>
                </thead>
                <tbody>
                    <tr>
                         <td class="border"><h4 class="d-inline-block"> Primary Vehicle </h4><i class="fa fa-question-circle" aria-hidden="true" data-toggle="modal" data-target="#modal1"></i></td>
                        <td class="border align-center"><i class="fa fa-check "></i></td>
                        <td class="border align-center"><i class="fa fa-check "></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border"><h4 class="d-inline-block"> Heavy Load </h4><i class="fa fa-question-circle" aria-hidden="true" data-toggle="modal" data-target="#modal2"></i></td>
                        <td class="border align-center"><i class="fa fa-times "></i></td>
                        <td class="border align-center"><i class="fa fa-check "></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border"><h4 class="d-inline-block"> Freight Load </h4><i class="fa fa-question-circle" aria-hidden="true" data-toggle="modal" data-target="#modal3"></i></td>
                        <td class="border align-center"><i class="fa fa-times"></i></td>
                        <td class="border align-center"><i class="fa fa-times"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border"><h4 class="d-inline-block"> Unlimited Posting </h4><i class="fa fa-question-circle" aria-hidden="true" data-toggle="modal" data-target="#modal4"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border"><h4 class="d-inline-block"> Matching  Route </h4><i class="fa fa-question-circle" aria-hidden="true" data-toggle="modal" data-target="#modal5"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border"><h4 class="d-inline-block"> Request On Load </h4><i class="fa fa-question-circle" aria-hidden="true" data-toggle="modal" data-target="#modal6"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border"><h4 class="d-inline-block"> Automated Reporting </h4><i class="fa fa-question-circle" aria-hidden="true" data-toggle="modal" data-target="#modal7"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>

                    <tr>
                        <td class="border"><h4 class="d-inline-block"> Real Time Tracking </h4><i class="fa fa-question-circle" aria-hidden="true" data-toggle="modal" data-target="#modal8"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border"><h4 class="d-inline-block"> Price Insight </h4><i class="fa fa-question-circle" aria-hidden="true" data-toggle="modal" data-target="#modal9"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border"><h4 class="d-inline-block"> Rating System </h4><i class="fa fa-question-circle" aria-hidden="true" data-toggle="modal" data-target="#modal10"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border"><h4 class="d-inline-block"> Chat System </h4><i class="fa fa-question-circle" aria-hidden="true" data-toggle="modal" data-target="#modal11"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                </tbody>
            </table>
</div>



<!-- About Us 2 Area Start Here  -->
<section class="about__area-2 pt-120 pb-60 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 col-xl-12">
                <div class="about__content-2 mb-60 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay=".5s">
                    <div class="section__title mb-50">
                        <span class="sub-title text-center">Why Choose Us?</span>
                        <h2 class="title text-center">A company involved in servicing, maintenance.</h2>
                    </div>
                    <div class="about__content-tab-2 mt-40">
                        <ul class="nav mb-5 " id="myTab" role="tablist">
                            <div class="tab-content  justify-content-center" id="myTabContent">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active clip-lg-btn" id="approch-tab" data-bs-toggle="tab"
                                        data-bs-target="#approch" type="button" role="tab" aria-controls="approch"
                                        aria-selected="true">Single Vehicle/Partial Load Delivery
                                </button>
                               <div class="tab-pane fade show active" id="approch" role="tabpanel"
                                 aria-labelledby="approch-tab">
                                <p class="text-center">With us, you will have the freedom to ship a single vehicle or Partial Load. Yes! No need to be a
                                    professional auto dealer we give you an opportunity to deliver a single vehicle or Partial Load.
                                </p>
                            </div>
                            
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link clip-lg-btn" id="goal-tab" data-bs-toggle="tab"
                                        data-bs-target="#goal" type="button" role="tab" aria-controls="goal"
                                        aria-selected="false">Affordability
                                </button>
                                  <div class="tab-pane fade show active" id="goal" role="tabpanel" aria-labelledby="goal-tab">
                                <p class="text-center">Will it be expensive? Not at all. We keep your ease and affordability ahead of
                                    anything. This means you can deliver with ease, negotiate with the carrier and
                                    deliver your vehicle safely and sound.</p>
                            </div>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link clip-lg-btn" id="mision-tab" data-bs-toggle="tab"
                                        data-bs-target="#mision" type="button" role="tab" aria-controls="mision"
                                        aria-selected="false">Fast Services
                                </button>
                                 <div class="tab-pane fade show active" id="mision" role="tabpanel" aria-labelledby="mision-tab">
                                <p class="text-center">You might be worried about the extended delivery days of your single vehicle so don’t
                                    worry that your vehicle will be shipped as earlier as it can be with the same care
                                    and handling as the bulk one.</p>
                                 </div>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link clip-lg-btn" id="review-tab" data-bs-toggle="tab"
                                        data-bs-target="#review" type="button" role="tab" aria-controls="review"
                                        aria-selected="false">Review the Carrier
                                </button>
                                <div class="tab-pane fade show active"  id="review" role="tabpanel" aria-labelledby="review-tab">
                                <p class="text-center">Though we strive hard to give you full details of the carriers but if you are still
                                    not happy with the service review the carrier on the website, our automated and
                                    efficient system keep the bad reviewed stay out of the website so that our valued
                                    and respected shippers don’t get contact with them.</p>
                                 </div>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link clip-lg-btn" id="block-tab" data-bs-toggle="tab"
                                        data-bs-target="#block" type="button" role="tab" aria-controls="block"
                                        aria-selected="false">Block the Carrier
                                </button>
                                 <div class="tab-pane fade show active" id="block" role="tabpanel" aria-labelledby="block-tab">
                                <p class="text-center">We give you full freedom the block the undesired carriers so that you can easily
                                    filter and search the best one without ruining your mood. We want you to stay our
                                    happy customer always! </p>
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


<script>
// <!--===================  modal on top the link has set  ============================-->

    // Function to generate modals
    function generateModal(id, title, content) {
        return `
            <div class="modal fade" id="${id}" tabindex="-1" role="dialog" aria-labelledby="${id}Title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="${id}Title">${title}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ${content}
                        </div>
                  
                    </div>
                </div>
            </div>`;
    }

    // Define modal content
    const modals = [
        { id: "modal1", title: "Primary Vehicle", content: "Get access to post and find carriers for your vehicle, bike, ATV, or UTV? Enjoy and get it with our Primary Vehicles platform, where you get instant access to post your vehicles. Whether it's a car, motorcycle, ATV, or UTV, our user-friendly interface makes listing your vehicle so easy like never before.Reach thousands of potential carrier trucks and get your vehicle shipped quickly and hassle-free." },
        { id: "modal2", title: "Heavy Load", content: "Need to transport heavy equipment or loads? Take it lightly with Day Dispatch!Our Heavy Equipment Load platform gives you instant access to post your heavy equipment and loads for transport. Whether it's construction machinery, industrial equipment, or oversized cargo, our platform connects you with reliable carriers ready to handle your heavy loads. With easy-to-use features and a vast network of carriers, transporting your heavy equipment has never been easier. " },
        { id: "modal3", title: "Freight Load", content: "Looking for drivers to transport your freight? Join our Freight Load platform at Day Dispatch.With instant access to post your freight and find drivers, our platform streamlines the process of connecting shippers with carriers.Whether you have full truckload (FTL) or less than truckload (LTL) shipments, our platform helps you find reliable drivers quickly and efficiently. " },
        { id: "modal4", title: "Unlimited Posting", content: "Say goodbye to load posting limits with our Unlimited Load Posting feature. With unlimited access to posting loads, you can list as many shipments as you need without any restrictions. Whether you have one shipment or a hundred, our platform allows you to post unlimited loads and reach a wider pool of carriers. Streamline your logistics process and maximize your shipping efficiency with Unlimited Load Posting. " },
        { id: "modal5", title: "Matching  Route", content: "Need to find the perfect truck for your shipment?Our Matching Trucks Route feature makes it easy to connect with drivers who match your load and route requirements. The driver carries an authentic license and experience to handle your shipment proficiently. Simply Post your load, and our platform will match you with drivers who have available space on their trucks and are traveling along your desired route. " },
        { id: "modal6", title: "Request On Load", content: "Want to receive bids and requests from carriers for your shipments? Our Request on Load and bid on load feature allows you to submit load requests and receive competitive bids from carriers. Simply submit your shipment details, and carriers will submit bids based on their availability and pricing. Choose the best offer and get your shipment on the road quickly and cost-effectively. " },
        { id: "modal7", title: "Automated Reporting", content: "Welcome to Day Dispatch, your proud partner to achieve your success easily like never before! Stay informed about your shipments with our Automated Reporting feature. Get instant access to real-time reporting on your shipments, including status updates, delivery confirmations, and more. With automated reporting, you can track your shipments' progress and make informed decisions to optimize your logistics operations. " },
        { id: "modal8", title: "Real Time Tracking", content: "Keep tabs on your shipments with our Real-Time Tracking feature. Track your shipments' status in real-time, so you always know where your cargo is and when it will arrive. " },
        { id: "modal9", title: "Price Insight", content: "We look after your shipment so you can see what is important for you!Our Compare Route Pricing feature allows you to easily compare pricing from multiple carriers for your desired routes.Simply input your shipment details, and our platform will provide you with pricing options from various carriers, so you can choose the most cost-effective option for your shipments." },
        { id: "modal10", title: "Rating System", content: "Share your experiences with our Rating System feature. Rate and review companies based on your interactions and experiences, helping other users make informed decisions. Whether you had a positive or negative experience, your feedback helps improve transparency and accountability within the industry." },
        { id: "modal11", title: "Chat System", content: "Experience ease like never before!Stay connected with carriers and shippers with our chatting feature.Communicate effortlessly with other users in real-time, discussing shipment details, negotiating terms, and resolving any issues that arise. With built-in chat functionality, you can streamline your communications and ensure everyone is on the same page throughout the shipping process. " },
    ];

    // Append modals to document
    modals.forEach(modal => {
        document.body.innerHTML += generateModal(modal.id, modal.title, modal.content);
    });
    // <!--===================  modal on top the link has set  ============================-->
</script>