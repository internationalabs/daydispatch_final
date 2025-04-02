<div class="location-area pt-80 pb-80 wow fadeInUp" data-wow-delay=".3s">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <nav>
                    <div class="country-tab mb-40">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-tab-1-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-tab-1" type="button" role="tab" aria-controls="nav-tab-1"
                                aria-selected="true">Vehicle
                            </button>
                            <button class="nav-link" id="nav-tab-2-tab" data-bs-toggle="tab" data-bs-target="#nav-tab-2"
                                type="button" role="tab" aria-controls="nav-tab-2" aria-selected="false">Heavy
                                EQUIP... (LTL)
                            </button>
                            <button class="nav-link" id="nav-tab-4-tab" data-bs-toggle="tab" data-bs-target="#nav-tab-4"
                                type="button" role="tab" aria-controls="nav-tab-4" aria-selected="false">Heavy
                                EQUIP...(FTL)
                            </button>
                            <button class="nav-link" id="nav-tab-3-tab" data-bs-toggle="tab" data-bs-target="#nav-tab-3"
                                type="button" role="tab" aria-controls="nav-tab-3" aria-selected="false">Freight
                                Shipping (LTL)
                            </button>
                            <button class="nav-link" id="nav-tab-5-tab" data-bs-toggle="tab" data-bs-target="#nav-tab-5"
                                type="button" role="tab" aria-controls="nav-tab-5" aria-selected="false">Freight
                                Shipping (FTL)
                            </button>
                        </div>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-tab-1" role="tabpanel"
                        aria-labelledby="nav-tab-1-tab">
                        <div class="cart-area">
                            <div class="container-fluid container-small">
                                <div class="row wow fadeInUp" data-wow-delay=".3s">
                                    <div class="col-12">
                                        <form action="#">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="pickup-search">Search Pickup:</label>
                                                    <input type="text" id="pickup-search"
                                                        class="form-control pickup-search" placeholder="Search Pickup">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="delivery-search">Search Delivery:</label>
                                                    <input type="text" id="delivery-search"
                                                        class="form-control delivery-search"
                                                        placeholder="Search Delivery">
                                                </div>
                                            </div>
                                            <div class="table-content table-responsive">
                                                <table
                                                    class="display dataTable advance-7692 text-center table-1 table-bordered table-cards">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-thumbnail">REF ID#</th>
                                                            <th class="cart-product-name">PICKUP</th>
                                                            <th class="product-price">DELIVERY</th>
                                                            <th class="product-quantity">VEHICLE DETAILS</th>
                                                            <th class="product-subtotal">CUSTOMER/PAYMENT</th>
                                                            <th class="product-remove">POSTED DATE</th>
                                                            <th class="product-remove">ACTIONS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @forelse ($Listing_I as $List)
                                                            <tr>
                                                                <td class="product-thumbnail"><span
                                                                        class="badge rounded-pill bg-success">{{ $List->Ref_ID }}</span>
                                                                </td>
                                                                <td class="product-name"><a
                                                                        href="JavaScript:void(0);"><i
                                                                            class="fa-solid fa-location-dot"
                                                                            style="color:green;"></i>{{ $List->routes->Origin_ZipCode }}
                                                                    </a><br>PickUp:
                                                                    {{ $List->pickup_delivery_info->Pickup_Date_mode }}

                                                                </td>
                                                                <td class="product-name"><a
                                                                        href="JavaScript:void(0);"><i
                                                                            class="fa-solid fa-location-dot"
                                                                            style="color:red;"></i>{{ $List->routes->Dest_ZipCode }}
                                                                    </a><br>
                                                                    Delivery:
                                                                    {{ $List->pickup_delivery_info->Delivery_Date_mode }}

                                                                </td>
                                                                <td class="product-quantity">
                                                                    @foreach ($List->vehicles as $vehcile)
                                                                        {{ $vehcile->Vehcile_Year }}
                                                                        {{ $vehcile->Vehcile_Make }}
                                                                        {{ $vehcile->Vehcile_Model }} <br>
                                                                    @endforeach
                                                                    {{ $List->routes->Miles }} / miles
                                                                </td>
                                                                <td class="product-subtotal">
                                                                    <strong>Price to Pay: </strong><span
                                                                        class="amount">${{ $List->paymentinfo->Price_Pay_Carrier ?? 0 }}</span><br>
                                                                    <strong>COD/COP: </strong><span
                                                                        class="amount">${{ $List->paymentinfo->COD_Amount ?? 0 }}</span><br>
                                                                    {{ $List->paymentinfo->COD_Method_Mode ?? 0 }} On
                                                                    {{ $List->paymentinfo->COD_Location_Amount ?? 0 }}
                                                                </td>
                                                                <td class="product-remove"><strong>Posted On:
                                                                    </strong><br>
                                                                    {{ $List->created_at }}</td>
                                                                <td class="product-quantity">
                                                                    @if (Auth::guard('Authorized')->user())
                                                                        <form
                                                                            action="{{ route('global.search.index') }}"
                                                                            method="GET" class="was-validated">
                                                                            @csrf
                                                                            <input type="hidden"
                                                                                name="search_criteria" value=1>
                                                                            <input type="hidden" name="search_query"
                                                                                value="{{ $List->Ref_ID }}">
                                                                            <button type="submit"
                                                                                class="fill-btn">Request Load</button>
                                                                        </form>
                                                                    @else
                                                                        <a href="{{ route('Auth.Forms') }}"
                                                                            class="fill-btn">Request
                                                                            Load</a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="7">Load Boards Are Empty</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-tab-2" role="tabpanel" aria-labelledby="nav-tab-2-tab">
                        <div class="cart-area">
                            <div class="container-fluid container-small">
                                <div class="row wow fadeInUp" data-wow-delay=".3s">
                                    <div class="col-12">
                                        <form action="#">
                                            <div class="table-content table-responsive">
                                                <table
                                                    class="display dataTable advance-769 text-center table-1 table-bordered table-cards">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-thumbnail">REF ID#</th>
                                                            <th class="cart-product-name">PICKUP</th>
                                                            <th class="product-price">DELIVERY</th>
                                                            <th class="product-quantity">VEHICLE DETAILS</th>
                                                            <th class="product-subtotal">CUSTOMER/PAYMENT</th>
                                                            <th class="product-remove">POSTED DATE</th>
                                                            <th class="product-remove">ACTIONS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @forelse ($Listing_II as $List)
                                                            <tr>
                                                                <td class="product-thumbnail"><span
                                                                        class="badge rounded-pill bg-success">{{ $List->Ref_ID }}</span>
                                                                </td>
                                                                <td class="product-name"><a
                                                                        href="JavaScript:void(0);"><i
                                                                            class="fa-solid fa-location-dot"
                                                                            style="color:green;"></i>{{ $List->routes->Origin_ZipCode }}
                                                                    </a><br>PickUp:
                                                                    {{ $List->pickup_delivery_info->Pickup_Date_mode }}
                                                                </td>
                                                                <td class="product-name"><a
                                                                        href="JavaScript:void(0);"><i
                                                                            class="fa-solid fa-location-dot"
                                                                            style="color:red;"></i>{{ $List->routes->Dest_ZipCode }}
                                                                    </a><br>
                                                                    Delivery:
                                                                    {{ $List->pickup_delivery_info->Delivery_Date_mode }}
                                                                </td>
                                                                <td class="product-quantity">
                                                                    @foreach ($List->heavy_equipments as $vehcile)
                                                                        {{ $vehcile->Equipment_Year }}
                                                                        {{ $vehcile->Equipment_Make }}
                                                                        {{ $vehcile->Equipment_Model }} <br>
                                                                    @endforeach
                                                                    {{ $List->routes->Miles }} / miles
                                                                </td>
                                                                <td class="product-subtotal">
                                                                    <strong>Price to Pay: </strong><span
                                                                        class="amount">${{ $List->paymentinfo->Price_Pay_Carrier ?? 0 }}</span><br>
                                                                    <strong>COD/COP: </strong><span
                                                                        class="amount">${{ $List->paymentinfo->COD_Amount ?? 0 }}</span><br>
                                                                    {{ $List->paymentinfo->COD_Method_Mode ?? 0 }} On
                                                                    {{ $List->paymentinfo->COD_Location_Amount ?? 0 }}
                                                                </td>
                                                                <td class="product-remove"><strong>Posted On:
                                                                    </strong><br>
                                                                    {{ $List->created_at }}</td>
                                                                <td class="product-quantity">
                                                                    @if (Auth::guard('Authorized')->user())
                                                                        <form
                                                                            action="{{ route('global.search.index') }}"
                                                                            method="GET" class="was-validated">
                                                                            @csrf
                                                                            <input type="hidden"
                                                                                name="search_criteria" value=1>
                                                                            <input type="hidden" name="search_query"
                                                                                value="{{ $List->Ref_ID }}">
                                                                            <button type="submit"
                                                                                class="fill-btn">Request Load</button>
                                                                        </form>
                                                                    @else
                                                                        <a href="{{ route('Auth.Forms') }}"
                                                                            class="fill-btn">Request
                                                                            Load</a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="7">Load Boards Are Empty</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-tab-4" role="tabpanel" aria-labelledby="nav-tab-4-tab">
                        <div class="cart-area">
                            <div class="container-fluid container-small">
                                <div class="row wow fadeInUp" data-wow-delay=".3s">
                                    <div class="col-12">
                                        <form action="#">
                                            <div class="table-content table-responsive">
                                                <table
                                                    class="display dataTable advance-769 text-center table-1 table-bordered table-cards">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-thumbnail">REF ID#</th>
                                                            <th class="cart-product-name">PICKUP</th>
                                                            <th class="product-price">DELIVERY</th>
                                                            <th class="product-quantity">VEHICLE DETAILS</th>
                                                            <th class="product-subtotal">CUSTOMER/PAYMENT</th>
                                                            <th class="product-remove">POSTED DATE</th>
                                                            <th class="product-remove">ACTIONS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($Listing_IV as $List)
                                                            <tr>
                                                                <td class="product-thumbnail"><span
                                                                        class="badge rounded-pill bg-success">{{ $List->Ref_ID }}</span>
                                                                </td>
                                                                <td class="product-name"><a
                                                                        href="JavaScript:void(0);"><i
                                                                            class="fa-solid fa-location-dot"
                                                                            style="color:green;"></i>{{ $List->routes->Origin_ZipCode }}
                                                                    </a><br>PickUp:
                                                                    {{ $List->pickup_delivery_info->Pickup_Date_mode }}
                                                                </td>
                                                                <td class="product-name"><a
                                                                        href="JavaScript:void(0);"><i
                                                                            class="fa-solid fa-location-dot"
                                                                            style="color:red;"></i>{{ $List->routes->Dest_ZipCode }}
                                                                    </a><br>
                                                                    Delivery:
                                                                    {{ $List->pickup_delivery_info->Delivery_Date_mode }}
                                                                </td>
                                                                <td class="product-quantity">
                                                                    @foreach ($List->heavy_equipments as $vehcile)
                                                                        {{ $vehcile->Equipment_Year }}
                                                                        {{ $vehcile->Equipment_Make }}
                                                                        {{ $vehcile->Equipment_Model }} <br>
                                                                    @endforeach
                                                                    {{ $List->routes->Miles }} / miles
                                                                </td>
                                                                <td class="product-subtotal">
                                                                    <strong>Price to Pay: </strong><span
                                                                        class="amount">${{ $List->paymentinfo->Price_Pay_Carrier ?? 0 }}</span><br>
                                                                    <strong>COD/COP: </strong><span
                                                                        class="amount">${{ $List->paymentinfo->COD_Amount ?? 0 }}</span><br>
                                                                    {{ $List->paymentinfo->COD_Method_Mode ?? 0 }} On
                                                                    {{ $List->paymentinfo->COD_Location_Amount ?? 0 }}
                                                                </td>
                                                                <td class="product-remove"><strong>Posted On:
                                                                    </strong><br>
                                                                    {{ $List->created_at }}</td>
                                                                <td class="product-quantity">
                                                                    @if (Auth::guard('Authorized')->user())
                                                                        <form
                                                                            action="{{ route('global.search.index') }}"
                                                                            method="GET" class="was-validated">
                                                                            @csrf
                                                                            <input type="hidden"
                                                                                name="search_criteria" value=1>
                                                                            <input type="hidden" name="search_query"
                                                                                value="{{ $List->Ref_ID }}">
                                                                            <button type="submit"
                                                                                class="fill-btn">Request Load</button>
                                                                        </form>
                                                                    @else
                                                                        <a href="{{ route('Auth.Forms') }}"
                                                                            class="fill-btn">Request
                                                                            Load</a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="7">Load Boards Are Empty</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-tab-3" role="tabpanel" aria-labelledby="nav-tab-3-tab">
                        <div class="cart-area">
                            <div class="container-fluid container-small">
                                <div class="row wow fadeInUp" data-wow-delay=".3s">
                                    <div class="col-12">
                                        <form action="#">
                                            <div class="table-content table-responsive">
                                                <table
                                                    class="display dataTable advance-769 text-center table-1 table-bordered table-cards">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-thumbnail">REF ID#</th>
                                                            <th class="cart-product-name">PICKUP</th>
                                                            <th class="product-price">DELIVERY</th>
                                                            <th class="product-quantity">VEHICLE DETAILS</th>
                                                            <th class="product-subtotal">CUSTOMER/PAYMENT</th>
                                                            <th class="product-remove">POSTED DATE</th>
                                                            <th class="product-remove">ACTIONS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @forelse ($Listing_III as $List)
                                                            <tr>
                                                                <td class="product-thumbnail"><span
                                                                        class="badge rounded-pill bg-success">{{ $List->Ref_ID }}</span>
                                                                </td>
                                                                <td class="product-name"><a
                                                                        href="JavaScript:void(0);"><i
                                                                            class="fa-solid fa-location-dot"
                                                                            style="color:green;"></i>{{ $List->routes->Origin_ZipCode }}
                                                                    </a><br>PickUp:
                                                                    {{ $List->pickup_delivery_info->Pickup_Date_mode }}
                                                                </td>
                                                                <td class="product-name"><a
                                                                        href="JavaScript:void(0);"><i
                                                                            class="fa-solid fa-location-dot"
                                                                            style="color:red;"></i>{{ $List->routes->Dest_ZipCode }}
                                                                    </a><br>
                                                                    Delivery:
                                                                    {{ $List->pickup_delivery_info->Delivery_Date_mode }}
                                                                </td>
                                                                <td class="product-quantity">
                                                                    @foreach ($List->vehicles as $vehcile)
                                                                        {{ $vehcile->Vehcile_Year }}
                                                                        {{ $vehcile->Vehcile_Make }}
                                                                        {{ $vehcile->Vehcile_Model }} <br>
                                                                    @endforeach
                                                                    {{ $List->routes->Miles }} / miles
                                                                </td>
                                                                <td class="product-subtotal">
                                                                    <strong>Price to Pay: </strong><span
                                                                        class="amount">${{ $List->paymentinfo->Price_Pay_Carrier ?? 0 }}</span><br>
                                                                    <strong>COD/COP: </strong><span
                                                                        class="amount">${{ $List->paymentinfo->COD_Amount ?? 0 }}</span><br>
                                                                    {{ $List->paymentinfo->COD_Method_Mode ?? 0 }} On
                                                                    {{ $List->paymentinfo->COD_Location_Amount ?? 0 }}
                                                                </td>
                                                                <td class="product-remove"><strong>Posted On:
                                                                    </strong><br>
                                                                    {{ $List->created_at }}</td>
                                                                <td class="product-quantity">
                                                                    @if (Auth::guard('Authorized')->user())
                                                                        <form
                                                                            action="{{ route('global.search.index') }}"
                                                                            method="GET" class="was-validated">
                                                                            @csrf
                                                                            <input type="hidden"
                                                                                name="search_criteria" value=1>
                                                                            <input type="hidden" name="search_query"
                                                                                value="{{ $List->Ref_ID }}">
                                                                            <button type="submit"
                                                                                class="fill-btn">Request Load</button>
                                                                        </form>
                                                                    @else
                                                                        <a href="{{ route('Auth.Forms') }}"
                                                                            class="fill-btn">Request
                                                                            Load</a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="7">Load Boards Are Empty</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-tab-5" role="tabpanel" aria-labelledby="nav-tab-5-tab">
                        <div class="cart-area">
                            <div class="container-fluid container-small">
                                <div class="row wow fadeInUp" data-wow-delay=".3s">
                                    <div class="col-12">
                                        <form action="#">
                                            <div class="table-content table-responsive">
                                                <table
                                                    class="display dataTable advance-769 text-center table-1 table-bordered table-cards">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-thumbnail">REF ID#</th>
                                                            <th class="cart-product-name">PICKUP</th>
                                                            <th class="product-price">DELIVERY</th>
                                                            <th class="product-quantity">VEHICLE DETAILS</th>
                                                            <th class="product-subtotal">CUSTOMER/PAYMENT</th>
                                                            <th class="product-remove">POSTED DATE</th>
                                                            <th class="product-remove">ACTIONS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @forelse ($Listing_V as $List)
                                                            <tr>
                                                                <td class="product-thumbnail"><span
                                                                        class="badge rounded-pill bg-success">{{ $List->Ref_ID }}</span>
                                                                </td>
                                                                <td class="product-name"><a
                                                                        href="JavaScript:void(0);"><i
                                                                            class="fa-solid fa-location-dot"
                                                                            style="color:green;"></i>{{ $List->routes->Origin_ZipCode }}
                                                                    </a><br>PickUp:
                                                                    {{ $List->pickup_delivery_info->Pickup_Date_mode }}
                                                                </td>
                                                                <td class="product-name"><a
                                                                        href="JavaScript:void(0);"><i
                                                                            class="fa-solid fa-location-dot"
                                                                            style="color:red;"></i>{{ $List->routes->Dest_ZipCode }}
                                                                    </a><br>
                                                                    Delivery:
                                                                    {{ $List->pickup_delivery_info->Delivery_Date_mode }}
                                                                </td>
                                                                <td class="product-quantity">
                                                                    @foreach ($List->vehicles as $vehcile)
                                                                        {{ $vehcile->Vehcile_Year }}
                                                                        {{ $vehcile->Vehcile_Make }}
                                                                        {{ $vehcile->Vehcile_Model }} <br>
                                                                    @endforeach
                                                                    {{ $List->routes->Miles }} / miles
                                                                </td>
                                                                <td class="product-subtotal">
                                                                    <strong>Price to Pay: </strong><span
                                                                        class="amount">${{ $List->paymentinfo->Price_Pay_Carrier ?? 0 }}</span><br>
                                                                    <strong>COD/COP: </strong><span
                                                                        class="amount">${{ $List->paymentinfo->COD_Amount ?? 0 }}</span><br>
                                                                    {{ $List->paymentinfo->COD_Method_Mode ?? 0 }} On
                                                                    {{ $List->paymentinfo->COD_Location_Amount ?? 0 }}
                                                                </td>
                                                                <td class="product-remove"><strong>Posted On:
                                                                    </strong><br>
                                                                    {{ $List->created_at }}</td>
                                                                <td class="product-quantity">
                                                                    @if (Auth::guard('Authorized')->user())
                                                                        <form
                                                                            action="{{ route('global.search.index') }}"
                                                                            method="GET" class="was-validated">
                                                                            @csrf
                                                                            <input type="hidden"
                                                                                name="search_criteria" value=1>
                                                                            <input type="hidden" name="search_query"
                                                                                value="{{ $List->Ref_ID }}">
                                                                            <button type="submit"
                                                                                class="fill-btn">Request Load</button>
                                                                        </form>
                                                                    @else
                                                                        <a href="{{ route('Auth.Forms') }}"
                                                                            class="fill-btn">Request
                                                                            Load</a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="7">Load Boards Are Empty</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- LoadBoard end  -->
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

<!-- Include DataTables JS -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    let table = $('.advance-7692').DataTable({
        "deferRender": true,
        "paging": true,
        "searching": true, // Keep searching enabled for custom inputs
        "ordering": true,
        "pagingType": "full_numbers",
        "lengthChange": false,
        "pageLength": 20,
        "dom": 'lrtip' // Excludes the default search box
    });

    $('.pickup-search').on('keyup', function() {
        table.column(1).search(this.value).draw();
    });

    $('.delivery-search').on('keyup', function() {
        table.column(2).search(this.value).draw();
    });
</script>
