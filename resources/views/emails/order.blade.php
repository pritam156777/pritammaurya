<h2>Thank you for your order 🎉</h2>

<p><strong>Order ID:</strong> {{ $order->id }}</p>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <tr>
        <th>Product</th>
        <th>Qty</th>
        <th>Price</th>
    </tr>
    @foreach($cartItems as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>₹ {{ number_format($item->product->price,2) }}</td>
        </tr>
    @endforeach
</table>

<p>Subtotal: ₹ {{ number_format($subtotal,2) }}</p>
<p>Extra Charges (5%): ₹ {{ number_format($extraCharge,2) }}</p>
<h3>Total Paid: ₹ {{ number_format($grandTotal,2) }}</h3>
