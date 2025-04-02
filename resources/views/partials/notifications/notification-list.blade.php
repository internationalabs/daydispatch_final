@php
    $notificationCount = count($data);
@endphp

<a href="JavaScript:void(0);" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
    aria-expanded="false">
    <div class="notification-btn">
        <i class="bx bx-bell"></i>
        <span class="badge badge-secondary">{{ $notificationCount }}</span>
        {{-- <span class="badge badge-secondary">0</span> --}}
    </div>
</a>
<div class="dropdown-menu">
    <div class="dropdown-header d-flex justify-content-between align-items-center">
        <span class="title d-inline-block">{{ $notificationCount }} New
            Notification{{ $notificationCount > 1 ? 's' : '' }}</span>
        <a href="{{ route('Mark.Notification', ['notify_id' => 'all']) }}">
            <span class="mark-all-btn d-inline-block">Mark all as read</span>
        </a>
    </div>
    <div class="dropdown-body">
        @if ($notificationCount > 0)
            <input type="hidden" class="dataCount" name="dataCount" id="dataCount" value="{{ $dataCount }}">
            {{-- @foreach ($msg as $row)
                <a href="{{ route('chat', $row->user_id) }}" class="dropdown-item d-flex align-items-center">
                    <div class="icon" style="width: 50px; height: 50px; border-radius: 10%;">
                        <i class="bx bx-message-rounded-dots" style="font-size: 1.5rem;"></i>
                    </div>

                    <div class="content" style="white-space: normal;">
                        <span>{{ $row->notification }}</span>
                        <p class="mb-0">{{ date('H:i:s', strtotime($row->created_at)) }}</p>
                    </div>
                </a>
            @endforeach --}}
            @foreach ($data as $row)
                <a href="JavaScript:void(0);" class="dropdown-item d-flex align-items-center">
                    <div class="icon" style="width: 50px; height: 50px; border-radius: 10%;">
                        <i class="bx bx-message-rounded-dots" style="font-size: 1.5rem;"></i>
                    </div>

                    <div class="content" style="white-space: normal;">
                        <span>{{ $row->Notification }}</span>
                        <p class="mb-0">{{ date('H:i:s', strtotime($row->created_at)) }}</p>
                    </div>
                </a>
            @endforeach
            {{-- <a href="JavaScript:void(0);" class="dropdown-item d-flex align-items-center">
                <div class="icon" style="width: 50px; height: 50px; border-radius: 10%;">
                    <i class="bx bx-message-rounded-dots" style="font-size: 1.5rem;"></i>
                </div>
                <div class="content" style="white-space: normal;">
                    <span class="d-block">No Notifications Found!</span>
                    <p class="sub-text mb-0">{{ date('H:i:s') }}</p>
                </div>
            </a> --}}
        @else
            <a href="JavaScript:void(0);" class="dropdown-item d-flex align-items-center">
                <div class="icon" style="width: 50px; height: 50px; border-radius: 10%;">
                    <i class="bx bx-message-rounded-dots" style="font-size: 1.5rem;"></i>
                </div>
                <div class="content" style="white-space: normal;">
                    <span class="d-block">No Notifications Found!</span>
                    <p class="sub-text mb-0">{{ date('H:i:s') }}</p>
                </div>
            </a>
        @endif
    </div>
    <div class="dropdown-footer">
        <a href="{{ route('View.Notification', ['user_id' => $user_id]) }}" class="dropdown-item">View All</a>
    </div>
</div>
