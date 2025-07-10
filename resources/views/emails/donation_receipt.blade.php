<!DOCTYPE html>
<html>
<head>
    <title>Donation Receipt</title>
</head>
<body>
    <h1>Thank You for Your Donation!</h1>
    <p>Donation Amount: ${{ number_format($donation->amount, 2) }}</p>
    <p>Campaign: {{ $donation->campaign->title }}</p>
    <p>Transaction Date: {{ $donation->paid_at->format('m/d/Y') }}</p>
</body>
</html>
