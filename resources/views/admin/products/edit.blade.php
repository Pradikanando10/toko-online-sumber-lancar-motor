{{-- @extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Produk</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Gunakan PUT untuk update -->

        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" class="form-control" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Perbarui Produk</button>
    </form>
</div>
@endsection --}}

{{-- @extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Produk</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Gunakan PUT untuk update -->

        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" class="form-control" required>{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required step="0.01">
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="stock">Stok</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
            @error('stock')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select name="category_id" class="form-control">
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Gambar</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Perbarui Produk</button>
    </form>
</div>
@endsection --}}

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Produk</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Gunakan PUT untuk update -->

        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" class="form-control" required>{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required step="0.01">
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="stock">Stok</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
            @error('stock')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Ganti Kategori menjadi Merk --}}
        <div class="form-group">
            <label for="brand">Merk</label>
            <input type="text" name="brand" class="form-control" value="{{ old('brand', $product->brand) }}" required>
            @error('brand')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Gambar</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Perbarui Produk</button>
    </form>
</div>
@endsection
