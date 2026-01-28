<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
<h2>{{ $user->name }}'s Orders</h2>

@foreach($orders as $order)
    <h3>Order #: {{ $order->order_number }}</h3>
    <p>Order Date: {{ $order->created_at->format('d M Y, H:i') }}</p>
    <table>
        <thead>
        <tr>
            <th>Product</th>
            <th>Category</th>
            <th>Price (₹)</th>
            <th>Qty</th>
            <th>GST (₹)</th>
            <th>Total (₹)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->product->category->name ?? 'N/A' }}</td>
                <td>{{ number_format($item->price,2) }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->gst,2) }}</td>
                <td>{{ number_format($item->total,2) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5" class="total">Grand Total</td>
            <td class="total">₹ {{ number_format($order->total_amount,2) }}</td>
        </tr>
        </tbody>
    </table>
@endforeach
</body>
</html>
