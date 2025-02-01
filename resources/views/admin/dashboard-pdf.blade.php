<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Summary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h3 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
<h3>Dashboard Summary</h3>
<table>
    <tr><th>Metric</th><th>Value</th></tr>
    <tr><td>Total Products</td><td>{{ $productsCount }}</td></tr>
    <tr><td>Total Orders</td><td>{{ $ordersCount }}</td></tr>
    <tr><td>Total Sales Made</td><td>PHP{{ number_format($totalPaidOrders, 2) }}</td></tr>
    <tr><td>Certified PADABA Member Breeders</td><td>{{ $vendorWithRsbsaCount }}</td></tr>
    <tr><td>Non-Member Breeders</td><td>{{ $vendorWithoutRsbsaCount }}</td></tr>
</table>

<h4>Sales Overview</h4>
<table>
    <tr><th>Year</th><th>Month</th><th>Total Sales (PHP)</th></tr>
    @foreach ($totals as $index => $total)
        <tr>
            <td>{{ $years[$index] }}</td>
            <td>{{ DateTime::createFromFormat('!m', $months[$index])->format('F') }}</td>
            <td>PHP{{ number_format($total, 2) }}</td>
        </tr>
    @endforeach
</table>

</body>
</html>
