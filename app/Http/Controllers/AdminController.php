<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Jumlah total pesanan dan produk
        $orderCount = Order::count();
        $productCount = Product::count();

        // Data untuk grafik penjualan 30 hari terakhir
        $salesDates = [];
        $salesCounts = [];

        $today = Carbon::today();

        for ($i = 29; $i >= 0; $i--) {
            $date = $today->copy()->subDays($i)->format('Y-m-d');
            $salesDates[] = $date;
            $salesCounts[] = Order::whereDate('created_at', $date)->count();
        }

        return view('admin.dashboard', compact(
            'orderCount',
            'productCount',
            'salesDates',
            'salesCounts'
        ));
    }

    public function orders()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors([
                'username' => 'You must be logged in to access this page.'
            ]);
        }

        $orders = Order::with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors([
                'username' => 'You must be logged in to access this page.'
            ]);
        }

        $request->validate([
            'status' => 'required|in:pending,shipped,completed',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Order status updated successfully!');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if ($credentials['username'] === 'superadmin123' && $credentials['password'] === '123superadmin') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Invalid credentials']);
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login')->with('success', 'Logged out successfully!');
    }
}
