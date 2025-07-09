<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::create('products', function (Blueprint $table) {
//             $table->id();
//             $table->string('name'); // Nama produk
//             $table->decimal('price', 8, 2); // Harga produk
//             $table->integer('stock'); // Stok produk
//             $table->text('description')->nullable(); // Deskripsi produk (opsional)
//             $table->timestamps(); // Timestamps untuk created_at dan updated_at
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('products');
//     }
// };

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Kolom ID
            $table->string('name'); // Nama produk
            $table->decimal('price', 8, 2); // Harga produk
            $table->integer('stock'); // Stok produk
            $table->text('description')->nullable(); // Deskripsi produk (opsional)
            $table->binary('image')->nullable(); // Kolom untuk menyimpan gambar produk (opsional)
            $table->unsignedBigInteger('category_id')->nullable(); // Kolom category_id tanpa foreign key
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};