@extends('layouts.app')

@section('content')

    {{-- Header --}}
    <h1>🛒 User Dashboard</h1>
    <p>Sell products and earn money</p>

    {{-- Total Earnings --}}
    <div class="card">
        <h3>💰 Total Earnings</h3>
        <h1>₹ {{ $sales->sum('amount') }}</h1>
    </div>

    {{-- Sales Table --}}
    <div class="card">
        <h3>📊 My Sales</h3>

        @if($sales->count() == 0)
            <p>No sales yet.</p>
        @else
            <table width="100%" cellpadding="10">
                <tr>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>

                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->product->name }}</td>
                        <td>₹ {{ $sale->amount }}</td>
                        <td>{{ $sale->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>

@endsection
