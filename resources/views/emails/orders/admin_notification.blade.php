<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f8; padding: 20px; }
        .card { background: #fff; padding: 25px; border-radius: 10px; max-width: 700px; margin: auto; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(90deg, #4f46e5, #9333ea); color: #fff; padding: 15px; border-radius: 8px; text-align: center; font-size: 22px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table th, table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        table th { background: #4f46e5; color: #fff; }
        .footer { text-align: center; color: #6b7280; font-size: 12px; margin-top: 20px; }
    </style>
</head>
<body>

<div class="card">
    <div class="header">🛒 New Order Notification</div>

    <p>Hello Super Admin,</p>
    <p>Admin <strong>{{ $order->user->name }}</strong> has just placed a new order.</p>

    <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
    <p><strong>Payment Method:</strong> {{ strtoupper(str_replace('_',' ',$order->payment_method)) }}</p>
    <p><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount,2) }}</p>

    <h3>Order Items:</h3>
    <table>
        <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>GST</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₹{{ number_format($item->price,2) }}</td>
                <td>₹{{ number_format($item->gst,2) }}</td>
                <td>₹{{ number_format($item->total,2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="footer">💙 Awesome Store - Keeping you updated!</div>
</div>

</body>
</html>
