@php
    $access = explode(',', $auth_user->sidebar_access);
@endphp
<style>
    .sidebar {
        margin-bottom: 10px;
    }

    .dropdown-btn {
        font-size: 16px;
        border: none;
        background: none;
        cursor: pointer;
        padding: 10px;
        width: 100%;
        text-align: left;
    }

    /*.dropdown-container.active {*/
    /*    display: block;*/
    /*}*/
    /*.dropdown-container {*/
    /*    display: none;*/
    /*    padding-left: 10px;*/
    /*}*/

    .dropdown-container a {
        display: block;
        padding: 8px 16px;
        text-decoration: none;
        color: #333;
    }

    /*.active {*/
    /*    display:block*/
    /*    ;*/
    /*}*/
    .dropdown-container a:hover {
        background-color: #ddd;
    }



    /*.sidebar.active .dropdown-container {*/
    /*    display: block;*/
    /*}*/
</style>
<div class="sidemenu-body">
    <ul class="sidemenu-nav metisMenu h-100" id="sidemenu-nav" data-simplebar>
        <li class="nav-item-title">
            Main Listing
        </li>
        @if (in_array('1', $access))
            <li class="nav-item @yield('Dashboard')">
                <a href="{{ route('User.Dashboard') }}" class="nav-link">
                    <span class="icon"><i class='bx bx-home-circle'></i></span>
                    <span class="menu-title">Dashboard</span>
                    {{-- <span class="badge">2</span> --}}
                </a>
            </li>
        @endif
        @if (in_array('1', $access) && $auth_user->usr_type !== 'Carrier')
            <li class="nav-item">
                <a href="{{ route('User.New.Listing') }}" class="nav-link @yield('New')">
                    <span class="icon"><i class='bx bx-home-circle'></i></span>
                    <span class="menu-title">Create Listing</span>
                    {{-- <span class="badge">2</span> --}}
                </a>
            </li>
        @endif
        <!-- Start New Work -->
        {{--  {{dd($dashboard)}} --}}
        {{-- Start Private Listing Management --}}
        {{-- End Private Listing Management --}}
        <!-- End New Work -->
        {{-- Start Listing Management --}}
        <li class="sidebar nav-item">
            <a href="/" class="dropdown-btn nav-link collapsed" data-toggle="collapse"
                data-target="#dropdown-container">
                <span class="icon"><i class="bx bx-file"></i></span>
                <span class="menu-title">Listing Management &nbsp;<i class="fa-solid fa-caret-down fa-sm"></i></span>
            </a>
            <div class="collapse dropdown-container" id="dropdown-container">
                @if ($verification && $auth_user->usr_type !== 'Carrier')
                    @if (in_array('2', $access))
                        <a href="{{ route('User.New.Listing') }}" class="nav-link @yield('New')">
                            <span class="icon"><i class='bx bx-home-circle'></i></span>
                            <span class="menu-title">New Listing</span>
                            {{-- <span class="badge">2</span> --}}
                        </a>
                    @endif

                    @if (in_array('4', $access))
                        <a href="{{ route('User.Direct.Dispatch') }}" class="nav-link">
                            <span class="icon"><i class='bx bxs-truck'></i></span>
                            <span class="menu-title">Direct Dispatch</span>
                            {{-- <span class="badge"></span> --}}
                        </a>
                    @endif

                    @if (in_array('3', $access))
                        <a href="{{ route('Time.Qoute') }}" class="nav-link @yield('Time_Quote')">
                            <span class="icon"><i class='bx bxs-truck'></i></span>
                            <span class="menu-title">Time Quote</span>
                            <span class="badge">{{ $orderCount['Time_Quote'] }}</span>
                        </a>
                    @endif



                @endif
                @if (in_array('5', $access))
                    <a href="{{ route('User.Listing') }}" class="nav-link @yield('Listing')">
                        <span class="icon"><i class='bx bx-file'></i></span>
                        <span class="menu-title">My Listings</span>
                        <span class="badge">{{ $orderCount['Listed'] }}</span>
                    </a>
                @endif
                @if ($auth_user->usr_type !== 'Carrier')
                    <a href="{{ route('Private.Listing') }}" class="nav-link @yield('Time_Quote')">
                        <span class="icon"><i class='bx bxs-truck'></i></span>
                        <span class="menu-title">Private Listing</span>
                        <span class="badge">{{ $orderCount['pvt_Listing'] }}</span>
                    </a>
                    <a href="{{ route('Deleted.Listing') }}" class="nav-link @yield('Deleted')">
                        <span class="icon"><i class='bx bx-trash'></i></span>
                        <span class="menu-title">Deleted Listing</span>
                        <span class="badge">{{ $orderCount['Deleted'] }}</span>
                    </a>
                @endif
            </div>
        </li>
        {{-- End Listing Management --}}
        {{-- Start Requests/Approval --}}
        <li class="sidebar nav-item">
            <a href="/" class="dropdown-btn nav-link collapsed" data-toggle="collapse"
                data-target="#dropdown-container1">
                <span class="icon"><i class="bx bxs-truck"></i></span>
                <span class="menu-title">Requests/Approval &nbsp;<i class="fa-solid fa-caret-down fa-sm"></i></span>
            </a>
            <div class="collapse dropdown-container" id="dropdown-container1">


                @if ($verification)

                    @if ($auth_user->usr_type !== 'Carrier')
                        @if (in_array('4', $access))
                            <a href="{{ route('My.Misc.Approve') }}" class="nav-link @yield('Misc_Approve')">
                                <span class="icon"><i class='bx bxs-truck'></i></span>
                                <span class="menu-title">Approve Misc Pay.</span>
                                <span class="badge">{{ $orderCount['MiscItems'] }}</span>
                            </a>
                        @endif
                    @endif


                    @if (in_array('6', $access))
                        <a href="{{ route('Requested.Listing') }}" class="nav-link @yield('Requested')">
                            <span class="icon"><i class='bx bx-git-pull-request'></i></span>
                            <span class="menu-title">Requested</span>
                            <span class="badge">{{ $orderCount['Requested'] }}</span>
                        </a>
                    @endif

                    @if (in_array('7', $access))
                        <a href="{{ route('Waitings.Listing') }}" class="nav-link @yield('Waitings')">
                            <span class="icon"><i class='bx bxs-time'></i></span>
                            <span class="menu-title">Waiting Approval</span>
                            <span class="badge">{{ $orderCount['Waiting_Approval'] }}</span>
                        </a>
                    @endif
                @endif

            </div>
        </li>
        {{-- End Requests/Approval --}}
        {{-- Start Shipping Status --}}
        <li class="sidebar nav-item">
            <a href="/" class="dropdown-btn nav-link collapsed" data-toggle="collapse"
                data-target="#dropdown-container2">
                <span class="icon"><i class="bx bx-purchase-tag"></i></span>
                <span class="menu-title">Shipping Status &nbsp;<i class="fa-solid fa-caret-down fa-sm"></i></span>
            </a>
            <div class="collapse dropdown-container" id="dropdown-container2">
                @if ($verification)
                    @if (in_array('8', $access))
                        <a href="{{ route('Dispatch.Listing') }}" class="nav-link @yield('Dispatch')">
                            <span class="icon"><i class='bx bx-purchase-tag'></i></span>
                            <span class="menu-title">Dispatch</span>
                            <span class="badge">{{ $orderCount['Dispatch'] }}</span>
                        </a>
                    @endif
                    {{-- <!-- @if (in_array('9', $access))
                            <a href="{{ route('PickUp.Approval.Listing') }}" class="nav-link @yield('PickUpApproval')">
                                <span class="icon"><i class='bx bxs-truck'></i></span>
                                <span class="menu-title">Pickup Approval</span>
                                <span class="badge">{{ $orderCount['PickUp_Approval'] }}</span>
                            </a>
                        @endif --> --}}
                    @if (in_array('10', $access))
                        <a href="{{ route('PickUp.Listing') }}" class="nav-link @yield('PickUp')">
                            <span class="icon"><i class="fa fa-car"></i></span>
                            <span class="menu-title">Pickup</span>
                            <span class="badge">{{ $orderCount['PickUp'] }}</span>
                        </a>
                    @endif
                    {{-- <!-- @if (in_array('11', $access))
                            <a href="{{ route('Deliver.Approval.Listing') }}" class="nav-link @yield('DeliverApproval')">
                                <span class="icon"><i class='bx bx-box'></i></span>
                                <span class="menu-title">Deliver Approval</span>
                                <span class="badge">{{ $orderCount['Deliver_Approval'] }}</span>
                            </a>
                        @endif --> --}}
                    @if (in_array('12', $access))
                        <a href="{{ route('Delivered.Listing') }}" class="nav-link @yield('Delivered')">
                            <span class="icon"><i class='bx bx-box'></i></span>
                            <span class="menu-title">Delivered</span>
                            <span class="badge">{{ $orderCount['Delivered'] }}</span>
                        </a>
                    @endif
                    @if (in_array('13', $access))
                        <a href="{{ route('Completed.Listing') }}" class="nav-link @yield('Completed')">
                            <span class="icon"><i class='bx bx-shopping-bag'></i></span>
                            <span class="menu-title">Completed</span>
                            <span class="badge">{{ $orderCount['Completed'] }}</span>
                        </a>
                    @endif
                @endif
            </div>
        </li>
        {{-- End Shipping Status --}}
        {{-- Start Shipping Status --}}
        <li class="sidebar nav-item">
            <a href="/" class="dropdown-btn nav-link collapsed" data-toggle="collapse"
                data-target="#dropdown-container3">
                <span class="icon"><i class="bx bx-menu"></i></span>
                <span class="menu-title">Status Managements &nbsp;<i class="fa-solid fa-caret-down fa-sm"></i></span>
            </a>
            <div class="collapse dropdown-container" id="dropdown-container3">
                @if ($verification)
                    @if (in_array('14', $access))
                        <a href="{{ route('Cancelled.Listing') }}" class="nav-link @yield('Cancelled')">
                            <span class="icon"><i class='fa fa-close'></i></span>
                            <span class="menu-title">Cancelled</span>
                            <span class="badge">{{ $orderCount['Cancelled'] }}</span>
                        </a>
                    @endif
                    @if (in_array('15', $access))
                        <a href="{{ route('User.Expired.Listing') }}" class="nav-link @yield('Expired')">
                            <span class="icon"><i class='bx bx-window-close'></i></span>
                            <span class="menu-title">Expired</span>
                            <span class="badge">{{ $orderCount['Expired'] }}</span>
                        </a>
                    @endif
                    @if (in_array('16', $access))
                        <a href="{{ route('User.Archived.Listing') }}" class="nav-link @yield('Archive')">
                            <span class="icon"><i class="fa fa-archive" aria-hidden="true"></i></span>
                            <span class="menu-title">Archived</span>
                            <span class="badge">{{ $orderCount['Archived'] }}</span>
                        </a>
                    @endif
                @endif
            </div>
        </li>
        {{-- End Shipping Status --}}
        {{-- Start Personalization --}}
        <li class="sidebar nav-item">
            <a href="/" class="dropdown-btn nav-link collapsed" data-toggle="collapse"
                data-target="#dropdown-container4">
                <span class="icon"><i class="bx bx-filter-alt"></i></span>
                <span class="menu-title">Personalization &nbsp;<i class="fa-solid fa-caret-down fa-sm"></i></span>
            </a>
            <div class="collapse dropdown-container" id="dropdown-container4">

                @if ($verification)
                    @if (in_array('17', $access))
                        <a href="{{ route('User.Watchlist') }}" class="nav-link @yield('Watchlist')">
                            <span class="icon"><i class='bx bx-heart'></i></span>
                            <span class="menu-title">My Watchlist</span>
                            <span class="badge">{{ $orderCount['WatchList'] }}</span>
                        </a>
                    @endif
                @endif

                @if (in_array('18', $access))
                    <a href="{{ route('Filterd.Listing') }}" class="nav-link @yield('Filter')">
                        <span class="icon"><i class='bx bx-filter-alt'></i></span>
                        <span class="menu-title">Search Load</span>
                        {{-- <span class="badge">2</span> --}}
                    </a>
                @endif
            </div>
        </li>
        {{-- End Personalization --}}
    </ul>
</div>
<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     const dropdownBtns = document.querySelectorAll('.dropdown-btn');

    //     dropdownBtns.forEach(function(btn) {
    //         btn.addEventListener('click', function() {
    //             const dropdownContainer = this.nextElementSibling;
    //             dropdownContainer.classList.toggle('active');
    //         });
    //     });
    // });
</script>