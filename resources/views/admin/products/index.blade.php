{{-- @extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Daftar Produk</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('admin.products.index', ['sort' => 'asc']) }}"
           class="btn btn-outline-success btn-sm mr-3 {{ $sort == 'asc' ? 'active fw-bold shadow-sm' : '' }}">
            <i class="bi bi-arrow-down"></i> Stok Terendah
        </a>
    
        <a href="{{ route('admin.products.index', ['sort' => 'desc']) }}"
           class="btn btn-outline-danger btn-sm {{ $sort == 'desc' ? 'active fw-bold shadow-sm' : '' }}">
            <i class="bi bi-arrow-up"></i> Stok Tertinggi
        </a>
    </div>
    

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Merk</th>
                <th>stok</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>Rp {{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->brand }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection --}}

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Daftar Produk</h1>

    {{-- Notifikasi berhasil --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Notifikasi stok menipis --}}
    @php
        $stokMenipis = $products->filter(function ($product) {
            return $product->stock <= 5;
        });
    @endphp

    @if ($stokMenipis->count() > 0)
        <div class="alert alert-warning">
            <strong>⚠️ Peringatan!</strong> Ada {{ $stokMenipis->count() }} produk dengan stok ≤ 5:
            <ul class="mt-2 mb-0">
                @foreach ($stokMenipis as $item)
                    <li>
                        {{ $item->name }} - 
                        <strong class="{{ $item->stock <= 0 ? 'text-danger' : 'text-dark' }}">
                            Stok: {{ $item->stock }}
                        </strong>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Tombol Tambah dan Sorting --}}
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('admin.products.index', ['sort' => 'asc']) }}"
           class="btn btn-outline-success btn-sm mr-3 {{ $sort == 'asc' ? 'active fw-bold shadow-sm' : '' }}">
            <i class="bi bi-arrow-down"></i> Stok Terendah
        </a>
    
        <a href="{{ route('admin.products.index', ['sort' => 'desc']) }}"
           class="btn btn-outline-danger btn-sm {{ $sort == 'desc' ? 'active fw-bold shadow-sm' : '' }}">
            <i class="bi bi-arrow-up"></i> Stok Tertinggi
        </a>
    </div>

    {{-- Tabel Produk --}}
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Merk</th>
                <th>stok</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>Rp {{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->brand }}</td>
                    <td class="{{ $product->stock <= 0 ? 'text-danger fw-bold' : ($product->stock <= 5 ? 'text-warning' : '') }}">
                        {{ $product->stock }}
                    </td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
