@extends('layouts.admin')

@section('content')

<div class="container">
    <h1>Tambah Produk</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"> <!-- Tambahkan enctype untuk upload file -->
        @csrf
        <div class="form-group">
            <label for="name">Nama Produk</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" name="price" id="price" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="stock">Stok</label>
            <input type="number" name="stock" id="stock" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="brand">Merk</label>
            <input type="text" name="brand" id="brand" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="image">Gambar Produk</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*" required> <!-- Input untuk gambar -->
        </div>
        <button type="submit" class="btn btn-success">Tambah Produk</button>
    </form>
</div>
@endsection