<?php

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
