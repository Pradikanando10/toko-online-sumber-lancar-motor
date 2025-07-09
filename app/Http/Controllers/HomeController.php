<?php

// namespace App\Http\Controllers;

// use App\Models\Product;
// use Illuminate\Http\Request;

// class HomeController extends Controller
// {
//     public function index(Request $request)
//     {
//         // Ambil input pencarian dari pengguna
//         $query = $request->input('search');

//         // Ambil produk dengan pencarian jika ada
//         $products = Product::when($query, function ($queryBuilder) use ($query) {
//             return $queryBuilder->where('name', 'like', "%{$query}%");
//         })->get();

//         // Kirim data produk ke tampilan
//         return view('home', compact('products'));
//     }
// }

// namespace App\Http\Controllers;

// use App\Models\Product;
// use Illuminate\Http\Request;

// class HomeController extends Controller
// {
//     public function index(Request $request)
//     {
//         // Ambil input pencarian dari URL (GET)
//         $query = $request->input('search');

//         // Ambil produk berdasarkan nama atau deskripsi
//         $products = Product::when($query, function ($queryBuilder) use ($query) {
//             return $queryBuilder->where(function ($q) use ($query) {
//                 $q->where('name', 'like', "%{$query}%")
//                     ->orWhere('description', 'like', "%{$query}%");
//             });
//         })->get();

//         // Kirim ke view
//         return view('home', compact('products'));
//     }
// }

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $brandFilter = $request->input('brand');

        $products = Product::when($searchQuery, function ($queryBuilder) use ($searchQuery) {
            $queryBuilder->where(function ($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%")
                    ->orWhere('description', 'like', "%{$searchQuery}%");
            });
        })->when($brandFilter, function ($queryBuilder) use ($brandFilter) {
            $queryBuilder->where('brand', $brandFilter);
        })->get();

        return view('home', compact('products'));
    }
}
