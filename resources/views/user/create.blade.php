@extends('layouts.app')

@section('title', 'Create User')

@section('content')
    <div class="container mx-auto p-6 max-w-lg">

        <h2 class="text-2xl font-bold mb-4">Create User</h2>

        <form method="POST" action="{{ route('super-admin.users.store') }}">
            @csrf

            <div class="mb-3">
                <label class="block mb-1">Name</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-3">
                <label class="block mb-1">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-3">
                <label class="block mb-1">Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Assign to Admin</label>
                <select name="admin_id" class="w-full border p-2 rounded" required>
                    @foreach($admins as $admin)
                        <option value="{{ $admin->id }}">{{ $admin->name }} ({{ $admin->email }})</option>
                    @endforeach
                </select>
            </div>

            <button
                class="w-full py-2 rounded font-semibold text-white"
                style="background:linear-gradient(135deg, #9B13FF, #356CD7, #19C4CC) !important">
                Create User
            </button>

        </form>

    </div>
@endsection
