<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Untuk user melihat pesanan mereka
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('dashboard.orders', compact('orders'));
    }

    // Untuk admin lihat semua pesanan dengan bukti transfer
    public function adminIndex()
    {
        $orders = Order::with('paymentProofs', 'user')->get();
        return view('admin.orders.index', compact('orders'));
    }
}
