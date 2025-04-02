<style>
    .custom {
        padding: 15px;
    }

    .btn.container.custom .btn-toggle {
        padding: 10px;
        border: none;
        filter: drop-shadow(0px 0px 2px grey);
        background: #ffffff;
        color: #1e2d62;
        border-radius: 5px;
        font-weight: 700;
    }

    .btn.container.custom .btn-toggle.active {
        background: #1e2d62;
        color: white;
    }
</style>

<table id="lanecarriersTable" role="tabpanel"
    class="table-hover table-sm display carrier-all-request dataTable advance-6 text-center table-1 table-bordered table-cards">
    <thead class="table-header">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Vehicle Information</th>
            <th>Date</th>
            <th>Contact</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $row)
            <tr class="card-row" data-status="active">
                <td class="view-action-column">
                    {{ $row->Ref_ID ?? 'N/A' }}
                </td>
                <td>
                    {{ $row->authorized_user->Company_Name ?? 'N/A' }}
                </td>
                <td>
                    @if (count($row->vehicles) === 1)
                        @foreach ($row->vehicles as $vehcile)
                            <a style="color: #0d6efd; font-weight: 800;"
                                href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                target="_blank"> {{ $vehcile->Vehcile_Year }}
                                {{ $vehcile->Vehcile_Make }}
                                {{ $vehcile->Vehcile_Model }}</a><br>

                            @if (!empty($vehcile->Vehcile_Condition))
                                <span
                                    class="badge rounded-pill bg-success text-white">{{ $vehcile->Vehcile_Condition }}<br></span>
                            @endif
                            @if (!empty($vehcile->Trailer_Type))
                                <span
                                    @if ($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="badge rounded-pill bg-success text-white" @endif>{{ $vehcile->Trailer_Type }}</span>
                                <br>
                            @endif
                        @endforeach
                    @endif
                    @if (count($row->vehicles) > 1)
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"
                                style="color: #0d6efd; font-weight: 800; cursor: pointer;">
                                Vehicles ({{ count($row->vehicles) }})
                            </a>
                            <div class="dropdown-menu text-center" style="max-height: 200px; overflow-y: auto;">
                                <h6 class="dropdown-header" style="background-color: lightgrey;">
                                    Attached Vehicles</h6>
                                @foreach ($row->vehicles as $vehicle)
                                    <a class="dropdown-item" style="color: #0d6efd; font-weight: 800;"
                                        href="https://www.google.com/search?q={{ $vehicle->Vehcile_Year }}%20{{ $vehicle->Vehcile_Make }}%20{{ $vehicle->Vehcile_Model }}"
                                        target="_blank">
                                        {{ $vehicle->Vehcile_Year }} {{ $vehicle->Vehcile_Make }}
                                        {{ $vehicle->Vehcile_Model }}
                                    </a>
                                    @if (!empty($vehicle->Vehcile_Condition))
                                        <div class="badge rounded-pill bg-success text-white">
                                            {{ $vehicle->Vehcile_Condition }}</div>
                                    @endif
                                    @if (!empty($vehicle->Trailer_Type))
                                        <div
                                            class="dropdown-item @if ($vehicle->Trailer_Type == "'(Enclosed Trailer Required)'") badge rounded-pill bg-success text-white @endif">
                                            {{ $vehicle->Trailer_Type }}
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if (count($row->heavy_equipments) === 1)
                        @foreach ($row->heavy_equipments as $vehcile)
                            <a style="color: #0d6efd; font-weight: 800;"
                                href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}'
                                target='_blank'>
                                {{ $vehcile->Equipment_Year }} {{ $vehcile->Equipment_Make }}
                                {{ $vehcile->Equipment_Model }}
                            </a><br>
                            <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }}
                            | <b>H</b>{{ $vehcile->Equip_Height }}
                            | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                            @if (!empty($vehcile->Equipment_Condition))
                                <br>{{ $vehcile->Equipment_Condition }}<br>
                            @endif
                            @if (!empty($vehcile->Trailer_Type))
                                <span
                                    @if ($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="badge rounded-pill bg-success text-white" @endif>{{ $vehcile->Trailer_Type }}</span>
                            @endif
                        @endforeach
                    @endif
                    @if (count($row->heavy_equipments) > 1)
                        <!-- <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                            data-trigger="focus" style="cursor: pointer;" title="Attached vehicles"
                                            data-content=
                                        "@foreach ($row->heavy_equipments as $vehcile)
                                        <a href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}' 
                                           target='_blank'>
                                           {{ $vehcile->Equipment_Year }} {{ $vehcile->Equipment_Make }} {{ $vehcile->Equipment_Model }}
                                        </a><br>
                                            <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                        @if (!empty($vehcile->Equipment_Condition))
                                            <br>{{ $vehcile->Equipment_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            <span @if ($vehcile->Trailer_Type == "'(Enclosed Trailer Required)'") class='text-primary font-weight-bold' @endif>{{ $vehcile->Trailer_Type }}</span>
                                        @endif @endforeach"
                                            data-html="true">vehicles ({{ count($row->heavy_equipments) }})
                                        </a> -->
                        <a style="color: #0d6efd; font-weight: 800;" href="javascript:void(0)" tabindex="0"
                            class="" data-toggle="popover" data-trigger="focus"
                            style="cursor: pointer background-color: lightgrey;;" title="Attached vehicles"
                            data-content="@foreach ($row->heavy_equipments as $vehcile)
                                                <a href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}' 
                                                   target='_blank'>
                                                   {{ $vehcile->Equipment_Year }} {{ $vehcile->Equipment_Make }} {{ $vehcile->Equipment_Model }}
                                                </a><br>
                                                <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                @if (!empty($vehcile->Equipment_Condition))
                                                    <br>{{ $vehcile->Equipment_Condition }}<br>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <span @if ($vehcile->Trailer_Type == '(Enclosed Trailer Required)') class='badge rounded-pill bg-success text-white' @endif>{{ $vehcile->Trailer_Type }}</span>
                                                @endif @endforeach"
                            data-html="true">
                            vehicles ({{ count($row->heavy_equipments) }})
                        </a>
                    @endif
                    @if (count($row->dry_vans) === 1)
                        @foreach ($row->dry_vans as $vehcile)
                            <span title="Freight Class">
                                <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                    data-trigger="focus" style="cursor: pointer;" title="Freight Class"
                                    data-html="true">
                                    {{ $vehcile->Freight_Class }}
                                </a>
                            </span>
                            <span title="Freight Weight">

                                <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                    data-trigger="focus" style="cursor: pointer;" title="Freight Weight"
                                    data-html="true">{{ $vehcile->Freight_Weight }}
                                </a>
                            </span> <b>LBS</b><br>
                            @if ($vehcile->is_hazmat_Check !== 0)
                                Hazmat Required<br>
                            @endif
                        @endforeach
                    @endif
                    @if (count($row->dry_vans) > 1)
                        <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                            data-trigger="focus" style="cursor: pointer;" title="Attached vehicles"
                            data-content=
                                        "@foreach ($row->dry_vans as $vehcile)
                                        <span title='Freight Class'>{{ $vehcile->Freight_Class }}</span>
                                        <span title='Freight Weight'>{{ $vehcile->Freight_Weight }}</span> <b>LBS</b><br>
                                        @if ($vehcile->is_hazmat_Check !== 0)
                                            Hazmat Required<br>
                                        @endif @endforeach"
                            data-html="true">vehicles ({{ count($row->dry_vans) }})
                        </a>
                    @endif
                    
                </td>
                <td>
                    {{ $row->created_at ?? 'N/A' }}
                </td>
                <td>
                    {{ $row->contact_info ?? 'N/A' }}
                </td>
                <td>
                    {{ '$' . '' . $row->paymentinfo->Price_Pay_Carrier ?? 'N/A' }}
                </td>
            </tr>
        @empty
            <tr class="card-row" data-status="active">
                <td colspan="7">No Data Found</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- <script>
    function toggleTable(tableId) {
        console.log(tableId);
        if (tableId === "bidTable") {
            $("#bidTable").show();
            $("#requestedTable").hide();
            console.log("done");
        } else {
            $("#bidTable").hide();
            $("#requestedTable").show();
            console.log("not done");
        }
    }
    $(document).ready(function() {
        $('.btn.container.custom .btn-toggle').click(function() {
            $('.btn.container.custom .btn-toggle').removeClass('active');
            $(this).addClass('active');
        });
    });
</script> --}}
<script>
    $(document).ready(function() {
        $('.visible-form').hide();
        $(document).on('click', '.decline-btn', function(event) {
            event.preventDefault();
            var $targetForm = $($(this).data('target'));
            $targetForm.show();
            $targetForm.find('input[type="text"]').prop('disabled', false);
            $targetForm.find('button[type="submit"]').prop('disabled', false);
            $(this).hide();
        });
    });
</script>
