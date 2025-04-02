<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>{{ Auth::guard('Authorized')->user()->usr_type }} Listing</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Order Images</li>
    </ol>

</div>
<!-- End Breadcrumb Area -->
<!-- Gallery Area -->
<div class="gallery-area">
    <div class="row">
        @forelse($Order_Attachments as $attachment)
            <div class="col-lg-4 col-sm-6 col-md-6">
                <div class="single-gallery-image mb-30">
                    <img src="{{ asset($attachment->Image_Name) }}" alt="Order_Image_{{ $attachment->id }}" data-original="{{ asset($attachment->Image_Name) }}">
                </div>
            </div>
        @empty
            <strong class="text-center">No Attachments</strong>
        @endforelse
    </div>
</div>
<!-- End Gallery Area -->
