<div class="timeline mb-30">
    @foreach($history as $month => $orders)
        <div class="timeline-month">{{ $month }}</div>
        
        @php
            $groupedByDay = $orders->groupBy(function ($order) {
                return \Carbon\Carbon::parse($order->created_at)->format('d, l'); // Group by day
            });
        @endphp

        @foreach($groupedByDay as $day => $ordersOnDay)
            <div class="timeline-section">
                <div class="timeline-date">{{ $day }}</div>
                <div class="row">
                    @foreach($ordersOnDay as $order)
                        <div class="col-lg-4 col-md-6">
                            <div class="timeline-box">
                                <div class="box-title">
                                    <i class="bx bxs-florist"></i> Order #{{ $order->order->Ref_ID }}
                                </div>
                                <div class="box-content">
                                    <div class="box-item"><strong>Customer Name:</strong> {{ $order->order->Customer_Name }}</div>
                                    <div class="box-item"><strong>Email:</strong> {{ $order->order->Customer_Email }}</div>
                                    <div class="box-item"><strong>Phone:</strong> {{ $order->order->Customer_Phone }}</div>
                                    <div class="box-item"><strong>Listing Status:</strong> {{ $order->order->Listing_Status }}</div>
                                    <div class="box-item"><strong>Company:</strong> {{ $order->authorized_user->Company_Name ?? 'N/A' }}</div>
                                    <div class="box-item"><strong>Posted Date:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</div>
                                    <div class="box-item"><strong>Remarks:</strong> {{ $order->history_description ?? 'N/A' }}</div>

                                </div>
                                 <div class="box-footer">- {{ $order->authorized_user->email ?? 'Unknown' }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endforeach
</div>
