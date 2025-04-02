

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    :root {
        --clr-common-white: #fff;
        --clr-common-black: #000;
        --clr-common-blue: #2785ff;
        --clr-common-heading: #012863;
        --clr-common-text: #777777;
        --clr-common-border: #eaebee;
        --clr-common-placeholder: #bcbcbc;
        --clr-common-color-red: #db1c29;
        --clr-common-gradient: linear-gradient(to left, #db1c29, #db1c29);
        --clr-theme-1: #012863;
        --clr-theme-2: #fb5050;
        --clr-bg-gray: #f3f4f6;
        --clr-bg-gray-2: #f5f5f5;
    }

    .container {
        font-family: Arial, sans-serif;
        /*background-color: var(--clr-bg-gray-2);*/
    }

    .invoice-container {
        padding: 20px;
        background-color: var(--clr-common-white);
        border-radius: 5px;
        border: 1px solid var(--clr-common-border);
    }

    .company-header {
        margin-bottom: 30px;
        color: var(--clr-theme-1);
    }

    .company-header h2 {
        color: var(--clr-theme-1);
    }

    .invoice-table td, .carrier-table td {
        padding: 10px;
        vertical-align: top;
    }

    .invoice-table td {
        border-bottom: 1px solid var(--clr-common-border);
    }

    .carrier-table td {
        border: 1px solid var(--clr-common-border);
    }

    .icon {
        margin-right: auto;
    }

    .action-buttons {
        position: relative;
        margin-bottom: 20px;
    }

    .btn-download, .btn-print {
        position: absolute;
        top: 0;
        right: 10px;
        margin-left: 10px;
    }

    .btn-download {
        right: 140px;
    }
</style>

<div class="container my-5">
    <!-- Action Buttons -->
    <div class="action-buttons">
        <button class="btn btn-danger btn-download mt-2" onclick="downloadInvoiceAsImage()"><i class="fas fa-download"></i> Download as PNG</button>
        <button class="btn btn-secondary btn-print mt-2" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
    </div>

    <div class="invoice-container" id="invoice-content">
        <div class="company-header mt-5">
            <!-- <img src="{{ asset($setting->logo) }}" width="100px" height="100px"> -->

            <!-- <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px;"> -->
                <!-- <div style="font-size: 24px; font-weight: bold;">{{$setting->company_name}}</div> -->
                <div class="text-center">
                    <img src="{{ asset($setting->logo) }}" alt="Image Description" style="max-width: 100px; height: auto;">
                </div>
            <!-- </div> -->

            <!-- <h2><i class="fas fa-truck-moving mt-5"></i> {{$setting->company_name}}</h2> -->
            <h1 style="color: red;"> {{$setting->company_name}}</h1>
            <p><i class="fas fa-map-marker-alt icon"></i> {{$order->authorized_user->Address}}</p>
            <p><i class="fas fa-phone icon"></i>Tel No: {{$order->authorized_user->Contact_Phone}}</p>
            <p><i class="fas fa-envelope icon"></i>Email: {{$order->authorized_user->email}}</p>
        </div>

        <!-- Invoice Information -->
        <label><strong>Invoice Information</strong></label>
        <div class="invoice-info mb-4">
            <table class="table invoice-table">
                <tr>
                    <td><strong><i class="fas fa-file-invoice icon"></i> Invoice No:</strong> {{$order->invoice_number}}</td>
                </tr>
                <tr>
                    <td><strong><i class="fas fa-receipt icon"></i> Order No:</strong> {{$order->Ref_ID}}</td>
                </tr>
                <tr>
                    <td><strong><i class="fas fa-calendar-alt icon"></i> Date:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y h:i A') }}</td>
                </tr>
            </table>
        </div>

        <label><strong>Additional Information</strong></label>
        <div class="invoice-info">
            <textarea style="height: 80px; border: 1px solid black; margin-bottom: 15px; width: 100%;"></textarea>
        </div>

        <!-- Carrier Information -->
        <div class="carrier-info mb-4">
            <table class="table carrier-table">
                <thead>
                    <tr>
                        <th><strong><i class="fas fa-id-badge icon"></i> Order ID:</strong></th>
                        <th><strong><i class="fas fa-map-signs icon"></i> From/To:</strong></th>
                        <th><strong><i class="fas fa-car icon"></i> Vehicle Name:</strong></th>
                        <th><strong><i class="fas fa-money-bill-wave icon"></i> Booking Price:</strong></th>
                        <th><strong><i class="fas fa-money-bill-wave icon"></i> Deposite Amount:</strong></th>
                        <th><strong><i class="fas fa-money-bill-wave icon"></i> Balance Amount:</strong></th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->routes->Origin_ZipCode}}, {{$order->routes->Dest_ZipCode}}</td>
                        @foreach($order->vehicles as $vehicle)
                        <td>{{$vehicle->Vehcile_Year}}, {{$vehicle->Vehcile_Make}}, {{$vehicle->Vehcile_Model}}</td>
                        @endforeach
                        <td>{{$order->paymentinfo->Order_Booking_Price}}</td>
                        <td>{{$order->paymentinfo->Deposite_Amount}}</td>
                        @php
                        $balance_amount = $order->paymentinfo->Order_Booking_Price - $order->paymentinfo->Deposite_Amount;
                        @endphp
                        <td>{{$balance_amount}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="container-new mt-5">
            <div class="row align-items-center">
                <div class="col text-end">
                    <label for="customerSignature" class="form-label me-2"><strong>Customer Signature:</strong></label>
                    <span style="border-bottom: 1px solid black; width: 300px; display: inline-block; height: 20px;"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<!-- Script to download the invoice as a PNG image -->
<script>
    function downloadInvoiceAsImage() {
        // Select the invoice content
        const invoiceContent = document.getElementById('invoice-content');

        const randomNum = Math.floor(Math.random() * 1000000); // Random number between 0 and 999999

        html2canvas(invoiceContent, {
            scale: 4, // You can adjust this value

            useCORS: true, 
            
            logging: true,

            backgroundColor: null // Can set to white if needed
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');

            const link = document.createElement('a');
            link.href = imgData;
            link.download = 'invoice_' + randomNum + '.png'; // Use random number in filename

            link.click();
        });
    }

</script>


