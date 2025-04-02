@php
    $messageCount = count($msgs);
    $recentMessages = $msgs->sortByDesc('created_at')->take(6);
@endphp
<a href="JavaScript:void(0);" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
    aria-expanded="false">
    <div class="message-btn">
        <i class="bx bx-envelope"></i>
        <span class="badge badge-secondary">{{ $messageCount }}</span>
    </div>
</a>
<div class="dropdown-menu">
    <div class="dropdown-header d-flex justify-content-between align-items-center">
        <span class="title d-inline-block">{{ $messageCount }} New
            Message{{ $messageCount > 1 ? 's' : '' }}</span>
    </div>
    <div class="dropdown-body">
        @if ($messageCount > 0)
            <input type="hidden" class="messageCount" name="messageCount" id="messageCount" value="{{ $messageCount }}">
            @foreach ($recentMessages as $row)
                <a href="{{ route('chat', $row->user_id) }}" class="dropdown-item d-flex align-items-center">
                    <div class="figure">
                        <img src="{{ $row->chat->user->profile_photo_path ? url($row->chat->user->profile_photo_path) : asset('backend/img/user1.jpg') }}" class="rounded-circle" alt="image">
                    </div>
                    <div class="content d-flex justify-content-between align-items-center">
                        <div class="text">
                            <span class="d-block">{{ $row->chat->user->Company_Name }}</span>
                            <p class="sub-text mb-0">{{ \Illuminate\Support\Str::limit($row->chat->content, 20) }}</p>
                        </div>
                        <p class="time-text mb-0">{{ date('H:i:s', strtotime($row->created_at)) }}</p>
                    </div>
                </a>
            @endforeach
        @else
            <a href="JavaScript:void(0);" class="dropdown-item d-flex align-items-center">
                <div class="icon" style="width: 50px; height: 50px; border-radius: 10%;">
                    <i class="bx bx-message-rounded-dots" style="font-size: 1.5rem;"></i>
                </div>
                <div class="content" style="white-space: normal;">
                    <span class="d-block">No Messages Found!</span>
                    <p class="sub-text mb-0">{{ date('H:i:s') }}</p>
                </div>
            </a>
        @endif
    </div>
    <div class="dropdown-footer">
        <a href="{{ route('chat', Auth::guard('Authorized')->user()->id) }}" class="dropdown-item">View All</a>
    </div>
</div>