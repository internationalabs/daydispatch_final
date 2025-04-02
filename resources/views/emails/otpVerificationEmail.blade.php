<!-- resources/views/emails/otpVerificationEmail.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        /* Your global email styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .footer {
            background-color: #f8f8f8;
            color: #777;
            text-align: center;
            padding: 10px;
            border-radius: 0 0 8px 8px;
            font-size: 12px;
        }

        h2 {
            color: #333;
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>OTP Verification</h1>
        </div>

        <!-- Body content -->
        <p>Hello {{ $name }},</p>

        <p>Your OTP code for email verification is:</p>

        <h2>{{ $otp }}</h2>

        <p>This OTP is valid for only 1 minute. Please enter it on the verification page to complete your registration
            process.</p>

        <p>Thank you!</p>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
