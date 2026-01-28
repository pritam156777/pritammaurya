<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminManagementController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
        ]);

        // ✅ Get the Super Admin (currently logged in)
        $superAdmin = auth()->user(); // make sure only Super Admin can access this route

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'created_by' => $superAdmin->id,
        ]);

        return redirect()->route('super-admin.admins.index')
            ->with('success', "Admin '{$admin->name}' created successfully!");
    }
    public function create()
    {
        return view('super-admin.admins.create'); // make sure this Blade exists
    }
}
