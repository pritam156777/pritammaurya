<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #4caf50; }
        .info { margin-bottom: 20px; }
        .info p { margin: 2px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .totals { float: right; width: 300px; }
        .totals table { border: none; }
        .totals td { border: none; padding: 5px; }
    </style>
</head>
<body>

<div class="header">
    <h1>Awesome Store</h1>
    <p>Invoice #: {{ $order->order_number }}</p>
    <p>Date: {{ $order->created_at->format('d-m-Y H:i') }}</p>
</div>

<div class="info">
    <p><strong>Customer:</strong> {{ $order->user->name ?? 'Guest' }}</p>
    <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
    <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
</div>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Product</th>
        <th>Qty</th>
        <th>Price (₹)</th>
        <th>GST (18%)</th>
        <th>Total (₹)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->items as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>₹ {{ number_format($item->price, 2) }}</td>
            <td>₹ {{ number_format($item->gst, 2) }}</td>
            <td>₹ {{ number_format($item->total, 2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="totals">
    <table>
        <tr>
            <td>Subtotal:</td>
            <td>₹ {{ number_format($order->subtotal, 2) }}</td>
        </tr>
        <tr>
            <td>Extra Charges:</td>
            <td>₹ {{ number_format($order->extra_charge, 2) }}</td>
        </tr>
        <tr>
            <td>GST (18%):</td>
            <td>₹ {{ number_format($order->gst, 2) }}</td>
        </tr>
        <tr>
            <td><strong>Grand Total:</strong></td>
            <td><strong>₹ {{ number_format($order->total_amount, 2) }}</strong></td>
        </tr>
    </table>
</div>

<p style="text-align:center; margin-top:30px;">Thank you for shopping with us! 🎉</p>

</body>
</html>
