<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function create()
    {
        // Get all Admins to assign User
        $admins = User::where('role', 'admin')->get();

        return view('super-admin.admins.create', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'admin_id' => 'required|exists:users,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'created_by' => $request->admin_id,
        ]);

        return redirect()->route('super-admin.users.create')
            ->with('success', "User '{$user->name}' created successfully!");
    }
}
