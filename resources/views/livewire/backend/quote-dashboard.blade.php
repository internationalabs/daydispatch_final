@extends('layouts.authorizedQuote')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css') }}">

    <style>
        #usa-map {
            width: 800px;
            height: 500px;
            border: 1px solid #ddd;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
    <br/>
    @php
        $user_adminver = Auth::guard('Authorized')->user();
    @endphp
    @if ($user_adminver && $user_adminver->admin_verify == 0)
        <div class="d-flex justify-content-center align-items-center">
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> <!-- Optional: Add an icon -->
                <div>
                    Your profile verification is pending. Please
                    <a href="{{ route('User.Profile') }}" class="alert-link fw-bold">complete your profile</a>
                    to ensure uninterrupted access.
                </div>
            </div>
        </div>
    @endif

    <div class="container-fluid my-5 mx-0">
        <div class="row justify-content-center">
            <div class="" style="width: 430px">
                <div class="card text-center p-3 border fs-4 shadow-lg hover-effect text-nowrap">
                    <div class="d-flex">
                        <div id="loader" class="spinner-border text-primary mr-2" role="status" style="display: none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div id="dashboardLabel" class="text"></div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="dashboardSwitch"
                                   onchange="toggleDashboardView()">
                            <label class="form-check-label" for="dashboardSwitch">Switch to User Dashboard</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="stats-card-box">
                <div class="icon-box">
                    <i class="fas fa-chart-line"></i>
                </div>
                <span class="sub-title">Conversion Rate</span>
                <h3>{{ round($currentMonthPercentage, 2) }}%
                    <span class="badge @if ($arrowDirection == 'down') badge-red @endif">
                        <i class="fas fa-arrow-{{ $arrowDirection }}"></i>
                        {{ round($percentageChange, 2) }}%
                    </span>
                </h3>
                <div class="progress-list">
                    <div class="bar-inner">
                        <div class="bar progress-line" data-width="{{ round($currentMonthPercentage, 2) }}"
                             style="width: {{ round($currentMonthPercentage, 2) }}%;"></div>
                    </div>
                    <p>Quotes converted into book orders</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stats-card-box">
                <div class="icon-box">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <span class="sub-title">Conversion Value</span>
                <h3>${{ number_format($currentMonthBookedOrdersTotal, 2) }}
                    <span class="badge">
                        <i class="fas fa-arrow-{{ $arrowDirectionTotalValue }}"></i>
                        {{ number_format($totalValueChange, 2) }}
                    </span>
                </h3>
                <div class="progress-list">
                    <div class="bar-inner">
                        <div class="bar progress-line"
                             data-width="{{ round(($currentMonthBookedOrdersTotal / ($previousMonthBookedOrdersTotal ?: 1)) * 100, 2) }}"
                             style="width: {{ round(($currentMonthBookedOrdersTotal / ($previousMonthBookedOrdersTotal ?: 1)) * 100, 2) }}%;">
                        </div>
                    </div>
                    <p>Total book price calculated per month.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stats-card-box">
                <div class="icon-box">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <span class="sub-title">Conversion Order</span>
                <h3>{{ $currentMonthBookedWithTrashed }}
                    <span class="badge badge-{{ $arrowDirectionWithTrashed }}">
                        <i class="fas fa-arrow-{{ $arrowDirectionWithTrashed }}"></i>
                        {{ $percentageChangeWithTrashed }}
                    </span>
                </h3>
                <div class="progress-list">
                    <div class="bar-inner">
                        <div class="bar progress-line" data-width="{{ $currentMonthBookedWithTrashed }}"
                             style="width: {{ $currentMonthBookedWithTrashed }}%;"></div>
                    </div>
                    <p>Count of book orders per month.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stats-card-box">
                <div class="icon-box">
                    <i class="fas fa-user-plus"></i>
                </div>
                <span class="sub-title">Unique Customers</span>
                <h3>{{ $currentMonthUniqueCustomers }}
                    <span class="badge">
                        <i class="fas fa-arrow-{{ $arrowDirection }}"></i> {{ number_format($percentageChange, 1) }}%
                    </span>
                </h3>
                <div class="progress-list">
                    <div class="bar-inner">
                        <div class="bar progress-line" data-width="{{ $percentageChange }}"
                             style="width: {{ $percentageChange }}%;"></div>
                    </div>
                    <p>New customers acquired per month.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7 col-md-12">
            <div class="card mb-30">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Website Analytics</h3>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bx bx-download"></i> Download
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="position: relative;">
                    <div id="website-quote-analytics-chart" class="extra-margin" style="min-height: 320px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-12">
            <!-- Email Send Chart -->
            <div class="card mb-30">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Email Send</h3>

                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bx bx-show"></i> View
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bx bx-edit-alt"></i> Edit
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bx bx-trash"></i> Delete
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bx bx-printer"></i> Print
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bx bx-download"></i> Download
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body" style="position: relative;">
                    <div id="emailSend-chart" class="extra-margin" style="min-height: 315.561px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Activity Timeline -->
        <div class="col-lg-7 col-md-12">
            <div class="card mb-30 pt-2" style="height: 500px">
                <div class="card-body activity-timeline-chart-box" style="position: relative;">
                    <div class="mb-3">
                        <label for="year-select">Select Year:</label>
                        <select id="year-select" class="form-control" style="width: 200px;">
                            @for ($year = now()->year; $year >= now()->year - 5; $year--)
                                <option
                                    value="{{ $year }}" {{ $year == now()->year ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div id="listing-status-chart" style="min-height: 293.556px;"></div>
                </div>
            </div>
        </div>

        <!-- Traffic Source & Browser Used -->
        <div class="col-lg-5 col-md-12">
            <div class="card mb-30" style="height: 500px">
                <div class="card-body" style="position: relative;">
                    <div class="mb-3">
                        <label for="year-select">Select Year:</label>
                        <select id="yearFilter" class="form-control" style="width: 200px;">
                            @for ($year = now()->year; $year >= now()->year - 5; $year--)
                                <option
                                    value="{{ $year }}" {{ $year == now()->year ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div id="traffic-source-chart2" class="extra-margin" style="min-height: 337px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="card mb-30" style="height: 500px;overflow-y: scroll">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Inactive Customers (Last 3+ Months)</h3>
                </div>
                <div class="card-body browser-used-box">
                    <div class="table-responsive">
                        <table class="table" id="inactiveCustomersTable">
                            <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Inactive Days</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <button id="loadMore" class="btn btn-primary">Load More</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-12">
            <div class="card mb-30" style="height: 500px">
                <div class="card-body" style="position: relative;">
                    <div class="mb-3">
                        <label for="year-select">Select Year:</label>
                        <select id="year-select2" class="form-control" style="width: 200px;">
                            @for ($year = now()->year; $year >= now()->year - 5; $year--)
                                <option
                                    value="{{ $year }}" {{ $year == now()->year ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div id="world-map-markers" class="extra-margin" style="min-height: 337px;"></div>
                </div>
            </div>
        </div>
    </div>





    <div class="ecommerce-stats-area">
        <div class="row">
            @foreach ($sidebarOptionsWithCount as $index => $option)
                <div class="col-lg-3 col-sm-6 col-md-6 mt-4">
                    <div class="single-stats-card-box">
                        <div class="icon">
                            <i class='bx bxs-file'></i>
                        </div>
                        <a href="{{ route('Custom.Quote.Folder', $option->name) }}">
                            <span class="sub-title">{{ $option->name }}</span>
                        </a>
                        <h3>{{ $option->count }}</h3>
                    </div>
                </div>
                @if (($index + 1) % 4 == 0 && $index + 1 != count($sidebarOptionsWithCount))
        </div> <!-- Closing row -->
        <div class="ecommerce-stats-area">
            <div class="row"> <!-- Reopening row -->
                @endif
                @endforeach
            </div> <!-- Closing last row -->
        </div> <!-- Closing last ecommerce-stats-area -->

        <!-- Additional Statistics Section -->
        <div class="ecommerce-stats-area">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-md-6 mt-4">
                    <div class="single-stats-card-box">
                        <div class="icon">
                            <i class='bx bxs-file'></i>
                        </div>
                        <a href="{{ route('Book.Order') }}"><span class="sub-title">Booked Order</span></a>
                        <h3>{{ $orderCount['Book_Order'] }}</h3>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-md-6 mt-4">
                    <div class="single-stats-card-box">
                        <div class="icon">
                            <i class='bx bxs-file'></i>
                        </div>
                        <a href="{{ route('Deleted.Quote') }}"><span class="sub-title">Deleted Order</span></a>
                        <h3>{{ $orderCount['Deleted'] }}</h3>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-md-6 mt-4">
                    <div class="single-stats-card-box">
                        <div class="icon">
                            <i class='bx bxs-file'></i>
                        </div>
                        <a href="{{ route('Cancelled.Quote') }}"><span class="sub-title">Cancelled Order</span></a>
                        <h3>{{ $orderCount['Cancelled'] }}</h3>
                    </div>
                </div>
            </div>
        </div>


        @endsection

        @section('extra_script')



            <!-- jvectormap Min JS -->
            <script src="{{ asset('backend/js/jvectormap-1.2.2.min.js') }} "></script>
            <script src="{{ asset('backend/js/jvectormap-world-mill-en.js') }}"></script>


            <script>
                function toggleDashboardView() {
                    const switchElement = document.getElementById('dashboardSwitch');
                    const loader = document.getElementById('loader');
                    const dashboardLabel = document.getElementById('dashboardLabel');
                    const userDashboardRoute = "{{ url('Authorized') }}";
                    const quoteDashboardRoute = "{{ url('Authorized/quote-dashboard') }}";
                    loader.style.display = 'inline-block';
                    dashboardLabel.innerHTML = "";
                    setTimeout(function () {
                        if (switchElement.checked) {
                            window.location.href = userDashboardRoute;
                        } else {
                            window.location.href = quoteDashboardRoute;
                        }
                    }, 1000);
                }
            </script>

            <script>
                (function ($) {
                    "use strict";
                    jQuery(document).on('ready', function () {
                        if (document.getElementById("website-quote-analytics-chart")) {
                            var options = {
                                chart: {
                                    height: 305,
                                    type: 'bar',
                                },
                                plotOptions: {
                                    bar: {
                                        horizontal: false,
                                        columnWidth: '50%',
                                    },
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                stroke: {
                                    show: true,
                                    width: 2,
                                    colors: ['transparent']
                                },
                                colors: ['#ea3a3b', '#4788ff', '#6a4ffc'],
                                series: [{
                                    name: 'Total Orders',
                                    data: @json($Website_Analytics_Total).reverse()
                                }, {
                                    name: 'Booked Orders',
                                    data: @json($Website_Analytics_Booked).reverse()
                                }, {
                                    name: 'Cancelled Orders',
                                    data: @json($Website_Analytics_Cancelled).reverse()
                                }],
                                xaxis: {
                                    categories: @json($monthsAnalytics).reverse(),
                                },
                                fill: {
                                    opacity: 1
                                },
                                tooltip: {
                                    y: {
                                        formatter: function (val) {
                                            return val + " orders";
                                        }
                                    }
                                }
                            };

                            var chart = new ApexCharts(
                                document.querySelector("#website-quote-analytics-chart"),
                                options
                            );
                            chart.render();
                        }
                    });
                })(jQuery);
            </script>

            <script>
                $(document).ready(function () {
                    function fetchChartData(year) {
                        $.ajax({
                            url: "{{ route('Quote.Listing.Status') }}", // Create this route in Laravel
                            type: "GET",
                            data: {year: year},
                            success: function (response) {
                                updateChart(response.listingsData);
                            }
                        });
                    }

                    function updateChart(data) {
                        var options = {
                            chart: {
                                type: 'pie',
                                height: 400
                            },
                            series: Object.values(data),
                            labels: Object.keys(data),
                            colors: ['#FF5733', '#FFC300', '#36A2EB', '#4CAF50', '#8E44AD', '#F39C12', '#E74C3C', '#3498DB', '#1ABC9C', '#2ECC71', '#9B59B6', '#34495E'],
                            title: {
                                text: "Listing Status Distribution (" + $("#year-select").val() + ")",
                                align: 'center'
                            }
                        };

                        $("#listing-status-chart").html(""); // Clear old chart
                        var chart = new ApexCharts($("#listing-status-chart")[0], options);
                        chart.render();
                    }

                    // Load chart initially
                    fetchChartData($("#year-select").val());

                    // On year change, update chart
                    $("#year-select").change(function () {
                        fetchChartData($(this).val());
                    });
                });
            </script>


            <script>
                $(document).ready(function () {
                    var chart2;

                    function fetchChartData(selectedYear) {
                        $.ajax({
                            url: "{{ route('Quote.getTrafficSource') }}",
                            method: "GET",
                            data: {year: selectedYear}, // Send selected year
                            success: function (response) {
                                console.log(response); // Debugging: Check if the response is correct

                                if (response.categories.length && response.series.length) {
                                    normalizeChartData(response.categories, response.series);
                                } else {
                                    console.log("No data available for chart.");
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error("AJAX Error: ", error);
                            }
                        });
                    }

                    function normalizeChartData(categories, seriesData) {
                        let categoryCount = categories.length;

                        // Ensure each series has data points equal to the number of categories
                        let updatedSeries = seriesData.map(series => {
                            let filledData = new Array(categoryCount).fill(0);
                            series.data.forEach((value, index) => {
                                if (index < categoryCount) {
                                    filledData[index] = value; // Assign existing values
                                }
                            });
                            return {name: series.name, data: filledData};
                        });

                        renderChart(categories, updatedSeries);
                    }

                    function renderChart(categories, seriesData) {
                        if ($("#traffic-source-chart2").length) {
                            var options = {
                                chart: {
                                    height: 322,
                                    type: 'line',
                                    zoom: {enabled: false},
                                },
                                dataLabels: {enabled: false},
                                stroke: {
                                    width: [3, 3],
                                    curve: 'smooth'
                                },
                                colors: ['#ea3a3b', '#13bb37'],
                                series: seriesData,
                                legend: {show: true},
                                markers: {
                                    size: 4,
                                    hover: {sizeOffset: 4}
                                },
                                xaxis: {categories: categories},
                                tooltip: {
                                    y: [{
                                        title: {formatter: val => val + " orders"}
                                    }]
                                },
                                grid: {borderColor: '#f1f1f1'}
                            };

                            if (chart2) {
                                chart2.updateOptions(options);
                            } else {
                                chart2 = new ApexCharts(
                                    document.querySelector("#traffic-source-chart2"),
                                    options
                                );
                                chart2.render();
                            }
                        }
                    }

                    // Fetch chart data on page load with default year
                    let defaultYear = $("#yearFilter").val();
                    fetchChartData(defaultYear);

                    // Fetch chart data when year filter changes
                    $("#yearFilter").change(function () {
                        let selectedYear = $(this).val();
                        fetchChartData(selectedYear);
                    });
                });
            </script>



            <script>
                $(document).ready(function () {
                    let page = 1;  // Track current page
                    let loading = false;  // Prevent multiple requests

                    function loadInactiveCustomers() {
                        if (loading) return;
                        loading = true;

                        $.ajax({
                            url: "{{ route('Quote.inactive.customers') }}?page=" + page,
                            type: "GET",
                            dataType: "json",
                            success: function (response) {
                                let data = response.data;
                                let tableBody = $("#inactiveCustomersTable tbody");

                                if (data.length > 0) {
                                    $.each(data, function (index, customer) {
                                        let maskedPhone = customer.Customer_Phone.slice(0, -4) + "XXXX";
                                        let row = "<tr>" +
                                            "<td>" + customer.Customer_Name + "</td>" +
                                            "<td>" + maskedPhone + "</td>" +
                                            "<td>" + customer.days_inactive + " days</td>" +
                                            "</tr>";
                                        tableBody.append(row);
                                    });

                                    page++;  // Increment page number
                                    loading = false;  // Allow next request
                                } else {
                                    $("#loadMore").hide();  // Hide button if no more data
                                }
                            },
                            error: function () {
                                console.log("Error fetching inactive customers.");
                                loading = false;
                            }
                        });
                    }

                    // Load first 20 on page load
                    loadInactiveCustomers();

                    // Load next 20 when button is clicked
                    $("#loadMore").click(function () {
                        loadInactiveCustomers();
                    });
                });
            </script>



            <script>
                $(document).ready(function () {
                    function loadMap(year) {
                        $.ajax({
                            url: "{{ route('Quote.customer.distribution') }}",
                            method: "GET",
                            data: { year: year }, // Send selected year to the server
                            success: function (response) {
                                var markers = [];

                                // Mapping ZIP codes to lat/lng
                                var zipCoordinates = {
                                    " MA, 01020": { latLng: [42.175, -72.520], name: "MA, 01020" },
                                    " MA, 01021": { latLng: [42.175, -72.520], name: "MA, 01021" },
                                    " MA, 01532": { latLng: [42.320, -71.644], name: "MA, 01532" },
                                    " NY, 11234": { latLng: [40.618, -73.918], name: "NY, 11234" },
                                    " NY, 12007": { latLng: [42.430, -73.820], name: "NY, 12007" },
                                    " MD, 21222": { latLng: [39.272, -76.478], name: "MD, 21222" },
                                    " VA, 24250": { latLng: [36.870, -81.500], name: "VA, 24250" },
                                    " FL, 32226": { latLng: [30.490, -81.560], name: "FL, 32226" }
                                };

                                // Convert API response to marker format
                                response.forEach(function (data) {
                                    if (zipCoordinates[data.state]) {
                                        markers.push({
                                            latLng: zipCoordinates[data.state].latLng,
                                            name: data.state + " (" + data.customer_count + " customers)"
                                        });
                                    }
                                });

                                // Destroy the existing map before reinitializing
                                $("#world-map-markers").html(""); // Clear previous map

                                // Initialize the Vector Map with the new data
                                $("#world-map-markers").vectorMap({
                                    map: "world_mill_en",
                                    backgroundColor: "transparent",
                                    regionStyle: {
                                        initial: { fill: "#419ebf" }
                                    },
                                    markerStyle: {
                                        initial: {
                                            r: 9,
                                            fill: "#e1000a",
                                            "fill-opacity": 0.9,
                                            stroke: "#ffffff",
                                            "stroke-width": 7,
                                            "stroke-opacity": 0.7
                                        },
                                        hover: {
                                            stroke: "#ffffff",
                                            "fill-opacity": 1,
                                            "stroke-width": 1.5
                                        }
                                    },
                                    markers: markers
                                });
                            },
                            error: function () {
                                alert("Failed to fetch customer distribution data.");
                            }
                        });
                    }

                    // Load map with default year (current year)
                    loadMap($("#year-select2").val());

                    // Reload map when year changes
                    $("#year-select2").change(function () {
                        loadMap($(this).val());
                    });
                });
            </script>




@endsection


