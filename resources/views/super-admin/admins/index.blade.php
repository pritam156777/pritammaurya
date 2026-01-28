@extends('layouts.app')

@section('title', 'Admins')

@section('content')
    <div class="container mx-auto p-6">

        <div class="flex justify-between mb-4">
            <h2 class="text-2xl font-bold">Admins</h2>
            <a href="{{ route('super-admin.admins.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded">
                + Create Admin
            </a>
        </div>

        <table class="w-full border">
            <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Created At</th>
            </tr>
            </thead>
            <tbody>
            @forelse($admins as $admin)
                <tr>
                    <td class="p-2 border">{{ $admin->name }}</td>
                    <td class="p-2 border">{{ $admin->email }}</td>
                    <td class="p-2 border">{{ $admin->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center p-4">No admins found</td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
@endsection
