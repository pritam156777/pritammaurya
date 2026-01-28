<!DOCTYPE html>
<html>
<head>
    <title>{{ $user->name }} - Order Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            background: #f4f6f9;
            color: #333;
        }

        /* ================= HEADER ================= */
        .header {
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
            color: #fff;
            padding: 25px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
            letter-spacing: 1px;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 13px;
            opacity: 0.9;
        }

        /* ================= CONTAINER ================= */
        .container {
            padding: 25px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 20px;
            color: #111827;
        }

        h3 {
            margin-bottom: 5px;
            color: #2563eb;
        }

        .order-meta {
            font-size: 11px;
            color: #6b7280;
            margin-bottom: 12px;
        }

        /* ================= TABLE ================= */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 35px;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }

        thead th {
            background: #1f2933;
            color: #ffffff;
            font-weight: bold;
            padding: 12px;
            border-bottom: 4px solid #111827; /* 🔥 THICKER HEADER */
            font-size: 12px;
        }

        tbody td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 11.5px;
        }

        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tbody tr:hover {
            background-color: #eef2ff;
        }

        /* ================= PRODUCT IMAGE ================= */
        .product-img {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
        }

        /* ================= TOTAL ROW ================= */
        .total-row td {
            background: #f1f5f9;
            font-weight: bold;
            border-top: 2px solid #111827;
        }

        .total-amount {
            color: #16a34a;
            font-size: 13px;
        }

        /* ================= FOOTER ================= */
        .footer {
            background: #111827;
            color: #d1d5db;
            text-align: center;
            padding: 15px;
            font-size: 11px;
        }

        .footer strong {
            color: #ffffff;
        }
    </style>
</head>

<body>

<!-- ================= HEADER ================= -->
<div class="header">
    <h1>🛒 Awesome Store</h1>
    <p>Premium Shopping Experience</p>
</div>

<!-- ================= CONTENT ================= -->
<div class="container">

    <h2>{{ $user->name }}'s Order Summary</h2>

    @foreach($orders as $order)
        <h3>Order #: {{ $order->order_number }}</h3>
        <div class="order-meta">
            Order Date: {{ $order->created_at->format('d M Y, H:i') }}
        </div>

        <table>
            <thead>
            <tr>
                <th>Product</th>
                <th>Image</th>
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
                    <td>
                        @if($item->product->image)
                            <img src="{{ asset('images/'.$item->product->image) }}"
                                 alt="{{ $item->product->name }}"
                                 style="width:60px;height:60px;object-fit:cover;border-radius:5px;">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $item->product->category->name ?? 'N/A' }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->gst, 2) }}</td>
                    <td>{{ number_format($item->total + $item->gst, 2) }}</td>
                </tr>
            @endforeach

            <tr class="total-row">
                <td colspan="6">Grand Total</td>
                <td class="total-amount">₹ {{ number_format($order->total_amount,2) }}</td>
            </tr>
            </tbody>
        </table>
    @endforeach

</div>

<!-- ================= FOOTER ================= -->
<div class="footer">
    <p>
        Thank you for shopping with <strong>Awesome Store</strong> ❤️<br>
        This is a system-generated invoice. No signature required.
    </p>
</div>

</body>
</html>
