<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $adminId = Auth::id();

        // Admin's users only
        $users = User::where('created_by', $adminId)->get();

        // Admin's products only
        $products = Product::where('admin_id', $adminId)->get();

        // ✅ Admin's sales via products (CORRECT WAY)
        $sales = OrderItem::whereHas('product', function ($q) use ($adminId) {
            $q->where('admin_id', $adminId);
        })->get();

        return view('admin.dashboard', compact('users', 'products', 'sales'));
    }
}
