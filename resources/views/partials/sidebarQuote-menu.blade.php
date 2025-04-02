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
            Main Quote
        </li>
        {{-- End Personalization --}}
        @if ($auth_user->usr_type !== 'Carrier')
            <li class="sidebar nav-item">
                <a href="/" class="dropdown-btn nav-link collapsed" data-toggle="collapse"
                    data-target="#dropdown-container33">
                    <span class="icon"><i class="bx bx-user"></i></span>
                    <span class="menu-title">Manage Customer &nbsp;<i class="fa-solid fa-caret-down fa-sm"></i></span>
                </a>
                <div class="collapse dropdown-container" id="dropdown-container33">
                    <a href="{{ route('User.New.Quote') }}" class="nav-link @yield('New')">
                        <span class="icon"><i class='bx bx-home-circle'></i></span>
                        <span class="menu-title">Create New Quote</span>
                    </a>
                    @php
                        $count = isset($orderQuoteCount['statusCounts']['New Quote'])
                            ? $orderQuoteCount['statusCounts']['New Quote']
                            : 0;
                    @endphp
                    <a href="{{ route('New.Order') }}" class="nav-link @yield('New')">
                        <span class="icon"><i class='bx bx-home-circle'></i></span>
                        <span class="menu-title">New Quotes</span>
                        <span class="badge">{{ $count }}</span>
                    </a>


                    @php
                        $sidebarOptions = App\Models\SidebarOption::where('user_id', $auth_user->id)->get();
                        $orders = App\Models\Quote\Order::where('user_id', $auth_user->id)->get();
                    @endphp

                    @foreach ($sidebarOptions as $sidebarOption)
                        @php
                            $count = isset($orderQuoteCount['statusCounts'][$sidebarOption->name])
                                ? $orderQuoteCount['statusCounts'][$sidebarOption->name]
                                : 0;
                        @endphp
                        <a href="{{ route('Custom.Quote.Folder', $sidebarOption->name) }}" class="nav-link">
                            <span class="icon"><i class='bx bx-home-circle'></i></span>
                            <span class="menu-title">{{ $sidebarOption->name }}</span>

                            <span class="badge">{{ $count }}</span>
                        </a>
                        <ul class="sidebar-menu">
                            @foreach ($orders as $order)
                                @if ($order->Listing_Status == $sidebarOption->name)
                                @endif
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </li>
        @endif
        <hr>

        @php
            $count = isset($orderQuoteCount['Book_Order'])
                ? $orderQuoteCount['Book_Order']
                : 0;
        @endphp
        <li class="sidebar nav-item">
            <a href="{{ route('Book.Order') }}" class="nav-link">
                <span class="icon"><i class='bx bx-file'></i></span>
                <span class="menu-title">Book Order</span>
                <span class="badge">{{ $count }}</span>
            </a>
        </li>
        <!-- @php
            $count = isset($orderQuoteCount['Deleted'])
                ? $orderQuoteCount['Deleted']
                : 0;
        @endphp -->

        <li class="sidebar nav-item">
            <a href="{{ route('Deleted.Quote') }}" class="nav-link">
                <span class="icon"><i class='bx bx-trash'></i></span>
                <span class="menu-title">Deleted Order</span>
                <span class="badge">{{ $orderQuoteCount['Deleted'] ?? 0 }}</span>
            </a>
        </li>

        <li class="sidebar nav-item">
            <a href="{{ route('Cancelled.Quote') }}" class="nav-link">
                <span class="icon"><i class='fa fa-close'></i></span>
                <span class="menu-title">Cancelled Order</span>
                <span class="badge">{{ $orderQuoteCount['Cancelled'] ?? 0 }}</span>
            </a>
        </li>

        <li class="sidebar nav-item">
            <a href="{{ route('sidebar-options.customer') }}" class="nav-link">
                <span class="icon"><i class='bx bx-plus'></i></span>
                <span class="menu-title">Customer List</span>
            </a>
        </li>

        <li class="sidebar nav-item">
            <a href="{{ route('sidebar-options.create') }}" class="nav-link @yield('New')">
                <span class="icon"><i class='bx bx-plus'></i></span>
                <span class="menu-title">Custom Status</span>
            </a>
        </li>

        <li class="sidebar nav-item">
            <a href="{{ route('order.form.setting') }}" class="nav-link">
                <span class="icon"><i class='bx bx-cog'></i></span>
                <span class="menu-title">Order Form Setting</span>
            </a>
        </li>

        <li class="sidebar nav-item">
            <a href="{{ route('quote.timeline') }}" class="nav-link">
                <span class="icon"><i class='bx bx-cog'></i></span>
                <span class="menu-title">Timeline</span>
            </a>
        </li>        

        <li class="sidebar nav-item">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#webMailModal">
                <!-- <span class="icon"><i class='bx bx-file'></i></span> -->
                <span class="icon icon-mail">
                    <svg width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" d="M12 13.6l11.6-8.6H2.4L12 13.6zm0 1.2L0 6v12c0 1.1.9 2 2 2h20c1.1 0 2-.9 2-2V6l-12 8.8z"/>
                    </svg>
                </span>               
                <span class="menu-title">WebMail</span>
            </a>
        </li>

        {{-- <div class="timeline mb-30">
            <div class="timeline-month">
                January, 2020
            </div>
            <div class="timeline-section">
                <div class="timeline-date">
                    21, Tuesday
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="timeline-box">
                            <div class="box-title">
                                <i class="bx bxs-florist"></i> Job Created
                            </div>
                            <div class="box-content">
                                <div class="box-item"><p class="mb-0">Dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde?</p></div>
                                <div class="box-item"><strong>Loss Type</strong>: A/C Leak</div>
                                <div class="box-item"><strong>Loss Territory</strong>: Texas</div>
                                <div class="box-item"><strong>Start Date</strong>: 08/22/2018</div>
                            </div>
                            <div class="box-footer">- Andro Smith</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="timeline-box">
                            <div class="box-title">
                                <i class="bx bx-edit"></i> Job Edited
                            </div>
                            <div class="box-content">
                                <div class="box-item"><strong>Project Manager</strong>: Marlyn</div>
                                <div class="box-item"><strong>Supervisor</strong>: Carol</div>
                            </div>
                            <div class="box-footer">- Andro Smith</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="timeline-section">
                <div class="timeline-date">
                    22, Wednesday
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="timeline-box">
                            <div class="box-title">
                                <i class="bx bx-edit"></i> Job Edited
                            </div>
                            <div class="box-content">
                                <div class="box-item"><strong>Extraction Type</strong>: Carpet Heavy</div>
                                <div class="box-item"><strong>Water Category</strong>: 4</div>
                                <div class="box-item"><strong>No. Of Tech</strong>: 6</div>
                                <div class="box-item"><strong>Est. Complation</strong>: 09/01/2018</div>
                            </div>
                            <div class="box-footer">- Andro Smith</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="timeline-box">
                            <div class="box-title">
                                <i class="bx bx-task"></i> New Job To Do
                            </div>
                            <div class="box-content">
                                <div class="box-item"><strong>Employee</strong>: Sam</div>
                                <div class="box-item"><strong>To Do</strong>: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nisi nulla, viverra quis felis sit amet, lacinia feugiat odio. Aliquam sed orci elementum, volutpat dolor eget, venenatis nunc</div>
                            </div>
                            <div class="box-footer">- Andro Smith</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="timeline-box">
                            <div class="box-title">
                                <i class="bx bx-task"></i> New Job To Do
                            </div>
                            <div class="box-content">
                                <div class="box-item"><strong>Employee</strong>: Jones</div>
                                <div class="box-item"><strong>To Do</strong>: Proin sit amet aliquet neque, eget sagittis nunc. Proin convallis lectus quis volutpat pharetra. Donec quis ultrices eros. Ut eget mi faucibus.</div>
                            </div>
                            <div class="box-footer">- Andro Smith</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="timeline-box">
                            <div class="box-title">
                                <i class="bx bxs-thermometer"></i> Pschrometrics
                            </div>
                            <div class="box-content">
                                <div class="box-item"><strong>Temp.</strong>: 23 <sup>o</sup>C</div>
                                <div class="box-item"><strong>Rh </strong>: 42</div>
                                <div class="box-item"><strong>Comments</strong>: Integer nec placerat ipsum. Aliquam id ligula suscipit, ornare dui nec, laoreet tortor.</div>
                            </div>
                            <div class="box-footer">- Andro Smith</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="timeline-box">
                            <div class="box-title">
                                <i class="bx bx-building"></i> Room Created
                            </div>
                            <div class="box-content">
                                <div class="box-item"><strong>Name</strong>: Kitchen</div>
                                <div class="box-item"><strong>Floor Level </strong>: 2</div>
                                <div class="box-item"><strong>Dimensions</strong>: 26 x 11 x 8</div>
                            </div>
        
                            <div class="box-footer">- Andro Smith</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="timeline-section">
                <div class="timeline-date">
                    23, Thursday
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="timeline-box">
                            <div class="box-title">
                                <i class="bx bx-task"></i> Job To Do Completed
                            </div>
                            <div class="box-content">
                                <div class="box-item"><strong>Employee</strong>: Sam</div>
                                <div class="box-item"><strong>Employee Response</strong>: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nisi nulla, viverra quis felis sit amet, lacinia feugiat odio. Aliquam sed orci elementum, volutpat dolor eget, venenatis nunc</div>
                            </div>
                            <div class="box-footer">- Andro Smith</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="timeline-box">
                            <div class="box-title">
                                <i class="bx bx-cog"></i> Equipment Entry
                            </div>
                            <div class="box-content">
                                <div class="box-item"><strong>ID</strong>: TW-3232</div>
                                <div class="box-item"><strong>Name</strong>: HEPA 600</div>
                                <div class="box-item"><strong>Date In</strong>: 08/22/2018</div>
                            </div>
        
                            <div class="box-footer">- Andro Smith</div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- <li class="sidebar nav-item">
            <a href="/" class="dropdown-btn nav-link collapsed" data-toggle="collapse"
                data-target="#dropdown-container3">
                <span class="icon"><i class="bx bx-user"></i></span>
                <span class="menu-title">Order Form Setting &nbsp;<i class="fa-solid fa-caret-down fa-sm"></i></span>
            </a>
        </li> -->

    </ul>
</div>

<!-- Modal -->
<div class="modal fade" id="webMailModal" tabindex="-1" role="dialog" aria-labelledby="webMailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="webMailModalLabel">View Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <!-- <a target="_blank" href="https://www.shipa1.com:2096/login/?user=testing@shipa1.com&amp;pass=Ny,b)kC(s?He" class="tx-white color" style="color: black;">SUPPORT EMAIL</a> -->
                    <a target="_blank" href="https://www.daydispatch.com:2096/login/?user=multitest@daydispatch.com&amp;pass=W-InLA~k]E[." class="btn btn-primary">SUPPORT EMAIL</a>
                    <a target="_blank" href="https://www.daydispatch.com:2096/login/?user=abs.test@70aa43fc5f8261786.temporary.link&amp;pass=ABS@12345abs@12345" class="btn btn-secondary">INFO EMAIL</a>
                    <!-- <a target="_blank" href="https://www.daydispatch.com:2096/login/?user=abs.test@70aa43fc5f8261786.temporary.link&amp;pass=ABS@12345abs@12345" class="btn btn-success">NO REPLY EMAIL</a> -->
                    <!-- <a target="_blank" href="https://www.shipa1.com:2096/login/?user=qa@shipa1.com&amp;pass=iwUn+%^Y2gx" class="btn btn-success">NO REPLY EMAIL</a> -->
                    <a target="_blank" href="https://www.daydispatch.com:2096/login/?user=qa@shipa1.com&amp;pass=iwUn+%^Y2gx" class="btn btn-success">NO REPLY EMAIL</a>
                    
                </div>
            </div>
        </div>
    </div>
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
