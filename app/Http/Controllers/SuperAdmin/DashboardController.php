<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\OrderItem;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // All admins
        $admins = User::where('role', 'admin')->get();

        // All sold items (system-wide)
        $sales = OrderItem::all();

        return view('super-admin.dashboard', compact('admins', 'sales'));
    }
}
