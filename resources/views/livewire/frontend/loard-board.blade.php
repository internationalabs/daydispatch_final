<!-- page title area  -->
<section class="page-title-area breadcrumb-spacing"
    data-background="{{ asset('frontend/img/Daydispatch-loadboard-banner.webp') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="page-title-wrapper text-center">
                    <h3 class="page-title mb-25">LoadBoard</h3>
                    <div class="breadcrumb-menu">
                        <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                            <ul class="trail-items">
                                <li class="trail-item trail-begin"><a
                                        href="{{ route('Frontend.index') }}"><span>Home</span></a></li>
                                <li class="trail-item trail-end"><span>LoadBoard</span></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page title area end -->

@include('partials.fetch-load-board',
[
    'Listing_I' => $Listing_I,
    'Listing_II' => $Listing_II,
    'Listing_III' => $Listing_III,
    'Listing_IV' => $Listing_IV,
    'Listing_V' => $Listing_V,
    ])
