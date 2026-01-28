@extends('layouts.app')

@section('content')
    <div class="min-h-screen p-6 bg-gray-50">

        {{-- Page Header --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-2">👑 Super Admin Dashboard</h1>
            <p class="text-gray-500 text-sm sm:text-base">Complete system overview</p>
        </div>

        {{-- Top Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

            {{-- Total Admins --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Admins</h3>
                <h1 class="text-3xl font-bold text-gray-800">{{ $admins->count() }}</h1>
            </div>

            {{-- Total Sales --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">💰 Total Sales</h3>
                <h1 class="text-3xl font-bold text-gray-800">₹ {{ $sales->sum('amount') }}</h1>
            </div>

            {{-- Placeholder Card (Optional for future metrics) --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Other Metric</h3>
                <h1 class="text-3xl font-bold text-gray-800">—</h1>
            </div>

        </div>

        {{-- Admins Table --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Admins Created</h3>

            @if($admins->count() == 0)
                <p class="text-gray-400 text-sm">No admins created yet.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-gray-700 border border-gray-100">
                        <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Created At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-2 font-medium">{{ $admin->name }}</td>
                                <td class="px-4 py-2">{{ $admin->email }}</td>
                                <td class="px-4 py-2 text-gray-500 text-sm">{{ $admin->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
@endsection
