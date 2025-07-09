<?php

// namespace App\Http\Controllers;

// use App\Models\Product;
// use App\Models\Category; // Pastikan model Category diimpor
// use Illuminate\Http\Request;

// class ProductController extends Controller
// {
//     public function index()
//     {
//         // Mengambil semua produk dari database
//         $products = Product::all(); // Anda bisa menggunakan pagination jika diperlukan

//         // Mengirim data produk ke tampilan
//         return view('admin.products.index', compact('products'));
//     }

//     public function create()
//     {
//         // Mengambil semua kategori dari database
//         $categories = Category::all(); // Ambil semua kategori

//         // Menampilkan form untuk menambahkan produk baru dengan kategori
//         return view('admin.products.create', compact('categories')); // Kirim kategori ke view
//     }

//     public function store(Request $request)
//     {
//         // Validasi input produk
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'price' => 'required|numeric',
//             'description' => 'nullable|string',
//             'category_id' => 'exists:categories,id',
//             'stock' => 'required|integer|min:0',
//         ]);

//         // Menyimpan produk baru ke database
//         Product::create($request->all());

//         // Redirect dengan pesan sukses
//         return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
//     }

//     public function show($id)
//     {
//         // Ambil produk berdasarkan ID
//         $product = Product::findOrFail($id);

//         // Kirim data produk ke tampilan
//         return view('product.show', compact('product'));
//     }

//     public function destroy($id)
//     {
//         // Mencari produk berdasarkan ID dan menghapusnya
//         $product = Product::findOrFail($id);
//         $product->delete();

//         // Redirect dengan pesan sukses
//         return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
//     }

//     public function edit($id)
//     {
//         $product = Product::findOrFail($id);
//         return view('admin.products.edit', compact('product'));
//     }

//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'description' => 'required|string',
//         ]);

//         $product = Product::findOrFail($id);
//         $product->update($request->all());

//         return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
//     }
// }

// 

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // $products = Product::all(); // Tampilkan semua produk
        $sort = $request->get('sort', 'asc'); // default asc
        $products = Product::orderBy('stock', $sort)->get();
        return view('admin.products.index', compact('products', 'sort'));
    }

    public function create()
    {
        return view('admin.products.create'); // Tidak perlu ambil kategori lagi
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:100', // ← Validasi merk
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = file_get_contents($request->file('image')->getRealPath());

        Product::create([
            'name' => $request->name,
            'brand' => $request->brand, // ← Simpan merk
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $image,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $product->image = file_get_contents($request->file('image')->getRealPath());
        }

        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }
}
