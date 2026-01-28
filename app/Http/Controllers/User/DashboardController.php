<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        $sales = OrderItem::with('product')
            ->whereHas('product', function ($q) {
                $q->where('admin_id', Auth::id());
            })
            ->get();

        return view('user.dashboard', compact('sales'));
    }

}
