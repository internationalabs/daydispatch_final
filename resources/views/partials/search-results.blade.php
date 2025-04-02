<ul class="navbar-nav right-nav align-items-center">
        <li class="nav-item message-box dropdown">
            <div class="dropdown-menu show">
                <div class="dropdown-header d-flex justify-content-between align-items-center">
                    <span class="title d-inline-block">Relevant Searching</span>
                    @if($countData > 0)
                        <span class="clear-all-btn d-inline-block">Results Found ({{ $countData }})</span>
                    @else
                        <span class="d-block">No Data Found</span>
                    @endif
                </div>
            </div>
        </li>
    @forelse($data as $row)
        <li class="nav-item message-box dropdown">
            <div class="dropdown-menu show">
                <div class="dropdown-body">
                    <a href="{{ route('View.Profile', $row->id) }}" target="_blank"
                       class="dropdown-item d-flex align-items-center">
                        <div class="figure">
                            <img
                                src="{{ $row->profile_photo_path ? asset($row->profile_photo_path) : asset('backend/img/user1.jpg') }}"
                                class="rounded-circle" alt="image">
                        </div>
                        <div class="content d-flex justify-content-between align-items-center">
                            <div class="text">
                                <span class="d-block">{{ $row->Company_Name }} , ({{ $row->Company_City }}, {{ $row->Company_State }}) </span>
                                <p class="sub-text mb-0">{{ $row->usr_type }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </li>
    @empty
        {{-- <li class="nav-item message-box dropdown ">
            <div class="dropdown-menu show">
                <div class="dropdown-header d-flex justify-content-between align-items-center">
                    <span class="title d-inline-block">Relevant Searching</span>
                    <span class="clear-all-btn d-inline-block">Results</span>
                </div>
                <div class="dropdown-body">
                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                        <div class="content d-flex justify-content-between align-items-center">
                            <div class="text">
                                <span class="d-block">No Data Found</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </li> --}}
    @endforelse
</ul>

