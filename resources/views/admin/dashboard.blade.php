@extends('layouts.app')

@section('content')
    <div class="min-h-screen p-6 bg-gray-50">

        {{-- Page Header --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-2">🧑‍💼 Admin Dashboard</h1>
            <p class="text-gray-500 text-sm sm:text-base">Manage your users, products & sales efficiently</p>
        </div>

        {{-- Dashboard Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

            {{-- Users Card --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">👥 Users</h3>
                    <span class="text-sm text-gray-500">{{ $users->count() }}</span>
                </div>
                <p class="text-gray-500 text-sm">Users created by you</p>
            </div>

            {{-- Products Card --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">📦 Products</h3>
                    <span class="text-sm text-gray-500">{{ $products->count() }}</span>
                </div>
                <p class="text-gray-500 text-sm">Total products you manage</p>
            </div>

            {{-- Sales Card --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">💰 Sales</h3>
                    <span class="text-sm text-gray-500">{{ $sales->count() }}</span>
                </div>
                <p class="text-gray-500 text-sm">Total sales via your products</p>
            </div>

        </div>

        {{-- Detailed Tables --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Products Table --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg">
                <h3 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">📦 My Products</h3>

                @if($products->count() == 0)
                    <p class="text-gray-400 text-sm">No products added.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-gray-700 border border-gray-100">
                            <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-4 py-2">Product</th>
                                <th class="px-4 py-2">Price</th>
                                <th class="px-4 py-2">Sold</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                @php
                                    $soldCount = $sales->where('product_id', $product->id)->count();
                                @endphp
                                <tr class="border-b hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-2">{{ $product->name }}</td>
                                    <td class="px-4 py-2 font-medium">₹ {{ number_format($product->price) }}</td>
                                    <td class="px-4 py-2 text-gray-500">{{ $soldCount }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- Users Table --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg">
                <h3 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">👥 My Master</h3>

                @if($users->count() == 0)
                    <p class="text-gray-400 text-sm">No users created yet.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-gray-700 border border-gray-100">
                            <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Joined</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr class="border-b hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-2 font-medium">{{ $user->name }}</td>
                                    <td class="px-4 py-2">{{ $user->email }}</td>
                                    <td class="px-4 py-2 text-gray-500 text-sm">{{ $user->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>

    </div>
@endsection
