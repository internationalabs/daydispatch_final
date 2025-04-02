<style>
   .shadow-bottom {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Adjust the values as needed */
    }
</style>
<div class="sidemenu-area toggle-sidemenu-area d-sm-none d-block" style="overflow: auto;">
    <div class="sidemenu-header">
        <a href="{{ route('User.Dashboard') }}" class="navbar-brand d-flex align-items-center">
            <img src="{{ asset('frontend/img/logo/logo.png') }}" height="29" width="35" alt="image">
            <span style="font-size: 18px;">Day Dispatch</span>
        </a>
        <div class="burger-menu d-none d-lg-block active">
            <span class="top-bar"></span>
            <span class="middle-bar"></span>
            <span class="bottom-bar"></span>
        </div>
        <div class="responsive-burger-menu d-block d-lg-none">
            <span class="top-bar"></span>
            <span class="middle-bar"></span>
            <span class="bottom-bar"></span>
        </div>
    </div>
    <div class="sidemenu-body">
        <ul class="sidemenu-nav metisMenu h-100" id="sidemenu-nav" data-simplebar>
            <li class="nav-item-title">
                Main Quote
            </li>
            <li class="sidebar nav-item">
                @if (Auth::guard('Authorized')->user()->usr_type == 'Carrier')
                    <a href="#" class="dropdown-btn nav-link" role="button" data-toggle="collapse" data-target="#dropdown-container33">
                        <div class="menu-profile">
                            <span>Search Shipment</span>
                            <i class="fa-solid fa-caret-down" style="margin-bottom: -1px;"></i>
                        </div>
                    </a>
                    <div class="collapse dropdown-container" id="dropdown-container33" >
                        <a href="{{ route('Filterd.Listing') }}" class="nav-link p-2 text-nowrap" >
                            {{-- <div class="menu-profile">
                                <span>Search Load</span>
                            </div> --}}
                            <span class="menu-title">Search Load</span>
                            <span class="badge">5</span>
                        </a>
                        <a href="{{ route('Requested.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="menu-title">Bid Loads</span>
                            <span class="badge">5</span>
                        </a>
                        <a href="{{ route('Waitings.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="menu-title">Waiting Approval</span>
                            <span class="badge">5</span>
                        </a>
                        <a href="{{ route('Dispatch.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="menu-title">Dispatch</span>
                            <span class="badge">5</span>
                        </a>
                        <a href="{{ route('PickUp.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="menu-title">Pickup</span>
                            <span class="badge">5</span>
                        </a>
                        <a href="{{ route('Delivered.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="menu-title">Delivered</span>
                            <span class="badge">5</span>
                        </a>
                        <a href="{{ route('User.Archived.Listing') }}" class="nav-link p-2 text-nowrap">
                            
                            <span class="">Archived</span>
                        </a>
                        <a href="{{ route('Cancelled.Listing') }}" class="nav-link p-2 text-nowrap">
                            
                            <span class="">Cancelled</span>
                        </a>
                        <a href="{{ route('User.Watchlist') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=''></i></span>
                            <span class="menu-title">My Watchlist</span>
                            <span class="badge">5</span>
                        </a>
                        {{-- @if (Auth::guard('Authorized')->user()->usr_type === 'Carrier')
                            <a href="{{ route('Completed.Listing') }}" class="nav-link p-2 text-nowrap">
                                <span class="menu-title">Completed</span>
                                <span class="badge">5</span>
                            </a>
                        @endif --}}
                        {{-- <a href="{{ route('User.New.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="menu-title">New Listing</span>
                            <span class="badge">5</span>
                        </a>
                        <a href="{{ route('User.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="menu-title">My Listings</span>
                            <span class="badge">5</span>
                        </a> --}}
                    </div>
                @else
                    <a href="#" class="dropdown-btn nav-link" role="button" data-toggle="collapse" data-target="#dropdown-container35">
                        <div class="menu-profile">
                            <span>Move Shipment</span>
                            <i class="fa-solid fa-caret-down" style="margin-bottom: -1px;"></i>
                        </div>
                    </a>
                    <div class="collapse dropdown-container" id="dropdown-container35" >
                        <a href="{{ route('User.New.Listing') }}" class="nav-link p-2 text-nowrap">
                            
                            <span class="">New Listing</span>
                            <span class="badge">3</span>
                        </a>
                        <a href="{{ route('User.Listing') }}" class="nav-link p-2 text-nowrap">
                            
                            <span class="">My Listings</span>
                            <span class="badge">3</span>
                        </a>
                        <a href="{{ route('Requested.Listing') }}" class="nav-link p-2 text-nowrap">
                            
                            <span class="">Bid Loads</span>
                            <span class="badge">3</span>
                        </a>
                        <a href="{{ route('Waitings.Listing') }}" class="nav-link p-2 text-nowrap">
                            
                            <span class="">Waiting Approval</span>
                            <span class="badge">3</span>
                        </a>
                        <a href="{{ route('Dispatch.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="">Dispatch</span>
                            <span class="badge">3</span>
                        </a>
                        <a href="{{ route('PickUp.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="">Pickup</span>
                            <span class="badge">3</span>
                        </a>
                        <a href="{{ route('Delivered.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="">Delivered</span>
                            <span class="badge">3</span>
                        </a>
                        <a href="{{ route('User.Archived.Listing') }}" class="nav-link p-2 text-nowrap">
                            
                            <span class="">Archived</span>
                        </a>
                        <a href="{{ route('Cancelled.Listing') }}" class="nav-link p-2 text-nowrap">
                            
                            <span class="">Cancelled</span>
                        </a>
                        @if (Auth::guard('Authorized')->user()->usr_type != 'Carrier')
                         <a href="{{ route('Private.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=""></i></span>
                            <span class="menu-title">Private Listing</span>
                            <span class="badge"></span>
                         </a>
                        @endif
                    </div>
                @endif
            </li>
            <li class="sidebar nav-item">
                <a href="#" class="dropdown-btn nav-link" role="button" data-toggle="collapse" data-target="#dropdown-container37">
                    <div class="menu-profile">
                        <span class="">Resources</span>
                        <i class="fa-solid fa-caret-down" style="margin-bottom: -1px;"></i>
                    </div>
                </a>
                <div class="collapse dropdown-container" id="dropdown-container37" >
                    <a href="{{ route('Filterd.Listing') }}" target="_blank" class="nav-link p-2 text-nowrap">
                        <i class='bx bx-filter-alt'></i> Filter
                    </a>
                    <a href="{{ route('View.Google.TruckSpace') }}" class="nav-link p-2 text-nowrap">
                        <i class='bx bxs-truck'></i> Truck Space
                    </a>
                    <a href="{{ route('View.Packages') }}" target="_blank" class="nav-link p-2 text-nowrap">
                        <i class="bx bx-dollar-circle"></i> Pricing
                    </a>
                    <a href="{{ route('task.calendar') }}" target="_blank" class="nav-link p-2 text-nowrap">
                        <i class="fas fa-calendar fa-sm"></i> Task Calendar
                    </a>
                    @php
                        $Check_Status = App\Models\Payments\PaymentSystem::where('id', '=', 6)->find(6);
                    @endphp
                    @if ($Check_Status->Payment_Switch === 0)
                        <a href="{{ route('number.of.login') }}" target="_blank" class="nav-link p-2 text-nowrap">
                            <i class="fas fa-chair fa-sm"></i> Pay For Seats
                        </a>
                    @endif
                    <a href="{{ route('borderWaitTime.index') }}" class="nav-link p-2 text-nowrap">
                        Border Wait Time
                    </a>
                    <a href="https://www.eia.gov/petroleum/gasdiesel/" target="_blank" class="nav-link p-2 text-nowrap">
                        Fuel Price
                    </a>
                    <a href="https://safer.fmcsa.dot.gov/CompanySnapshot.aspx" target="_blank" class="nav-link p-2 text-nowrap">
                        FMCSA Search
                    </a>
                    <a target="_blank" href="https://www.google.com/maps/place/United+States/@36.0182818,-161.6911694,3z/data=!3m1!4b1!4m6!3m5!1s0x54eab584e432360b:0x1c3bb99243deb742!8m2!3d37.09024!4d-95.712891!16zL20vMDljN3cw?entry=ttu" class="nav-link p-2 text-nowrap">
                        Google Maps
                    </a>
                </div> 
            </li>
            <li class="sidebar nav-item">
                <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" >
                    <div class="menu-profile">
                        <span>Status Management</span>
                        <i class="fa-solid fa-caret-down" style="margin-bottom: -1px;"></i>
                    </div>
                </a>
                <div class="dropdown-menu"  style="background: white;position: absolute;z-index: 1000;left: 0px;padding: 5px 5px;">
                    
                    <a href="{{ route('User.Watchlist') }}" class="nav-link p-2 text-nowrap">
                        <span class="icon"><i class=''></i></span>
                        <span class="menu-title">My Watchlist</span>
                    </a>
                    @if (Auth::guard('Authorized')->user()->usr_type !== 'Carrier')
                        <a href="{{ route('Filterd.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=''></i></span>
                            <span class="menu-title">Search Load</span>
                        </a>
                    @endif
                </div>
            </li>
        </ul>
    </div>
</div>
<nav class="DamyNavbar">
</nav>
<nav class="navbar navbar-expand-lg d-inline top-navbar px-4 navbar-expand toggle-navbar-area toggle-navbar-area-2 shadow-bottom hide-sidemenu-area">
    <div class="collapse navbar-collapse" id="navbarSupportContent">
        <div class="responsive-burger-menu d-block d-lg-none">
            <span class="top-bar"></span>
            <span class="middle-bar"></span>
            <span class="bottom-bar"></span>
        </div>    
        <ul class="navbar-nav pr-5 align-items-center d-none d-sm-block">
            <li class="nav-item">
                <a href="{{ route('User.Dashboard') }}">
                    <img src="{{ asset('frontend/img/logo/logo.png') }}" style=" max-width: fit-content;"
                        alt="Logo">
                </a>
            </li>
        </ul>
        <ul class="navbar-nav left-nav align-items-center">
            <li class="nav-item dropdown profile-nav-item">
                @if (Auth::guard('Authorized')->user()->usr_type == 'Carrier')
                    <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">
                        <div class="menu-profile">
                            <span>Search Shipment</span>
                            <i class="fa-solid fa-caret-down" style="margin-bottom: -1px;"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu" style="background: white;position: absolute;z-index: 1000;left: 0px;padding: 5px 5px;">
                        <a href="{{ route('Filterd.Listing') }}" class="nav-link p-2 text-nowrap" >
                            {{-- <div class="menu-profile">
                                <span>Search Load</span>
                            </div> --}}
                            <span class="icon"><i class=""></i></span>
                            <span class="menu-title">Search Load</span>
                            <span class="badge"></span>
                        </a>
                        <a href="{{ route('Requested.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=""></i></span>
                            <span class="menu-title">Bid / Request</span>
                            <span class="badge"></span>
                        </a>
                        <a href="{{ route('Waitings.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=""></i></span>
                            <span class="menu-title">Waiting Approval</span>
                            <span class="badge"></span>
                        </a>
                        <a href="{{ route('Dispatch.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=''></i></span>
                            <span class="menu-title">Dispatch</span>
                            <span class="badge"></span>
                        </a>
                        <a href="{{ route('PickUp.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=''></i></span>
                            <span class="menu-title">Pickup</span>
                            <span class="badge"></span>
                        </a>
                        <a href="{{ route('Delivered.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=''></i></span>
                            <span class="menu-title">Delivered</span>
                            <span class="badge"></span>
                        </a>
                        <a href="{{ route('User.Archived.Listing') }}" class="nav-link p-2 text-nowrap">
                            
                            <span class="">Archived</span>
                        </a>
                        <a href="{{ route('Cancelled.Listing') }}" class="nav-link p-2 text-nowrap">
                            
                            <span class="">Cancelled</span>
                        </a>
                        <a href="{{ route('User.Watchlist') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=''></i></span>
                            <span class="menu-title">My Watchlist</span>
                        </a>
                        {{-- @if (Auth::guard('Authorized')->user()->usr_type === 'Carrier')
                            <a href="{{ route('Completed.Listing') }}" class="nav-link p-2 text-nowrap">
                                <span class="icon"><i class=''></i></span>
                                <span class="menu-title">Completed</span>
                                <span class="badge"></span>
                            </a>
                        @endif --}}
                        {{-- <a href="{{ route('User.New.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=""></i></span>
                            <span class="menu-title">New Listing</span>
                            <span class="badge"></span>
                        </a>
                        <a href="{{ route('User.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=""></i></span>
                            <span class="menu-title">My Listings</span>
                            <span class="badge"></span>
                        </a> --}}
                    </div>
                    {{-- <a href="{{ route('Filterd.Listing') }}" class="nav-link dropdown-toggle" role="button"
                        data-target="#dropdown-container" aria-haspopup="true" aria-expanded="false">
                        <div class="menu-profile">
                            <span>Search Load</span>
                        </div>
                    </a> --}}
                @else
                    <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">
                        <div class="menu-profile">
                            <span>Move Shipment</span>
                            <i class="fa-solid fa-caret-down" style="margin-bottom: -1px;"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu" style="background: white;position: absolute;z-index: 1000;left: 0px;padding: 5px 5px;">
                        <a href="{{ route('User.New.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=""></i></span>
                            <span class="menu-title">New Listing</span>
                            <span class="badge"></span>
                        </a>
                        @php
                            $user_ver = Auth::guard('Authorized')->user();
                        @endphp
                        @if ($user_ver && $user_ver->admin_verify == 0)
                        <a href="{{ route('User.Direct.Dispatch') }}" class="nav-link p-2 text-nowrap disabled" style="color: grey">
                            <span class="">Direct Dispatch</span>
                            <span class="badge">3</span>
                        </a>
                        @else
                        <a href="{{ route('User.Direct.Dispatch') }}" class="nav-link p-2 text-nowrap">
                            <span class="">Direct Dispatch</span>
                            <span class="badge">3</span>
                        </a>
                        @endif
                        
                        <a href="{{ route('User.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=""></i></span>
                            <span class="menu-title">My Listings</span>
                            <span class="badge"></span>
                        </a>
                        <a href="{{ route('Requested.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=""></i></span>
                            <span class="menu-title">Bid / Request</span>
                            <span class="badge"></span>
                        </a>
                        <a href="{{ route('Waitings.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=""></i></span>
                            <span class="menu-title">Waiting Approval</span>
                            <span class="badge"></span>
                        </a>
                        <a href="{{ route('Dispatch.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=''></i></span>
                            <span class="menu-title">Dispatch</span>
                            <span class="badge"></span>
                        </a>
                        <a href="{{ route('PickUp.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=''></i></span>
                            <span class="menu-title">Pickup</span>
                            <span class="badge"></span>
                        </a>
                        <a href="{{ route('Delivered.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=''></i></span>
                            <span class="menu-title">Delivered</span>
                            <span class="badge"></span>
                        </a>
                        <a href="{{ route('User.Archived.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=""></i></span>
                            <span class="menu-title">Archived</span>
                        </a>
                        <a href="{{ route('Cancelled.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=""></i></span>
                            <span class="menu-title">Cancelled</span>
                        </a>
                        @if (Auth::guard('Authorized')->user()->usr_type != 'Carrier')
                        <a href="{{ route('Private.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=""></i></span>
                            <span class="menu-title">Private Listing</span>
                            <span class="badge"></span>
                        </a>
                    @endif
                    </div>
                @endif
            </li>
            <li class="nav-item dropdown profile-nav-item">
                {{-- <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" >
                    <div class="menu-profile">
                        <span class="">Shipping Status</span>
                        <i class="fa-solid fa-caret-down" style="margin-bottom: -1px;"></i>
                    </div>
                </a> --}}
                <div class="dropdown-menu"  style="background: white;position: absolute;z-index: 1000;left: 0px;padding: 5px 5px;">
                    @if (Auth::guard('Authorized')->user()->usr_type != 'Carrier')
                        <a href="{{ route('Private.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=""></i></span>
                            <span class="menu-title">Private Listing</span>
                            <span class="badge"></span>
                        </a>
                    @endif
                    {{-- <a href="{{ route('Requested.Listing') }}" class="nav-link p-2 text-nowrap">
                        <span class="icon"><i class=""></i></span>
                        <span class="menu-title">Bid Loads</span>
                        <span class="badge"></span>
                    </a>
                    <a href="{{ route('Waitings.Listing') }}" class="nav-link p-2 text-nowrap">
                        <span class="icon"><i class=""></i></span>
                        <span class="menu-title">Waiting Approval</span>
                        <span class="badge"></span>
                    </a>
                    <a href="{{ route('Dispatch.Listing') }}" class="nav-link p-2 text-nowrap">
                        <span class="icon"><i class=''></i></span>
                        <span class="menu-title">Dispatch</span>
                        <span class="badge"></span>
                    </a>
                    <a href="{{ route('PickUp.Listing') }}" class="nav-link p-2 text-nowrap">
                        <span class="icon"><i class=''></i></span>
                        <span class="menu-title">Pickup</span>
                        <span class="badge"></span>
                    </a>
                    <a href="{{ route('Delivered.Listing') }}" class="nav-link p-2 text-nowrap">
                        <span class="icon"><i class=''></i></span>
                        <span class="menu-title">Delivered</span>
                        <span class="badge"></span>
                    </a> --}}
                    {{-- @if (Auth::guard('Authorized')->user()->usr_type === 'Carrier')
                        <a href="{{ route('Completed.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=''></i></span>
                            <span class="menu-title">Completed</span>
                            <span class="badge"></span>
                        </a>
                    @endif --}}
                </div>
            </li>
            <li class="nav-item dropdown profile-nav-item">
                {{-- <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" >
                    <div class="menu-profile">
                        <span>Status Management</span>
                        <i class="fa-solid fa-caret-down" style="margin-bottom: -1px;"></i>
                    </div>
                </a> --}}
                <div class="dropdown-menu"  style="background: white;position: absolute;z-index: 1000;left: 0px;padding: 5px 5px;">
                    {{-- <a href="{{ route('Cancelled.Listing') }}" class="nav-link p-2 text-nowrap">
                        <span class="icon"><i class=""></i></span>
                        <span class="menu-title">Cancelled</span>
                    </a> --}}
                    {{-- @if (Auth::guard('Authorized')->user()->usr_type === 'Carrier')
                        <a href="{{ route('User.Expired.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=""></i></span>
                            <span class="menu-title">Expired</span>
                        </a>
                    @endif --}}
                    {{-- <a href="{{ route('User.Archived.Listing') }}" class="nav-link p-2 text-nowrap">
                        <span class="icon"><i class=""></i></span>
                        <span class="menu-title">Archived</span>
                    </a> --}}
                    {{-- @if (Auth::guard('Authorized')->user()->usr_type === 'Carrier')
                        <a href="{{ route('Deleted.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=""></i></span>
                            <span class="menu-title">Deleted</span>
                        </a>
                    @endif --}}
                    {{-- <a href="{{ route('User.Watchlist') }}" class="nav-link p-2 text-nowrap">
                        <span class="icon"><i class=''></i></span>
                        <span class="menu-title">My Watchlist</span>
                    </a> --}}
                    @if (Auth::guard('Authorized')->user()->usr_type !== 'Carrier')
                        <a href="{{ route('Filterd.Listing') }}" class="nav-link p-2 text-nowrap">
                            <span class="icon"><i class=''></i></span>
                            <span class="menu-title">Search Load</span>
                        </a>
                    @endif
                    <div class="dropdown-submenu">
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="dropdown-submenu">
                                <a href="#" class="dropdown-item">
                                    <span class="icon"><i class=""></i></span>
                                    <span class="menu-title">Resources</span>
                                </a>
                            </li>
                        </ul>
                        <div class="dropdown-menu" style="background: white; z-index: 1000; padding: 10px;">
                            <a href="{{ route('Filterd.Listing') }}" target="_blank" class="dropdown-item">
                                <i class='bx bx-filter-alt'></i> Filter
                            </a>
                            <a href="{{ route('View.Google.TruckSpace') }}" class="dropdown-item">
                                <i class='bx bxs-truck'></i> Truck Space
                            </a>
                            <a href="{{ route('View.Packages') }}" target="_blank" class="dropdown-item">
                                <i class="bx bx-dollar-circle"></i> Pricing
                            </a>
                            <a href="{{ route('task.calendar') }}" target="_blank" class="dropdown-item">
                                <i class="fas fa-calendar fa-sm"></i> Task Calendar
                            </a>
                            @php
                                $Check_Status = App\Models\Payments\PaymentSystem::where('id', '=', 6)->find(6);
                            @endphp
                            @if ($Check_Status->Payment_Switch === 0)
                                <a href="{{ route('number.of.login') }}" target="_blank" class="dropdown-item">
                                    <i class="fas fa-chair fa-sm"></i> Pay For Seats
                                </a>
                            @endif
                            <a href="{{ route('borderWaitTime.index') }}" class="dropdown-item">
                                Border Wait Time
                            </a>
                            <a href="https://www.eia.gov/petroleum/gasdiesel/" target="_blank" class="dropdown-item">
                                Fuel Price
                            </a>
                            <a href="https://safer.fmcsa.dot.gov/CompanySnapshot.aspx" target="_blank" class="dropdown-item">
                                FMCSA Search
                            </a>
                            <a target="_blank" href="https://www.google.com/maps/place/United+States/@36.0182818,-161.6911694,3z/data=!3m1!4b1!4m6!3m5!1s0x54eab584e432360b:0x1c3bb99243deb742!8m2!3d37.09024!4d-95.712891!16zL20vMDljN3cw?entry=ttu" class="dropdown-item">
                                Google Maps
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="parentOfSreach">
            <form class="nav-search-form d-none ml-auto d-md-block" method="POST"
                action="{{ route('User.Company.Search') }}">
                @csrf
                <label><i class='bx bx-search'></i></label>
                @php
                    $user_ver = Auth::guard('Authorized')->user();
                @endphp
                @if ($user_ver && $user_ver->admin_verify == 0)                
                <input type="text" class="form-control Search-Bar" name="Search_Bar"
                    placeholder="Search Company... (Verify Your Account)" value="" disabled>
                @else
                <input type="text" class="form-control Search-Bar" id="check-search-field" name="Search_Bar"
                placeholder="Search Company..." value="">
                <input type="submit" id="myBtn" hidden />
                @endif
            </form>
            <div class="CMP-User-List"></div>
        </div>
        <ul class="navbar-nav right-nav align-items-center">
            <li class="nav-item">
                <a class="nav-link bx-fullscreen-btn" id="fullscreen-button">
                    <i class="bx bx-fullscreen"></i>
                </a>
            </li>
            {{-- <li class="nav-item message-box dropdown show">
                <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <div class="message-btn">
                        <i class="bx bx-envelope" style="animation: ring 4s .7s ease-in-out infinite;"></i>
                        <span class="badge badge-primary">4</span>
                    </div>
                </a>
                @php
                     $msgs = App\Models\Extras\MessageNotifications::where('recipient_id', Auth::guard('Authorized')->user()->id)
                        ->where('is_read', '0')
                        ->latest('id')
                        ->limit(5)
                        ->get();
                @endphp
                <div class="dropdown-menu">
                    <div class="dropdown-header d-flex justify-content-between align-items-center">
                        <span class="title d-inline-block">{{ count($msgs) }} New Message</span>
                        <span class="clear-all-btn d-inline-block">Clear All</span>
                    </div>
                    <div class="dropdown-body">
                        @foreach ($msgs as $row)
                            <a href="{{ route('chat', $row->user_id) }}" class="dropdown-item d-flex align-items-center">
                                <div class="figure">
                                    <div class="icon" style="width: 50px; height: 50px; border-radius: 10%;">
                                        <i class="bx bx-message-rounded-dots" style="font-size: 1.5rem;"></i>
                                    </div>
                                </div>
                                <div class="content d-flex justify-content-between align-items-center">
                                    <div class="text">
                                        <p class="sub-text mb-0">{{ $row->notification }}</p>
                                    </div>
                                    <p class="time-text mb-0">{{ date('H:i:s', strtotime($row->created_at)) }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    @if ($currentUser->usr_type === 'Carrier')
                    <div class="dropdown-footer">
                        <a href="#" class="dropdown-item">View All</a>
                    </div>
                    @else
                    <div class="dropdown-footer">
                        <a href="#" class="dropdown-item">View All</a>
                    </div>
                    @endif
                    
                </div>
            </li> --}}
            <li class="nav-item notification-box dropdown Notification">
            </li>
            <li class="nav-item message-box dropdown Message">
            </li>
                @if ($verification)
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="User Verified">
                <a class="nav-link verify-user" style="color: green;">
                    <i class='bx bxs-check-shield'></i>
                </a>
            </li>
                @endif
            <li class="nav-item dropdown profile-nav-item" >
                <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <div class="menu-profile">
                        <span
                            class="name">{{ \Illuminate\Support\Str::limit($currentUser->Company_Name, $limit = 21, '...') }}</span>
                        <i class="fa-solid fa-caret-down" style="margin-bottom: -1px;"></i>
                        <img src="{{ $currentUser->profile_photo_path ? url($currentUser->profile_photo_path) : asset('backend/img/user1.jpg') }}"
                            class="rounded-circle" alt="image">
                    </div>
                </a>
                <div class="dropdown-menu  "
                    style="background-color: white; border: 3px solid #1e2d62; border-radius: 25px; z-index: 999; ">
                    <div class="dropdown-header d-flex flex-column align-items-center">
                        <div class="figure mb-3">
                            <img src="{{ $currentUser->profile_photo_path ? url($currentUser->profile_photo_path) : asset('backend/img/user1.jpg') }}"
                                class="rounded-circle" alt="image">
                        </div>
                        <div class="info text-center">
                            <span class="name">
                                {{ $currentUser->name }} <br>
                                {{ $currentUser->usr_type }}
                            </span>
                            <p class="mb-3 email"><a href="mailto:{{ $currentUser->email }}"
                                    class="__cf_email__">[{{ $currentUser->email }}]</a>
                            </p>
                        </div>
                        @if ($currentUser->usr_type == 'Dispatcher' && $currentUser->ref_code_dispatcher != null)
                            <span class="name">
                                Ref. Code: {{ $currentUser->ref_code_dispatcher }}
                            </span>
                        @endif
                        @if (Auth::guard('Authorized')->user()->dispatcher()->exists())
                            @if (Auth::guard('Authorized')->user()->usr_type == 'Dispatcher')
                                <div class="info text-center">
                                    @php
                                        $All_Users = App\Models\Extras\ManagedUser::with('user')
                                            ->where('dispatcher_id', Auth::guard('Authorized')->user()->id)
                                            ->get();

                                        $checkMe = App\Models\Extras\ManagedUser::with('user')
                                            ->where('dispatcher_id', Auth::guard('Authorized')->user()->id)
                                            ->first();
                                    @endphp

                                    @if ($All_Users && $checkMe->user)
                                        <span class="name">
                                            I Manage
                                        </span>
                                        @foreach ($All_Users as $row)
                                            <a
                                                href="{{ route('switch.managed.user', $row->user->id) }}">{{ $row->user->Company_Name }}</a>
                                            <br>
                                        @endforeach
                                    @endif
                                </div>
                            @endif
                        @endif
                        @if (Auth::guard('Authorized')->user()->managedUsers)
                            <div class="info text-center">
                                @php
                                    $user = App\Models\Extras\ManagedUser::with('dispatcher')
                                        ->where('user_id', Auth::guard('Authorized')->user()->id)
                                        ->first();
                                @endphp

                                @if ($user && $user->dispatcher)
                                    <span class="name">
                                        Managed By
                                    </span>

                                    <a href="{{ route('Auth.Forms') }}">{{ $user->dispatcher->Company_Name }}</a>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="dropdown-body" >
                        <ul class="profile-nav p-0 pt-3">
                            <li class="nav-item">
                                <a href="{{ route('User.Profile') }}" class="nav-link">
                                    <i class='bx bx-user'></i> <span>Account Settings</span>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link">
                                    <i class='bx bx-user'></i> <span>Add Account</span>
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                                    <i class='bx bx-user'></i> <span>Add Account</span>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ route('View.MyReports') }}" class="nav-link">
                                    <i class='bx bx-user'></i> <span>My Report</span>
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="{{ route('View.Profile.Ratings', ['user_id' => $currentUser->id]) }}"
                                    class="nav-link">
                                    <i class='bx bx-star'></i> <span>My Ratings</span>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ route('My.Tickets') }}" class="nav-link">
                                    <i class='bx bx-extension'></i> <span>3-Way Support</span>
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="{{ route('View.Notification', ['user_id' => $currentUser->id]) }}"
                                    class="nav-link">
                                    <i class='bx bx-detail'></i> <span>My Notifications</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="dropdown-footer " >
                        <ul class="profile-nav">
                            <li class="nav-item">
                                <a href="{{ route('User.LogOut') }}" class="nav-link">
                                    <i class='bx bx-log-out'></i> <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>