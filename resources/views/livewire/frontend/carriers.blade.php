<link href="https://daydispatch.com/admin-backend/css/custom.min.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        width: 266px;
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
    table#table-2 {
        zoom: 85%;
        display: block;
        width: -webkit-fill-available;
        margin: auto;
    }
    .container.table2 {
        width: 84%;
        overflow: hidden;
    }
    @media screen and (max-width: 986px) {
        .zoom-media { 
            zoom: 100%!important;
        }
         table#table-2 {
            overflow-x: scroll;
        }
    }
    .broker-img {
        background-image: url(https://daydispatch.com/frontend/img/plan-img/plan-broker.jpeg)!important;
        object-fit: cover;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
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
        background: linear-gradient(197deg, #012863, #47638e);
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
    .card.pricing-box.card-bg {
        width: 350px;
    }
    .carriers-img {
        background-image: url("../frontend/img/plan-img/Shipper-Image-1.webp");
        /* background-image: url(https://daydispatch.com/frontend/img/plan-img/plan-carriers.jpeg)!important; */
        object-fit: cover;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
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
    @media screen and (min-width: 1000px) and (max-width: 1400px) {
    .zoom-media { 
            zoom: 75%!important;
        }
         table#table-2 {
            overflow-x: scroll;
            zoom: 75%;
        }
    }
</style>
<!-- page title area  -->
<section class="page-title-area breadcrumb-spacing"
         data-background="{{ asset('frontend/img/carrier-banner.webp') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="page-title-wrapper text-center">
                    <h3 class="page-title mb-25">Carriers</h3>
                    <div class="breadcrumb-menu">
                        <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                            <ul class="trail-items">
                                <li class="trail-item trail-begin"><a
                                        href="{{ route('Frontend.index') }}"><span>Home</span></a></li>
                                <li class="trail-item trail-end"><span>Carriers</span></li>
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
                    <span class="sub-title">carriers</span>
                    <h2 class="title">How Day Dispatch work for carriers?</h2>
                    <p>Day Dispatch brought its innovative services to the carriers while providing them 
                        with an easy platform to gain maximum shippers in very less time. How can we be 
                        worth it to you? So you will be amazed that we have millions of cargoes listed on
                         our website “Day Dispatch”. We help you to thrive more quickly by keeping your trucks
                          filled. With our hundreds of happy customers, we can say that our products help you 
                          promote better, and faster, and not just this we also bring our services ahead to work
                           with more efficient work from drivers and dispatchers.
                        With our website, you can easily search brokers, dealers, and other shippers who have 
                        posted their Loads on Day Dispatch. The shippers' posting has full information available
                         on our website such as where the vehicle/cargoes is going. What are the desired charges of shippers,
                          they are willing to pay? Not just this you can access the travailing route of your Shipment
                           and bargain a good deal with a shipper or broker directly with this website. 
                        
                        </p>
                </div>
            </div>
        </div>
        <div class="row wow fadeInUp justify-content-center" data-wow-duration="1.5s" data-wow-delay=".5s">
            <div class="col-xl-6 col-md-6">
                <div class="services__3-item mb-30">
                    <div class="services__3-item-num">
                        <h3>01</h3>
                    </div>
                    <div class="services__3-item-icon">
                        <!--<i class="flaticon-boat"></i>-->
                        <img class="dealer" src="{{ asset('frontend/img/Isitforme/Dealer.png') }}">
                    </div>
                    <h3 class="services__3-item-title"><a href="JavaScript:void(0);">How will you do this? </a></h3>
                    <p class="services__3-item-text">It’s really easy to do! Just click on search for the shipments
                         and be ready to fill the truck. The shipment post will consist of the pickup 
                         location, delivery location, and payment method. Once you are finished with the required
                          information time to bid with the shippers, deal with them directly and move forward to
                           the successful journey with him with the following 4 steps:  
 
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
                        <img class="broker" src="{{ asset('frontend/img/Isitforme/searching-veh.png') }}">
                    </div>
                    <h3 class="services__3-item-title"><a href="JavaScript:void(0);">Searching for Load on Day Dispatch </a></h3>
                    <p class="services__3-item-text"> Click on the search bar and find out available shippers
                         to your routes contact them using this website. If the shipper is ready to move with 
                         you, congratulations then! Provide your information to the shipper ad move to the next
                          step, 

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
                    <h3 class="services__3-item-title"><a href="JavaScript:void(0);">Coordinating with the broker directly for pickup </a></h3>
                    <p class="services__3-item-text"> We know that you are proficient enough to make deal 
                        with the shipper that’s why we offer you this opportunity to coordinate with the broker 
                        directly for pickup. Now it’s time to make the deal!


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
                    <img class="Import and Export" src="{{ asset('frontend/img/Isitforme/request.png') }}">

                    </div>
                    <h3 class="services__3-item-title"><a href="JavaScript:void(0);">Shipper acceptance of your request</a></h3>
                    <p class="services__3-item-text">When the shipper agreed to your deal/ request then you will 
                        get your shipment accepted and ready to deliver with assistance with the day dispatch.
                    
                    </p>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="services__3-item mb-30">
                    <div class="services__3-item-num">
                        <h3>05</h3>
                    </div>
                    <div class="services__3-item-icon">
                        <!--<i class="flaticon-train"></i>-->
                    <img class="Import and Export" src="{{ asset('frontend/img/Isitforme/time-diliver.png') }}">

                    </div> 
                    <h3 class="services__3-item-title"><a href="JavaScript:void(0);">Time to Deliver! </a></h3>
                    <p class="services__3-item-text">As the delivery is made, if the payment is COD collect your
                         payment. It is not stopped here, you can rate the shipper based on your experience. 

                        So start searching and grow richer!
                        
                    
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container table2">
    <div class="section__title mb-50 mt-50">
        <span class="sub-title text-center">Payment Plan</span> 
        <h2 class="title text-center">PAYMENT PLAN for Carrier</h2> 
    </div>
    <table id="table-2" class="table border wow fadeInUp"  data-wow-duration="1.5s" data-wow-delay=".3s">
        <thead>
            <tr>
                <th scope="col" class="border text-lg h4 align-self-center carriers-img"><p class="z-index">Payment Plan Carriers </P></th>
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
                                        <div class="flex-grow-1">
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
                                        <div class="flex-grow-1">
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
                <td class="border"><h4 class="d-inline-block"> Load Alert </h4><i class="fa fa-question-circle" aria-hidden="true" data-toggle="modal" data-target="#modal1"></i></td>
                <td class="border align-center"><i class="fa fa-check "></i></td>
                <td class="border align-center"><i class="fa fa-check "></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
            </tr>
            <tr>
                <td class="border"><h4 class="d-inline-block"> Primary Vehicle </h4><i class="fa fa-question-circle" aria-hidden="true" data-toggle="modal" data-target="#modal2"></i></td>
                <td class="border align-center"><i class="fa fa-check "></i></td>
                <td class="border align-center"><i class="fa fa-check "></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
            </tr>
            <tr>
                <td class="border"><h4 class="d-inline-block"> Heavy Load </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal3"></i></td>
                <td class="border align-center"><i class="fa fa-times "></i></td>
                <td class="border align-center"><i class="fa fa-check "></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
            </tr>
            <tr>
                <td class="border"><h4 class="d-inline-block"> Freight Load </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal4"></i></td>
                <td class="border align-center"><i class="fa fa-times"></i></td>
                <td class="border align-center"><i class="fa fa-times"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
            </tr>

            <tr>
                <td class="border"><h4 class="d-inline-block"> Matching Loads </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal5"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
            </tr>
            <tr>
                <td class="border"><h4 class="d-inline-block"> Request On Load </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal6"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
            </tr>
            <tr>
                <td class="border"><h4 class="d-inline-block"> Automated Reporting </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal7"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
            </tr>

            <tr>
                <td class="border"><h4 class="d-inline-block"> Real Time Tracking </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal8"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
            </tr>
            <tr>
                <td class="border"><h4 class="d-inline-block">Price Insight</h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal9"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
            </tr>
            <tr>
                <td class="border"><h4 class="d-inline-block"> Rating System </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal10"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
                <td class="border align-center"><i class="fa fa-check"></i></td>
            </tr>
            <tr>
                <td class="border"><h4 class="d-inline-block"> Chat System </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal11"></i></td>
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
                        <span class="sub-title text-center">Explore</span>
                        <h2 class="title text-center">Why Choose Us?</h2>
                    </div>
                    <div class="about__content-tab-2 mt-40">
                        <ul class="nav mb-5 " id="myTab" role="tablist">
                            <div class="tab-content  justify-content-center" id="myTabContent">
                            <li class="nav-item" role="presentation">
                                <!--<button class="nav-link active clip-lg-btn" id="approch-tab" data-bs-toggle="tab"-->
                                <!--        data-bs-target="#approch" type="button" role="tab" aria-controls="approch"-->
                                <!--        aria-selected="true">Single Vehicle Delivery-->
                                <!--</button>-->
                               <div class="tab-pane fade show active" id="approch" role="tabpanel"
                                 aria-labelledby="approch-tab">
                                <p class="text-center">You may have a question: why will you choose us? The answer is simple we make
                                your experience delighted with our exceptional features and client-friendly services through the following benefits: 

                                </p>
                            </div>
                            
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link clip-lg-btn" id="goal-tab" data-bs-toggle="tab"
                                        data-bs-target="#goal" type="button" role="tab" aria-controls="goal"
                                        aria-selected="false">Carrier Invoicing
                                </button>
                                  <div class="tab-pane fade show active" id="goal" role="tabpanel" aria-labelledby="goal-tab">
                                <p class="text-center">An ultimate feature to get 2x faster by our integrated invoice creation
                                not just it, you can email customers really easily using a single click on the feature. 
                                </p>
                            </div>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link clip-lg-btn" id="mision-tab" data-bs-toggle="tab"
                                        data-bs-target="#mision" type="button" role="tab" aria-controls="mision"
                                         aria-selected="false">Storage of Document
                                </button>
                                 <div class="tab-pane fade show active" id="mision" role="tabpanel" aria-labelledby="mision-tab">
                                <p class="text-center">Taking care of the documents is no longer needed as we
                                offer you this benefit by providing you the option to save your important files
                                and important paperwork associated with dispatched cargoes. Not only this you can
                                anytime share your documents with all your loads and also have a history of your documents. 
                                We brought this feature for you so that you can breathe more easily with the feeling of being more empowered. 
                                </p>
                                 </div>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link clip-lg-btn" id="review-tab" data-bs-toggle="tab"
                                        data-bs-target="#review" type="button" role="tab" aria-controls="review"
                                        aria-selected="false">Preferred Shipper 
                                </button>
                                <div class="tab-pane fade show active"  id="review" role="tabpanel" aria-labelledby="review-tab">
                                <p class="text-center">You don’t need to be afraid of being disturbed why? Because they have enabled this 
                                out-class option for you, with which you can easily block the undesired shippers and get access to your 
                                preferred shippers. It’s not stopped here. This feature helps you to filter your search smartly and save
                                your time by only getting an approach to the preferred partners instead of all the undesired/ blocked ones.
                                </p>
                                 </div>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link clip-lg-btn" id="block-tab" data-bs-toggle="tab"
                                        data-bs-target="#block" type="button" role="tab" aria-controls="block"
                                        aria-selected="false">Review the Shipper

                                </button>
                                 <div class="tab-pane fade show active" id="block" role="tabpanel" aria-labelledby="block-tab">
                                <p class="text-center">Had a bad experience? Don’t ignore it. We are here to heal your sore feelings by providing you
                                with this feature
                                to review your shippers and make the world know about them. Isn’t it cool? </p>
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
       //========   carrier ============ 
        { id: "modal1", title: "Load Alert", content: "Receive email and notification alerts for new load listings, ensuring you stay updated on available transportation opportunities. Whether it's a new shipment of vehicles or a bulk freight load, load alerts provide timely information to help you identify and secure transportation opportunities that meet your needs. " },
        { id: "modal2", title: "Primary Vehicle", content: "Access a wide range of vehicles including ATVs, UTVs, cars, trucks, vans or more. Meet the diverse transportation needs efficiently. Whether you're transporting recreational vehicles for a weekend getaway or utility vehicles for a construction project, primary vehicle listings offer a comprehensive selection to choose from. " },
        { id: "modal3", title: "Heavy Load", content: "Explore listings specifically for heavy loads, facilitating the transportation of bulky or oversized items with ease. Whether it's heavy machinery or construction materials, heavy load listings provide specialized transportation options to ensure safe and efficient delivery whenever using the Day Dispatch platform. " },
        { id: "modal4", title: "Freight Load", content: "Browse listings dedicated to freight transportation, this option helps streamline the process of finding suitable freight loads. Whether you're shipping goods across the country or transporting inventory to a warehouse, freight load listings offer a convenient platform to connect with shippers and brokers." },
        { id: "modal5", title: "Matching Loads", content: "Easily identify matching loads for available trucks, optimizing efficiency and maximizing load utilization. Whether you are a carrier looking to fill empty truck space or a shipper in need of transportation services, matching load features help streamline the logistics process and minimize empty miles." },
        { id: "modal6", title: "Request On Load", content: " Initiate requests for specific loads, enabling tailored transportation solutions that meet your unique requirements. Whether it's a specialized vehicle, Heavy Equipment or a Freight shipment, request-on-load options allow you to communicate your needs directly with potential transportation providers with effective services and authentic pricing." },
        { id: "modal7", title: "Automated Reporting", content: " Get benefits from automated reports detailing key transportation metrics and performance indicators, simplifying logistics management and tackling logistics challenges. Reporting features provide valuable insights to optimize transportation operations." },
        { id: "modal8", title: "Real Time Tracking", content: "Monitor and track delivery progress in real time, ensuring transparency and accountability throughout the transportation process. Improve the driver’s performance and manage the shipment conveniently. Whether you're a shipper tracking a shipment or a carrier monitoring  movement, real-time tracking features offer visibility and convenience at the same time." },
        { id: "modal9", title: "Price Insight", content: "Access market competitive pricing information and compare rates across different routes, making informed decisions to optimize cost-effectiveness. Whether you're a shipper seeking competitive rates or a carrier pricing your services, price insight features help ensure fair and transparent transactions to help you get the best prices." },
        { id: "modal10", title: "Rating System", content: "Rate and review transportation services based on your experience, contributing to a transparent and reliable feedback system for the community. the rating system raises trust and accountability within the transportation ecosystem and makes you choose the services wisely." },
        { id: "modal11", title: "Chat System", content: "Utilize a dedicated chat system for effective communication among dealers, importers, carriers, brokers or shippers, facilitating collaboration and problem-solving during transportation operations. Whether it's coordinating pickup and delivery schedules or resolving issues in real time, the chat system enhances efficiency and ensures smooth communication between parties. " },
    //========   carrier ============ 
    ];
    // Append modals to document
    modals.forEach(modal => {
        document.body.innerHTML += generateModal(modal.id, modal.title, modal.content);
    });
    // <!--===================  modal on top the link has set  ============================-->
</script>