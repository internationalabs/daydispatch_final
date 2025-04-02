@section('Expired', 'mm-active')

@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
@endphp

<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>{{ $currentUser->usr_type }} Listing</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Expired</li>
    </ol>

</div>
<!-- End Breadcrumb Area -->
@include('partials.global-search')
<div class="card">
    <div class="card-body">
        {{-- <div class="table-responsive dataTables_wrapper me-0 d-flex">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <table>
                    <tbody class="dataTables_filter">
                    <tr>
                        <td><strong>Search For: </strong></td>
                        <td>
                            <select class="form-control ml-1" id="Search_Criteria" name="Search_Criteria">
                                <option value="1" selected>Order ID</option>
                                <option value="2">Pickup City</option>
                                <option value="3">Pickup State</option>
                                <option value="4">Delivery City</option>
                                <option value="5">Delivery State</option>
                            </select>
                        </td>
                        <td>
                            <input class="form-control" id="Search_Value" placeholder="Enter Search Value"
                                   type="search" name="Search_Value">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <table>
                    <tbody class="dataTables_filter">
                    <tr>
                        <td><strong>Time Frame: </strong></td>
                        <td>
                            <select class="form-control ml-1" id="Time_Frame" name="Time_Frame">
                                <option value="1" selected>EveryThing</option>
                                <option value="2">03 Months</option>
                                <option value="3">06 Months</option>
                                <option value="4">01 Year</option>
                                <option value="5">03 Years</option>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div> --}}
        <div class="table-responsive">
            <table class="table-1 dataTable advance-6 datatable-range text-center table-bordered table-cards">
                <thead class="table-header">
                <tr>
                    <th>ID</th>
                    <th>Routes</th>
                    <th>Load Details</th>
                    <th>Payments</th>
                    <th>Dates</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($Lisiting as $List)
                    <tr class="card-row" data-status="active">
                        <td>
                            <div><strong style="font-size: 14px;"></strong><br><span
                                class="badge badge-pill badge-primary">Expired</span></div>
                            <span style="font-size: x-large;"><strong>{{ $List->Ref_ID }}</strong></span><br>
                            @if(count($List->attachments) > 0)
                                <strong><a
                                        href="{{ route('Order.Attachments', ['List_ID' => $List->id]) }}"
                                        target="_blank">View Images</a></strong>
                            @endif
                        </td>
                        <td>
                            <span style="font-size: large;"><strong>Pickup:</strong></span><br>
                            <a class="text-nowrap" href="https://www.google.com/maps/place/{{ urlencode($List->routes->Origin_ZipCode) }}"
                                   target="_blank">
                                   {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                {{ Str::replace(',', '-', $List->routes->Origin_ZipCode) }}
                            </a><br>
                            <span style="font-size: large;"><strong>Delivery:</strong></span><br>
                            <a class="text-nowrap" href="https://www.google.com/maps/place/{{ urlencode($List->routes->Dest_ZipCode) }}"
                                   target="_blank">
                                   {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                {{ Str::replace(',', '-', $List->routes->Dest_ZipCode) }}
                            </a>
                            <div class="mb-2">
                                <span class="fs-5"><strong><a class="badge badge-pill badge-primary"
                                    href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                    target="_blank">View Route</a></strong></span>
                            </div>
                        </td>
                        <td>
                            @if(count($List->vehicles) === 1)
                                @foreach ($List->vehicles as $vehcile)
                                <span style="font-size: large; "><a class="font-weight-bold text-dark"
                                    href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                    target="_blank"><strong>{{ $vehcile->Vehcile_Year }}
                                        {{ $vehcile->Vehcile_Make }}
                                        {{ $vehcile->Vehcile_Model }}</strong></a></span><br>
                                    @if (!empty($vehcile->Vehcile_Condition))
                                        <span
                                            class="badge badge-pill mt-2 @if ($vehcile->Vehcile_Condition == 'Running') badge-success @elseif($vehcile->Vehcile_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                            style="font-size: 16px;">
                                            {{ $vehcile->Vehcile_Condition }}
                                        </span>
                                    @endif
                                    @if (!empty($vehcile->Trailer_Type))
                                        <span class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                            style="font-size: 16px;">{{ $vehcile->Trailer_Type }}</span>
                                    @endif
                                @endforeach
                            @endif
                            @if(count($List->vehicles) > 1)
                                {{-- <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                   data-trigger="focus" style="cursor: pointer;"
                                   title="Attached vehicles" data-content=
                                       "@foreach ($List->vehicles as $vehcile)
                                    <a href='https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}'
                                    target='_blank'> {{ $vehcile->Vehcile_Year }}
                                    {{ $vehcile->Vehcile_Make }}
                                    {{ $vehcile->Vehcile_Model }}</a><br>
                                    @if (!empty($vehcile->Vehcile_Condition))
                                        {{ $vehcile->Vehcile_Condition }}<br>
                                    @endif
                                    @if (!empty($vehcile->Trailer_Type))
                                        {{ $vehcile->Trailer_Type }} <br>
                                    @endif
                                    @endforeach" data-html="true">vehicles ({{ count($List->vehicles) }})
                                </a> --}}
                                <div class="dropdown">
                                    <a href="javascript:void(0)" class="dropdown-toggle"
                                        data-toggle="dropdown" style="cursor: pointer;">vehicles
                                        ({{ count($List->vehicles) }})
                                    </a>
                                    <div class="dropdown-menu text-center">
                                        <h6 class="dropdown-header" style="background-color: lightgrey;">Attached Vehicles</h6>
                                        @foreach ($List->vehicles as $vehcile)
                                            <a class="dropdown-item" style="color: #0d6efd; font-weight: 800;"
                                                href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                target="_blank">{{ $vehcile->Vehcile_Year }}{{ $vehcile->Vehcile_Make }}{{ $vehcile->Vehcile_Model }}</a>
                                            @if (!empty($vehcile->Vehcile_Condition))
                                                <span
                                                    class="badge badge-pill mt-2 @if ($vehcile->Vehcile_Condition == 'Running') badge-success @elseif($vehcile->Vehcile_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                    style="font-size: 16px;">
                                                    {{ $vehcile->Vehcile_Condition }}
                                                </span>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                <span class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                    style="font-size: 16px;">{{ $vehcile->Trailer_Type }}</span>
                                            @endif
                                            {{-- @if (!empty($vehcile->Vehcile_Condition))
                                                <div class="badge rounded-pill bg-success text-white">
                                                    {{ $vehcile->Vehcile_Condition }}</div>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                {{ $vehcile->Trailer_Type }}
                                            @endif --}}
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if(count($List->heavy_equipments) === 1)
                                @foreach ($List->heavy_equipments as $vehcile)
                                  {{-- <p class="ymm">  {{ $vehcile->Equipment_Year }}
                                    {{ $vehcile->Equipment_Make }}
                                    {{ $vehcile->Equipment_Model }}</p><br> --}}

                                    <a style="color: mediumvioletred; font-weight: 800;" href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}' 
                                               target='_blank'>
                                               {{ $vehcile->Equipment_Year }} {{ $vehcile->Equipment_Make }} {{ $vehcile->Equipment_Model }}
                                            </a><br>
                                            
                                    @if (!empty($vehcile->Equipment_Condition))
                                        <span>{{ $vehcile->Equipment_Condition }}</span><br>
                                    @endif
                                    @if (!empty($vehcile->Trailer_Type))
                                       <span> {{ $vehcile->Trailer_Type }}</span> <br>
                                    @endif
                                @endforeach
                            @endif
                            @if(count($List->heavy_equipments) > 1)
                                <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                   data-trigger="focus" style="cursor: pointer;"
                                   title="Attached vehicles" data-content=
                                       "@foreach ($List->heavy_equipments as $vehcile)
                                    {{ $vehcile->Equipment_Year }}
                                    {{ $vehcile->Equipment_Make }}
                                    {{ $vehcile->Equipment_Model }}<br>
                                    @if (!empty($vehcile->Equipment_Condition))
                                        {{ $vehcile->Equipment_Condition }}<br>
                                    @endif
                                    @if (!empty($vehcile->Trailer_Type))
                                        {{ $vehcile->Trailer_Type }} <br>
                                    @endif
                                @endforeach" data-html="true">vehicles ({{ count($List->heavy_equipments) }})
                                </a>
                            @endif
                            @if(count($List->dry_vans) === 1)
                                @foreach ($List->dry_vans as $vehcile)
                                    {{ $vehcile->Freight_Class }}
                                    {{ $vehcile->Freight_Weight }}<br>
                                    @if ($vehcile->is_hazmat_Check !== 0)
                                        Hazmat Required<br>
                                    @endif
                                @endforeach
                            @endif
                            @if(count($List->dry_vans) > 1)
                                <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                   data-trigger="focus" style="cursor: pointer;"
                                   title="Attached vehicles" data-content=
                                       "@foreach ($List->dry_vans as $vehcile)
                                    {{ $vehcile->Freight_Class }}
                                    {{ $vehcile->Freight_Weight }}<br>
                                    @if ($vehcile->is_hazmat_Check !== 0)
                                        Hazmat Required<br>
                                    @endif
                                @endforeach" data-html="true">vehicles ({{ count($List->dry_vans) }})
                                </a>
                            @endif
                            <br>
                            <div class="dropdown">
                                <a href="javascript:void(0)" tabindex="0" class="btn btn-link dropdown-toggle"
                                    id="additionalTermsDropdown" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    {{ !empty($List->additional_info->Additional_Terms)
                                        ? Str::limit($List->additional_info->Additional_Terms, 20)
                                        : '...' }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="additionalTermsDropdown">
                                    <p class="dropdown-item">
                                        {{ !empty($List->additional_info->Additional_Terms)
                                            ? $List->additional_info->Additional_Terms
                                            : 'No additional terms available' }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong>Price to Pay: </strong><span>${{ $List->paymentinfo->COD_Amount }}</span><br>
                            <strong>COD/COP:</strong>{{ $List->paymentinfo->COD_Method_Mode }}<br>
                            {{ $List->routes->Miles }}miles<br>
                            ${{ DayDispatchHelper::PricePerMiles($List->paymentinfo->COD_Amount, $List->routes->Miles) }}
                            /miles
                        </td>
                        <td>
                            <strong>Pickup Date: </strong><br>
                            ({{ $List->pickup_delivery_info->Pickup_Date_mode }})
                            {{ $List->pickup_delivery_info->Pickup_Date }}
                            <br>
                            <strong>Deliver Date: </strong><br>
                            ({{ $List->pickup_delivery_info->Delivery_Date_mode }})
                            {{ $List->pickup_delivery_info->Delivery_Date }}
                            <strong>Expired Date: </strong><br>
                            {{ $List->expire_at }}
                        </td>
                        <td>
                            {{-- <div class="row d-block"> --}}
                                @if ($List->user_id === $currentUser->id)
                                    <a href="{{ route('User.ReList.Expired.Listing', ['List_ID' => $List->id]) }}"
                                        target="_blank">
                                        <button class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap">
                                            Re-List
                                        </button>
                                    </a>
                                    <a href="{{ route('User.Expire.Re.Edit.Listing', ['List_ID' => $List->id]) }}"
                                        target="_blank">
                                        <button class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap">
                                            Re-List & Edit
                                        </button>
                                    </a>
                                @endif
                            {{-- </div> --}}
                            {{-- <div class="dropdown show list-actions">
                                <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                   role="button" data-toggle="dropdown" aria-haspopup="true">
                                    Actions
                                </a>
                                <div class="dropdown-menu">
                                    @if ($List->user_id === $currentUser->id)
                                        <a class="dropdown-item"
                                           href="{{ route('User.ReList.Expired.Listing', ['List_ID' => $List->id]) }}"
                                           target="_blank">Re-List</a>
                                    @endif
                                    @if ($List->user_id === $currentUser->id)
                                        <a class="dropdown-item"
                                           href="{{ route('User.Expire.Re.Edit.Listing', ['List_ID' => $List->id]) }}"
                                           target="_blank">Re-List & Edit</a>
                                    @endif
                                </div>
                            </div> --}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    // $('.advance-6').DataTable({
    //     "deferRender": true,
    // });
</script>
