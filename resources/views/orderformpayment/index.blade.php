<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form Payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Order Form Payment</h1>
        <form action="{{ route('order.form.payment.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="booking_price">Booking Price</label>
                <input type="number" step="0.01" class="form-control" id="booking_price" name="booking_price" required>
                @error('booking_price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="deposit">Deposit</label>
                <input type="number" step="0.01" class="form-control" id="deposit" name="deposit" required>
                @error('deposit')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="balance_amount">Balance Amount</label>
                <input type="number" step="0.01" class="form-control" id="balance_amount" name="balance_amount" required>
                @error('balance_amount')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="card_first_name">Card First Name</label>
                <input type="text" class="form-control" id="card_first_name" name="card_first_name" required>
                @error('card_first_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="card_last_name">Card Last Name</label>
                <input type="text" class="form-control" id="card_last_name" name="card_last_name" required>
                @error('card_last_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="billing_address">Billing Address</label>
                <input type="text" class="form-control" id="billing_address" name="billing_address" required>
                @error('billing_address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="zip_code">ZIP Code</label>
                <input type="text" class="form-control" id="zip_code" name="zip_code" required>
                @error('zip_code')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="card_type">Card Type</label>
                <input type="text" class="form-control" id="card_type" name="card_type" required>
                @error('card_type')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="credit_card_number">Credit Card Number</label>
                <input type="text" class="form-control" id="credit_card_number" name="credit_card_number" required>
                @error('credit_card_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="card_expiry_date">Card Expiry Date (MM/YY)</label>
                <input type="text" class="form-control" id="card_expiry_date" name="card_expiry_date" required>
                @error('card_expiry_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="card_security_code">Card Security Code (CVC)</label>
                <input type="text" class="form-control" id="card_security_code" name="card_security_code" required>
                @error('card_security_code')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
