@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
@endphp

<style>
    .rating i {
        color: #3d74cd;
        font-size: 18px;
    }

    #rate-stats .svg-inline--fa {
        height: auto !important;
    }

    #rate-stats .stats-box:hover {
        border: 1px solid #e1000a !important;
    }

    .active-stats-box {
        border: 1px solid #e1000a !important;
    }

    .bx {
        font-family: 'boxicons', serif !important;
        font-weight: normal;
        font-style: normal;
        font-variant: normal;
        line-height: 1;
        display: inline-block;
        text-transform: none;
        speak: none;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 25px;
        margin-left: 15px;
    }

    .card .card-body {
        background-color: transparent;
    }

    @media screen and (max-width: 767px) {
        .card-body .table-responsive .table tbody tr td span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 100px;
        }

        .card-body .table-responsive .progress-content tbody tr td span {
            text-overflow: ellipsis;
            white-space: normal;
            max-width: 50px;
        }

        .card-body .table-responsive .checkbox-td-width tbody tr td,
        .card-body .table-responsive .radio-first-col-width tbody tr td {
            min-width: 200px !important;
        }
    }

    @media screen and (max-width: 575px) {
        div.table-responsive>div.dataTables_wrapper>div.row>div[class^="col-"]:last-child {
            padding-left: 0 !important;
        }

        div.table-responsive>div.dataTables_wrapper>div.row>div[class^="col-"]:first-child {
            padding-right: 0 !important;
        }
    }
</style>
<!-- Breadcrumb Area -->
<div class="breadcrumb-area mb-0">
    <h1>My Rating Dashboard</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">My Rating Dashboard</li>
    </ol>
</div>
<!-- End Breadcrumb Area -->

<section class="profile-area">

    <div class="profile-header">

        <div class="user-profile-nav" style="padding: 25px 25px 25px 25px !important;">
            <ul class="nav nav-tabs" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" id="MyRatings-tab" data-toggle="tab" href="#myRatings" role="tab"
                        aria-controls="myRatings" aria-selected="false">My Ratings</a>
                </li>

                @if (Auth::guard('Authorized')->user()->usr_type != 'Carrier')
                    <li class="nav-item">
                        <a class="nav-link" id="Overview-tab" data-toggle="tab" href="#overall" role="tab"
                            aria-controls="overall" aria-selected="false">Rated By Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="pendings-tab" data-toggle="tab" href="#pendings" role="tab"
                            aria-controls="pendings" aria-selected="false">Pending</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <div class="tab-content">

        <div class="tab-pane fade show active" id="myRatings" role="tabpanel" aria-labelledby="myRatings-tab">

            <div class="card top-rated-product-box pl-3">

                <div class="card-header" style="margin-bottom: 0px;">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 pl-3 ml-3 text-center">
                            <h3>{{ $User_Info->Company_Name }}</h3>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 pl-3 ml-3 text-center">
                            <h3>Overall Rating <i class="fa fa-exclamation-circle-alt"></i></h3>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 pl-3 ml-3 text-center">
                            <h3>Experience Details</h3>
                        </div>
                    </div>
                </div>

                <div class="row pl-3">
                    <div class="col-lg-4 col-md-4 col-sm-12 text-center m-3"
                        style="border: 1px solid #d0d0d0; border-radius: 10px;">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 p-3">
                                <span class="">{{ $User_Info->Address }}</span><br>
                                <span class="">{{ $User_Info->Company_City }},
                                    {{ $User_Info->Company_State }}</span><br>
                                <span class="">{{ $User_Info->Contact_Phone }}</span><br>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 p-3">
                                <strong>Join Date:</strong>&nbsp;<span
                                    class="">{{ $User_Info->updated_at }}</span><br>
                                <strong>Business Type:</strong>&nbsp;<span
                                    class="">{{ $User_Info->usr_type }}</span><br>
                                <strong>Total Shipments:</strong>&nbsp;<span
                                    class="">{{ number_format($User_Info->all_listing_count) }}</span><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 p-3 m-3 text-center"
                        style="border: 1px solid #d0d0d0; border-radius: 10px;">
                        <div class="rating d-inline-block">
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                        </div>
                        <a href="">({{ count($User_Rating) }})</a><br>
                        <span class="font-weight-bolder"
                            style="font-size: 2rem;">{{ number_format($avg_rating, 1) }}</span> <span>out of 5</span>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12 p-3 m-3 text-center"
                        style="border: 1px solid #d0d0d0; border-radius: 10px;">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <strong>Timeliness <i class="fa fa-exclamation-circle"></i></strong><br>
                                <span class="font-weight-bolder"
                                    style="font-size: 1.2rem;">{{ round($User_Info->ratings_avg_timeliness, 2) }}</span>
                                <div class="rating d-inline-block">
                                    <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <strong>Communication <i class="fa fa-exclamation-circle"></i></strong><br>
                                <span class="font-weight-bolder"
                                    style="font-size: 1.2rem;">{{ round($User_Info->ratings_avg_communication, 2) }}</span>
                                <div class="rating d-inline-block">
                                    <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <strong>Documentation <i class="fa fa-exclamation-circle"></i></strong><br>
                                <span class="font-weight-bolder"
                                    style="font-size: 1.2rem;">{{ round($User_Info->ratings_avg_documentation, 2) }}</span>
                                <div class="rating d-inline-block">
                                    <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header mt-1">
                    <h3 class="font-weight-bolder">My Ratings</h3>
                </div>

                @if (Auth::guard('Authorized')->user()->usr_type === 'Carrier')
                    {{-- {{ dd($User_Rating->toArray()) }} --}}
                    @forelse($User_Rating as $Rate)
                        <div class="row" style="border: 1px solid #d0d0d0; border-radius: 10px;">
                            <div class="col-lg-3 col-md-3 col-sm-12"
                                style="background: #efefef; padding: 1.5rem 0rem 0rem 1.5rem;">
                                <div class="card-header mt-1" style="background: #efefef;">
                                    <h3 class="">{{ $Rate->rated_user->Company_Name }}</h3><br>
                                    <span>{{ $Rate->rated_user->Company_City }},
                                        {{ $Rate->rated_user->Company_State }}</span>
                                    <span><strong>Order ID: </strong>{{ $Rate->all_listing->Ref_ID }}</span>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12" style="padding: 1.5rem 0rem 0rem 1.5rem;">
                                <div class="row my-3">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <h5 class="font-weight-bolder">Overall Rating</h5>
                                        <div class="rating d-inline-block">
                                            @if ($Rate->Rating === 'Positive')
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                            @endif
                                            @if ($Rate->Rating === 'Neutral')
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                            @endif
                                            @if ($Rate->Rating === 'Negative')
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <strong>Timeliness <i class="fa fa-exclamation-circle"></i></strong><br>
                                        <span class="font-weight-bolder"
                                            style="font-size: 1.2rem;">{{ $Rate->Timeliness }}</span>
                                        <div class="rating d-inline-block">
                                            <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <strong>Communication <i class="fa fa-exclamation-circle"></i></strong><br>
                                        <span class="font-weight-bolder"
                                            style="font-size: 1.2rem;">{{ $Rate->Communication }}</span>
                                        <div class="rating d-inline-block">
                                            <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <strong>Documentation <i class="fa fa-exclamation-circle"></i></strong><br>
                                        <span class="font-weight-bolder"
                                            style="font-size: 1.2rem;">{{ $Rate->Documentation }}</span>
                                        <div class="rating d-inline-block">
                                            <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                        </div>
                                    </div>
                                </div>
                                @if (!empty($Rate->Rating_Comments))
                                    <blockquote class="blockquote">
                                        <p class="mb-0 small">{{ $Rate->Rating_Comments }}</p>
                                        @if (!empty($Rate->Rating_Replied))
                                            <p class="mb-0 small text-right" style="margin-right: 1.5rem;">
                                                {{ $Rate->Rating_Replied }}</p>
                                        @elseif($Rate->user_id !== Auth::guard('Authorized')->user()->id)
                                            <a data-toggle="modal" data-target="#RatingRepliedComments"
                                                href="javascript:void(0);"
                                                class="rate-reply btn btn-sm btn-outline-danger text-end mb-3 mr-3"
                                                style="float: right;"><i class="bx bx-home-circle"></i>
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $Rate->order_id }}">
                                                <input hidden type="text" class="Rate-ID"
                                                    value="{{ $Rate->id }}">
                                                Replied!</a>
                                        @endif
                                    </blockquote>
                                @endif
                            </div>
                        </div>
                    @empty
                    @endforelse
                @else
                    @forelse($My_Rating as $Rate)
                        <div class="row" style="border: 1px solid #d0d0d0; border-radius: 10px;">
                            <div class="col-lg-3 col-md-3 col-sm-12"
                                style="background: #efefef; padding: 1.5rem 0rem 0rem 1.5rem;">
                                <div class="card-header mt-1" style="background: #efefef;">
                                    <h3 class="">{{ $Rate->authorized_user->Company_Name }}</h3><br>
                                    <span>{{ $Rate->authorized_user->Company_City }},
                                        {{ $Rate->authorized_user->Company_State }}</span>
                                    <span><strong>Order ID: </strong>{{ $Rate->all_listing->Ref_ID }}</span>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12" style="padding: 1.5rem 0rem 0rem 1.5rem;">
                                <div class="row my-3">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <h5 class="font-weight-bolder">Overall Rating</h5>
                                        <div class="rating d-inline-block">
                                            @if ($Rate->Rating === 'Positive')
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                            @endif
                                            @if ($Rate->Rating === 'Neutral')
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                            @endif
                                            @if ($Rate->Rating === 'Negative')
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <strong>Timeliness <i class="fa fa-exclamation-circle"></i></strong><br>
                                        <span class="font-weight-bolder"
                                            style="font-size: 1.2rem;">{{ $Rate->Timeliness }}</span>
                                        <div class="rating d-inline-block">
                                            <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <strong>Communication <i class="fa fa-exclamation-circle"></i></strong><br>
                                        <span class="font-weight-bolder"
                                            style="font-size: 1.2rem;">{{ $Rate->Communication }}</span>
                                        <div class="rating d-inline-block">
                                            <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <strong>Documentation <i class="fa fa-exclamation-circle"></i></strong><br>
                                        <span class="font-weight-bolder"
                                            style="font-size: 1.2rem;">{{ $Rate->Documentation }}</span>
                                        <div class="rating d-inline-block">
                                            <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                        </div>
                                    </div>
                                </div>
                                @if (!empty($Rate->Rating_Comments))
                                    <blockquote class="blockquote">
                                        <p class="mb-0 small">{{ $Rate->Rating_Comments }}</p>
                                        @if (!empty($Rate->Rating_Replied))
                                            <p class="mb-0 small text-right" style="margin-right: 1.5rem;">
                                                {{ $Rate->Rating_Replied }}</p>
                                        @elseif($Rate->user_id !== Auth::guard('Authorized')->user()->id)
                                            <a data-toggle="modal" data-target="#RatingRepliedComments"
                                                href="javascript:void(0);"
                                                class="rate-reply btn btn-sm btn-outline-danger text-end mb-3 mr-3"
                                                style="float: right;"><i class="bx bx-home-circle"></i>
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $Rate->order_id }}">
                                                <input hidden type="text" class="Rate-ID"
                                                    value="{{ $Rate->id }}">
                                                Replied!</a>
                                        @endif
                                    </blockquote>
                                @endif
                            </div>
                        </div>
                    @empty
                    @endforelse
                @endif
            </div>

        </div>

        @if (Auth::guard('Authorized')->user()->usr_type != 'Carrier')
            <div class="tab-pane fade" id="overall" role="tabpanel" aria-labelledby="overall-tab">

                <div class="card top-rated-product-box pl-3">

                    <div class="card-header" style="margin-bottom: 0px;">
                        {{-- <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 pl-3 ml-3 text-center">
                                <h3>{{ $User_Info->Company_Name }}</h3>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 pl-3 ml-3 text-center">
                                <h3>Overall Rating <i class="fa fa-exclamation-circle-alt"></i></h3>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-12 pl-3 ml-3 text-center">
                                <h3>Experience Details</h3>
                            </div>
                        </div> --}}
                    </div>

                    <div class="card-header mt-1">
                        <h3 class="font-weight-bolder">Most Helpful Reviews</h3>
                    </div>

                    @if (Auth::guard('Authorized')->user()->usr_type === 'Carrier')
                        @forelse($My_Rating as $Rate)
                            <div class="row" style="border: 1px solid #d0d0d0; border-radius: 10px;">
                                <div class="col-lg-3 col-md-3 col-sm-12"
                                    style="background: #efefef; padding: 1.5rem 0rem 0rem 1.5rem;">
                                    <div class="card-header mt-1" style="background: #efefef;">
                                        <h3 class="">{{ $Rate->rated_user->Company_Name }}</h3><br>
                                        <span>{{ $Rate->rated_user->Company_City }},
                                            {{ $Rate->rated_user->Company_State }}</span>
                                        <span><strong>Order ID: </strong>{{ $Rate->all_listing->Ref_ID }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12" style="padding: 1.5rem 0rem 0rem 1.5rem;">
                                    <div class="row my-3">
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <h5 class="font-weight-bolder">Overall Rating</h5>
                                            <div class="rating d-inline-block">
                                                @if ($Rate->Rating === 'Positive')
                                                    <i class="bx bxs-star"></i>
                                                    <i class="bx bxs-star"></i>
                                                    <i class="bx bxs-star"></i>
                                                    <i class="bx bxs-star"></i>
                                                    <i class="bx bxs-star"></i>
                                                @endif
                                                @if ($Rate->Rating === 'Neutral')
                                                    <i class="bx bxs-star"></i>
                                                    <i class="bx bxs-star"></i>
                                                    <i class="bx bxs-star"></i>
                                                @endif
                                                @if ($Rate->Rating === 'Negative')
                                                    <i class="bx bxs-star"></i>
                                                    <i class="bx bxs-star"></i>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <strong>Timeliness <i class="fa fa-exclamation-circle"></i></strong><br>
                                            <span class="font-weight-bolder"
                                                style="font-size: 1.2rem;">{{ $Rate->Timeliness }}</span>
                                            <div class="rating d-inline-block">
                                                <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <strong>Communication <i class="fa fa-exclamation-circle"></i></strong><br>
                                            <span class="font-weight-bolder"
                                                style="font-size: 1.2rem;">{{ $Rate->Communication }}</span>
                                            <div class="rating d-inline-block">
                                                <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <strong>Documentation <i class="fa fa-exclamation-circle"></i></strong><br>
                                            <span class="font-weight-bolder"
                                                style="font-size: 1.2rem;">{{ $Rate->Documentation }}</span>
                                            <div class="rating d-inline-block">
                                                <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @if (!empty($Rate->Rating_Comments))
                                        <blockquote class="blockquote">
                                            <p class="mb-0 small">{{ $Rate->Rating_Comments }}</p>
                                            @if (!empty($Rate->Rating_Replied))
                                                <p class="mb-0 small text-right" style="margin-right: 1.5rem;">
                                                    {{ $Rate->Rating_Replied }}</p>
                                            @elseif($Rate->user_id !== Auth::guard('Authorized')->user()->id)
                                                <a data-toggle="modal" data-target="#RatingRepliedComments"
                                                    href="javascript:void(0);"
                                                    class="rate-reply btn btn-sm btn-outline-danger text-end mb-3 mr-3"
                                                    style="float: right;"><i class="bx bx-home-circle"></i>
                                                    <input hidden type="text" class="Listed-ID"
                                                        value="{{ $Rate->order_id }}">
                                                    <input hidden type="text" class="Rate-ID"
                                                        value="{{ $Rate->id }}">
                                                    Replied!</a>
                                            @endif
                                        </blockquote>
                                    @endif
                                </div>
                            </div>
                        @empty
                        @endforelse
                    @else
                        @forelse($My_Rating as $Rate)
                            <div class="row" style="border: 1px solid #d0d0d0; border-radius: 10px;">
                                <div class="col-lg-3 col-md-3 col-sm-12"
                                    style="background: #efefef; padding: 1.5rem 0rem 0rem 1.5rem;">
                                    <div class="card-header mt-1" style="background: #efefef;">
                                        <h3 class="">{{ $Rate->rated_user->Company_Name }}</h3><br>
                                        <span>{{ $Rate->rated_user->Company_City }},
                                            {{ $Rate->rated_user->Company_State }}</span>
                                        <span><strong>Order ID: </strong>{{ $Rate->all_listing->Ref_ID }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12" style="padding: 1.5rem 0rem 0rem 1.5rem;">
                                    <div class="row my-3">
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <h5 class="font-weight-bolder">Overall Rating</h5>
                                            <div class="rating d-inline-block">
                                                @if ($Rate->Rating === 'Positive')
                                                    <i class="bx bxs-star"></i>
                                                    <i class="bx bxs-star"></i>
                                                    <i class="bx bxs-star"></i>
                                                    <i class="bx bxs-star"></i>
                                                    <i class="bx bxs-star"></i>
                                                @endif
                                                @if ($Rate->Rating === 'Neutral')
                                                    <i class="bx bxs-star"></i>
                                                    <i class="bx bxs-star"></i>
                                                    <i class="bx bxs-star"></i>
                                                @endif
                                                @if ($Rate->Rating === 'Negative')
                                                    <i class="bx bxs-star"></i>
                                                    <i class="bx bxs-star"></i>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <strong>Timeliness <i class="fa fa-exclamation-circle"></i></strong><br>
                                            <span class="font-weight-bolder"
                                                style="font-size: 1.2rem;">{{ $Rate->Timeliness }}</span>
                                            <div class="rating d-inline-block">
                                                <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <strong>Communication <i class="fa fa-exclamation-circle"></i></strong><br>
                                            <span class="font-weight-bolder"
                                                style="font-size: 1.2rem;">{{ $Rate->Communication }}</span>
                                            <div class="rating d-inline-block">
                                                <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <strong>Documentation <i class="fa fa-exclamation-circle"></i></strong><br>
                                            <span class="font-weight-bolder"
                                                style="font-size: 1.2rem;">{{ $Rate->Documentation }}</span>
                                            <div class="rating d-inline-block">
                                                <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @if (!empty($Rate->Rating_Comments))
                                        <blockquote class="blockquote">
                                            <p class="mb-0 small">{{ $Rate->Rating_Comments }}</p>
                                            @if (!empty($Rate->Rating_Replied))
                                                <p class="mb-0 small text-right" style="margin-right: 1.5rem;">
                                                    {{ $Rate->Rating_Replied }}</p>
                                            @elseif($Rate->user_id !== Auth::guard('Authorized')->user()->id)
                                                <a data-toggle="modal" data-target="#RatingRepliedComments"
                                                    href="javascript:void(0);"
                                                    class="rate-reply btn btn-sm btn-outline-danger text-end mb-3 mr-3"
                                                    style="float: right;"><i class="bx bx-home-circle"></i>
                                                    <input hidden type="text" class="Listed-ID"
                                                        value="{{ $Rate->order_id }}">
                                                    <input hidden type="text" class="Rate-ID"
                                                        value="{{ $Rate->id }}">
                                                    Replied!</a>
                                            @endif
                                        </blockquote>
                                    @endif
                                </div>
                            </div>
                        @empty
                        @endforelse
                    @endif
                </div>

            </div>

            <div class="tab-pane fade" id="pendings" role="tabpanel" aria-labelledby="pendings-tab">
                <div class="card top-rated-product-box pl-3">

                    <div class="card-header" style="margin-bottom: 0px;">
                        <h3>What Do You Think?</h3>
                        <p class="text-muted text-capitalize">ALL THE DELIVERY ORDER SHOW IN THIS SECTION USER CAN RATE
                            THE
                            CARRIER / BROKER / MANUFACTURING /
                            SALVAGE (etc.), all the listing show for 60 days, after 60 the listing will be automatically
                            removed</p>
                    </div>
                    <div class="card-body">
                        @if (Auth::guard('Authorized')->user()->usr_type === 'Carrier')
                            <div class="table-responsive">
                                <table class="display dataTable advance-6 datatable-range text-center table-1 table-bordered table-cards">
                                    <thead class="table-header">
                                        <tr>
                                            <th>Routes</th>
                                            <th>Load Details</th>
                                            <th>ID</th>
                                            <th>Company Details</th>
                                            <th>Payments</th>
                                            <th>Assign Dates</th>
                                            <th>Listing Dates</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Lisiting as $List)
                                            @if ($List->all_listing->Is_Rate === 1)
                                                @continue
                                            @endif
                                            <tr class="card-row" data-status="active">
                                                <td>
                                                    <strong>Pickup: </strong>
                                                    <a href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">
                                                        {{ Str::replace(',', '-', $List->all_listing->routes->Origin_ZipCode) }}
                                                    </a><br>

                                                    <strong>Delivery: </strong>
                                                    <a href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">
                                                        {{ Str::replace(',', '-', $List->all_listing->routes->Dest_ZipCode) }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if (count($List->all_listing->vehicles) === 1)
                                                        @foreach ($List->all_listing->vehicles as $vehcile)
                                                            {{ $vehcile->Vehcile_Year }}
                                                            {{ $vehcile->Vehcile_Make }}
                                                            {{ $vehcile->Vehcile_Model }}<br>
                                                            @if (!empty($vehcile->Vehcile_Condition))
                                                                {{ $vehcile->Vehcile_Condition }}<br>
                                                            @endif
                                                            @if (!empty($vehcile->Trailer_Type))
                                                                {{ $vehcile->Trailer_Type }} <br>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (count($List->all_listing->vehicles) > 1)
                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Attached vehicles"
                                                            data-content=
                                                       "@foreach ($List->all_listing->vehicles as $vehcile)
                                                    {{ $vehcile->Vehcile_Year }}
                                                    {{ $vehcile->Vehcile_Make }}
                                                    {{ $vehcile->Vehcile_Model }}<br>
                                                    @if (!empty($vehcile->Vehcile_Condition))
                                                        {{ $vehcile->Vehcile_Condition }}<br>
                                                    @endif
                                                    @if (!empty($vehcile->Trailer_Type))
                                                        {{ $vehcile->Trailer_Type }} <br>
                                                    @endif @endforeach"
                                                            data-html="true">vehicles
                                                            ({{ count($List->all_listing->vehicles) }})
                                                        </a>
                                                    @endif
                                                    @if (count($List->all_listing->heavy_equipments) === 1)
                                                        @foreach ($List->all_listing->heavy_equipments as $vehcile)
                                                            {{ $vehcile->Equipment_Year }}
                                                            {{ $vehcile->Equipment_Make }}
                                                            {{ $vehcile->Equipment_Model }}<br>
                                                            @if (!empty($vehcile->Equipment_Condition))
                                                                {{ $vehcile->Equipment_Condition }}<br>
                                                            @endif
                                                            @if (!empty($vehcile->Trailer_Type))
                                                                {{ $vehcile->Trailer_Type }} <br>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (count($List->all_listing->heavy_equipments) > 1)
                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Attached vehicles"
                                                            data-content=
                                                       "@foreach ($List->all_listing->heavy_equipments as $vehcile)
                                                    {{ $vehcile->Equipment_Year }}
                                                    {{ $vehcile->Equipment_Make }}
                                                    {{ $vehcile->Equipment_Model }}<br>
                                                    @if (!empty($vehcile->Equipment_Condition))
                                                        {{ $vehcile->Equipment_Condition }}<br>
                                                    @endif
                                                    @if (!empty($vehcile->Trailer_Type))
                                                        {{ $vehcile->Trailer_Type }} <br>
                                                    @endif @endforeach"
                                                            data-html="true">vehicles
                                                            ({{ count($List->all_listing->heavy_equipments) }})
                                                        </a>
                                                    @endif
                                                    @if (count($List->all_listing->dry_vans) === 1)
                                                        @foreach ($List->all_listing->dry_vans as $vehcile)
                                                            {{ $vehcile->Freight_Class }}
                                                            {{ $vehcile->Freight_Weight }}<br>
                                                            @if ($vehcile->is_hazmat_Check !== 0)
                                                                Hazmat Required<br>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (count($List->all_listing->dry_vans) > 1)
                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Attached vehicles"
                                                            data-content=
                                                       "@foreach ($List->all_listing->dry_vans as $vehcile)
                                                    {{ $vehcile->Freight_Class }}
                                                    {{ $vehcile->Freight_Weight }}<br>
                                                    @if ($vehcile->is_hazmat_Check !== 0)
                                                        Hazmat Required<br>
                                                    @endif @endforeach"
                                                            data-html="true">vehicles
                                                            ({{ count($List->all_listing->dry_vans) }})
                                                        </a>
                                                    @endif
                                                    <br>
                                                    <a href="javascript:void(0)" tabindex="0" class=""
                                                        data-toggle="popover" data-trigger="focus"
                                                        style="cursor: pointer;" title="Additional Terms"
                                                        data-content=
                                                   "{{ !empty($List->all_listing->additional_info->Additional_Terms) ? $List->all_listing->additional_info->Additional_Terms : '' }}">
                                                        {{ !empty($List->all_listing->additional_info->Additional_Terms) ? Str::limit($List->all_listing->additional_info->Additional_Terms, 20) : '...' }}</a>
                                                </td>
                                                <td>
                                                    <strong>Ref-ID:</strong>{{ $List->all_listing->Ref_ID }} <br>
                                                    {{ $List->all_listing->routes->Miles }} miles<br>
                                                    $
                                                    {{ number_format((float) $List->all_listing->paymentinfo->Order_Booking_Price / (float) $List->all_listing->routes->Miles, 2, '.', '') }}
                                                    /miles
                                                </td>
                                                <td><strong><a
                                                            href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
                                                            target="_blank">{{ $List->all_listing->authorized_user->Company_Name }}</a></strong><br>
                                                    {{ $List->all_listing->authorized_user->Contact_Phone }}<br>
                                                    {{ $List->all_listing->authorized_user->Hours_Operations }}<br>
                                                    {{ $List->all_listing->authorized_user->Time_Zone }}<br>
                                                </td>
                                                <td>
                                                    <strong>Price to Pay:
                                                    </strong>${{ $List->all_listing->paymentinfo->Order_Booking_Price }}
                                                    <br>
                                                    <strong>COD/COP:
                                                    </strong>${{ $List->all_listing->paymentinfo->COD_Amount }}
                                                    <br>
                                                    {{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '' }}
                                                    On
                                                    {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }}
                                                </td>
                                                <td>
                                                    <strong>Pickup:</strong><br>
                                                    {{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                                    ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                                                    <br>
                                                    <strong>Delivery:</strong><br>
                                                    {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                                    ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }})
                                                </td>
                                                <td>
                                                    <strong>Created At:</strong><br>
                                                    {{ $List->all_listing->created_at }}<br>
                                                    <strong>Modified At:</strong><br>
                                                    {{ $List->all_listing->updated_at }}
                                                </td>
                                                {{-- <td>
                                                    <h6>Status: <span
                                                            class="badge badge-warning">{{ $List->all_listing->Listing_Status }}</span>
                                                    </h6>
                                                    <br>
                                                    <div class="dropdown show list-actions">
                                                        <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                                        role="button" data-toggle="dropdown" aria-haspopup="true">
                                                            Actions
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                            href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                            target="_blank">View Route</a>
                                                            <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                            class="dropdown-item" role="button">View Detail</a>
                                                            @if ($List->all_listing->user_id === Auth::guard('Authorized')->user()->id)
                                                                <a class="dropdown-item rate-order" data-toggle="modal"
                                                                data-target="#RatingOrderModal" href="javascript:void(0);">
                                                                <input hidden type="text" class="New-Ref-ID"
                                                                        value="{{ $List->all_listing->Ref_ID }}">
                                                                    <input hidden type="text" class="Listed-ID"
                                                                        value="{{ $List->all_listing->id }}">
                                                                    <input hidden type="text" class="Profile-ID"
                                                                        value="{{ $List->all_listing->authorized_user->id }}">
                                                                    Rate Order</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td> --}}
                                                <td>
                                                    <h6>Status: <span
                                                            class="badge badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                                    </h6><br>
                                                    <div class="dropdown show list-actions">
                                                        <a class="btn btn-success dropdown-toggle btn-sm"
                                                            href="#" role="button" data-toggle="dropdown"
                                                            aria-haspopup="true">
                                                            Actions
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                                target="_blank">View Route</a>
                                                            <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                                class="dropdown-item" role="button">View Detail</a>
                                                            @if ($List->CMP_id === Auth::guard('Authorized')->user()->id)
                                                                <a class="dropdown-item rate-order"
                                                                    data-toggle="modal"
                                                                    data-target="#RatingOrderModal"
                                                                    href="javascript:void(0);">
                                                                    <input hidden type="text" class="New-Ref-ID"
                                                                        value="{{ $List->all_listing->Ref_ID }}">
                                                                    <input hidden type="text" class="Listed-ID"
                                                                        value="{{ $List->all_listing->id }}">
                                                                    <input hidden type="text" class="Profile-ID"
                                                                        value="{{ $List->all_listing->completed->completed_user->id }}">
                                                                    Rate Order</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @foreach ($CancelledLisiting as $List)
                                            @if ($List->all_listing->Is_Rate === 1 || $List->all_listing->Listing_Status !== 'Cancelled')
                                                @continue
                                            @endif
                                            <tr>
                                                <td>
                                                    <strong>Pickup: </strong>
                                                    <a href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">
                                                        {{ Str::replace(',', '-', $List->all_listing->routes->Origin_ZipCode) }}
                                                    </a><br>

                                                    <strong>Delivery: </strong>
                                                    <a href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">
                                                        {{ Str::replace(',', '-', $List->all_listing->routes->Dest_ZipCode) }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if (count($List->all_listing->vehicles) === 1)
                                                        @foreach ($List->all_listing->vehicles as $vehcile)
                                                            {{ $vehcile->Vehcile_Year }}
                                                            {{ $vehcile->Vehcile_Make }}
                                                            {{ $vehcile->Vehcile_Model }}<br>
                                                            @if (!empty($vehcile->Vehcile_Condition))
                                                                {{ $vehcile->Vehcile_Condition }}<br>
                                                            @endif
                                                            @if (!empty($vehcile->Trailer_Type))
                                                                {{ $vehcile->Trailer_Type }}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (count($List->all_listing->vehicles) > 1)
                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Attached vehicles"
                                                            data-content=
                                                       "@foreach ($List->all_listing->vehicles as $vehcile)
                                                    {{ $vehcile->Vehcile_Year }}
                                                    {{ $vehcile->Vehcile_Make }}
                                                    {{ $vehcile->Vehcile_Model }}<br>
                                                    @if (!empty($vehcile->Vehcile_Condition))
                                                        {{ $vehcile->Vehcile_Condition }}<br>
                                                    @endif
                                                    @if (!empty($vehcile->Trailer_Type))
                                                        {{ $vehcile->Trailer_Type }}
                                                    @endif @endforeach"
                                                            data-html="true">vehicles
                                                            ({{ count($List->all_listing->vehicles) }})
                                                        </a>
                                                    @endif
                                                    @if (count($List->all_listing->heavy_equipments) === 1)
                                                        @foreach ($List->all_listing->heavy_equipments as $vehcile)
                                                            {{ $vehcile->Equipment_Year }}
                                                            {{ $vehcile->Equipment_Make }}
                                                            {{ $vehcile->Equipment_Model }}<br>
                                                            <b>L</b>{{ $vehcile->Equip_Length }} |
                                                            <b>W</b>{{ $vehcile->Equip_Width }} |
                                                            <b>H</b>{{ $vehcile->Equip_Height }}
                                                            | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                            @if (!empty($vehcile->Equipment_Condition))
                                                                <br>{{ $vehcile->Equipment_Condition }}<br>
                                                            @endif
                                                            @if (!empty($vehcile->Trailer_Type))
                                                                {{ $vehcile->Trailer_Type }}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (count($List->all_listing->heavy_equipments) > 1)
                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Attached vehicles"
                                                            data-content=
                                                       "@foreach ($List->all_listing->heavy_equipments as $vehcile)
                                                    {{ $vehcile->Equipment_Year }}
                                                    {{ $vehcile->Equipment_Make }}
                                                    {{ $vehcile->Equipment_Model }}<br>
                                                        <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                    @if (!empty($vehcile->Equipment_Condition))
                                                        <br>{{ $vehcile->Equipment_Condition }}<br>
                                                    @endif
                                                    @if (!empty($vehcile->Trailer_Type))
                                                        {{ $vehcile->Trailer_Type }}
                                                    @endif @endforeach"
                                                            data-html="true">Vehicles
                                                            ({{ count($List->all_listing->heavy_equipments) }})
                                                        </a>
                                                    @endif
                                                    @if (count($List->all_listing->dry_vans) === 1)
                                                        @foreach ($List->all_listing->dry_vans as $vehcile)
                                                            {{ $vehcile->Freight_Class }}
                                                            {{ $vehcile->Freight_Weight }}<br>
                                                            @if ($vehcile->is_hazmat_Check !== 0)
                                                                Hazmat Required<br>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (count($List->all_listing->dry_vans) > 1)
                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Attached vehicles"
                                                            data-content=
                                                       "@foreach ($List->all_listing->dry_vans as $vehcile)
                                                    {{ $vehcile->Freight_Class }}
                                                    {{ $vehcile->Freight_Weight }}<br>
                                                    @if ($vehcile->is_hazmat_Check !== 0)
                                                        Hazmat Required<br>
                                                    @endif @endforeach"
                                                            data-html="true">Vehicles
                                                            ({{ count($List->all_listing->dry_vans) }})
                                                        </a>
                                                    @endif
                                                    <br>
                                                    <a href="javascript:void(0)" tabindex="0" class=""
                                                        data-toggle="popover" data-trigger="focus"
                                                        style="cursor: pointer;" title="Additional Terms"
                                                        data-content=
                                                   "{{ !empty($List->all_listing->additional_info->Additional_Terms) ? $List->all_listing->additional_info->Additional_Terms : '' }}">
                                                        {{ !empty($List->all_listing->additional_info->Additional_Terms) ? Str::limit($List->all_listing->additional_info->Additional_Terms, 20) : '...' }}</a>
                                                </td>
                                                <td>
                                                    @if (count($List->all_listing->attachments) > 0)
                                                        <strong><a
                                                                href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                                target="_blank">View Images</a></strong><br>
                                                    @endif
                                                    <strong>Ref-ID:</strong>{{ $List->all_listing->Ref_ID }} <br>
                                                    {{ $List->all_listing->routes->Miles }} miles
                                                </td>
                                                <td><strong><a
                                                            href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
                                                            target="_blank">{{ $List->all_listing->authorized_user->Company_Name }}</a></strong><br>
                                                    {{ $List->all_listing->authorized_user->Contact_Phone }}<br>
                                                    {{ $List->all_listing->authorized_user->Hours_Operations }}<br>
                                                    {{ $List->all_listing->authorized_user->Time_Zone }}<br>
                                                </td>
                                                <td>
                                                    <strong>Price to Pay:
                                                    </strong>${{ $List->all_listing->paymentinfo->COD_Amount }}
                                                    <br>
                                                    {{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '' }}
                                                    On
                                                    {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }}
                                                </td>
                                                <td>
                                                    <strong>Pickup:</strong><br>
                                                    {{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                                    ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                                                    <br>
                                                    <strong>Delivery:</strong><br>
                                                    {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                                    ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }})
                                                </td>
                                                <td>
                                                    <strong>Created At:</strong><br>
                                                    {{ $List->all_listing->created_at }}<br>
                                                    <strong>Modified At:</strong><br>
                                                    {{ $List->all_listing->updated_at }}
                                                </td>
                                                {{-- <td>
                                                    <h6>Status: <span
                                                            class="badge badge-warning">{{ $List->all_listing->Listing_Status }}</span>
                                                    </h6>
                                                    <div class="dropdown show list-actions">
                                                        <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true">
                                                            Actions
                                                        </a>
                    
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                            href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                            target="_blank">View Route</a>
                                                            <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                            class="dropdown-item" role="button">View Detail</a>
                                                            @if ($List->all_listing->user_id === $currentUser->id)
                                                                <a class="dropdown-item"
                                                                href="{{ route('User.Edit.Listing', $List->all_listing->id) }}"
                                                                target="_blank">Re Listed</a>
                                                            @endif
                                                            <a class="dropdown-item Generate-Ticket" data-toggle="modal"
                                                            data-target="#TicketModal" href="javascript:void(0);">
                                                                <input hidden type="text" class="Listed-ID"
                                                                    value="{{ $List->all_listing->id }}">
                                                                <input hidden type="text" class="User-ID"
                                                                    value="{{ $List->all_listing->user_id }}">
                                                                <input hidden type="text" class="User-Email"
                                                                    value="{{ $List->all_listing->authorized_user->email }}">
                                                                <input hidden type="text" class="User-Name"
                                                                    value="{{ $List->all_listing->authorized_user->Company_Name }}">
                                                                <input hidden type="text" class="CMP-ID"
                                                                    value="{{ $List->all_listing->cancel->cancel_user->id }}">
                                                                <input hidden type="text" class="CMP-Email"
                                                                    value="{{ $List->all_listing->cancel->cancel_user->email }}">
                                                                <input hidden type="text" class="CMP-Name"
                                                                    value="{{ $List->all_listing->cancel->cancel_user->Company_Name }}">
                                                                Generate Ticket</a>
                                                        </div>
                                                    </div>
                    
                                                </td> --}}
                                                {{-- <td>
                                                    <h6>Status: <span
                                                            class="badge badge-warning">{{ $List->all_listing->Listing_Status }}</span>
                                                    </h6>
                                                    <br>
                                                    <div class="dropdown show list-actions">
                                                        <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                                        role="button" data-toggle="dropdown" aria-haspopup="true">
                                                            Actions
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                            href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                            target="_blank">View Route</a>
                                                            <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                            class="dropdown-item" role="button">View Detail</a>
                                                            @if ($List->all_listing->user_id === Auth::guard('Authorized')->user()->id)
                                                                <a class="dropdown-item rate-order" data-toggle="modal"
                                                                data-target="#RatingOrderModal" href="javascript:void(0);">
                                                                <input hidden type="text" class="New-Ref-ID"
                                                                        value="{{ $List->all_listing->Ref_ID }}">
                                                                    <input hidden type="text" class="Listed-ID"
                                                                        value="{{ $List->all_listing->id }}">
                                                                    <input hidden type="text" class="Profile-ID"
                                                                        value="{{ $List->all_listing->authorized_user->id }}">
                                                                    Rate Order</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td> --}}
                                                <td>
                                                    <h6>Status: <span
                                                            class="badge badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                                    </h6><br>
                                                    <div class="dropdown show list-actions">
                                                        <a class="btn btn-success dropdown-toggle btn-sm"
                                                            href="#" role="button" data-toggle="dropdown"
                                                            aria-haspopup="true">
                                                            Actions
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                                target="_blank">View Route</a>
                                                            <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                                class="dropdown-item" role="button">View Detail</a>
                                                            @if ($List->CMP_id === Auth::guard('Authorized')->user()->id)
                                                                <a class="dropdown-item rate-order"
                                                                    data-toggle="modal"
                                                                    data-target="#RatingOrderModal"
                                                                    href="javascript:void(0);">
                                                                    <input hidden type="text" class="New-Ref-ID"
                                                                        value="{{ $List->all_listing->Ref_ID }}">
                                                                    <input hidden type="text" class="Listed-ID"
                                                                        value="{{ $List->all_listing->id }}">
                                                                    <input hidden type="text" class="Profile-ID"
                                                                        value="{{ $List->all_listing->cancel->cancel_user->id }}">
                                                                    Rate Order</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="display dataTable advance-6 datatable-range text-center table-1 table-bordered table-cards">
                                    <thead class="table-header">
                                        <tr>
                                            <th>Request</th>
                                            <th>Routes</th>
                                            <th>Load Details</th>
                                            <th>ID</th>
                                            <th>Payments</th>
                                            <th>Dates</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Lisiting as $List)
                                            <tr class="card-row" data-status="active">
                                                <td>
                                                    <div><span
                                                            class="badge badge-pill badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                                    </div>
                                                    <span
                                                        style="font-size: x-large;"><strong>{{ $List->all_listing->Ref_ID }}</strong></span><br>
                                                    @if (count($List->all_listing->attachments) > 0)
                                                        <strong><a
                                                                href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                                target="_blank">View Images</a></strong><br>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span style="font-size: x-large;"><a target="_blank" class="locations-color"
                                                            href="{{ route('View.Profile', $List->all_listing->completed->completed_user->id) }}"><strong>{{ $List->all_listing->completed->completed_user->Company_Name }}</strong></a>
                                                    </span>
                                                    <br>
                                                    <span>
                                                        <strong>Contact:</strong>
                                                        <a  class="locations-color"
                                                            href="tel:{{ $List->all_listing->completed->completed_user->Contact_Phone }}">
                                                            {{ $List->all_listing->completed->completed_user->Contact_Phone }}
                                                        </a>
                                                    </span><br>
                                                    <span>
                                                        <strong>Email:</strong>
                                                        <a class="locations-color"
                                                            href="mailto:{{ $List->all_listing->completed->completed_user->email }}">
                                                            {{ $List->all_listing->completed->completed_user->email }}
                                                        </a>
                                                    </span><br>
                                                    <strong>Time:</strong>
                                                    {{ $List->all_listing->completed->completed_user->Hours_Operations }}
                                                    </span>
                                                    <br>
                                                    @php
                                                        if (!function_exists('getUserRating')) {
                                                            function getUserRating($userId)
                                                            {
                                                                $orderRatings = app(\App\Services\OrderRatings::class);
                                                                $ratings = $orderRatings->getUserRating($userId);
                                                                $ratingsCount = $orderRatings
                                                                    ->getUserRatingRecords($userId)
                                                                    ->count();

                                                                return [
                                                                    'ratings' => $ratings,
                                                                    'count' => $ratingsCount,
                                                                ];
                                                            }
                                                        }

                                                        $userRatings = getUserRating(
                                                            $List->all_listing->completed->completed_user->id,
                                                        );
                                                        $ratings = $userRatings['ratings'];
                                                        $ratingsCount = $userRatings['count'];

                                                        $avg_rating = $ratings
                                                            ? array_sum([
                                                                    $ratings->ratings_avg_timeliness,
                                                                    $ratings->ratings_avg_communication,
                                                                    $ratings->ratings_avg_documentation,
                                                                ]) / 3
                                                            : null;
                                                    @endphp
                                                    @if (isset($avg_rating))
                                                        <div class="rating d-inline-block">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="fa fa-star {{ $i <= $avg_rating ? 'text-warning' : 'text-muted' }}"></i>
                                                            @endfor
                                                            {{ number_format($avg_rating, 1) }}
                                                            <a href="">({{ $ratingsCount }})</a>
                                                        </div>
                                                    @else
                                                        <span>No ratings yet.</span>
                                                    @endif <br>
                                                    <span class="badge badge-pill badge-success"
                                                        style="cursor:pointer;"
                                                        onclick="window.open('{{ route('chat', $List->CMP_id) }}', '_blank')">
                                                        Message Carrier
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="mb-2">
                                                        <span><strong>Pickup</strong></span><br>
                                                        <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                                            href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Origin_ZipCode) }}"
                                                            target="_blank">
                                                            {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                                            {{ Str::replace(',', '-', $List->all_listing->routes->Origin_ZipCode) }}
                                                        </a>
                                                    </div>
                                                    <div class="mb-2">
                                                        <span><strong>Delivery</strong></span><br>
                                                        <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                                            href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Dest_ZipCode) }}"
                                                            target="_blank">
                                                            {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                                            {{ Str::replace(',', '-', $List->all_listing->routes->Dest_ZipCode) }}
                                                        </a>
                                                    </div>
                                                    <div class="mb-2">
                                                        <span class="fs-5"><strong><a
                                                                    class="btn btn-outline-primary text-decoration-none fw-bold"
                                                                    href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                                    target="_blank">View Route</a></strong></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if (!is_null($List->all_listing->vehicles) && count($List->all_listing->vehicles) === 1)
                                                        @foreach ($List->all_listing->vehicles as $vehcile)
                                                            <span style="font-size: large; ">
                                                                <a class="font-weight-bold text-dark"
                                                                    href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                                    target="_blank"><strong>{{ $vehcile->Vehcile_Year }}
                                                                        {{ $vehcile->Vehcile_Make }}
                                                                        {{ $vehcile->Vehcile_Model }} ({{ $vehcile->Vehcile_Type }})</strong></a>
                                                            </span><br>
                                                            @if (!empty($vehcile->Vehcile_Condition))
                                                                <span
                                                                    class="badge badge-pill mt-2 @if ($vehcile->Vehcile_Condition == 'Running') badge-success @elseif($vehcile->Vehcile_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                                    style="font-size: 16px;">
                                                                    {{ $vehcile->Vehcile_Condition }}
                                                                </span>
                                                            @endif
                                                            @if (!empty($vehcile->Trailer_Type))
                                                                <span
                                                                    class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                                    style="font-size: 16px;">
                                                                    {{ $vehcile->Trailer_Type }}
                                                                </span>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (!is_null($List->all_listing->vehicles) && count($List->all_listing->vehicles) > 1)
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-toggle font-weight-bold d-inline-flex align-items-center text-dark text-decoration-none"
                                                                data-toggle="dropdown"
                                                                style="font-size: 21px; cursor: pointer;">Vehicles({{ count($List->all_listing->vehicles) }})</a>
                                                            <div class="dropdown-menu text-center"
                                                                style="max-height: 200px; overflow-y: auto;">
                                                                <h6 class="dropdown-header"
                                                                    style="background-color: lightgrey;">
                                                                    Attached Vehicles</h6>
                                                                @foreach ($List->all_listing->vehicles as $vehcile)
                                                                    <a class="dropdown-item"
                                                                        style="color: #0d6efd; font-weight: 800;"
                                                                        href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                                        target="_blank">{{ $vehcile->Vehcile_Year }}
                                                                        {{ $vehcile->Vehcile_Make }}
                                                                        {{ $vehcile->Vehcile_Model }}<br>
                                                                        @if (!empty($vehcile->Vehcile_Condition))
                                                                            <span
                                                                                class="badge badge-pill mt-2 @if ($vehcile->Vehcile_Condition == 'Running') badge-success @elseif($vehcile->Vehcile_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                                                style="font-size: 16px;">
                                                                                {{ $vehcile->Vehcile_Condition }}
                                                                            </span>
                                                                        @endif
                                                                        @if (!empty($vehcile->Trailer_Type))
                                                                            <span
                                                                                class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                                                style="font-size: 16px;">
                                                                                {{ $vehcile->Trailer_Type }}</span>
                                                                        @endif
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if (count($List->all_listing->heavy_equipments) === 1)
                                                        @foreach ($List->all_listing->heavy_equipments as $vehcile)
                                                            <p class="ymm"> {{ $vehcile->Equipment_Year }}
                                                                {{ $vehcile->Equipment_Make }}
                                                                {{ $vehcile->Equipment_Model }}</p><br>
                                                            <b>L</b>{{ $vehcile->Equip_Length }} |
                                                            <b>W</b>{{ $vehcile->Equip_Width }} |
                                                            <b>H</b>{{ $vehcile->Equip_Height }}
                                                            | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                            @if (!empty($vehcile->Equipment_Condition))
                                                                <br>{{ $vehcile->Equipment_Condition }}<br>
                                                            @endif
                                                            @if (!empty($vehcile->Trailer_Type))
                                                                {{ $vehcile->Trailer_Type }}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (count($List->all_listing->heavy_equipments) > 1)
                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Attached vehicles"
                                                            data-content=
                                                            "@foreach ($List->all_listing->heavy_equipments as $vehcile)
                                                            {{ $vehcile->Equipment_Year }}
                                                            {{ $vehcile->Equipment_Make }}
                                                            {{ $vehcile->Equipment_Model }}<br>
                                                                <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                            @if (!empty($vehcile->Equipment_Condition))
                                                                <br>{{ $vehcile->Equipment_Condition }}<br>
                                                            @endif
                                                            @if (!empty($vehcile->Trailer_Type))
                                                                {{ $vehcile->Trailer_Type }}
                                                            @endif @endforeach"
                                                            data-html="true">Vehicles
                                                            ({{ count($List->all_listing->heavy_equipments) }})
                                                        </a>
                                                    @endif
                                                    @if (count($List->all_listing->dry_vans) === 1)
                                                        @foreach ($List->all_listing->dry_vans as $vehcile)
                                                            {{ $vehcile->Freight_Class }}
                                                            {{ $vehcile->Freight_Weight }}<br>
                                                            @if ($vehcile->is_hazmat_Check !== 0)
                                                                Hazmat Required<br>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (count($List->all_listing->dry_vans) > 1)
                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Attached vehicles"
                                                            data-content=
                                                            "@foreach ($List->all_listing->dry_vans as $vehcile)
                                                            {{ $vehcile->Freight_Class }}
                                                            {{ $vehcile->Freight_Weight }}<br>
                                                            @if ($vehcile->is_hazmat_Check !== 0)
                                                                Hazmat Required<br>
                                                            @endif @endforeach"
                                                            data-html="true">Vehicles
                                                            ({{ count($List->all_listing->dry_vans) }})
                                                        </a>
                                                    @endif
                                                    <br>
                                                    <div class="dropdown mt-3">
                                                        <a href="javascript:void(0)" tabindex="0"
                                                            class="btn btn-outline-primary dropdown-toggle text-truncate"
                                                            id="additionalTermsDropdown" role="button"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false" style="max-width: 200px;">
                                                            {{ $List->all_listing->additional_info->Additional_Terms }}Additional
                                                            Terms
                                                        </a>
                                                        <div class="dropdown-menu p-3 shadow-sm"
                                                            aria-labelledby="additionalTermsDropdown"
                                                            style="max-width: 300px;">
                                                            <p class="dropdown-item-text m-0 text-wrap">
                                                                {{ !empty($List->all_listing->additional_info->Additional_Terms)
                                                                    ? $List->all_listing->additional_info->Additional_Terms
                                                                    : 'No additional terms available.' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <strong>Price to Pay:
                                                    </strong><span>${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}</span>
                                                    <br>
                                                    @if (!empty($List->all_listing->request_broker->Offer_Price) && $List->all_listing->request_broker->Offer_Price !== 0)
                                                        <strong>Ask
                                                            Price:</strong>${{ $List->all_listing->request_broker->Offer_Price }}
                                                        <br>
                                                    @endif
                                                    {{ $List->all_listing->routes->Miles }}miles<br>
                                                    ${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
                                                    /miles
                                                </td>
                                                <td>
                                                    <strong>Created At:</strong><br>
                                                    <span class="text-nowrap">{{ $List->created_at }}</span><br>
                                                    <strong>Modified At:</strong><br>
                                                    <span class="text-nowrap">{{ $List->updated_at }}</span><br>
                                                    {{-- <strong>Created At:</strong><br>
                                                    {{ $List->created_at }}<br>
                                                    <strong>Modified At:</strong><br>
                                                    {{ $List->updated_at }}<br> --}}
                                                    <strong>PickUp: </strong><br><span class="text-nowrap">
                                                    {{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                                    ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})</span><br>
                                                    <strong>Delivery:</strong><br><span class="text-nowrap">
                                                    {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                                    ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }})</span>
                                                </td>
                                                <td>
                                                    <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                                        href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route</a>
                                                    <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                        class="btn btn-outline-primary mb-2 w-100 d-block" role="button">View
                                                        Detail</a>
                                                    @if ($List->all_listing->user_id === $currentUser->id)
                                                        @if ($List->all_listing->Is_Rate != 1)
                                                            <a class="btn btn-outline-primary mb-2 w-100 d-block rate-order"
                                                                data-toggle="modal" data-target="#RatingOrderModal"
                                                                href="javascript:void(0);">
                                                                <input hidden type="text" class="New-Ref-ID"
                                                                    value="{{ $List->all_listing->Ref_ID }}">
                                                                <input hidden type="text" class="Listed-ID"
                                                                    value="{{ $List->all_listing->id }}">
                                                                <input hidden type="text" class="Profile-ID"
                                                                    value="{{ $List->all_listing->completed->completed_user->id }}">
                                                                <input hidden type="text" class="Company-Name"
                                                                    value="{{ $List->all_listing->completed->completed_user->Company_Name }}">
                                                                Rate Order
                                                            </a>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-outline-primary mb-2 w-100 d-block" disabled>
                                                                <span class="">Rate Order</span>
                                                            </button>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        @foreach ($CancelledLisiting as $List)
                                            <tr class="card-row" data-status="active">
                                                <td>
                                                    @if ($List->deleted_at !== null)
                                                        <h6><span class="badge badge-primary mb-2">Re
                                                                Listed</span><br><span
                                                                class="badge badge-warning">{{ !is_null($List->all_listing->cancel->cancelled_by) ? $List->all_listing->cancel->cancelled_by->Company_Name : '' }}</span>
                                                        </h6>
                                                    @else
                                                        <h6><span
                                                                class="badge badge-warning">{{ $List->all_listing->Listing_Status }}
                                                                by
                                                                {{ $List->all_listing->cancel->cancelled_By->Company_Name }}</span>
                                                        </h6>
                                                    @endif
                                                    <span
                                                        style="font-size: x-large;"><strong>{{ $List->all_listing->Ref_ID }}</strong></span><br>
                                                    @if (count($List->all_listing->attachments) > 0)
                                                        <strong><a
                                                                href="{{ route('Order.Attachments', ['List_ID' => $List->id]) }}"
                                                                target="_blank">View Images</a></strong><br>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>
                                                        <span style="font-size: x-large; "><a class="fs-3 text-wrap locations-color"
                                                                href="{{ route('View.Profile', $List->all_listing->cancel->cancel_user->id) }}"
                                                                target="_blank">{{ $List->all_listing->cancel->cancel_user->Company_Name }}</a>
                                                        </span>
                                                    </strong><br>
                                                    <span>
                                                        <strong>Contact:</strong>
                                                        <a class="locations-color"
                                                            href="tel:{{ $List->all_listing->cancel->cancel_user->Contact_Phone }}">
                                                            {{ $List->all_listing->cancel->cancel_user->Contact_Phone }}
                                                        </a>
                                                    </span><br>
                                                    <span>
                                                        <strong>Email:</strong>
                                                        <a class="locations-color"
                                                            href="mailto:{{ $List->all_listing->cancel->cancel_user->email }}">
                                                            {{ $List->all_listing->cancel->cancel_user->email }}
                                                        </a>
                                                    </span><br>
                                                    @php
                                                        if (!function_exists('getUserRating')) {
                                                            function getUserRating($userId)
                                                            {
                                                                $orderRatings = app(\App\Services\OrderRatings::class);
                                                                $ratings = $orderRatings->getUserRating($userId);
                                                                $ratingsCount = $orderRatings
                                                                    ->getUserRatingRecords($userId)
                                                                    ->count();

                                                                return [
                                                                    'ratings' => $ratings,
                                                                    'count' => $ratingsCount,
                                                                ];
                                                            }
                                                        }

                                                        $userRatings = getUserRating(
                                                            $List->all_listing->cancel->cancel_user->id,
                                                        );
                                                        $ratings = $userRatings['ratings'];
                                                        $ratingsCount = $userRatings['count'];

                                                        $avg_rating = $ratings
                                                            ? array_sum([
                                                                    $ratings->ratings_avg_timeliness,
                                                                    $ratings->ratings_avg_communication,
                                                                    $ratings->ratings_avg_documentation,
                                                                ]) / 3
                                                            : null;
                                                    @endphp
                                                    @if (isset($avg_rating))
                                                        <div class="rating d-inline-block">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="fa fa-star fa-fade {{ $i <= $avg_rating ? 'text-warning' : 'text-muted' }}"></i>
                                                            @endfor
                                                            {{ number_format($avg_rating, 1) }}
                                                            <a href="">({{ $ratingsCount }})</a>
                                                        </div>
                                                    @else
                                                        <span>No ratings yet.</span>
                                                    @endif <br>
                                                    <span class="badge badge-pill badge-success"
                                                        style="cursor:pointer;"
                                                        onclick="window.open('{{ route('chat', $List->CMP_id) }}', '_blank')">
                                                        Message Carrier
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="mb-2">
                                                        <span><strong>Pickup Location</strong></span><br>
                                                        <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                                            href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Origin_ZipCode) }}"
                                                            target="_blank">
                                                            {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                                            {{ Str::replace(',', '-', $List->all_listing->routes->Origin_ZipCode) }}
                                                        </a>
                                                    </div>
                                                    <div class="mb-2">
                                                        <span><strong>Delivery Location</strong></span><br>
                                                        <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                                            href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Dest_ZipCode) }}"
                                                            target="_blank">
                                                            {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                                            {{ Str::replace(',', '-', $List->all_listing->routes->Dest_ZipCode) }}
                                                        </a>
                                                    </div>
                                                    <div class="mb-2">
                                                        <span class="fs-5"><strong><a
                                                                    class="btn btn-outline-primary text-decoration-none fw-bold"
                                                                    href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                                    target="_blank">View Route</a></strong></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if (!is_null($List->all_listing->vehicles) && count($List->all_listing->vehicles) === 1)
                                                        @foreach ($List->all_listing->vehicles as $vehcile)
                                                            <span style="font-size: large; ">
                                                                <a class="font-weight-bold text-dark"
                                                                    href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                                    target="_blank"><strong>{{ $vehcile->Vehcile_Year }}
                                                                        {{ $vehcile->Vehcile_Make }}
                                                                        {{ $vehcile->Vehcile_Model }} ({{ $vehcile->Vehcile_Type }})</strong></a>
                                                            </span><br>
                                                            @if (!empty($vehcile->Vehcile_Condition))
                                                                <span
                                                                    class="badge badge-pill mt-2 @if ($vehcile->Vehcile_Condition == 'Running') badge-success @elseif($vehcile->Vehcile_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                                    style="font-size: 16px;">
                                                                    {{ $vehcile->Vehcile_Condition }}
                                                                </span>
                                                            @endif
                                                            @if (!empty($vehcile->Trailer_Type))
                                                                <span
                                                                    class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                                    style="font-size: 16px;">
                                                                    {{ $vehcile->Trailer_Type }}
                                                                </span>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (!is_null($List->all_listing->vehicles) && count($List->all_listing->vehicles) > 1)
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-toggle font-weight-bold d-inline-flex align-items-center text-dark text-decoration-none"
                                                                data-toggle="dropdown"
                                                                style="font-size: 21px; cursor: pointer;">Vehicles({{ count($List->all_listing->vehicles) }})</a>
                                                            <div class="dropdown-menu text-center"
                                                                style="max-height: 200px; overflow-y: auto;">
                                                                <h6 class="dropdown-header"
                                                                    style="background-color: lightgrey;">
                                                                    Attached Vehicles</h6>
                                                                @foreach ($List->all_listing->vehicles as $vehcile)
                                                                    <a class="dropdown-item"
                                                                        style="color: #0560a6; font-weight: 800;"
                                                                        href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                                        target="_blank">{{ $vehcile->Vehcile_Year }}
                                                                        {{ $vehcile->Vehcile_Make }}
                                                                        {{ $vehcile->Vehcile_Model }}<br>
                                                                        @if (!empty($vehcile->Vehcile_Condition))
                                                                            <span
                                                                                class="badge badge-pill mt-2 @if ($vehcile->Vehcile_Condition == 'Running') badge-success @elseif($vehcile->Vehcile_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                                                style="font-size: 16px;">
                                                                                {{ $vehcile->Vehcile_Condition }}
                                                                            </span>
                                                                        @endif
                                                                        @if (!empty($vehcile->Trailer_Type))
                                                                            <span
                                                                                class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                                                style="font-size: 16px;">
                                                                                {{ $vehcile->Trailer_Type }}</span>
                                                                        @endif
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if (count($List->all_listing->heavy_equipments) === 1)
                                                        @foreach ($List->all_listing->heavy_equipments as $vehcile)
                                                            <p class="ymm"> {{ $vehcile->Equipment_Year }}
                                                                {{ $vehcile->Equipment_Make }}
                                                                {{ $vehcile->Equipment_Model }}</p><br>
                                                            <b>L</b>{{ $vehcile->Equip_Length }} |
                                                            <b>W</b>{{ $vehcile->Equip_Width }} |
                                                            <b>H</b>{{ $vehcile->Equip_Height }}
                                                            | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                            @if (!empty($vehcile->Equipment_Condition))
                                                                <br>{{ $vehcile->Equipment_Condition }}<br>
                                                            @endif
                                                            @if (!empty($vehcile->Trailer_Type))
                                                                {{ $vehcile->Trailer_Type }}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (count($List->all_listing->heavy_equipments) > 1)
                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Attached vehicles"
                                                            data-content=
                                                            "@foreach ($List->all_listing->heavy_equipments as $vehcile)
                                                            {{ $vehcile->Equipment_Year }}
                                                            {{ $vehcile->Equipment_Make }}
                                                            {{ $vehcile->Equipment_Model }}<br>
                                                                <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                            @if (!empty($vehcile->Equipment_Condition))
                                                                <br>{{ $vehcile->Equipment_Condition }}<br>
                                                            @endif
                                                            @if (!empty($vehcile->Trailer_Type))
                                                                {{ $vehcile->Trailer_Type }}
                                                            @endif @endforeach"
                                                            data-html="true">Vehicles
                                                            ({{ count($List->all_listing->heavy_equipments) }})
                                                        </a>
                                                    @endif
                                                    @if (count($List->all_listing->dry_vans) === 1)
                                                        @foreach ($List->all_listing->dry_vans as $vehcile)
                                                            {{ $vehcile->Freight_Class }}
                                                            {{ $vehcile->Freight_Weight }}<br>
                                                            @if ($vehcile->is_hazmat_Check !== 0)
                                                                Hazmat Required<br>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (count($List->all_listing->dry_vans) > 1)
                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Attached vehicles"
                                                            data-content=
                                                            "@foreach ($List->all_listing->dry_vans as $vehcile)
                                                            {{ $vehcile->Freight_Class }}
                                                            {{ $vehcile->Freight_Weight }}<br>
                                                            @if ($vehcile->is_hazmat_Check !== 0)
                                                                Hazmat Required<br>
                                                            @endif @endforeach"
                                                            data-html="true">Vehicles
                                                            ({{ count($List->all_listing->dry_vans) }})
                                                        </a>
                                                    @endif
                                                    <br>
                                                    <div class="dropdown mt-3">
                                                        <a href="javascript:void(0)" tabindex="0"
                                                            class="btn btn-outline-primary dropdown-toggle text-truncate"
                                                            id="additionalTermsDropdown" role="button"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false" style="max-width: 200px;">
                                                            {{ $List->all_listing->additional_info->Additional_Terms }}Additional
                                                            Terms
                                                        </a>
                                                        <div class="dropdown-menu p-3 shadow-sm"
                                                            aria-labelledby="additionalTermsDropdown"
                                                            style="max-width: 300px;">
                                                            <p class="dropdown-item-text m-0 text-wrap">
                                                                {{ !empty($List->all_listing->additional_info->Additional_Terms)
                                                                    ? $List->all_listing->additional_info->Additional_Terms
                                                                    : 'No additional terms available.' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <strong>Price to Pay:</strong><span
                                                        class="text-nowrap">${{ $List->all_listing->paymentinfo->COD_Amount }}</span>
                                                    <br>
                                                    <strong>Mile:</strong>{{ $List->all_listing->routes->Miles }}miles<br>
                                                    @if (!empty($List->all_listing->request_broker->Offer_Price) && $List->all_listing->request_broker->Offer_Price !== 0)
                                                        <strong>Ask Price:</strong><br><span
                                                            class="text-nowrap">${{ $List->all_listing->request_broker->Offer_Price }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>Created At:</strong><br>
                                                    <span class="text-nowrap">{{ $List->created_at }}</span><br>
                                                    <strong>Modified At:</strong><br>
                                                    <span class="text-nowrap">{{ $List->updated_at }}</span>
                                                </td>
                                                <td>
                                                    @if ($List->all_listing->user_id === $currentUser->id)
                                                        @if ($List->all_listing->Is_Rate != 1)
                                                            <a class="btn btn-outline-primary mb-2 w-100 d-block rate-order"
                                                                data-toggle="modal" data-target="#RatingOrderModal"
                                                                href="javascript:void(0);">
                                                                <input hidden type="text" class="New-Ref-ID"
                                                                    value="{{ $List->all_listing->Ref_ID }}">
                                                                <input hidden type="text" class="Listed-ID"
                                                                    value="{{ $List->all_listing->id }}">
                                                                <input hidden type="text" class="Profile-ID"
                                                                    value="{{ $List->all_listing->cancel->cancelled_by->id }}">
                                                                <input hidden type="text" class="Company-Name"
                                                                    value="{{ $List->all_listing->cancel->cancelled_by->Company_Name }}">
                                                                Rate Order
                                                            </a>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-outline-primary mb-2 w-100 d-block" disabled>
                                                                <span class="">Rate Order</span>
                                                            </button>
                                                        @endif
                                                    @endif
                                                    <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                        class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                        role="button">View
                                                        Detail</a>
                                                    @if ($List->all_listing->user_id === $currentUser->id)
                                                        <button class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                            onclick="window.location.href='{{ route('User.Replicate.Listing', ['List_ID' => $List->all_listing->id]) }}'">
                                                            Replicate Listing
                                                        </button>
                                                    @endif
                                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap Generate-Ticket"
                                                        data-toggle="modal" data-target="#TicketModal"
                                                        href="javascript:void(0);">
                                                        <input hidden type="text" class="Listed-ID"
                                                            value="{{ $List->all_listing->id }}">
                                                        <input hidden type="text" class="Ref-ID"
                                                            value="{{ $List->all_listing->Ref_ID }}">
                                                        <input hidden type="text" class="User-ID"
                                                            value="{{ $List->all_listing->user_id }}">
                                                        <input hidden type="text" class="User-Email"
                                                            value="{{ $List->all_listing->authorized_user->email }}">
                                                        <input hidden type="text" class="User-Name"
                                                            value="{{ $List->all_listing->authorized_user->Company_Name }}">
                                                        <input hidden type="text" class="CMP-ID"
                                                            value="{{ $List->all_listing->cancel->cancel_user->id }}">
                                                        <input hidden type="text" class="CMP-Email"
                                                            value="{{ $List->all_listing->cancel->cancel_user->email }}">
                                                        <input hidden type="text" class="CMP-Name"
                                                            value="{{ $List->all_listing->cancel->cancel_user->Company_Name }}">
                                                        Generate Ticket</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @foreach ($DeliveredLisiting as $List)
                                            <tr class="card-row" data-status="active">
                                                <td>
                                                    <div><span
                                                            class="badge badge-pill badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                                    </div>
                                                    <span
                                                        style="font-size: x-large;"><strong>{{ $List->all_listing->Ref_ID }}</strong></span><br>
                                                    @if (count($List->all_listing->attachments) > 0)
                                                        <strong>
                                                            <a class="text-nowrap"
                                                                href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                                target="_blank">View Images</a>
                                                        </strong><br>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span style="font-size: x-large; "><a class="locations-color"
                                                            href="{{ route('View.Profile', $List->all_listing->deliver->delivered_user->id) }}"
                                                            target="_blank"><strong>{{ $List->all_listing->deliver->delivered_user->Company_Name }}</strong></a></span>
                                                    <br>
                                                    <span>
                                                        <strong>Contact:</strong>
                                                        <a  class="locations-color"
                                                            href="tel:{{ $List->all_listing->deliver->delivered_user->Contact_Phone }}">
                                                            {{ $List->all_listing->deliver->delivered_user->Contact_Phone }}
                                                        </a>
                                                    </span><br>
                                                    <span>
                                                        <strong>Email:</strong>
                                                        <a  class="locations-color"
                                                            href="mailto:{{ $List->all_listing->deliver->delivered_user->email }}">
                                                            {{ $List->all_listing->deliver->delivered_user->email }}
                                                        </a>
                                                    </span>
                                                    <br>
                                                    <strong>Time:</strong>
                                                    {{ $List->all_listing->deliver->delivered_user->Hours_Operations }}
                                                    </span><br>
                                                    @php
                                                        if (!function_exists('getUserRating')) {
                                                            function getUserRating($userId)
                                                            {
                                                                $orderRatings = app(\App\Services\OrderRatings::class);
                                                                $ratings = $orderRatings->getUserRating($userId);
                                                                $ratingsCount = $orderRatings
                                                                    ->getUserRatingRecords($userId)
                                                                    ->count();

                                                                return [
                                                                    'ratings' => $ratings,
                                                                    'count' => $ratingsCount,
                                                                ];
                                                            }
                                                        }
                                                        $userRatings = getUserRating(
                                                            $List->all_listing->deliver->delivered_user->id,
                                                        );
                                                        $ratings = $userRatings['ratings'];
                                                        $ratingsCount = $userRatings['count'];

                                                        $avg_rating = $ratings
                                                            ? array_sum([
                                                                    $ratings->ratings_avg_timeliness,
                                                                    $ratings->ratings_avg_communication,
                                                                    $ratings->ratings_avg_documentation,
                                                                ]) / 3
                                                            : null;
                                                    @endphp
                                                    @if (isset($avg_rating))
                                                        <div class="rating d-inline-block">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="fa fa-star fa-fade {{ $i <= $avg_rating ? 'text-warning' : 'text-muted' }}"></i>
                                                            @endfor
                                                            {{ number_format($avg_rating, 1) }}
                                                            <a href="">({{ $ratingsCount }})</a>
                                                        </div>
                                                    @else
                                                        <span>No ratings yet.</span>
                                                    @endif <br>
                                                    <span class="badge badge-pill badge-success"
                                                        style="cursor:pointer;"
                                                        onclick="window.open('{{ route('chat', $List->CMP_id) }}', '_blank')">
                                                        Message Carrier
                                                    </span>
                                                </td>
                                                <td>
                                                    <span style="font-size: large;"><strong>Pickup:</strong></span>
                                                    <br>
                                                    <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                                        href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Origin_ZipCode) }}"
                                                        target="_blank">
                                                        {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                                        {{ Str::replace(',', '-', $List->all_listing->routes->Origin_ZipCode) }}
                                                    </a><br>
                                                    <span
                                                        style="font-size: large;"><strong>Delivery:</strong></span><br>
                                                    <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                                        href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Dest_ZipCode) }}"
                                                        target="_blank">
                                                        {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                                        {{ Str::replace(',', '-', $List->all_listing->routes->Dest_ZipCode) }}
                                                    </a>
                                                    <div class="mb-2">
                                                        <span class="fs-5"><strong><a
                                                                    class="btn btn-outline-primary text-decoration-none fw-bold"
                                                                    href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                                    target="_blank">View Route</a></strong></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if (count($List->all_listing->vehicles) === 1)
                                                        @foreach ($List->all_listing->vehicles as $vehcile)
                                                            <span style="font-size: large; "><a
                                                                    class="font-weight-bold text-dark"
                                                                    href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                                    target="_blank"><strong>{{ $vehcile->Vehcile_Year }}
                                                                        {{ $vehcile->Vehcile_Make }}
                                                                        {{ $vehcile->Vehcile_Model }}</strong></a></span><br>
                                                            @if (!empty($vehcile->Vehcile_Condition))
                                                                <span
                                                                    class="badge badge-pill mt-2 @if ($vehcile->Vehcile_Condition == 'Running') badge-success @elseif($vehcile->Vehcile_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                                    style="font-size: 16px;">
                                                                    {{ $vehcile->Vehcile_Condition }}
                                                                </span>
                                                            @endif
                                                            @if (!empty($vehcile->Trailer_Type))
                                                                <span
                                                                    class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                                    style="font-size: 16px;">{{ $vehcile->Trailer_Type }}</span>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (count($List->all_listing->vehicles) > 1)
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0)" class="dropdown-toggle"
                                                                data-toggle="dropdown"
                                                                style="cursor: pointer;">vehicles({{ count($List->all_listing->vehicles) }})
                                                            </a>
                                                            <div class="dropdown-menu text-center">
                                                                <h6 class="dropdown-header"
                                                                    style="background-color: lightgrey;">
                                                                    Attached Vehicles</h6>
                                                                @foreach ($List->all_listing->vehicles as $vehcile)
                                                                    <a class="dropdown-item"
                                                                        style="color: #0d6efd; font-weight: 800;"
                                                                        href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                                        target="_blank">{{ $vehcile->Vehcile_Year }}{{ $vehcile->Vehcile_Make }}{{ $vehcile->Vehcile_Model }}<br>
                                                                        @if (!empty($vehcile->Vehcile_Condition))
                                                                            <span
                                                                                class="badge badge-pill mt-2 @if ($vehcile->Vehcile_Condition == 'Running') badge-success @elseif($vehcile->Vehcile_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                                                style="font-size: 16px;">
                                                                                {{ $vehcile->Vehcile_Condition }}
                                                                            </span>
                                                                        @endif
                                                                        @if (!empty($vehcile->Trailer_Type))
                                                                            <span
                                                                                class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                                                style="font-size: 16px;">{{ $vehcile->Trailer_Type }}</span>
                                                                        @endif
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if (count($List->all_listing->heavy_equipments) === 1)
                                                        @foreach ($List->all_listing->heavy_equipments as $vehcile)
                                                            <p class="ymm"> {{ $vehcile->Equipment_Year }}
                                                                {{ $vehcile->Equipment_Make }}
                                                                {{ $vehcile->Equipment_Model }} </p><br>
                                                            <b>L</b>{{ $vehcile->Equip_Length }} |
                                                            <b>W</b>{{ $vehcile->Equip_Width }}
                                                            | <b>H</b>{{ $vehcile->Equip_Height }}
                                                            | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                            @if (!empty($vehcile->Equipment_Condition))
                                                                <br><span>{{ $vehcile->Equipment_Condition }}</span><br>
                                                            @endif
                                                            @if (!empty($vehcile->Trailer_Type))
                                                                <span>{{ $vehcile->Trailer_Type }}</span>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (count($List->all_listing->heavy_equipments) > 1)
                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Attached vehicles"
                                                            data-content=
                                                            "@foreach ($List->all_listing->heavy_equipments as $vehcile)
                                                            {{ $vehcile->Equipment_Year }}
                                                            {{ $vehcile->Equipment_Make }}
                                                            {{ $vehcile->Equipment_Model }}<br>
                                                                <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                            @if (!empty($vehcile->Equipment_Condition))
                                                                <br>{{ $vehcile->Equipment_Condition }}<br>
                                                            @endif
                                                            @if (!empty($vehcile->Trailer_Type))
                                                                {{ $vehcile->Trailer_Type }}
                                                            @endif @endforeach"
                                                            data-html="true">Vehicles
                                                            ({{ count($List->all_listing->heavy_equipments) }})
                                                        </a>
                                                    @endif
                                                    @if (count($List->all_listing->dry_vans) === 1)
                                                        @foreach ($List->all_listing->dry_vans as $vehcile)
                                                            {{ $vehcile->Freight_Class }}
                                                            {{ $vehcile->Freight_Weight }}<br>
                                                            @if ($vehcile->is_hazmat_Check !== 0)
                                                                Hazmat Required<br>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (count($List->all_listing->dry_vans) > 1)
                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Attached vehicles"
                                                            data-content=
                                                            "@foreach ($List->all_listing->dry_vans as $vehcile)
                                                            {{ $vehcile->Freight_Class }}
                                                            {{ $vehcile->Freight_Weight }}<br>
                                                            @if ($vehcile->is_hazmat_Check !== 0)
                                                                Hazmat Required<br>
                                                            @endif @endforeach"
                                                            data-html="true">Vehicles
                                                            ({{ count($List->all_listing->dry_vans) }})
                                                        </a>
                                                    @endif
                                                    <br>
                                                    <div class="dropdown mt-3">
                                                        <a href="javascript:void(0)" tabindex="0"
                                                            class="btn btn-outline-primary dropdown-toggle text-truncate"
                                                            id="additionalTermsDropdown" role="button"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false" style="max-width: 200px;">
                                                            {{ $List->all_listing->additional_info->Additional_Terms }}Additional
                                                            Terms
                                                        </a>
                                                        <div class="dropdown-menu p-3 shadow-sm"
                                                            aria-labelledby="additionalTermsDropdown"
                                                            style="max-width: 300px;">
                                                            <p class="dropdown-item-text m-0 text-wrap">
                                                                {{ !empty($List->all_listing->additional_info->Additional_Terms)
                                                                    ? $List->all_listing->additional_info->Additional_Terms
                                                                    : 'No additional terms available.' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <strong>Price to Pay:
                                                    </strong><span>${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}</span>
                                                    @if (!empty($List->all_listing->request_broker->Offer_Price) && $List->all_listing->request_broker->Offer_Price !== 0)
                                                        <br>
                                                        <strong>Ask Price:
                                                        </strong>${{ $List->all_listing->request_broker->Offer_Price }}
                                                    @endif
                                                    <br>
                                                    <strong>Mile:</strong>{{ $List->all_listing->routes->Miles }}
                                                    miles<br>
                                                    <strong>Price per
                                                        Mile:</strong>${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}/miles
                                                </td>
                                                <td>
                                                    @php
                                                        // Helper function to get formatted date if Carbon instance, else return raw value
                                                        $getFormattedDate = function ($item) {
                                                            return $item instanceof \Carbon\Carbon
                                                                ? $item->format('Y-m-d')
                                                                : $item;
                                                        };
                                                    @endphp
                                                    @if ($List->all_listing->pickup || $List->all_listing->pickup()->withTrashed()->first())
                                                        <strong>Picked up:</strong><br>
                                                        {{ $getFormattedDate($List->all_listing->pickup ? $List->all_listing->pickup->created_at : $List->all_listing->pickup()->withTrashed()->first()->created_at) }}<br>
                                                    @endif
                                                    @if ($List->all_listing->deliver || $List->all_listing->deliver()->withTrashed()->first())
                                                        <strong>Delivered:</strong><br>
                                                        {{ $getFormattedDate($List->all_listing->deliver ? $List->all_listing->deliver->created_at : $List->all_listing->deliver()->withTrashed()->first()->created_at) }}<br>
                                                    @endif
                                                    @if ($List->all_listing->dispatch_listing || $List->all_listing->dispatch_listing()->withTrashed()->first())
                                                        <strong>Dispatched:</strong><br>
                                                        {{ $getFormattedDate($List->all_listing->dispatch_listing ? $List->all_listing->dispatch_listing->created_at : $List->all_listing->dispatch_listing()->withTrashed()->first()->created_at) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($List->all_listing->user_id === $currentUser->id)
                                                        @if ($List->all_listing->Is_Rate != 1)
                                                            <a class="btn btn-outline-primary mb-2 w-100 d-block rate-order"
                                                                data-toggle="modal" data-target="#RatingOrderModal"
                                                                href="javascript:void(0);">
                                                                <input hidden type="text" class="New-Ref-ID"
                                                                    value="{{ $List->all_listing->Ref_ID }}">
                                                                <input hidden type="text" class="Listed-ID"
                                                                    value="{{ $List->all_listing->id }}">
                                                                <input hidden type="text" class="Profile-ID"
                                                                    value="{{ $List->all_listing->deliver->delivered_user->id }}">
                                                                <input hidden type="text" class="Company-Name"
                                                                    value="{{ $List->all_listing->deliver->delivered_user->Company_Name }}">
                                                                Rate Order
                                                            </a>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-outline-primary mb-2 w-100 d-block" disabled>
                                                                <span class="">Rate Order</span>
                                                            </button>
                                                        @endif
                                                    @endif
                                                    <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                                        href="{{ route('User.Listing.Archive', ['List_ID' => $List->all_listing->id]) }}">Archive</a>
                                                    <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                        class="btn btn-outline-primary mb-2 w-100 d-block" role="button">View
                                                        Detail</a>
                                                    <button class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                        onclick="window.location.href='{{ route('User.Replicate.Listing', ['List_ID' => $List->all_listing->id]) }}'">
                                                        Replicate Listing
                                                    </button>
                                                    <a href="#" class="btn btn-outline-primary mb-2 w-100 d-block"
                                                        role="button">View
                                                        BOL(s)</a>
                                                    @if ($List->all_listing->user_id !== $currentUser->id)
                                                        <a class="btn btn-outline-primary mb-2 w-100 d-block add-misc"
                                                            data-toggle="modal" data-target="#AddMisc"
                                                            href="javascript:void(0);">
                                                            <input hidden type="text" class="Listed-ID"
                                                                value="{{ $List->all_listing->id }}">Add Misc.</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
<!-- Rating Order Modal -->
{{-- <div class="modal fade" id="RatingOrderModal" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h3 class="modal-title">Overall Rating For Order ID: <span class="get_Order_ID"></span></h3>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3 text-center">
                <p class="text-muted text-justify">By submitting a rating you declare that you have conducted business
                    with the rated
                    company. Otherwise, your subscription and/or rating privileges may be suspended.

                    In the event of an inquiry by a rated company, proof of a business relationship may be
                    requested. <strong>Please keep your transaction documents secure and
                        accessible.</strong></p>
                <div id="rate-stats">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="new-user-box stats-box">
                                <div class="icon" style="margin-bottom: 22px;">
                                    <i class="fa-regular fa-lg fa-face-smile"></i>
                                </div>
                                <span class="sub-text font-weight-bold positive-span">Positive</span>
                                <button type="button" class="btn btn-success" id="positive-rate">Positive
                                </button>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="upcoming-product-box stats-box">
                                <div class="icon" style="margin-bottom: 22px;">
                                    <i class="fa-regular fa-lg fa-face-frown-open"></i>
                                </div>
                                <span class="sub-text font-weight-bold neutral-span">Neutral</span>
                                <button type="button" class="btn btn-outline-primary" id="neutral-rate">Neutral
                                </button>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="new-product-box stats-box">
                                <div class="icon" style="margin-bottom: 22px;">
                                    <i class="fa-regular fa-lg fa-face-frown"></i>
                                </div>
                                <span class="sub-text font-weight-bold negative-span">Negative</span>
                                <button type="button" class="btn btn-danger" id="negative-rate">Negative
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="user-settings-box" id="comments">
                        <form action="{{ route('View.Profile.Post.Ratings') }}" method="POST"
                            class="was-validated p-3">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Timeliness</label>
                                        <select class="custom-select" name="Timeliness" required>
                                            <option value="">Select AnyOne</option>
                                            <option value="1">Poor</option>
                                            <option value="2">Fair</option>
                                            <option value="3">Good</option>
                                            <option value="4">Average</option>
                                            <option value="5">Excellent</option>
                                        </select>
                                        <div class="invalid-feedback">Select Timeliness</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Communication</label>
                                        <select class="custom-select" name="Communication" required>
                                            <option value="">Select AnyOne</option>
                                            <option value="1">Poor</option>
                                            <option value="2">Fair</option>
                                            <option value="3">Good</option>
                                            <option value="4">Average</option>
                                            <option value="5">Excellent</option>
                                        </select>
                                        <div class="invalid-feedback">Select Communication</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Documentation</label>
                                        <select class="custom-select" name="Documentation" required>
                                            <option value="">Select AnyOne</option>
                                            <option value="1">Poor</option>
                                            <option value="2">Fair</option>
                                            <option value="3">Good</option>
                                            <option value="4">Average</option>
                                            <option value="5">Excellent</option>
                                        </select>
                                        <div class="invalid-feedback">Select Documentation</div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Comments</label>
                                        <textarea rows="3" name="Rating_Comments" id="Rating_Comments" placeholder="Enter Comments"
                                            class="form-control"></textarea>
                                        <div class="invalid-feedback">
                                            Reason Required to Submit this Rating.
                                        </div>
                                    </div>
                                    <input hidden type="text" id="Ratings" name="Rating" value="">
                                    <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID"
                                        value="">
                                    <input hidden type="text" name="get_Profile_ID" class="get_Profile_ID"
                                        value="">
                                </div>
                                <div class="col-lg-12">
                                    <div class="btn-box">
                                        <button type="submit" class="submit-btn"><i class='bx bx-save'></i>
                                            Save Rating
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <p class="small text-muted"><i class="fa fa-question-circle"></i>
                    To update the comments, remove the rating and re-submit.</p>
            </div>
        </div>
    </div>
</div> --}}
<!-- Rating Replied Comments Modal -->
<div class="modal fade" id="RatingRepliedComments" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Overall Rating For Order ID: <span class="get_Order_ID"></span></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="rate-stats">
                    <div class="user-settings-box" id="comments">
                        <form action="{{ route('Ratings.Replied') }}" method="POST" class="was-validated">
                            @csrf
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Comments</label>
                                    <textarea rows="3" name="Rating_Replied" id="Rating_Replied" placeholder="Enter Comments"
                                        class="form-control" required></textarea>
                                    <div class="invalid-feedback">
                                        Reason Required to Submit this Rating.
                                    </div>
                                </div>
                                <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID"
                                    value="">
                                <input hidden type="text" name="get_Rate_ID" class="get_Rate_ID" value="">
                            </div>
                            <div class="btn-box">
                                <button type="submit" class="submit-btn btn-block btn-sm"><i class='bx bx-save'></i>
                                    Save Replied
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Rating Order Modal -->
    {{-- <div class="modal fade" id="RatingOrderModal" data-backdrop="true" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h3 class="modal-title">Overall Rating For Order IDsss: <span class="get_Order_ID"></span></h3>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3 text-center">
                    <p class="text-muted text-justify">By submitting a rating you declare that you have conducted
                        business
                        with the rated
                        company. Otherwise, your subscription and/or rating privileges may be suspended.

                        In the event of an inquiry by a rated company, proof of a business relationship may be
                        requested. <strong>Please keep your transaction documents secure and
                            accessible.</strong></p>
                    <div id="rate-stats">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="new-user-box stats-box">
                                    <div class="icon" style="margin-bottom: 22px;">
                                        <i class="fa-regular fa-lg fa-face-smile"></i>
                                    </div>
                                    <span class="sub-text font-weight-bold positive-span">Positive</span>
                                    <button type="button" class="btn btn-success" id="positive-rate">Positive
                                    </button>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="upcoming-product-box stats-box">
                                    <div class="icon" style="margin-bottom: 22px;">
                                        <i class="fa-regular fa-lg fa-face-frown-open"></i>
                                    </div>
                                    <span class="sub-text font-weight-bold neutral-span">Neutral</span>
                                    <button type="button" class="btn btn-primary" id="neutral-rate">Neutral
                                    </button>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="new-product-box stats-box">
                                    <div class="icon" style="margin-bottom: 22px;">
                                        <i class="fa-regular fa-lg fa-face-frown"></i>
                                    </div>
                                    <span class="sub-text font-weight-bold negative-span">Negative</span>
                                    <button type="button" class="btn btn-danger" id="negative-rate">Negative
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="user-settings-box" id="comments">
                            <form action="{{ route('View.Profile.Post.Ratings') }}" id="ratingForm" method="POST"
                                class="was-validated p-3">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Timeliness</label>
                                            <div class="star-rating">
                                                <input type="radio" id="star5" name="Timeliness"
                                                    class="timelinessValue" value="5">
                                                <label class="fs-1" for="star5">&#9733;</label>

                                                <input type="radio" id="star4" name="Timeliness"
                                                    class="timelinessValue" value="4">
                                                <label class="fs-1" for="star4">&#9733;</label>

                                                <input type="radio" id="star3" name="Timeliness"
                                                    class="timelinessValue" value="3">
                                                <label class="fs-1" for="star3">&#9733;</label>

                                                <input type="radio" id="star2" name="Timeliness"
                                                    class="timelinessValue" value="2">
                                                <label class="fs-1" for="star2">&#9733;</label>

                                                <input type="radio" id="star1" name="Timeliness"
                                                    class="timelinessValue" value="1" required>
                                                <label class="fs-1" for="star1">&#9733;</label>
                                            </div>
                                            <div class="invalid-feedback">Select Timeliness</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Communication</label>
                                            <div class="star-rating">
                                                <input type="radio" id="communication5" name="Communication"
                                                    value="5" required>
                                                <label class="fs-1" for="communication5">&#9733;</label>

                                                <input type="radio" id="communication4" name="Communication"
                                                    value="4">
                                                <label class="fs-1" for="communication4">&#9733;</label>

                                                <input type="radio" id="communication3" name="Communication"
                                                    value="3">
                                                <label class="fs-1" for="communication3">&#9733;</label>

                                                <input type="radio" id="communication2" name="Communication"
                                                    value="2">
                                                <label class="fs-1" for="communication2">&#9733;</label>

                                                <input type="radio" id="communication1" name="Communication"
                                                    value="1">
                                                <label class="fs-1" for="communication1">&#9733;</label>
                                            </div>
                                            <div class="invalid-feedback">Select Communication</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Documentation</label>
                                            <div class="star-rating">
                                                <input type="radio" id="documentation5" name="Documentation"
                                                    value="5" required>
                                                <label class="fs-1" for="documentation5">&#9733;</label>

                                                <input type="radio" id="documentation4" name="Documentation"
                                                    value="4">
                                                <label class="fs-1" for="documentation4">&#9733;</label>

                                                <input type="radio" id="documentation3" name="Documentation"
                                                    value="3">
                                                <label class="fs-1" for="documentation3">&#9733;</label>

                                                <input type="radio" id="documentation2" name="Documentation"
                                                    value="2">
                                                <label class="fs-1" for="documentation2">&#9733;</label>

                                                <input type="radio" id="documentation1" name="Documentation"
                                                    value="1">
                                                <label class="fs-1" for="documentation1">&#9733;</label>
                                            </div>
                                            <div class="invalid-feedback">Select Documentation</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Comments</label>
                                            <textarea rows="3" name="Rating_Comments" id="Rating_Comments" placeholder="Enter Comments"
                                                class="form-control"></textarea>
                                            <div class="invalid-feedback">
                                                Reason Required to Submit this Rating.
                                            </div>
                                        </div>
                                        <input hidden type="text" id="Ratings" name="Rating" value="">
                                        <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID"
                                            value="">
                                        <input hidden type="text" name="get_Profile_ID" class="get_Profile_ID"
                                            value="">
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="btn-box">
                                            <button type="submit" class="submit-btn"><i class='bx bx-save'></i>
                                                Save Rating
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="small text-muted"><i class="fa fa-question-circle"></i>
                        To update the comments, remove the rating and re-submit.</p>
                </div>
            </div>
        </div>
    </div> --}}
<script>
    $('.advance-6').DataTable({
        "deferRender": true,
        "searching": false,
    });

    // $(document).ready(function() {
    //     $("#comments").hide();
    //     $(".positive-span").hide();
    //     $(".negative-span").hide();
    //     $(".neutral-span").hide();

    //     $("#positive-rate").click(function() {

    //         $("#positive-rate").hide();
    //         $("#negative-rate").show();
    //         $("#neutral-rate").show();

    //         $(".new-user-box").addClass('active-stats-box');
    //         $(".upcoming-product-box").removeClass('active-stats-box');
    //         $(".new-product-box").removeClass('active-stats-box');

    //         $(".positive-span").show();
    //         $(".negative-span").hide();
    //         $(".neutral-span").hide();

    //         $("#comments").show();
    //         $("#comments textarea").html("Don’t take too long to respond");

    //         $("#Ratings").val('Positive');

    //     });

    //     $("#neutral-rate").click(function() {

    //         $("#negative-rate").show();
    //         $("#positive-rate").show();
    //         $("#neutral-rate").hide();

    //         $(".new-user-box").removeClass('active-stats-box');
    //         $(".upcoming-product-box").addClass('active-stats-box');
    //         $(".new-product-box").removeClass('active-stats-box');

    //         $(".neutral-span").show();
    //         $(".negative-span").hide();
    //         $(".positive-span").hide();

    //         $("#comments").show();
    //         $("#comments textarea").html("");

    //         $("#Ratings").val('Neutral');

    //     });

    //     $("#negative-rate").click(function() {

    //         $("#negative-rate").hide();
    //         $("#positive-rate").show();
    //         $("#neutral-rate").show();

    //         $(".new-user-box").removeClass('active-stats-box');
    //         $(".upcoming-product-box").removeClass('active-stats-box');
    //         $(".new-product-box").addClass('active-stats-box');

    //         $(".negative-span").show();
    //         $(".neutral-span").hide();
    //         $(".positive-span").hide();

    //         $("#comments").show();
    //         $("#comments textarea").html("");

    //         $("#Ratings").val('Negative');

    //     });

    //     // Get Profile Info Functionality For Rating Request
    //     $(".rate-order").click(function() {
    //         var getListedID = $(this).find('.Listed-ID').val();
    //         var getProfileID = $(this).find('.Profile-ID').val();
    //         var getRefID = $(this).find('.New-Ref-ID').val();
    //         // console.log('getRefID', getRefID);
    //         $(".get_Order_ID").html(getRefID);
    //         $(".get_Listed_ID").val(getListedID);
    //         $(".get_Profile_ID").val(getProfileID);
    //     });
    //     // Get Profile Info Functionality For Rating Replied
    //     $(".rate-reply").click(function() {
    //         var getListedID = $(this).find('.Listed-ID').val();
    //         var getRateID = $(this).find('.Rate-ID').val();
    //         $(".get_Order_ID").html(getListedID);
    //         $(".get_Listed_ID").val(getListedID);
    //         $(".get_Rate_ID").val(getRateID);
    //     });
    // });
</script>