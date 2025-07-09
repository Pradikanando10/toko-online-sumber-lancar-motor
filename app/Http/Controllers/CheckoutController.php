<?php

// namespace App\Http\Controllers;
// use App\Models\Order;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;

// class CheckoutController extends Controller
// {
//     public function index()
//     {
//         $cart = session()->get('cart');
//         return view('checkout.index', compact('cart'));
//     }

//     public function process(Request $request)
//     {
//         $cart = session()->get('cart');
//         $totalPrice = 0;

//         foreach ($cart as $item) {
//             $totalPrice += $item['price'] * $item['quantity'];
//         }

//         // Buat order baru
//         $order = Order::create([
//             'user_id' => Auth::id(),
//             'total_price' => $totalPrice,
//             'status' => 'pending',
//         ]);

//         // Hapus keranjang setelah checkout
//         session()->forget('cart');

//         return redirect()->route('home')->with('success', 'Order placed successfully!');
//     }
// }


// namespace App\Http\Controllers;

// use App\Models\Order;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;

// class CheckoutController extends Controller
// {
//     public function index()
//     {
//         $cart = session()->get('cart');
//         return view('checkout.index', compact('cart'));
//     }

//     public function process(Request $request)
//     {
//         $cart = session()->get('cart');
//         $totalPrice = 0;
//         $productNames = [];

//         foreach ($cart as $item) {
//             $totalPrice += $item['price'] * $item['quantity'];
//             $productNames[] = $item['name'];
//         }

//         $productNamesString = implode(", ", $productNames);

//         $order = Order::create([
//             'user_id' => Auth::id(),
//             'total_price' => $totalPrice,
//             'status' => 'pending',
//             'product_name' => $productNamesString,
//         ]);

//         session()->forget('cart');

//         return redirect()->route('home')->with('success', 'Order placed successfully!');
//     }
// }


// namespace App\Http\Controllers;

// use App\Models\Order;
// use App\Models\PaymentProof; // Import model PaymentProof
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;

// class CheckoutController extends Controller
// {
//     public function index()
//     {
//         // $cart = session()->get('cart');
//         // return view('checkout.index', compact('cart'));
//         $cart = session()->get('cart', []);
//         return view('checkout.index', compact('cart'));
//     }

//     public function process(Request $request)
//     {
//         $cart = session()->get('cart');
//         $totalPrice = 0;
//         $productNames = [];

//         foreach ($cart as $item) {
//             $totalPrice += $item['price'] * $item['quantity'];
//             $productNames[] = $item['name'];
//         }

//         $productNamesString = implode(", ", $productNames);

//         // Validasi input
//         // $request->validate([
//         //     'payment_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Validasi file gambar
//         // ]);

//         // // Simpan order baru
//         // $order = Order::create([
//         //     'user_id' => Auth::id(),
//         //     'total_price' => $totalPrice,
//         //     'status' => 'pending',
//         //     'product_name' => $productNamesString,
//         // ]);

//         $request->validate([
//             'payment_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
//             'shipping_method' => 'required|string',
//             'shipping_cost' => 'required|integer|min:0',
//         ]);

//         $totalPrice += $request->shipping_cost;

//         $order = Order::create([
//             'user_id' => Auth::id(),
//             'total_price' => $totalPrice,
//             'status' => 'pending',
//             'product_name' => $productNamesString,
//             'shipping_method' => $request->shipping_method,
//             'shipping_cost' => $request->shipping_cost,
//         ]);


//         // Simpan file bukti transfer ke storage
//         $path = $request->file('payment_image')->store('payment_proofs', 'public');

//         // Simpan data bukti transfer
//         PaymentProof::create([
//             'user_id' => Auth::id(),
//             'order_id' => $order->id,
//             'image_path' => $path,
//         ]);

//         // Hapus cart setelah pemesanan
//         session()->forget('cart');

//         return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat dan bukti transfer berhasil diupload!');
//     }
// }


// namespace App\Http\Controllers;

// use App\Models\Order;
// use App\Models\PaymentProof;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;

// class CheckoutController extends Controller
// {
//     public function index()
//     {
//         $cart = session()->get('cart', []);
//         return view('checkout.index', compact('cart'));
//     }

//     public function process(Request $request)
//     {
//         $cart = session()->get('cart');
//         $totalPrice = 0;
//         $productNames = [];

//         foreach ($cart as $item) {
//             $totalPrice += $item['price'] * $item['quantity'];
//             $productNames[] = $item['name'];
//         }

//         $productNamesString = implode(", ", $productNames);

//         // Validasi input
//         $request->validate([
//             'payment_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
//             'shipping_method' => 'required|string',
//             'shipping_cost' => 'required|integer|min:0',
//         ]);

//         $totalPrice += $request->shipping_cost;

//         // Generate nomor resi otomatis (contoh: JNE-1718722256-742)
//         $generatedResi = strtoupper($request->shipping_method) . '-' . time() . '-' . rand(100, 999);

//         // Simpan order ke database
//         $order = Order::create([
//             'user_id' => Auth::id(),
//             'total_price' => $totalPrice,
//             'status' => 'pending',
//             'product_name' => $productNamesString,
//             'shipping_method' => $request->shipping_method,
//             'shipping_cost' => $request->shipping_cost,
//             'no_resi' => $generatedResi, // Tambahkan no_resi di sini
//         ]);

//         // Simpan file bukti transfer ke storage
//         $path = $request->file('payment_image')->store('payment_proofs', 'public');

//         // Simpan data bukti transfer
//         PaymentProof::create([
//             'user_id' => Auth::id(),
//             'order_id' => $order->id,
//             'image_path' => $path,
//         ]);

//         // Hapus cart setelah pemesanan
//         session()->forget('cart');

//         return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat dan bukti transfer berhasil diupload!');
//     }
// }

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\PaymentProof;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('checkout.index', compact('cart'));
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang anda kosong.');
        }

        $totalPrice = 0;
        $productNames = [];

        // Hitung total harga dan siapkan nama produk
        foreach ($cart as $productId => $item) {
            $totalPrice += $item['price'] * $item['quantity'];
            $productNames[] = $item['name'];
        }

        $productNamesString = implode(', ', $productNames);

        // Validasi input
        $request->validate([
            'payment_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'shipping_method' => 'required|string',
            'shipping_cost' => 'required|integer|min:0',
        ]);

        $totalPrice += $request->shipping_cost;

        // Nomor resi otomatis
        $generatedResi = strtoupper($request->shipping_method) . '-' . time() . '-' . rand(100, 999);

        // Buat order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'status' => 'pending',
            'product_name' => $productNamesString,
            'shipping_method' => $request->shipping_method,
            'shipping_cost' => $request->shipping_cost,
            'no_resi' => $generatedResi,
        ]);

        // Upload bukti transfer
        $path = $request->file('payment_image')->store('payment_proofs', 'public');

        PaymentProof::create([
            'user_id' => Auth::id(),
            'order_id' => $order->id,
            'image_path' => $path,
        ]);

        // 🔻 Kurangi stok produk
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $product->stock -= $item['quantity'];
                $product->save();
            }
        }

        // Hapus cart
        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat dan bukti transfer berhasil diupload!');
    }
}
