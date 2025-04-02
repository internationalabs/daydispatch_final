<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style> 
    body {
        background-color: #ffffff;!important;
    }
    .nice-select.form-control {
        width: 100%;
    }
    ul.list {
        width: 100%;
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
    i.fa.fa-question-circle {
        font-size: 21px;
        color: #bc101c;
        cursor: pointer;
        margin-left: 15px;
    }
    .fa.fa-check {
        color: #23bd23;
        font-size: 25px;
    }  
    .card.pricing-box.card-bg {
        background:#01286317;
        color: #012863; 
    }
    .price-bg {
    background: linear-gradient(197deg, #012863, #47638e);
    color: #fff4f4;
    }
    .card-body.p-4.m-2 {
        width: 340px;
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
    @media screen and (max-width: 986px) {
        .zoom-media { 
            zoom: 100%!important;
        }
         table#table-1 {
            overflow-x: scroll;
            zoom: 85%;
        }
         table#table-2 {
            overflow-x: scroll;
            zoom: 85%;
        }
         table#table-3 {
            overflow-x: scroll;
            zoom: 85%;
        }
         table#table-4 {
            overflow-x: scroll;
            zoom: 85%;
        }
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
    .broker-img {
        background-image: url("../img/plan-img/Shipper-Image-1.webp");
        /* background-image: url(https://daydispatch.com/frontend/img/plan-img/plan-broker.jpeg)!important; */
        object-fit: cover;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        width: 325px;
    }
    .carriers-img {
        background-image: url("../frontend/img/plan-img/Shipper-Image-1.webp");
        /* background-image: url(https://daydispatch.com/frontend/img/plan-img/plan-carriers.jpeg)!important; */
        object-fit: cover;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        width: 325px;
    }
    .shipper-img {
        background-image: url("../frontend/img/plan-img/Shipper-Image-1.webp");
        /* background-image: url(https://daydispatch.com/frontend/img/plan-img/plan-shipper.jpeg)!important; */
        object-fit: cover;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        width: 325px;
    }
    .dispatch-img {
        background-image: url(https://daydispatch.com/frontend/img/plan-img/plan-dispatch.jpeg)!important;
        object-fit: cover;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        width: 325px;
    }
    @media screen and (min-width: 1000px) and (max-width: 1400px) {
    .zoom-media { 
            zoom: 75%!important;
        }
         table#table-1 {
            overflow-x: scroll;
            zoom: 75%;
        }
         table#table-2 {
            overflow-x: scroll;
            zoom: 75%;
        }
         table#table-3 {
            overflow-x: scroll;
            zoom: 75%;
        }
         table#table-4 {
            overflow-x: scroll;
            zoom: 75%;
        }
    }
</style>
@extends('layouts.master')
@section('content')
<section class="page-title-area breadcrumb-spacing" data-background="{{ asset('frontend/img/Daydispatch-packages-banner.webp') }}">    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="page-title-wrapper text-center">
                    <h3 class="page-title mb-25">Packages</h3>
                    <div class="breadcrumb-menu">
                        <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                            <ul class="trail-items">
                                <li class="trail-item trail-begin"><a href="https://daydispatch.com"><span>Home</span></a></li>
                                <li class="trail-item trail-end"><span>Pricing Plan</span></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container"> 
    <div class="row justify-content-center mt-5 m-auto col-11" >
        <div class="section__title gallery-section-title  text-center mt-60">
            <h2 class="title">Choose the plan that's right for you</h2>
            <span class="sub-title mt-40">Simple pricing. No hidden fees. Advanced features for you business.</span>
        </div>
        <div class="container mt-4" >
            <label for="dropdown">Select Account Type:</label>
            <select class="form-control" id="dropdown" name="dropdown">
                <!--<option disabled selected class="text-muted-color ">Select Account Type</option>-->
                <option @selected($type == 'Brokers') value="Brokers">Brokers</option>
                <option @selected($type == 'Carriers') value="Carriers">Carriers</option>
                <!--<option @selected($type == 'Dispatch') value="Dispatch">Dispatch</option>-->
                <option @selected($type == 'Shipper') value="Shipper">Shipper</option>
            </select>
        </div>
        <!--end col-->
    </div> 
</div>
<div class="container mt-4 wow fadeInUp"  data-wow-duration="1.5s" data-wow-delay=".3s"> 
    <div class="row justify-content-center overflow-auto zoom-media" style="zoom: 85%;">
        <div class="col-xl-11">
            <div class="row ">
                <table id="table-1" class="table border "  >
                    <thead>
                        <tr>
                            <th scope="col" class="border text-lg h4 align-self-center broker-img"> <p class="z-index">Payment Plan Brokers</p></th>
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
                                                <h2 class="price-bg" ><sup><small>$</small></sup>0 <span
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
                                            <!--            <div class="form-check" style="margin-right: 9px;">-->
                                            <!--                <input class="form-check-input" type="radio"-->
                                            <!--                    name="Payment_Method" value="1" id="flexRadioDefault3">-->
                                            <!--                <label class="form-check-label" for="flexRadioDefault3">-->
                                            <!--                    Stripe Payment-->
                                            <!--                </label>-->
                                            <!--            </div>-->

                                            <!--            <div class="form-check" style="margin-left: 9px;">-->
                                            <!--                <input class="form-check-input" type="radio"-->
                                            <!--                    name="Payment_Method" value="2" id="flexRadioDefault4"-->
                                            <!--                    required>-->
                                            <!--                <label class="form-check-label" for="flexRadioDefault4">-->
                                            <!--                    PayPal Payment-->
                                            <!--                </label>-->
                                            <!--            </div>-->
                                            <!--        </div>-->

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
                                                    <br>
                                                <!--<div class="mt-4">-->
                                                <!--    <button type="button" disabled-->
                                                <!--        class="btn btn-success w-100 waves-effect waves-light">Already-->
                                                <!--        Subscribed-->
                                                <!--    </button>-->
                                                <!--</div>-->
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
                            <td class="border"><h4 class="d-inline-block">Primary Vehicle</h4> <i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal1"></i></td>
                            <td class="border align-center"><i class="fa fa-check "></i></td>
                            <td class="border align-center"><i class="fa fa-check "></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block">Heavy Load</h4> <i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal2"></i></td>
                            <td class="border align-center"><i class="fa fa-times "></i></td>
                            <td class="border align-center"><i class="fa fa-check "></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block">Freight Load </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal3"></i></td>
                            <td class="border align-center"><i class="fa fa-times"></i></td>
                            <td class="border align-center"><i class="fa fa-times"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block">Unlimited Posting </h4> <i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal4"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block">Matching  Route </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal5"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block">Request On Load </h4> <i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal6"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block">Automated Reporting </h4> <i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal7"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>

                        <tr>
                            <td class="border"><h4 class="d-inline-block">Real Time Tracking </h4> <i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal8"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block">Price Insight </h4> <i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal9"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block">Rating System  </h4> <i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal10"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block">Chat System </h4> <i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal11"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                    </tbody>
                </table> 
                <table id="table-2" class="table border "  >
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
                            <td class="border"><h4 class="d-inline-block"> Load Alert </h4><i class="fa fa-question-circle" aria-hidden="true" data-toggle="modal" data-target="#modal12"></i></td>
                            <td class="border align-center"><i class="fa fa-check "></i></td>
                            <td class="border align-center"><i class="fa fa-check "></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Primary Vehicle </h4><i class="fa fa-question-circle" aria-hidden="true" data-toggle="modal" data-target="#modal13"></i></td>
                            <td class="border align-center"><i class="fa fa-check "></i></td>
                            <td class="border align-center"><i class="fa fa-check "></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Heavy Load </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal14"></i></td>
                            <td class="border align-center"><i class="fa fa-times "></i></td>
                            <td class="border align-center"><i class="fa fa-check "></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Freight Load </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal15"></i></td>
                            <td class="border align-center"><i class="fa fa-times"></i></td>
                            <td class="border align-center"><i class="fa fa-times"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>

                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Matching Loads </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal16"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Request On Load </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal17"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Automated Reporting </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal18"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>

                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Real Time Tracking </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal19"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block">Price Insight</h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal20"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Rating System </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal21"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Chat System </h4><i class="fa fa-question-circle" aria-hidden="true"  data-toggle="modal" data-target="#modal22"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                    </tbody>
                </table>
                <table id="table-3" class="table border "  >
                    <thead>
                        <tr>
                            <th scope="col" class="border text-lg h4 align-self-center dispatch-img"><p class="z-index">Payment Plan Dispatch </P></th>
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
                            <td class="border"><h4 class="d-inline-block"> Load Alert </h4><i class="fa fa-question-circle" aria-hidden="true"></i></td>
                            <td class="border align-center"><i class="fa fa-check "></i></td>
                            <td class="border align-center"><i class="fa fa-check "></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Primary Vehicle </h4><i class="fa fa-question-circle" aria-hidden="true"></i></td>
                            <td class="border align-center"><i class="fa fa-check "></i></td>
                            <td class="border align-center"><i class="fa fa-check "></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Heavy Load </h4><i class="fa fa-question-circle" aria-hidden="true"></i></td>
                            <td class="border align-center"><i class="fa fa-times "></i></td>
                            <td class="border align-center"><i class="fa fa-check "></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Freight Load </h4><i class="fa fa-question-circle" aria-hidden="true"></i></td>
                            <td class="border align-center"><i class="fa fa-times"></i></td>
                            <td class="border align-center"><i class="fa fa-times"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>

                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Matching Loads </h4><i class="fa fa-question-circle" aria-hidden="true"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Request On Load </h4><i class="fa fa-question-circle" aria-hidden="true"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Automated Reporting </h4><i class="fa fa-question-circle" aria-hidden="true"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>

                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Real Time Tracking </h4><i class="fa fa-question-circle" aria-hidden="true"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block">Price Insight</h4><i class="fa fa-question-circle" aria-hidden="true"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Rating System </h4><i class="fa fa-question-circle" aria-hidden="true"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="border"><h4 class="d-inline-block"> Chat System </h4><i class="fa fa-question-circle" aria-hidden="true"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                            <td class="border align-center"><i class="fa fa-check"></i></td>
                        </tr>
                    </tbody>
                </table>
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
                                                <input type="hidden" name="Amount" value="{{ $Pacakges->Dry_Van_Load_Amount }}">
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
            <!--end row-->
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        let typeValue = '{{ $type }}';
        console.log(typeValue, 'typeValue');

        function toggleTables(value) {
            $("#table-1, #table-2, #table-3, #table-4").hide();
            if (value === "Brokers") $("#table-1").show();
            else if (value === "Carriers") $("#table-2").show();
            else if (value === "Dispatch") $("#table-3").show();
            else if (value === "Shipper") $("#table-4").show();
            else $("#table-1").show();
        }

        toggleTables(typeValue);

        $("#dropdown").on('change', function() {
            toggleTables($(this).val());
            console.log($(this).val());
        });
    });
</script>
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
    //========   brocker and shipper start ============ 
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
    //========   brocker and shipper ends ============ 
    //========   carrier ============  
        { id: "modal12", title: "Load Alert", content: "Receive email and notification alerts for new load listings, ensuring you stay updated on available transportation opportunities. Whether it's a new shipment of vehicles or a bulk freight load, load alerts provide timely information to help you identify and secure transportation opportunities that meet your needs. " },
        { id: "modal13", title: "Primary Vehicle", content: "Access a wide range of vehicles including ATVs, UTVs, cars, trucks, vans or more. Meet the diverse transportation needs efficiently. Whether you're transporting recreational vehicles for a weekend getaway or utility vehicles for a construction project, primary vehicle listings offer a comprehensive selection to choose from. " },
        { id: "modal14", title: "Heavy Load", content: "Explore listings specifically for heavy loads, facilitating the transportation of bulky or oversized items with ease. Whether it's heavy machinery or construction materials, heavy load listings provide specialized transportation options to ensure safe and efficient delivery whenever using the Day Dispatch platform. " },
        { id: "modal15", title: "Freight Load", content: "Browse listings dedicated to freight transportation, this option helps streamline the process of finding suitable freight loads. Whether you're shipping goods across the country or transporting inventory to a warehouse, freight load listings offer a convenient platform to connect with shippers and brokers." },
        { id: "modal16", title: "Matching Loads", content: "Easily identify matching loads for available trucks, optimizing efficiency and maximizing load utilization. Whether you are a carrier looking to fill empty truck space or a shipper in need of transportation services, matching load features help streamline the logistics process and minimize empty miles." },
        { id: "modal17", title: "Request On Load", content: " Initiate requests for specific loads, enabling tailored transportation solutions that meet your unique requirements. Whether it's a specialized vehicle or a time-sensitive shipment, request-on-load options allow you to communicate your needs directly with potential transportation providers with effective services and authentic pricing." },
        { id: "modal18", title: "Automated Reporting", content: " Get benefits from automated reports detailing key transportation metrics and performance indicators, simplifying logistics management and tackling logistics challenges. Reporting features provide valuable insights to optimize transportation operations." },
        { id: "modal19", title: "Real Time Tracking", content: "Monitor and track delivery progress in real time, ensuring transparency and accountability throughout the transportation process. Improve the driver’s performance and manage the shipment conveniently. Whether you're a shipper tracking a shipment or a carrier monitoring  movement, real-time tracking features offer visibility and convenience at the same time." },
        { id: "modal20", title: "Price Insight", content: "Access market competitive pricing information and compare rates across different routes, making informed decisions to optimize cost-effectiveness. Whether you're a shipper seeking competitive rates or a carrier pricing your services, price insight features help ensure fair and transparent transactions to help you get the best prices." },
        { id: "modal21", title: "Rating System", content: "Rate and review transportation services based on your experience, contributing to a transparent and reliable feedback system for the community. the rating system raises trust and accountability within the transportation ecosystem and makes you choose the services wisely." },
        { id: "modal22", title: "Chat System", content: "Utilize a dedicated chat system for effective communication among dealers, importers, carriers, brokers or shippers, facilitating collaboration and problem-solving during transportation operations. Whether it's coordinating pickup and delivery schedules or resolving issues in real time, the chat system enhances efficiency and ensures smooth communication between parties. " },
    
    //========   carrier ============ 
    ];
    // Append modals to document
    modals.forEach(modal => {
        document.body.innerHTML += generateModal(modal.id, modal.title, modal.content);
    });
    // <!--===================  modal on top the link has set  ============================-->
</script>
@endsection