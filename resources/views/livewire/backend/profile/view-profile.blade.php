@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
    $verification = $currentUser->admin_verify && $currentUser->is_email_verified && $currentUser->Profile_Update;
@endphp
<style>
    #rate-stats .svg-inline--fa {
        height: auto !important;
    }

    #rate-stats .stats-box:hover {
        border: 1px solid #052c65 !important;
    }

    .active-stats-box {
        border: 1px solid #052c65 !important;
    }

    .rating i {
        color: #ffce00;
        font-size: 18px;
    }

    #rate-stats .svg-inline--fa {
        height: auto !important;
    }

    #rate-stats .stats-box:hover {
        border: 1px solid #052c65 !important;
    }

    .active-stats-box {
        border: 1px solid #052c65 !important;
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

    .flex {
        display: flex;
    }
</style>
<!-- Start Profile Area -->
<section class="profile-area">
    <div class="profile-header mb-30">
        <div class="user-profile-images">
            <img src="{{ asset('backend/img/profile-banner.jpg') }}" class="cover-image" height="30px" alt="image">

            <div class="profile-image">
                <img src="{{ $Profile_Info->profile_photo_path ? url($Profile_Info->profile_photo_path) : asset('backend/img/user1.jpg') }}"
                    alt="image">
            </div>

            <div class="user-profile-text">
                <h3>{{ $Profile_Info->Company_Name }}</h3>
                <span class="d-block">{{ $Profile_Info->usr_type }}</span>
            </div>
        </div>
        <div class="flex">
            <div class="user-profile-nav d-flex">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="timeline-tab" data-toggle="tab" href="#timeline" role="tab"
                            aria-controls="timeline" aria-selected="true">Timeline</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="about-tab" data-toggle="tab" href="#rate" role="tab"
                            aria-controls="rate" aria-selected="false">Rate Us</a>
                    </li>
                    @if (is_null($Profile_Network))
                        <li class="nav-item justify-content-end">
                            <a class="nav-link"
                                href="{{ route('Profile.Add.Network', ['CMP_Find' => $Profile_Info->Company_Name, 'CMP_ID' => $Profile_Info->id]) }}"
                                role="button">Preferred List</a>
                        </li>
                        <li class="nav-item justify-content-end">
                            <a class="nav-link"
                                href="{{ route('Profile.Blocked.Network', ['CMP_Find' => $Profile_Info->Company_Name, 'CMP_ID' => $Profile_Info->id]) }}"
                                role="button">Blocked List</a>
                        </li>
                    @endif
                    @if (!is_null($Profile_Network))
                        <li class="nav-item justify-content-end">
                            <a href="{{ route('Profile.Update.Network', ['CMP_Find' => $Profile_Info->Company_Name, 'CMP_ID' => $Profile_Info->id]) }}"
                                class="nav-link {{ $Profile_Network->status === 0 ? 'active' : '' }}">Preferred
                            </a>
                        </li>

                        <li class="nav-item justify-content-end">
                            <a href="{{ route('Profile.Update.Network', ['CMP_Find' => $Profile_Info->Company_Name, 'CMP_ID' => $Profile_Info->id]) }}"
                                class="nav-link {{ $Profile_Network->status === 1 ? 'active' : '' }}">
                                @if ($Profile_Network->status === 1)
                                    Unblock
                                @else
                                    Block
                                @endif
                            </a>
                        </li>
                    @endif
                </ul>
                @if ($verification)
                    <div class="profile-status text-center">
                        <a class="verify-user" style="color: green; font-size: 35px; padding: 20px;"
                            data-toggle="tooltip" data-placement="top" title="User Verified">
                            <i class="bx bxs-check-shield"></i>
                        </a>
                    </div>
                @endif
                <ul class="nav nav-tabs">
                    <li>
                        <form action="{{ route('User.Listing') }}" method="get">
                            <input type="hidden" name="get_comp_listing" value="{{ $Profile_Info->id }}">
                            <input class="nav-link active" type="submit"
                                value="Active Listings ({{ $Lisiting_Count }})">
                        </form>
                        {{-- <a class="nav-link active" href="{{ route('User.Listing') }}">Active Requests</a> --}}
                    </li>
                </ul>
            </div>

            <div class="user-profile-nav d-flex">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="message"
                            href="{{ route('chat', $Profile_Info->id) }}">Message</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-12">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card top-rated-product-box pl-3 mb-4">
                                <div class="card-header" style="margin-bottom: 0px;">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12 pl-3 ml-3 text-center">
                                            <h3>{{ $Profile_Info->Company_Name }}</h3>
                                            {{-- <h3>{{$Lisiting}}</h3> --}}
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
                                                <span class="">{{ $Profile_Info->Address }}</span><br>
                                                <span class="">{{ $Profile_Info->Company_City }},
                                                    {{ $Profile_Info->Company_State }}</span><br>
                                                <span class="">{{ $Profile_Info->Contact_Phone }}</span><br>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 p-3">
                                                <strong>Join Date:</strong>&nbsp;<span
                                                    class="">{{ $Profile_Info->updated_at }}</span><br>
                                                <strong>Business Type:</strong>&nbsp;<span
                                                    class="">{{ $Profile_Info->usr_type }}</span><br>
                                                <strong>Total Shipments:</strong>&nbsp;<span
                                                    class="">{{ number_format($Profile_Info->all_listing_count) }}</span><br>
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
                                            style="font-size: 2rem;">{{ number_format($avg_rating, 1) }}</span>
                                        <span>out of {{ count($User_Rating) }}</span>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 p-3 m-3 text-center"
                                        style="border: 1px solid #d0d0d0; border-radius: 10px;">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <strong>Timeliness <i
                                                        class="fa fa-exclamation-circle"></i></strong><br>
                                                <span class="font-weight-bolder"
                                                    style="font-size: 1.2rem;">{{ round($User_Info->ratings_avg_timeliness, 2) }}</span>
                                                <div class="rating d-inline-block">
                                                    <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <strong>Communication <i
                                                        class="fa fa-exclamation-circle"></i></strong><br>
                                                <span class="font-weight-bolder"
                                                    style="font-size: 1.2rem;">{{ round($User_Info->ratings_avg_communication, 2) }}</span>
                                                <div class="rating d-inline-block">
                                                    <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <strong>Documentation <i
                                                        class="fa fa-exclamation-circle"></i></strong><br>
                                                <span class="font-weight-bolder"
                                                    style="font-size: 1.2rem;">{{ round($User_Info->ratings_avg_documentation, 2) }}</span>
                                                <div class="rating d-inline-block">
                                                    <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card user-info-box mb-30">





                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3>Company Information</h3>
                                </div>

                                <div class="card-body">

                                    <ul class="list-unstyled mb-0">

                                        <li class="d-flex">
                                            <i class="bx bx-building mr-2"></i>
                                            <h6 class="d-inline-block"><b>Company Name:</b> <span
                                                    class="d-inline-block">{{ $Profile_Info->Company_Name }}</span>
                                            </h6>
                                        </li>

                                        <li class="d-flex">
                                            <i class="bx bx-map mr-2"></i>
                                            <h6 class="d-inline-block"><b>Address:</b> <span class="d-inline-block">
                                                    {{ $Profile_Info->Address }}</span>
                                            </h6>
                                        </li>

                                        <li class="d-flex">
                                            <i class="bx bx-home mr-2"></i>
                                            <h6 class="d-inline-block"><b>City:</b> <span class="d-inline-block">
                                                    {{ $Profile_Info->Company_City }}</span>
                                            </h6>
                                        </li>

                                        <li class="d-flex">
                                            <i class="bx bx-globe mr-2"></i>
                                            <h6 class="d-inline-block"><b>Website:</b> <span class="d-inline-block">
                                                    <a target="_blank"
                                                        href="{{ $Profile_Info->Website_Url ?: 'javascript:void(0);' }}">View
                                                        Website</a></span>
                                            </h6>
                                        </li>

                                        <li class="d-flex">
                                            <i class="bx bx-time mr-2"></i>
                                            <h6 class="d-inline-block"><b>Hours:</b> <span class="d-inline-block">
                                                    {{ $Profile_Info->Hours_Operations ?: 'N/A' }}</span>
                                            </h6>
                                        </li>

                                        <li class="d-flex">
                                            <i class="bx bx-time-time mr-2"></i>
                                            <h6 class="d-inline-block"><b>Timezone:</b> <span class="d-inline-block">
                                                    {{ $Profile_Info->Time_Zone ?: 'N/A' }}</span>
                                            </h6>
                                        </li>

                                        <li class="d-flex">
                                            <i class="bx bx-location mr-2"></i>
                                            <h6 class="d-inline-block"><b>Established:</b> <span
                                                    class="d-inline-block">
                                                    {{ $Profile_Info->created_at ? date('Y', strtotime($Profile_Info->created_at)) : 'N/A' }}</span>
                                            </h6>
                                        </li>

                                        {{-- <li class="d-flex">
                                            <i class="bx bx-location mr-2"></i>
                                            <h6 class="d-inline-block"><b>Company Description:</b> <span
                                                    class="d-inline-block">
                                                    {{ $Profile_Info->Company_Desc ? $Profile_Info->Company_Desc : 'N/A'
                                                    }}</span>
                                            </h6>
                                        </li> --}}

                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h3>{{ $Profile_Info->usr_type }} Bond Information</h3>
                                        </div>

                                        <li class="d-flex">
                                            <i class="bx bx-file mr-2"></i>
                                            <h6 class="d-inline-block"><b>Surety Bonding Agent:</b> <span
                                                    class="d-inline-block">{{ !empty($Profile_Info->insurance->Agent_Name) ? $Profile_Info->insurance->Agent_Name : 'N/A' }}</span>
                                            </h6>
                                        </li>

                                        <li class="d-flex">
                                            <i class="bx bx-phone mr-2"></i>
                                            <h6 class="d-inline-block"><b>Bonding Company Phone:</b> <span
                                                    class="d-inline-block">
                                                    {{ !empty($Profile_Info->insurance->Agent_Phone) ? $Profile_Info->insurance->Agent_Phone : 'N/A' }}</span>
                                            </h6>
                                        </li>

                                    </ul>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header">
                                        <h3>Operating Authority and Document Packet (Authority, Insurance, W-9, etc.)
                                        </h3>
                                    </div>
                                    <!-- Start -->
                                    <div class="todo-content-area text-center">

                                        <div class="content-right w-100 " style="float: none;">
                                            <div class="todo-area">
                                                <div class="todo-list-wrapper">
                                                    <div class="todo-list">

                                                        <ul class="list-wrapper w-100" data-simplebar
                                                            style="height: auto;">
                                                            @if (is_null($Profile_Info->certificates))
                                                                <li class="todo-list-item">
                                                                    <div class="todo-item-title">
                                                                        <h3>Verified Documents are <strong>Not
                                                                                Attached.</strong>

                                                                        </h3>
                                                                    </div>
                                                                </li>
                                                            @endif

                                                            <!-- @if($results)
                                                            @foreach($results as $item)
                                                            {{$item->USDOT_Certificate}}
                                                            {{$item->Insurance_Certificate}}
                                                            {{$item->W_Nine}}
                                                            <div class="todo-item-action">
                                                                <a target="_blank"
                                                                    href="{{ $item ? url($item->USDOT_Certificate) : '' }}"
                                                                    class="edit"><i
                                                                        class='fa fa-eye'></i></a>
                                                            </div>
                                                            @endforeach
                                                            @endif -->

                                                            

                                                            @foreach ($Certificates_assigns as $row)
                                                                @if ($Profile_Info->certificates->USDOT_Privacy === 0 && $row->certificate_name == 'USDOT_Certificate')
                                                                    <li class="todo-list-item">
                                                                        <div class="todo-item-title">
                                                                            <img src="{{ asset('backend/img/pdf.PNG') }}"
                                                                                alt="icon">
                                                                            <h3>DOT Certificate or License
                                                                            </h3>
                                                                            <p><a target="_blank"
                                                                                    href="{{ $Profile_Info->certificates->USDOT_Certificate ? url($Profile_Info->certificates->USDOT_Certificate) : '' }}">View
                                                                                    Certificate</a></p>
                                                                        </div>

                                                                        <div class="todo-item-action">
                                                                            <a target="_blank"
                                                                                href="{{ $Profile_Info->certificates->USDOT_Certificate ? url($Profile_Info->certificates->USDOT_Certificate) : '' }}"
                                                                                class="edit"><i
                                                                                    class='fa fa-eye'></i></a>
                                                                        </div>
                                                                    </li>
                                                                @endif
                                                            @endforeach

                                                            @foreach ($Certificates_assigns as $row)
                                                            @if ($Profile_Info->certificates->Insurance_Privacy === 0 && $row->certificate_name == 'Insurance_Certificate')
                                                                <li class="todo-list-item">
                                                                    <div class="todo-item-title">
                                                                        <img src="{{ asset('backend/img/pdf.PNG') }}"
                                                                            alt="image">

                                                                        <h3>Insurance or Bond Certificate
                                                                        </h3>
                                                                        <p><a target="_blank"
                                                                                href="{{ $Profile_Info->certificates->Insurance_Certificate ? url($Profile_Info->certificates->Insurance_Certificate) : '' }}">View
                                                                                Certificate</a></p>
                                                                    </div>

                                                                    <div class="todo-item-action">
                                                                        <a target="_blank"
                                                                            href="{{ $Profile_Info->certificates->Insurance_Certificate ? url($Profile_Info->certificates->Insurance_Certificate) : '' }}"
                                                                            class="edit"><i
                                                                                class='fa fa-eye'></i></a>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                            @endforeach

                                                            @foreach ($Certificates_assigns as $row)
                                                            @if ($Profile_Info->certificates->W_Nine_Privacy === 0 && $row->certificate_name == 'W_Nine')
                                                                <li class="todo-list-item">
                                                                    <div class="todo-item-title">
                                                                        <img src="{{ asset('backend/img/pdf.PNG') }}"
                                                                            alt="image">

                                                                        <h3>Completed W-9 [W/O Instructions]
                                                                        </h3>
                                                                        <p><a target="_blank"
                                                                                href="{{ $Profile_Info->certificates->W_Nine ? url($Profile_Info->certificates->W_Nine) : '' }}">View
                                                                                Certificate</a></p>
                                                                    </div>

                                                                    <div class="todo-item-action">
                                                                        <a target="_blank"
                                                                            href="{{ $Profile_Info->certificates->W_Nine ? url($Profile_Info->certificates->W_Nine) : '' }}"
                                                                            class="edit"><i
                                                                                class='fa fa-eye'></i></a>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                            @endforeach

                                                            @if (!empty($Profile_Info->Company_USDot))
                                                                <li class="todo-list-item">
                                                                    <div class="todo-item-title">
                                                                        <h3>
                                                                            ICC-MC#. :
                                                                            {{ !empty($Profile_Info->Mc_Number) ? $Profile_Info->Mc_Number : 'N/A' }}
                                                                        </h3>
                                                                        <h3>
                                                                            View DOT Info for MC#. : <a target="_blank"
                                                                                href="https://li-public.fmcsa.dot.gov/LIVIEW/pkg_carrquery.prc_carrlist?s_prefix=MC&n_docketno={{ $Profile_Info->Company_USDot }}">{{ !empty($Profile_Info->Company_USDot) ? $Profile_Info->Company_USDot : 'N/A' }}</a>
                                                                        </h3>
                                                                    </div>
                                                                </li>
                                                            @endif

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End -->
                                </div>
                                <div class="card-footer">
                                    <p class="small text-muted">
                                        <i class="fa fa-exclamation-circle"></i>
                                        Member submitted all documents in the Document Packet directly without
                                        verification by Day Dispatch.
                                        Day Dispatch makes no representation as to the accuracy, warranty, or fitness of
                                        these documents, and use of these
                                        documents is at the sole discretion and risk of any party that uses the
                                        documents.
                                    </p>

                                    <p class="small text-muted"><i class="fa fa-question-circle"></i>
                                        A document packet is a copy of DOT authority, insurance, W-9, and any other
                                        licenses that a company has
                                        faxed to DAy Dispatch. To find out more about document packets.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card user-info-box mb-30">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3>Contact Information</h3>
                                </div>

                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">

                                        <li class="d-flex">
                                            <i class="bx bx-file mr-2"></i>
                                            <h6 class="d-inline-block"><b>Dispatch Contact:</b> <span
                                                    class="d-inline-block">{{ $Profile_Info->Dispatch_Contact ?: 'N/A' }}</span>
                                            </h6>
                                        </li>

                                        <li class="d-flex">
                                            <i class="bx bx-phone mr-2"></i>
                                            <h6 class="d-inline-block"><b>Preferred Contact Method:</b> <span
                                                    class="d-inline-block">
                                                    {{ $Profile_Info->Contact_Method ?: 'N/A' }}</span>
                                            </h6>
                                        </li>

                                        <li class="d-flex">
                                            <i class="bx bx-phone mr-2"></i>
                                            <h6 class="d-inline-block"><b>Toll-Free:</b> <span class="d-inline-block">
                                                    {{ $Profile_Info->Toll_Free ?: 'N/A' }}</span>
                                            </h6>
                                        </li>

                                        <li class="d-flex">
                                            <i class="bx bx-phone mr-2"></i>
                                            <h6 class="d-inline-block"><b>Local Phone:</b> <span
                                                    class="d-inline-block">
                                                    {{ $Profile_Info->Local_Phone ?: 'N/A' }}</span>
                                            </h6>
                                        </li>

                                        <li class="d-flex">
                                            <i class="bx bx-phone mr-2"></i>
                                            <h6 class="d-inline-block"><b>Fax:</b> <span class="d-inline-block">
                                                    {{ $Profile_Info->Fax_Phone ?: 'N/A' }}</span>
                                            </h6>
                                        </li>

                                        <li class="d-flex">
                                            <i class="bx bx-envelope mr-2"></i>
                                            <h6 class="d-inline-block"><b>Email Address:</b> <span
                                                    class="d-inline-block">
                                                    {{ $Profile_Info->email ?: 'N/A' }}</span>
                                            </h6>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                            <div class="card user-info-box mb-30">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3>Equipment & Route Information</h3>
                                </div>

                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">

                                        <li class="d-flex">
                                            <i class="bx bx-file mr-2"></i>
                                            <h6 class="d-inline-block"><b>Number of Trucks:</b> <span
                                                    class="d-inline-block">{{ $User_Info->Number_of_Trucks ? $User_Info->Number_of_Trucks : 'N/A' }}</span>
                                            </h6>
                                        </li>

                                        <li class="d-flex">
                                            <i class="bx bx-phone mr-2"></i>
                                            <h6 class="d-inline-block"><b>Equipment Type:</b> <span
                                                    class="d-inline-block">
                                                    {{ $User_Info->Equipment_Type ? $User_Info->Equipment_Type : 'N/A' }}</span>
                                            </h6>
                                        </li>

                                        <li class="d-flex">
                                            <i class="bx bx-phone mr-2"></i>
                                            <h6 class="d-inline-block"><b>Equipment Description:</b> <span
                                                    class="d-inline-block">
                                                    {{ $User_Info->Equipment_Description ? $User_Info->Equipment_Description : 'N/A' }}</span>
                                            </h6>
                                        </li>

                                        <li class="d-flex">
                                            <i class="bx bx-phone mr-2"></i>
                                            <h6 class="d-inline-block"><b>Route Description:</b> <span
                                                    class="d-inline-block">
                                                    {{ $User_Info->Route_Description ? $User_Info->Route_Description : 'N/A' }}</span>
                                            </h6>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="rate" role="tabpanel" aria-labelledby="rate-tab">
                    <section class="profile-area">

                        <div class="profile-header">

                            <div class="user-profile-nav" style="padding: 25px 25px 25px 25px !important;">
                                <ul class="nav nav-tabs" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active" id="Overview-tab" data-toggle="tab"
                                            href="#overall" role="tab" aria-controls="overall"
                                            aria-selected="false">Overview</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="pendings-tab" data-toggle="tab" href="#pendings"
                                            role="tab" aria-controls="pendings" aria-selected="false">Pending</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="overall" role="tabpanel"
                                aria-labelledby="overall-tab">

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
                                                style="font-size: 2rem;">{{ number_format($avg_rating, 1) }}</span>
                                            <span>out of {{ count($User_Rating) }}</span>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-12 p-3 m-3 text-center"
                                            style="border: 1px solid #d0d0d0; border-radius: 10px;">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <strong>Timeliness <i
                                                            class="fa fa-exclamation-circle"></i></strong><br>
                                                    <span class="font-weight-bolder"
                                                        style="font-size: 1.2rem;">{{ round($User_Info->ratings_avg_timeliness, 2) }}</span>
                                                    <div class="rating d-inline-block">
                                                        <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <strong>Communication <i
                                                            class="fa fa-exclamation-circle"></i></strong><br>
                                                    <span class="font-weight-bolder"
                                                        style="font-size: 1.2rem;">{{ round($User_Info->ratings_avg_communication, 2) }}</span>
                                                    <div class="rating d-inline-block">
                                                        <i class="bx bxs-star ml-2" style="font-size: 1.5rem;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <strong>Documentation <i
                                                            class="fa fa-exclamation-circle"></i></strong><br>
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
                                        <h3 class="font-weight-bolder">Most Helpful Reviews</h3>
                                    </div>

                                    @if ($currentUser->usr_type === 'Broker')
                                        @forelse($User_Rating as $Rate)
                                            <div class="row"
                                                style="border: 1px solid #d0d0d0; border-radius: 10px;">
                                                <div class="col-lg-3 col-md-3 col-sm-12"
                                                    style="background: #efefef; padding: 1.5rem 0rem 0rem 1.5rem;">
                                                    <div class="card-header mt-1" style="background: #efefef;">
                                                        <h3 class="">{{ $Rate->rated_user->Company_Name }}</h3>
                                                        <br>
                                                        <span>{{ $Rate->rated_user->Company_City }},
                                                            {{ $Rate->rated_user->Company_State }}</span><br>
                                                        <span><strong>Order ID:
                                                            </strong>{{ $Rate->all_listing->Ref_ID }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-12"
                                                    style="padding: 1.5rem 0rem 0rem 1.5rem;">
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
                                                            <strong>Timeliness <i
                                                                    class="fa fa-exclamation-circle"></i></strong><br>
                                                            <span class="font-weight-bolder"
                                                                style="font-size: 1.2rem;">{{ $Rate->Timeliness }}</span>
                                                            <div class="rating d-inline-block">
                                                                <i class="bx bxs-star ml-2"
                                                                    style="font-size: 1.5rem;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                                            <strong>Communication <i
                                                                    class="fa fa-exclamation-circle"></i></strong><br>
                                                            <span class="font-weight-bolder"
                                                                style="font-size: 1.2rem;">{{ $Rate->Communication }}</span>
                                                            <div class="rating d-inline-block">
                                                                <i class="bx bxs-star ml-2"
                                                                    style="font-size: 1.5rem;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                                            <strong>Documentation <i
                                                                    class="fa fa-exclamation-circle"></i></strong><br>
                                                            <span class="font-weight-bolder"
                                                                style="font-size: 1.2rem;">{{ $Rate->Documentation }}</span>
                                                            <div class="rating d-inline-block">
                                                                <i class="bx bxs-star ml-2"
                                                                    style="font-size: 1.5rem;"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if (!empty($Rate->Rating_Comments))
                                                        <blockquote class="blockquote">
                                                            <p class="mb-0 small">{{ $Rate->Rating_Comments }}</p>
                                                            @if (!empty($Rate->Rating_Replied))
                                                                <p class="mb-0 small text-right"
                                                                    style="margin-right: 1.5rem;">
                                                                    {{ $Rate->Rating_Replied }}</p>
                                                            @elseif($Rate->user_id !== $currentUser->id && $Rate->rated_user->id == Auth::guard('Authorized')->user()->id)
                                                                <a data-toggle="modal"
                                                                    data-target="#RatingRepliedComments"
                                                                    href="javascript:void(0);"
                                                                    class="rate-reply btn btn-sm btn-outline-danger text-end mb-3 mr-3"
                                                                    style="float: right;"><i
                                                                        class="bx bx-home-circle"></i>
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
                                        @forelse($User_Rating as $Rate)
                                            <div class="row"
                                                style="border: 1px solid #d0d0d0; border-radius: 10px;">
                                                <div class="col-lg-3 col-md-3 col-sm-12"
                                                    style="background: #efefef; padding: 1.5rem 0rem 0rem 1.5rem;">
                                                    <div class="card-header mt-1" style="background: #efefef;">
                                                        <h3 class="">{{ $Rate->authorized_user->Company_Name }}
                                                        </h3><br>
                                                        <span>{{ $Rate->authorized_user->Company_City }},
                                                            {{ $Rate->authorized_user->Company_State }}</span>
                                                        <span><strong>Order ID:
                                                            </strong>{{ $Rate->all_listing->Ref_ID }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-12"
                                                    style="padding: 1.5rem 0rem 0rem 1.5rem;">
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
                                                            <strong>Timeliness <i
                                                                    class="fa fa-exclamation-circle"></i></strong><br>
                                                            <span class="font-weight-bolder"
                                                                style="font-size: 1.2rem;">{{ $Rate->Timeliness }}</span>
                                                            <div class="rating d-inline-block">
                                                                <i class="bx bxs-star ml-2"
                                                                    style="font-size: 1.5rem;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                                            <strong>Communication <i
                                                                    class="fa fa-exclamation-circle"></i></strong><br>
                                                            <span class="font-weight-bolder"
                                                                style="font-size: 1.2rem;">{{ $Rate->Communication }}</span>
                                                            <div class="rating d-inline-block">
                                                                <i class="bx bxs-star ml-2"
                                                                    style="font-size: 1.5rem;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                                            <strong>Documentation <i
                                                                    class="fa fa-exclamation-circle"></i></strong><br>
                                                            <span class="font-weight-bolder"
                                                                style="font-size: 1.2rem;">{{ $Rate->Documentation }}</span>
                                                            <div class="rating d-inline-block">
                                                                <i class="bx bxs-star ml-2"
                                                                    style="font-size: 1.5rem;"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if (!empty($Rate->Rating_Comments))
                                                        <blockquote class="blockquote">
                                                            <p class="mb-0 small">{{ $Rate->Rating_Comments }}</p>
                                                            @if (!empty($Rate->Rating_Replied))
                                                                <p class="mb-0 small text-right"
                                                                    style="margin-right: 1.5rem;">
                                                                    {{ $Rate->Rating_Replied }}</p>
                                                            @elseif($Rate->user_id !== $currentUser->id && $Rate->rated_user->id == Auth::guard('Authorized')->user()->id)
                                                                <a data-toggle="modal"
                                                                    data-target="#RatingRepliedComments"
                                                                    href="javascript:void(0);"
                                                                    class="rate-reply btn btn-sm btn-outline-danger text-end mb-3 mr-3"
                                                                    style="float: right;"><i
                                                                        class="bx bx-home-circle"></i>
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

                            <div class="tab-pane fade" id="pendings" role="tabpanel"
                                aria-labelledby="pendings-tab">

                                <div class="card top-rated-product-box pl-3">

                                    <div class="card-header" style="margin-bottom: 0px;">
                                        <h3>What Do You Think?</h3>
                                        <p class="text-muted text-capitalize">ALL THE DELIVERY ORDER SHOW IN THIS
                                            SECTION USER CAN RATE THE
                                            CARRIER / BROKER / MANUFACTURING /
                                            SALVAGE (etc.), all the listing show for 60 days, after 60 the listing will
                                            be automatically
                                            removed</p>
                                    </div>
                                    <div class="card-body">
                                        @if ($currentUser->usr_type === 'Carrier')
                                            <div class="table-responsive">
                                                <table class="display dataTable datatable-range table-1 advance-786 text-center table-bordered table-cards">
                                                    <thead class="table-header">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Routes</th>
                                                            <th>Load Details</th>
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
                                                                    <strong>Ref-ID:</strong>{{ $List->all_listing->Ref_ID }}
                                                                    <br>
                                                                    {{ $List->all_listing->routes->Miles }} miles<br>
                                                                    $
                                                                    {{ number_format(
                                                                        (float) $List->all_listing->paymentinfo->Order_Booking_Price / (float) $List->all_listing->routes->Miles,
                                                                        2,
                                                                        '.',
                                                                        '',
                                                                    ) }}
                                                                    /miles
                                                                </td>
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
                                                                        <a href="javascript:void(0)" tabindex="0"
                                                                            class="" data-toggle="popover"
                                                                            data-trigger="focus"
                                                                            style="cursor: pointer;"
                                                                            title="Attached vehicles"
                                                                            data-content="@foreach ($List->all_listing->vehicles as $vehcile)
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
                                                                        <a href="javascript:void(0)" tabindex="0"
                                                                            class="" data-toggle="popover"
                                                                            data-trigger="focus"
                                                                            style="cursor: pointer;"
                                                                            title="Attached vehicles"
                                                                            data-content="@foreach ($List->all_listing->heavy_equipments as $vehcile)
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
                                                                            ({{ count($List->all_listing->heavy_equipments) }}
                                                                            )
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
                                                                        <a href="javascript:void(0)" tabindex="0"
                                                                            class="" data-toggle="popover"
                                                                            data-trigger="focus"
                                                                            style="cursor: pointer;"
                                                                            title="Attached vehicles"
                                                                            data-content="@foreach ($List->all_listing->dry_vans as $vehcile)
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
                                                                    <a href="javascript:void(0)" tabindex="0"
                                                                        class="" data-toggle="popover"
                                                                        data-trigger="focus" style="cursor: pointer;"
                                                                        title="Additional Terms"
                                                                        data-content="{{ !empty($List->all_listing->additional_info->Additional_Terms) ? $List->all_listing->additional_info->Additional_Terms : '' }}">
                                                                        {{ !empty($List->all_listing->additional_info->Additional_Terms)
                                                                            ? Str::limit($List->all_listing->additional_info->Additional_Terms, 20)
                                                                            : '...' }}</a>
                                                                </td>
                                                                <td>
                                                                    <strong>
                                                                        <a href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
                                                                            target="_blank">{{ $List->all_listing->authorized_user->Company_Name }}</a></strong><br>
                                                                    {{ $List->all_listing->authorized_user->Contact_Phone }}
                                                                    <br>
                                                                    {{ $List->all_listing->authorized_user->Hours_Operations }}
                                                                    <br>
                                                                    {{ $List->all_listing->authorized_user->Time_Zone }}<br>
                                                                </td>
                                                                <td>
                                                                    <strong>Price to Pay:
                                                                    </strong>${{ $List->all_listing->paymentinfo->Order_Booking_Price }}
                                                                    <br>
                                                                    <strong>COD/COP:
                                                                    </strong>${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}
                                                                    <br>
                                                                    {{ !empty($List->all_listing->paymentinfo->COD_Method_Mode)
                                                                        ? $List->all_listing->paymentinfo->COD_Method_Mode
                                                                        : '' }}
                                                                    On
                                                                    {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount)
                                                                        ? $List->all_listing->paymentinfo->COD_Location_Amount
                                                                        : '' }}
                                                                </td>
                                                                <td>
                                                                    <strong>Pickup:</strong><br>
                                                                    {{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                                                    ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }}
                                                                    )
                                                                    <br>
                                                                    <strong>Delivery:</strong><br>
                                                                    {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                                                    ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }}
                                                                    )
                                                                </td>
                                                                <td>
                                                                    <strong>Created At:</strong><br>
                                                                    {{ $List->all_listing->created_at }}<br>
                                                                    <strong>Modified At:</strong><br>
                                                                    {{ $List->all_listing->updated_at }}
                                                                </td>
                                                                {{-- <td>
                                                                <h6>Status: <span class="badge badge-warning">{{
                                                                        $List->all_listing->Listing_Status }}</span>
                                                                </h6>
                                                                <br>
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
                                                                            class="dropdown-item" role="button">View
                                                                            Detail</a>
                                                                        @if ($List->all_listing->user_id === Auth::guard('Authorized')->user()->id)
                                                                        <a class="dropdown-item rate-order"
                                                                            data-toggle="modal"
                                                                            data-target="#RatingOrderModal"
                                                                            href="javascript:void(0);">
                                                                            <input hidden type="text" class="Listed-ID"
                                                                                value="{{ $List->all_listing->id }}">
                                                                            <input hidden type="text" class="Profile-ID"
                                                                                value="{{ $List->all_listing->authorized_user->id }}">
                                                                            Rate Order</a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                </td> --}}
                                                                    {{-- <td>
                                                                    <h6>Status: <span
                                                                            class="badge badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                                                    </h6><br>
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
                                                                            @if ($List->CMP_id === Auth::guard('Authorized')->user()->id)
                                                                                <a class="dropdown-item rate-order" data-toggle="modal"
                                                                                data-target="#RatingOrderModal" href="javascript:void(0);">
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
                                                                </td> --}}
                                                                <td>
                                                                    <h6>Status: <span
                                                                            class="badge badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                                                    </h6><br>
                                                                    <div class="dropdown show list-actions">
                                                                        <a class="btn btn-success dropdown-toggle btn-sm"
                                                                            href="#" role="button"
                                                                            data-toggle="dropdown"
                                                                            aria-haspopup="true">
                                                                            Actions
                                                                        </a>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item"
                                                                                href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                                                target="_blank">View Route</a>
                                                                            <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                                                class="dropdown-item"
                                                                                role="button">View Detail</a>
                                                                            @if ($List->CMP_id === Auth::guard('Authorized')->user()->id)
                                                                                <a class="dropdown-item rate-order"
                                                                                    data-toggle="modal"
                                                                                    data-target="#RatingOrderModal"
                                                                                    href="javascript:void(0);">
                                                                                    <input hidden type="text"
                                                                                        class="New-Ref-ID"
                                                                                        value="{{ $List->all_listing->Ref_ID }}">
                                                                                    <input hidden type="text"
                                                                                        class="Listed-ID"
                                                                                        value="{{ $List->all_listing->id }}">
                                                                                    <input hidden type="text"
                                                                                        class="Profile-ID"
                                                                                        value="{{ $List->all_listing->completed->completed_user->id }}">
                                                                                    Rate Order</a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        @foreach ($CancelledLisiting as $List)
                                                            @if ($List->all_listing->Is_Rate === 1)
                                                                @continue
                                                            @endif
                                                            <tr class="card-row" data-status="active">
                                                                <td>
                                                                    @if (count($List->all_listing->attachments) > 0)
                                                                        <strong><a
                                                                                href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                                                target="_blank">View
                                                                                Images</a></strong><br>
                                                                    @endif
                                                                    <strong>Ref-ID:</strong>{{ $List->all_listing->Ref_ID }}
                                                                    <br>
                                                                    {{ $List->all_listing->routes->Miles }} miles
                                                                </td>
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
                                                                        <a href="javascript:void(0)" tabindex="0"
                                                                            class="" data-toggle="popover"
                                                                            data-trigger="focus"
                                                                            style="cursor: pointer;"
                                                                            title="Attached vehicles"
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
                                                                        <a href="javascript:void(0)" tabindex="0"
                                                                            class="" data-toggle="popover"
                                                                            data-trigger="focus"
                                                                            style="cursor: pointer;"
                                                                            title="Attached vehicles"
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
                                                                        <a href="javascript:void(0)" tabindex="0"
                                                                            class="" data-toggle="popover"
                                                                            data-trigger="focus"
                                                                            style="cursor: pointer;"
                                                                            title="Attached vehicles"
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
                                                                    <a href="javascript:void(0)" tabindex="0"
                                                                        class="" data-toggle="popover"
                                                                        data-trigger="focus" style="cursor: pointer;"
                                                                        title="Additional Terms"
                                                                        data-content=
                                                                    "{{ !empty($List->all_listing->additional_info->Additional_Terms) ? $List->all_listing->additional_info->Additional_Terms : '' }}">
                                                                        {{ !empty($List->all_listing->additional_info->Additional_Terms) ? Str::limit($List->all_listing->additional_info->Additional_Terms, 20) : '...' }}</a>
                                                                </td>
                                                                <td>
                                                                    <strong><a href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
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
                                                                            href="#" role="button"
                                                                            data-toggle="dropdown"
                                                                            aria-haspopup="true">
                                                                            Actions
                                                                        </a>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item"
                                                                                href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                                                target="_blank">View Route</a>
                                                                            <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                                                class="dropdown-item"
                                                                                role="button">View Detail</a>
                                                                            @if ($List->CMP_id === Auth::guard('Authorized')->user()->id)
                                                                                <a class="dropdown-item rate-order"
                                                                                    data-toggle="modal"
                                                                                    data-target="#RatingOrderModal"
                                                                                    href="javascript:void(0);">
                                                                                    <input hidden type="text"
                                                                                        class="New-Ref-ID"
                                                                                        value="{{ $List->all_listing->Ref_ID }}">
                                                                                    <input hidden type="text"
                                                                                        class="Listed-ID"
                                                                                        value="{{ $List->all_listing->id }}">
                                                                                    <input hidden type="text"
                                                                                        class="Profile-ID"
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
                                                <table
                                                    class="display dataTable datatable-range table-1 advance-786 text-center table-bordered table-cards">
                                                    <thead class="table-header">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Request</th>
                                                            <th>Routes</th>
                                                            <th>Load Details</th>
                                                            <th>Payments</th>
                                                            <th>Dates</th>
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
                                                                    <strong>Ref-ID:</strong>{{ $List->all_listing->Ref_ID }}
                                                                    <br>
                                                                    {{ $List->all_listing->routes->Miles }} miles<br>
                                                                    $
                                                                    {{ number_format(
                                                                        (float) $List->all_listing->paymentinfo->Order_Booking_Price / (float) $List->all_listing->routes->Miles,
                                                                        2,
                                                                        '.',
                                                                        '',
                                                                    ) }}
                                                                    /miles
                                                                </td>
                                                                <td>
                                                                    <strong><a target="_blank"
                                                                            href="{{ route('View.Profile', $List->all_listing->completed->completed_user->id) }}">{{ $List->all_listing->completed->completed_user->Company_Name }}</a></strong><br>
                                                                    <strong><a
                                                                            href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                                            target="_blank">View Contract</a>
                                                                    </strong><br>
                                                                    <strong>PickUp:
                                                                    </strong>{{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                                                    ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                                                                    <br>
                                                                    <strong>Delivery: </strong>
                                                                    {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                                                    ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }}
                                                                    )
                                                                </td>
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
                                                                        <a href="javascript:void(0)" tabindex="0"
                                                                            class="" data-toggle="popover"
                                                                            data-trigger="focus"
                                                                            style="cursor: pointer;"
                                                                            title="Attached vehicles"
                                                                            data-content="@foreach ($List->all_listing->vehicles as $vehcile)
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
                                                                        <a href="javascript:void(0)" tabindex="0"
                                                                            class="" data-toggle="popover"
                                                                            data-trigger="focus"
                                                                            style="cursor: pointer;"
                                                                            title="Attached vehicles"
                                                                            data-content="@foreach ($List->all_listing->heavy_equipments as $vehcile)
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
                                                                            ({{ count($List->all_listing->heavy_equipments) }}
                                                                            )
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
                                                                        <a href="javascript:void(0)" tabindex="0"
                                                                            class="" data-toggle="popover"
                                                                            data-trigger="focus"
                                                                            style="cursor: pointer;"
                                                                            title="Attached vehicles"
                                                                            data-content="@foreach ($List->all_listing->dry_vans as $vehcile)
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
                                                                    <a href="javascript:void(0)" tabindex="0"
                                                                        class="" data-toggle="popover"
                                                                        data-trigger="focus" style="cursor: pointer;"
                                                                        title="Additional Terms"
                                                                        data-content="{{ !empty($List->all_listing->additional_info->Additional_Terms) ? $List->all_listing->additional_info->Additional_Terms : '' }}">
                                                                        {{ !empty($List->all_listing->additional_info->Additional_Terms)
                                                                            ? Str::limit($List->all_listing->additional_info->Additional_Terms, 20)
                                                                            : '...' }}</a>
                                                                </td>
                                                                <td>
                                                                    <strong>Price to Pay:
                                                                    </strong>${{ $List->all_listing->paymentinfo->Order_Booking_Price }}
                                                                    <br>
                                                                    {{-- <strong>Assigned to:
                                                                    </strong>{{ $List->all_listing->completed->completed_user->usr_type }}
                                                                    <br> --}}
                                                                    <strong><a
                                                                            href="https://li-public.fmcsa.dot.gov/LIVIEW/pkg_carrquery.prc_carrlist?s_prefix=MC&n_docketno={{ $List->all_listing->completed->completed_user->Mc_Number }}"
                                                                            target="_blank">View
                                                                            MC</a>&nbsp;&nbsp;<a
                                                                            href="https://li-public.fmcsa.dot.gov/LIVIEW/pkg_carrquery.prc_carrlist?s_prefix=MC&n_docketno={{ $List->all_listing->completed->completed_user->Mc_Number }}"
                                                                            target="_blank">View DOT</a></strong>
                                                                    @if (!empty($List->all_listing->request_broker->Offer_Price) && $List->all_listing->request_broker->Offer_Price !== 0)
                                                                        <br>
                                                                        <strong>Ask Price:
                                                                        </strong>
                                                                        ${{ $List->all_listing->request_broker->Offer_Price }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <strong>Created At:</strong><br>
                                                                    {{ $List->all_listing->created_at }}<br>
                                                                    <strong>Modified At:</strong><br>
                                                                    {{ $List->all_listing->updated_at }}
                                                                </td>
                                                                    {{-- <td>
                                                                    <h6>Status: <span class="badge badge-primary">{{
                                                                            $List->all_listing->Listing_Status }}</span>
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
                                                                                class="dropdown-item" role="button">View
                                                                                Detail</a>
                                                                            @if ($List->all_listing->user_id === $currentUser->id)
                                                                            <a class="dropdown-item rate-order"
                                                                                data-toggle="modal"
                                                                                data-target="#RatingOrderModal"
                                                                                href="javascript:void(0);">
                                                                                <input hidden type="text" class="Listed-ID"
                                                                                    value="{{ $List->all_listing->id }}">
                                                                                <input hidden type="text" class="Profile-ID"
                                                                                    value="{{ $List->all_listing->completed->completed_user->id }}">
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
                                                                            href="#" role="button"
                                                                            data-toggle="dropdown"
                                                                            aria-haspopup="true">
                                                                            Actions
                                                                        </a>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item"
                                                                                href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                                                target="_blank">View Route</a>
                                                                            <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                                                class="dropdown-item"
                                                                                role="button">View Detail</a>
                                                                            @if ($List->all_listing->user_id === Auth::guard('Authorized')->user()->id)
                                                                                <a class="dropdown-item rate-order"
                                                                                    data-toggle="modal"
                                                                                    data-target="#RatingOrderModal"
                                                                                    href="javascript:void(0);">
                                                                                    <input hidden type="text"
                                                                                        class="New-Ref-ID"
                                                                                        value="{{ $List->all_listing->Ref_ID }}">
                                                                                    <input hidden type="text"
                                                                                        class="Listed-ID"
                                                                                        value="{{ $List->all_listing->id }}">
                                                                                    <input hidden type="text"
                                                                                        class="Profile-ID"
                                                                                        value="{{ $List->all_listing->completed->completed_user->id }}">
                                                                                    Rate Order</a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        @foreach ($CancelledLisiting as $List)
                                                            @if ($List->all_listing->Is_Rate === 1)
                                                                @continue
                                                            @endif
                                                            <tr class="card-row" data-status="active">
                                                                <td>
                                                                    @if (count($List->all_listing->attachments) > 0)
                                                                        <strong><a
                                                                                href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                                                target="_blank">View
                                                                                Images</a></strong><br>
                                                                    @endif
                                                                    <strong>Ref-ID:</strong>{{ $List->all_listing->Ref_ID }}
                                                                    <br>
                                                                    {{ $List->all_listing->routes->Miles }} miles
                                                                </td>
                                                                <td>
                                                                    <strong><a target="_blank"
                                                                            href="{{ route('View.Profile', $List->all_listing->cancel->cancel_user->id) }}">{{ $List->all_listing->cancel->cancel_user->Company_Name }}</a></strong><br>
                                                                    <strong><a
                                                                            href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                                            target="_blank">View Contract</a>
                                                                    </strong><br>
                                                                    <strong>PickUp:
                                                                    </strong>{{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                                                    ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                                                                    <br>
                                                                    <strong>Delivery: </strong>
                                                                    {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                                                    ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }})
                                                                </td>
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
                                                                        <a href="javascript:void(0)" tabindex="0"
                                                                            class="" data-toggle="popover"
                                                                            data-trigger="focus"
                                                                            style="cursor: pointer;"
                                                                            title="Attached vehicles"
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
                                                                        <a href="javascript:void(0)" tabindex="0"
                                                                            class="" data-toggle="popover"
                                                                            data-trigger="focus"
                                                                            style="cursor: pointer;"
                                                                            title="Attached vehicles"
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
                                                                        <a href="javascript:void(0)" tabindex="0"
                                                                            class="" data-toggle="popover"
                                                                            data-trigger="focus"
                                                                            style="cursor: pointer;"
                                                                            title="Attached vehicles"
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
                                                                    <a href="javascript:void(0)" tabindex="0"
                                                                        class="" data-toggle="popover"
                                                                        data-trigger="focus" style="cursor: pointer;"
                                                                        title="Additional Terms"
                                                                        data-content=
                                                                    "{{ !empty($List->all_listing->additional_info->Additional_Terms) ? $List->all_listing->additional_info->Additional_Terms : '' }}">
                                                                        {{ !empty($List->all_listing->additional_info->Additional_Terms) ? Str::limit($List->all_listing->additional_info->Additional_Terms, 20) : '...' }}</a>
                                                                </td>
                                                                <td>
                                                                    <strong>Price to Pay:
                                                                    </strong>${{ $List->all_listing->paymentinfo->COD_Amount }}
                                                                    <br>
                                                                    {{-- <strong>Assigned to:
                                                                    </strong>{{ $List->all_listing->cancel->cancel_user->usr_type }}
                                                                    <br> --}}
                                                                    <strong><a
                                                                            href="{{ route('View.Profile', $List->all_listing->cancel->cancel_user->id) }}"
                                                                            target="_blank">View
                                                                            MC</a>&nbsp;&nbsp;<a
                                                                            href="{{ route('View.Profile', $List->all_listing->cancel->cancel_user->id) }}"
                                                                            target="_blank">View DOT</a></strong>
                                                                    @if (!empty($List->all_listing->request_broker->Offer_Price) && $List->all_listing->request_broker->Offer_Price !== 0)
                                                                        <br>
                                                                        <strong>Ask Price:
                                                                        </strong>${{ $List->all_listing->request_broker->Offer_Price }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <strong>Created At:</strong><br>
                                                                    {{ $List->all_listing->created_at }}<br>
                                                                    <strong>Modified At:</strong><br>
                                                                    {{ $List->all_listing->updated_at }}
                                                                </td>
                                                                {{-- <td>
                                                                    <h6>Status: <span
                                                                            class="badge badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                                                    </h6><br>
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
                                                                                        value="{{ $List->all_listing->completed->completed_user->id }}">
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
                                                                            href="#" role="button"
                                                                            data-toggle="dropdown"
                                                                            aria-haspopup="true">
                                                                            Actions
                                                                        </a>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item"
                                                                                href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                                                target="_blank">View Route</a>
                                                                            <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                                                class="dropdown-item"
                                                                                role="button">View Detail</a>
                                                                            @if ($List->all_listing->user_id === Auth::guard('Authorized')->user()->id)
                                                                                <a class="dropdown-item rate-order"
                                                                                    data-toggle="modal"
                                                                                    data-target="#RatingOrderModal"
                                                                                    href="javascript:void(0);">
                                                                                    <input hidden type="text"
                                                                                        class="New-Ref-ID"
                                                                                        value="{{ $List->all_listing->Ref_ID }}">
                                                                                    <input hidden type="text"
                                                                                        class="Listed-ID"
                                                                                        value="{{ $List->all_listing->id }}">
                                                                                    <input hidden type="text"
                                                                                        class="Profile-ID"
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
                                        @endif
                                    </div>
                                </div>

                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="RatingOrderModal" data-backdrop="true" role="dialog" aria-hidden="true">
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
                        <form action="{{ route('View.Profile.Post.Ratings') }}" method="POST"
                            class="was-validated p-3">
                            @csrf
                            {{-- Don’t take too long to respond --}}
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
</div>
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
<script>
    // $('.advance-6').DataTable({
    //     "deferRender": true,
    // });

    // $(document).ready(function () {
    //     $("#comments").hide();
    //     $(".positive-span").hide();
    //     $(".negative-span").hide();
    //     $(".neutral-span").hide();

    //     $("#positive-rate").click(function () {

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

    //     $("#neutral-rate").click(function () {

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

    //     $("#negative-rate").click(function () {

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
    //     $(".rate-order").click(function () {
    //         var getListedID = $(this).find('.Listed-ID').val();
    //         var getProfileID = $(this).find('.Profile-ID').val();
    //         var getRefID = $(this).find('.New-Ref-ID').val();
    //         // console.log('getRefID', getRefID);
    //         $(".get_Order_ID").html(getRefID);
    //         $(".get_Listed_ID").val(getListedID);
    //         $(".get_Profile_ID").val(getProfileID);
    //     });
    //     // Get Profile Info Functionality For Rating Replied
    //     $(".rate-reply").click(function () {
    //         var getListedID = $(this).find('.Listed-ID').val();
    //         var getRateID = $(this).find('.Rate-ID').val();
    //         $(".get_Order_ID").html(getListedID);
    //         $(".get_Listed_ID").val(getListedID);
    //         $(".get_Rate_ID").val(getRateID);
    //     });
    // });
    $(document).ready(function() {
        $("#comments").hide();
        $(".positive-span").hide();
        $(".negative-span").hide();
        $(".neutral-span").hide();

        $("#positive-rate").click(function() {

            $("#positive-rate").hide();
            $("#negative-rate").show();
            $("#neutral-rate").show();

            $(".new-user-box").addClass('active-stats-box');
            $(".upcoming-product-box").removeClass('active-stats-box');
            $(".new-product-box").removeClass('active-stats-box');

            $(".positive-span").show();
            $(".negative-span").hide();
            $(".neutral-span").hide();

            $("#comments").show();
            $("#comments textarea").html("Don’t take too long to respond");

            $("#Ratings").val('Positive');

        });

        $("#neutral-rate").click(function() {

            $("#negative-rate").show();
            $("#positive-rate").show();
            $("#neutral-rate").hide();

            $(".new-user-box").removeClass('active-stats-box');
            $(".upcoming-product-box").addClass('active-stats-box');
            $(".new-product-box").removeClass('active-stats-box');

            $(".neutral-span").show();
            $(".negative-span").hide();
            $(".positive-span").hide();

            $("#comments").show();
            $("#comments textarea").html("");

            $("#Ratings").val('Neutral');

        });

        $("#negative-rate").click(function() {

            $("#negative-rate").hide();
            $("#positive-rate").show();
            $("#neutral-rate").show();

            $(".new-user-box").removeClass('active-stats-box');
            $(".upcoming-product-box").removeClass('active-stats-box');
            $(".new-product-box").addClass('active-stats-box');

            $(".negative-span").show();
            $(".neutral-span").hide();
            $(".positive-span").hide();

            $("#comments").show();
            $("#comments textarea").html("");

            $("#Ratings").val('Negative');

        });

        // Get Profile Info Functionality For Rating Request
        $(".rate-order").click(function() {
            var getListedID = $(this).find('.Listed-ID').val();
            var getProfileID = $(this).find('.Profile-ID').val();
            var getRefID = $(this).find('.New-Ref-ID').val();
            // console.log('getRefID', getRefID);
            $(".get_Order_ID").html(getRefID);
            $(".get_Listed_ID").val(getListedID);
            $(".get_Profile_ID").val(getProfileID);
        });
        // Get Profile Info Functionality For Rating Replied
        $(".rate-reply").click(function() {
            var getListedID = $(this).find('.Listed-ID').val();
            var getRateID = $(this).find('.Rate-ID').val();
            $(".get_Order_ID").html(getListedID);
            $(".get_Listed_ID").val(getListedID);
            $(".get_Rate_ID").val(getRateID);
        });
    });
</script>