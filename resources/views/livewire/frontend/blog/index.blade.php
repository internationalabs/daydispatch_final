@extends('layouts.master')

@section('content')
<main>
    <style>
        @media screen and (max-width: 800px) {
            .flex-custom {
                flex-wrap: wrap;
            }

            .flex-custom img {
                width: 50% !important;
                margin-bottom: 20px;
            }

        }

        .blog-btn-style {
            padding: 6px 40px !important;
        }

        .flex-custom {
            display: flex !important;
            column-gap: 20px;
            margin-bottom: 30px;
            align-items: center;
        }

        .about__3.about__gray-bg::before {
            display: none;
        }

        table tr td {
            font-family: Lato-Regular;
            font-size: 15px;
            color: gray;
            line-height: 1.4;
        }

        table tr:nth-child(even) {
            background-color: #1f437c12;
        }

        th,
        td {
            padding: 10px;
        }

        table {
            width: 100%;
            box-shadow: 0 0 10px 0 #01286342;
            margin-bottom: 30px;
        }

        table thead {
            background: var(--clr-common-color-red-2);
            color: white;
        }
    </style>
    <!-- page title area  -->
    <section class="page-title-area breadcrumb-spacing"
        poster="https://daydispatch.com/frontend/img/breadcrumb-bg-low-resolution.webp"
        data-background="https://daydispatch.com/frontend/img/breadcrumb-bg.webp" loading="lazy">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-9">
                    <div class="page-title-wrapper text-center">
                        <h3 class="page-title mb-25">Blog</h3>
                        <div class="breadcrumb-menu">
                            <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                                <ul class="trail-items">
                                    <li class="trail-item trail-begin"><a
                                            href="{{ route('Frontend.index') }}"><span>Home</span></a></li>
                                    <li class="trail-item trail-end"><span>Blog</span></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page title area end -->
    <section class="about__3 about__gray-bg p-relative pt-120 pb-60 wow fadeInUp" data-wow-duration="1.5s"
        data-wow-delay=".3s">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="services__details-wrapper mb-60">
                                <div class="service__details-content mb-25">
                                    <?php
                                        // GuzzleHTTP ka use karke API se data retrieve karna
                                        $client = new \GuzzleHttp\Client();
                                        $response = $client->request('GET', 'https://blog.daydispatch.com/public/api/bloglist');
                                        $data = json_decode($response->getBody());
                                    
                                        // API se mila data display karna
                                         if (!empty($data)): ?>
                                            <?php foreach ($data as $item): ?>
                                                <div class="flex-custom">
                                                    <img loading="lazy" src="https://blog.daydispatch.com/public/uploads/apifileregistration/<?= $item->post_image ?>" width="30%" alt="Work">
                                                    <div>
                                                        <h4><?= $item->post_name ?>:</h4>
                                                        <p class="content-para">
                                                            <?= $item->post_short_description ?>
                                                            <div class="menu-btn">
                                                                <a class="clip-btn blog-btn-style" href="https://daydispatch.com/Blog/<?= $item->slug_name ?>">View More</a>
                                                            </div>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            No data available.
                                        <?php endif; ?>

                                    
                                    <div class="flex-custom">
                                        <img loading="lazy"
                                            src="https://daydispatch.com/frontend/img/Blog-img/Flatbed-Trailer.webp"
                                            width="30%" alt="Work">
                                        <div>
                                            <h4>Flatbed Trailer:</h4>
                                            <p class="content-para">
                                                These trailers are incredibly versatile and are a staple in the trucking
                                                industry. They offer flexibility
                                                as they can be loaded from the top, sides, or rear, making them a top
                                                choice for many hauls. It's worth
                                                noting that some flatbeds can house heavier loads for an additional
                                                cost, but this often necessitates
                                                obtaining state permits.
                                            <div class="menu-btn">
                                                <a class="clip-btn blog-btn-style"
                                                    href="https://daydispatch.com/Blog/Flatbed-Trailer">View More</a>
                                            </div>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="flex-custom">
                                        <img loading="lazy"
                                            src="https://daydispatch.com/frontend/img/work/Day Dispatch 2.jpg"
                                            width="30%" alt="Work">
                                        <div>
                                            <h4>Reefer Containers:</h4>
                                            <p class="content-para">
                                                Welcome to the world of reefer containers with Day Dispatch, where the
                                                journey of perishable goods
                                                becomes a thrilling tale of temperature-controlled adventure. These
                                                containers are the silent heroes
                                                of the shipping industry, ensuring that everything from juicy fruits to
                                                life-saving pharmaceuticals
                                                arrives at its destination in pristine condition.
                                            <div class="menu-btn">
                                                <a class="clip-btn blog-btn-style"
                                                    href="https://daydispatch.com/Blog/Reefer-Containers">View More</a>
                                            </div>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="flex-custom">
                                        <img loading="lazy"
                                            src="https://daydispatch.com/frontend/img/Blog-img/Power-Only-Truck.webp"
                                            width="30%" alt="Work">
                                        <div>
                                            <h4>Power Only:</h4>
                                            <p class="content-para">
                                                You know how we usually think of trucks and trailers as inseparable
                                                partners, owned by the same company?
                                                Well, in the shipping world, there's a cool twist to this story that's
                                                all about flexibility and creative solutions.
                                            <div class="menu-btn">
                                                <a class="clip-btn blog-btn-style"
                                                    href="https://daydispatch.com/Blog/Power-Only">View More</a>
                                            </div>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="flex-custom">
                                        <img loading="lazy"
                                            src="https://daydispatch.com/frontend/img/Blog-img/Landoll-Trailer.webp"
                                            width="30%" alt="Work">
                                        <div>
                                            <h4>Landoll Trailers:</h4>
                                            <p class="content-para">
                                                For many, the name "Landoll" is synonymous with "Traveling Axle
                                                Trailers." This family-owned company, established
                                                in 1963, has been a pioneer in the trailer technology industry.
                                            <div class="menu-btn">
                                                <a class="clip-btn blog-btn-style"
                                                    href="https://daydispatch.com/Blog/Landoll-Trailers">View More</a>
                                            </div>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="flex-custom">
                                        <img loading="lazy"
                                            src="https://daydispatch.com/frontend/img/work/Day Dispatch 2.jpg"
                                            width="30%" alt="Work">
                                        <div>
                                            <h4>HopperBottom Trailer:</h4>
                                            <p class="content-para">
                                                A hopper bottom trailer, also known as a hopper trailer, is a special
                                                type of trailer mostly used
                                                in farming and the bulk goods industry.
                                                Its main job is to carry large amounts of stuff like grains, seeds, and
                                                fertilizer. What's unique
                                                about it is its shape, which makes it really good at unloading the cargo
                                                easily, often using gravity
                                                to help with tha
                                            <div class="menu-btn">
                                                <a class="clip-btn blog-btn-style"
                                                    href="https://daydispatch.com/Blog/HopperBottom-Trailer">View
                                                    More</a>
                                            </div>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="flex-custom">
                                        <img loading="lazy"
                                            src="https://daydispatch.com/frontend/img/work/Day Dispatch 2.jpg"
                                            width="30%" alt="Work">
                                        <div>
                                            <h4>HEAVY HAULERS:</h4>
                                            <p class="content-para">
                                                In the world of transportation, there are special challenges when it
                                                comes to moving really big and heavy things.
                                                Heavy haulers are the super-sized heroes of the road that are designed
                                                for one important mission: carrying huge,
                                                oversized loads that can't fit on regular trucks
                                            <div class="menu-btn">
                                                <a class="clip-btn blog-btn-style"
                                                    href="https://daydispatch.com/Blog/Titans">View More</a>
                                            </div>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="flex-custom">
                                        <img loading="lazy"
                                            src="https://daydispatch.com/frontend/img/Blog-img/Endump-Truck.webp"
                                            width="30%" alt="Work">
                                        <div>
                                            <h4>Dump Trucks:</h4>
                                            <p class="content-para">
                                                Dump trucks, also known as dumping trucks, are essential vehicles used
                                                in construction and coal transportation.
                                                They're designed with an open-box bed that can be raised and tilted to
                                                deposit materials like dirt, gravel,
                                                or demolition waste at construction sites.
                                            <div class="menu-btn">
                                                <a class="clip-btn blog-btn-style"
                                                    href="https://daydispatch.com/Blog/Dump-Trucks">View More</a>
                                            </div>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="flex-custom">
                                        <img loading="lazy"
                                            src="https://daydispatch.com/frontend/img/Blog-img/Boat-Hauler.webp"
                                            width="30%" alt="Work">
                                        <div>
                                            <h4>BOAT Shipping:</h4>
                                            <p class="content-para">
                                                When you own a boat, sooner or later, you'll need to move it from one
                                                place to another. Even if you live near water,
                                                your boat had to get to your home somehow, right? Adding to this moving
                                                a boat might sound tough, but don't worry
                                                with some planning and care, you can do it safely. So, let's talk about
                                                boat shipping with this guide we will help
                                                you transport your beloved boat without any worries.
                                            <div class="menu-btn">
                                                <a class="clip-btn blog-btn-style"
                                                    href="https://daydispatch.com/Blog/Hassle-Free">View More</a>
                                            </div>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="flex-custom">
                                        <img loading="lazy"
                                            src="https://daydispatch.com/frontend/img/work/Day Dispatch 2.jpg"
                                            width="30%" alt="Work">
                                        <div>
                                            <h4>Straight Box Trucks:</h4>
                                            <p class="content-para">
                                                In the fast-paced world of logistics and transportation, the humble
                                                straight truck often takes center stage.
                                                Whether you call it a "box truck" or a "cube truck," it's more than just
                                                a name
                                                Let's discover why these dependable vehicles are so important.
                                            <div class="menu-btn">
                                                <a class="clip-btn blog-btn-style"
                                                    href="https://daydispatch.com/Blog/Straight-Box-Trucks">View
                                                    More</a>
                                            </div>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="flex-custom">
                                        <img loading="lazy"
                                            src="https://daydispatch.com/frontend/img/work/Day Dispatch 2.jpg"
                                            width="30%" alt="Work">
                                        <div>
                                            <h4>Truckload shipping:</h4>
                                            <p class="content-para">
                                                Partial truckload shipping is a smart choice for those with sizable
                                                shipments that don't require a
                                                full truckload trailer.
                                                It falls in between less than truckload (LTL) and full truckload options
                                                and usually involves shipments
                                                over 5,000 pounds or six or more pallets.
                                            <div class="menu-btn">
                                                <a class="clip-btn blog-btn-style"
                                                    href="https://daydispatch.com/Blog/Truckload_shipping">View
                                                    More</a>
                                            </div>
                                            </p>

                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-md-3">

                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" class="modal-dialog modal-lg" id="exampleModalToggle" aria-hidden="true"
        aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Calculate Freight Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('livewire.backend.extras.frieght-calculator')
                </div>
                <div class="modal-footer">
                    <!--<button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Open second modal</button>-->
                </div>
            </div>
        </div>
    </div>
</main>
<!-- back to top start -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<!-- back to top end -->


@endsection
<!-- JS here -->

<script async data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script defer src="{{ asset('frontend/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script defer src="{{ asset('frontend/js/vendor/waypoints.min.js') }}" loading="lazy"></script>
<script defer src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script defer src="{{ asset('frontend/js/meanmenu.js') }}"></script>
<script defer src="{{ asset('frontend/js/swiper-bundle.min.js') }}"></script>
<script defer src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script defer src="{{ asset('frontend/js/magnific-popup.min.js') }}"></script>
<script defer src="{{ asset('frontend/js/parallax.min.js') }}"></script>
<script defer src="{{ asset('frontend/js/backToTop.js') }}"></script>
<script defer src="{{ asset('frontend/js/jquery-ui-slider-range.js') }}"></script>
<script defer src="{{ asset('frontend/js/nice-select.min.js') }}"></script>
<script defer src="{{ asset('frontend/js/counterup.min.js') }}"></script>
<script defer src="{{ asset('frontend/js/ajax-form.js') }}"></script>
<script defer src="{{ asset('frontend/js/wow.min.js') }}"></script>
<script defer src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
<script defer src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
<script defer src="{{ asset('frontend/js/rangeslider-js.min.js') }}"></script>
<script defer src="{{ asset('frontend/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all images with the 'loading="lazy"' attribute
        const lazyImages = document.querySelectorAll('img[loading="lazy"]');

        // Intersection Observer options
        const options = {
            root: null, // Use the viewport as the root
            rootMargin: '0px', // No margin
            threshold: 0.5 // Trigger when 50% of the image is in the viewport
        };

        // Callback function when an image enters the viewport
        const handleIntersection = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;

                    // Set the 'src' attribute to load the image
                    img.src = img.getAttribute('data-src');

                    // Remove the 'data-src' attribute to prevent double-loading
                    img.removeAttribute('data-src');

                    // Unobserve the image once loaded
                    observer.unobserve(img);
                }
            });
        };

        // Create the Intersection Observer
        const imageObserver = new IntersectionObserver(handleIntersection, options);

        // Observe each lazy-loaded image
        lazyImages.forEach(img => {
            // Store the original 'src' attribute in 'data-src'
            img.setAttribute('data-src', img.src);
            // Clear the 'src' attribute
            img.src = '';
            // Observe the image
            imageObserver.observe(img);
        });
    });
</script>
<script defer>
    $('.basic_quote_info').hide();
    $('.vehicle_quote_info').hide();
    $('.route_quote_info').hide();

    $('.vehicle_make').hide();
    $('.vehicle_model').hide();
    $('.vehicle_heading').hide();
    $('.vehicle_dimension').hide();
    $('.vehicle_additional').hide();
    $('.vehicle_carrier').hide();
    $('.vehicle_condition').hide();
    $('.vehicle_quote_info_Freight').hide();
    $('.vehicle_quote_info').hide();
    var showdryvanpopup = 0;



    $(document).ready(function() {
        $('.route_quote_info').show();
        $('#step_2').click(function() {
            if ($("#F_ZipCode").val() === '') {
                $("#F_ZipCode").attr("style", "border-color:red;");
            } else {
                $("#F_ZipCode").attr("style", "border-color:transparent;");
            }
            if ($("#T_ZipCode").val() === '') {
                $("#T_ZipCode").attr("style", "border-color:red;");
            } else {
                $("#T_ZipCode").attr("style", "border-color:transparent;");
            }
            if ($("#F_ZipCode").val() !== '' && $("#T_ZipCode").val() !== '') {
                $('.route_quote_info').hide();
                $('.vehicle_quote_info').show();
                $('.vehicle_quote_info_Freight').hide();
            }
        });
        $('.step_1').click(function() {
            $('.route_quote_info').show();
            $('.vehicle_quote_info').hide();
            $('.vehicle_quote_info_Freight').hide();
        });
        $('.step_1_goback').click(function() {
            $('.route_quote_info').hide();
            $('.vehicle_quote_info').show();
            $('.vehicle_quote_info_Freight').hide();
        })
        $("#showdryvan").click(function() {
            console.log('show Dry Van');
            $('.vehicle_quote_info_Freight').show();
            $('.route_quote_info').hide();
            $('.vehicle_quote_info').hide();


            showdryvanpopup = 1;
        })
        $('.vehicle_type select').change(function() {
            const type = $(this).val();
            if (type == 'DRYVAN') {
                $('#vehicleinfo').text('Freight shipping')
            } else if (type) {
                $('#vehicleinfo').text(type)
            } else {
                $('#vehicleinfo').text("VEHICLE INFORMATION")
            }
            if (type === 'Car') {
                $('.vehicle_make').show();
                $('.vehicle_model').show();
                $('.vehicle_carrier').show();
                $('.vehicle_condition').show();
                $('.vehicle_heading').hide();
                $('.vehicle_dimension').hide();
                $('.vehicle_additional').hide();

                // $('#selectvehicle').children('a').attr('id','step_3');
                $('#nextstepof').children('#first').show();
                $('#nextstepof').children('#second').hide();

            } else if (type === 'MotorCycle') {
                $('.vehicle_heading').show();
                $('.vehicle_additional').show();
                $('.vehicle_carrier').show();
                $('.vehicle_condition').show();
                $('.vehicle_make').hide();
                $('.vehicle_model').hide();
                $('.vehicle_dimension').hide();

                // $('#selectvehicle').children('a').attr('id','step_3');

                $('#nextstepof').children('#first').show();
                $('#nextstepof').children('#second').hide();

            } else if (type === 'Heavy Equipment') {
                $('.vehicle_heading').show();
                $('.vehicle_dimension').show();
                $('.vehicle_additional').show();
                $('.vehicle_make').hide();
                $('.vehicle_model').hide();
                $('.vehicle_carrier').hide();
                $('.vehicle_condition').hide();

                // $('#selectvehicle').children('a').attr('id','step_3');

                $('#nextstepof').children('#first').show();
                $('#nextstepof').children('#second').hide();

            } else if (type === 'Dryvan') {
                console.log('show')
                $('.vehicle_dimension').show();


                $('.vehicle_make').hide();
                $('.vehicle_model').hide();
                $('.vehicle_heading').hide();
                $('.vehicle_additional').hide();
                $('.vehicle_carrier').hide();
                $('.vehicle_condition').hide();

                // $('#selectvehicle').children('a').attr('id','showdryvan');


                $('#nextstepof').children('#first').hide();
                $('#nextstepof').children('#second').show();
            } else {
                $('.vehicle_make').hide();
                $('.vehicle_model').hide();
                $('.vehicle_heading').hide();
                $('.vehicle_dimension').hide();
                $('.vehicle_additional').hide();
                $('.vehicle_carrier').hide();
                $('.vehicle_condition').hide();

                // $('#selectvehicle').children('a').attr('id','step_3');

                $('#nextstepof').children('#first').show();
                $('#nextstepof').children('#second').hide();
            }
        });
        $('.step_3').click(function() {
            $('.route_quote_info').hide();
            $('.vehicle_quote_info').hide();
            $('.basic_quote_info').show();
            $('.vehicle_quote_info_Freight').hide();

            showdryvanpopup = 0;
        });
        $('.step_3_show').click(function() {
            $('.route_quote_info').hide();
            $('.vehicle_quote_info').hide();
            $('.basic_quote_info').show();
            $('.vehicle_quote_info_Freight').hide();

            showdryvanpopup = 1;
        });
        $('#prev_step_2').click(function() {
            console.log(showdryvanpopup)
            if (showdryvanpopup != 0) {
                $('.route_quote_info').hide();
                $('.vehicle_quote_info').hide();
                $('.basic_quote_info').hide();
                $('.vehicle_quote_info_Freight').show();
            } else {
                $('.route_quote_info').hide();
                $('.vehicle_quote_info').show();
                $('.basic_quote_info').hide();
                $('.vehicle_quote_info_Freight').hide();
            }

        });
    });
</script>
<script defer>
    const path = "{{ route('autocomplete') }}";
    $('.Dest_ZipCode.typeahead, .Origin_ZipCode.typeahead').typeahead({
        source: function(query, process) {
            return $.get(path, {
                query: query
            }, function(data) {
                return process(data);
            });
        }
    });

    const GetVehicleMake = '{{ route('Get.Vehcile.Make') }}';
    const GetVehicleModel = '{{ route('Get.Vehcile.Model') }}';
    $('input.make.typeahead').typeahead({
        source: function(query, process) {
            return $.get(GetVehicleMake, {
                query: query
            }, function(data) {
                return process(data);
            });
        }
    });

    $('input.model.typeahead').typeahead({
        source: function(query, process) {
            return $.get(GetVehicleModel, {
                query: query
            }, function(data) {
                return process(data);
            });
        }
    });

    function calculateFreight() {
        let x = document.getElementById('CarrierRequestLoad');
        x.style.display = "block";
    }

    $('#firstrow').children('.col-lg-2').addClass('col-lg-6');
    $('.breadcrumb-area h1').remove();
    $('.breadcrumb .item:nth-child(2)').remove();
</script>
