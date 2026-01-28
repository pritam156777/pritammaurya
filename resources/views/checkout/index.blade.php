<h2>Checkout</h2>

<form action="{{ route('checkout.store') }}" method="POST">
    @csrf

    <label>Payment Method</label>
    {{--<select name="payment_method" required>
        <option value="credit_card">Credit Card</option>
        <option value="debit_card">Debit Card</option>
        <option value="cash_on_delivery">Cash on Delivery</option>
    </select>--}}

    <label class="payment-option">
        <input type="radio" name="payment_method" value="cash" checked>
        <span>Cash on Delivery</span>
    </label>

    <label class="payment-option">
        <input type="radio" name="payment_method" value="card" data-label="Credit Card">
        <span>Credit Card</span>
    </label>

    <label class="payment-option">
        <input type="radio" name="payment_method" value="card" data-label="Debit Card">
        <span>Debit Card</span>
    </label>

    <label>Order Type</label>
    <select name="order_type" required>
        <option value="delivery">Delivery</option>
        <option value="pickup">Pickup</option>
    </select>

    <input type="text" name="delivery_address" placeholder="Delivery Address">

    <button type="submit">Pay Now</button>
</form>
