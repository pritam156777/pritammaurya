<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Invoice</title>

    <style>
        /* 🔥 MOST IMPORTANT */
        @page {
            margin-top: 0;
            margin-bottom: 0;
            margin-left: 0;
            margin-right: 0;
        }

        body {
            margin: 0;
            padding: 0;
            background: #f4f6f8;
            font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
    </style>
</head>

<body>

<!-- 🔽 MOVE CONTENT UP USING NEGATIVE MARGIN -->
<table width="100%" cellpadding="0" cellspacing="0" style="margin-top:-60px;">
    <tr>
        <td align="center">

            <!-- A4 WIDTH CONTAINER -->
            <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;">

                <!-- HEADER -->
                <tr>
                    <td style="
                        background:linear-gradient(90deg,#4f46e5,#9333ea);
                        padding:30px;
                        color:#ffffff;
                        text-align:center;
                    ">
                        <h1 style="margin:0;font-size:28px;">🎉 Order Confirmed</h1>
                        <p style="margin-top:8px;font-size:15px;">
                            Thank you for shopping with <strong>Awesome Store</strong>
                        </p>
                    </td>
                </tr>

                <!-- BODY -->
                <tr>
                    <td style="padding:35px;color:#111827;">

                        <p style="font-size:17px;">
                            Hello <strong>{{ $order->user->name }}</strong>,
                        </p>

                        <p style="font-size:15px;">
                            Your order has been placed successfully. Below are your complete order details.
                        </p>

                        <!-- ORDER DETAILS -->
                        <table width="100%" cellpadding="12" style="
                            margin-top:20px;
                            background:#f9fafb;
                            border-radius:10px;
                            font-size:14px;
                        ">
                            <tr>
                                <td><strong>Order Number</strong></td>
                                <td align="right">{{ $order->order_number }}</td>
                            </tr>
                            <tr>
                                <td><strong>Payment Method</strong></td>
                                <td align="right">
                                    {{ strtoupper(str_replace('_',' ', $order->payment_method)) }}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td align="right">{{ strtoupper($order->status) }}</td>
                            </tr>
                        </table>

                        <!-- ITEMS -->
                        <h3 style="
                            margin-top:35px;
                            padding-bottom:10px;
                            border-bottom:2px solid #e5e7eb;
                            font-size:18px;
                        ">
                            🛒 Order Items
                        </h3>

                        <table width="100%" cellpadding="12" style="font-size:14px;">
                            <thead>
                            <tr style="background:#eef2ff;">
                                <th align="left">Product</th>
                                <th align="center">Qty</th>
                                <th align="right">Price</th>
                                <th align="right">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->items as $item)
                                <tr style="border-bottom:1px solid #e5e7eb;">
                                    <td>{{ $item->product->name }}</td>
                                    <td align="center">{{ $item->quantity }}</td>
                                    <td align="right">₹{{ number_format($item->price,2) }}</td>
                                    <td align="right">₹{{ number_format($item->total,2) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- TOTALS -->
                        <table width="100%" cellpadding="10" style="margin-top:25px;font-size:15px;">
                            <tr>
                                <td align="right">Subtotal</td>
                                <td align="right" width="150">₹{{ number_format($order->subtotal,2) }}</td>
                            </tr>
                            <tr>
                                <td align="right">Extra Charges (5%)</td>
                                <td align="right">₹{{ number_format($order->extra_charge,2) }}</td>
                            </tr>
                            <tr>
                                <td align="right">GST (18%)</td>
                                <td align="right">₹{{ number_format($order->gst,2) }}</td>
                            </tr>
                            <tr>
                                <td align="right" style="font-size:20px;font-weight:bold;color:#16a34a;">
                                    Grand Total
                                </td>
                                <td align="right" style="font-size:20px;font-weight:bold;color:#16a34a;">
                                    ₹{{ number_format($order->total_amount,2) }}
                                </td>
                            </tr>
                        </table>

                        <!-- FOOTER -->
                        <p style="
                            margin-top:30px;
                            font-size:13px;
                            color:#6b7280;
                            text-align:center;
                        ">
                            Need help? Just reply to this email.<br>
                            💙 Thank you for choosing <strong>Awesome Store</strong>.
                        </p>

                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>
