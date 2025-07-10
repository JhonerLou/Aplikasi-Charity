<!DOCTYPE html>
<html>
<head>
    <title>Donation Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; }
        .footer { margin-top: 50px; font-size: 12px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name') }}</h1>
        <h2>Donation Receipt</h2>
    </div>

    <div class="info">
        <p><strong>Donation ID:</strong> {{ $donation->id }}</p>
        <p><strong>Date:</strong> {{ $donation->created_at->format('F j, Y') }}</p>
        <p><strong>Status:</strong> {{ ucfirst($donation->payment_status) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Donation to {{ $donation->campaign->title }}</td>
                <td>${{ number_format($donation->amount, 2) }}</td>
            </tr>
            <tr class="total">
                <td>Total</td>
                <td>${{ number_format($donation->amount, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="donor-info">
        <h3>Donor Information</h3>
        <p><strong>Name:</strong> {{ $donation->donor_name }}</p>
        @if($donation->donor_email)
        <p><strong>Email:</strong> {{ $donation->donor_email }}</p>
        @endif
    </div>

    <div class="footer">
        <p>Thank you for your generous donation!</p>
        <p>{{ config('app.name') }}</p>
    </div>
</body>
</html>
