<style>
    .cargo-details p {
    margin: 0;
    font-size: 14px;
    line-height: 1.5;
}
.vehicle-details, .equipment-details, .dry-van-details {
    border-bottom: 1px dashed #ccc;
    padding-bottom: 8px;
    margin-bottom: 8px;
}
.vehicle-details:last-child, .equipment-details:last-child, .dry-van-details:last-child {
    border-bottom: none;
}

</style>
@if (count($data) > 0)
<div class="table-responsive">
    <table class="display dataTable advance-6 table-1 table-cards table-bordered table-hover table-striped text-center carrier-all-request">
        <thead class="table-header">
        <tr>
            <th>Cargo</th>
            <th>Route</th>
            <th>Price</th>
            <th>Accepted by Carrier?</th>
            <th>Comparable Price for {{ $miles }}/mi</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $row)
            <tr class="card-row" data-status="active">
                <!-- Cargo Details -->
                {{-- <td>
                    @if ($row->vehicles->isNotEmpty())
                        @foreach ($row->vehicles as $vehicle)
                            <span><i class="fas fa-truck"></i> {{ $vehicle->Vehcile_Type }}</span><br>
                            <span><i class="fas fa-tools"></i> {{ $vehicle->Vehcile_Condition }}</span><br>
                            <span><i class="fas fa-trailer"></i> {{ $vehicle->Trailer_Type }}</span>
                        @endforeach
                    @elseif ($row->heavy_equipments->isNotEmpty())
                        @foreach ($row->heavy_equipments as $equipment)
                            <span><i class="fas fa-cogs"></i> {{ $equipment->Shipment_Preferences }}</span><br>
                            <span><i class="fas fa-tools"></i> {{ $equipment->Equipment_Condition }}</span><br>
                            <span><i class="fas fa-trailer"></i> {{ $equipment->Trailer_Type }}</span>
                        @endforeach
                    @elseif ($row->dry_vans->isNotEmpty())
                        @foreach ($row->dry_vans as $van)
                            <span><i class="fas fa-box"></i> {{ $van->Freight_Class }}</span><br>
                            <span><i class="fas fa-weight-hanging"></i> {{ $van->Freight_Weight }}</span>
                        @endforeach
                    @endif
                </td> --}}
                <td>
                    <div class="cargo-details">
                        @if ($row->vehicles->isNotEmpty())
                            @foreach ($row->vehicles as $vehicle)
                                <div class="vehicle-details mb-2">
                                    <p><i class="fas fa-truck text-primary"></i> <strong>Type:</strong> {{ $vehicle->Vehcile_Type }}</p>
                                    <p><i class="fas fa-tools text-secondary"></i> <strong>Condition:</strong> {{ $vehicle->Vehcile_Condition }}</p>
                                    <p><i class="fas fa-trailer text-success"></i> <strong>Trailer:</strong> {{ $vehicle->Trailer_Type }}</p>
                                </div>
                            @endforeach
                        @elseif ($row->heavy_equipments->isNotEmpty())
                            @foreach ($row->heavy_equipments as $equipment)
                                <div class="equipment-details mb-2">
                                    <p><i class="fas fa-cogs text-info"></i> <strong>Preferences:</strong> {{ $equipment->Shipment_Preferences }}</p>
                                    <p><i class="fas fa-tools text-secondary"></i> <strong>Condition:</strong> {{ $equipment->Equipment_Condition }}</p>
                                    <p><i class="fas fa-trailer text-success"></i> <strong>Trailer:</strong> {{ $equipment->Trailer_Type }}</p>
                                </div>
                            @endforeach
                        @elseif ($row->dry_vans->isNotEmpty())
                            @foreach ($row->dry_vans as $van)
                                <div class="dry-van-details mb-2">
                                    <p><i class="fas fa-box text-warning"></i> <strong>Class:</strong> {{ $van->Freight_Class }}</p>
                                    <p><i class="fas fa-weight-hanging text-muted"></i> <strong>Weight:</strong> {{ $van->Freight_Weight }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-danger"><i class="fas fa-exclamation-circle"></i> No Data Available</p>
                        @endif
                    </div>
                </td>                
                {{-- <td>
                    <div class="cargo-details">
                        @if ($row->vehicles->count() > 1)
                            <div class="accordion" id="vehicleAccordion{{ $row->id }}">
                                @foreach ($row->vehicles as $index => $vehicle)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $row->id }}-{{ $index }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#collapse{{ $row->id }}-{{ $index }}" 
                                                aria-expanded="false" aria-controls="collapse{{ $row->id }}-{{ $index }}">
                                                Vehicle {{ $index + 1 }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $row->id }}-{{ $index }}" class="accordion-collapse collapse" 
                                            aria-labelledby="heading{{ $row->id }}-{{ $index }}" 
                                            data-bs-parent="#vehicleAccordion{{ $row->id }}">
                                            <div class="accordion-body">
                                                <p><i class="fas fa-truck text-primary"></i> <strong>Type:</strong> {{ $vehicle->Vehcile_Type }}</p>
                                                <p><i class="fas fa-tools text-secondary"></i> <strong>Condition:</strong> {{ $vehicle->Vehcile_Condition }}</p>
                                                <p><i class="fas fa-trailer text-success"></i> <strong>Trailer:</strong> {{ $vehicle->Trailer_Type }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @elseif ($row->vehicles->count() === 1)
                            @foreach ($row->vehicles as $vehicle)
                                <div class="vehicle-details">
                                    <p><i class="fas fa-truck text-primary"></i> <strong>Type:</strong> {{ $vehicle->Vehcile_Type }}</p>
                                    <p><i class="fas fa-tools text-secondary"></i> <strong>Condition:</strong> {{ $vehicle->Vehcile_Condition }}</p>
                                    <p><i class="fas fa-trailer text-success"></i> <strong>Trailer:</strong> {{ $vehicle->Trailer_Type }}</p>
                                </div>
                            @endforeach
                        @elseif ($row->heavy_equipments->isNotEmpty())
                            @foreach ($row->heavy_equipments as $equipment)
                                <div class="equipment-details">
                                    <p><i class="fas fa-cogs text-info"></i> <strong>Preferences:</strong> {{ $equipment->Shipment_Preferences }}</p>
                                    <p><i class="fas fa-tools text-secondary"></i> <strong>Condition:</strong> {{ $equipment->Equipment_Condition }}</p>
                                    <p><i class="fas fa-trailer text-success"></i> <strong>Trailer:</strong> {{ $equipment->Trailer_Type }}</p>
                                </div>
                            @endforeach
                        @elseif ($row->dry_vans->isNotEmpty())
                            @foreach ($row->dry_vans as $van)
                                <div class="dry-van-details">
                                    <p><i class="fas fa-box text-warning"></i> <strong>Class:</strong> {{ $van->Freight_Class }}</p>
                                    <p><i class="fas fa-weight-hanging text-muted"></i> <strong>Weight:</strong> {{ $van->Freight_Weight }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-danger"><i class="fas fa-exclamation-circle"></i> No Data Available</p>
                        @endif
                    </div>
                </td> --}}
                <td>
                    <strong><i class="fas fa-map-marker-alt"></i> PickUp:</strong> {{ $row->routes->Origin_ZipCode }}<br>
                    <strong><i class="fas fa-map-pin"></i> Delivery:</strong> {{ $row->routes->Dest_ZipCode }}<br>
                </td>
                
                <td>${{ $row->paymentinfo->Order_Booking_Price }}</td>
                
                <td>
                    @if ($row->dispatch_listing)
                        <span class="text-success"><strong>Yes <i class="fas fa-check-circle"></i></strong></span>
                    @else
                        <span class="text-danger"><strong>No <i class="fas fa-times-circle"></i></strong></span>
                    @endif
                </td>
                
                <td>${{ $row->paymentinfo->Order_Booking_Price }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@else
<div class="text-center">
    <p class="alert alert-warning"><i class="fas fa-info-circle"></i> No Data Found</p>
</div>
@endif
