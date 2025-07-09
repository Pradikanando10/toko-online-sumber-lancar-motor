{{--@extends('layouts.app')

@section('content')
 <div class="container">
    <h1 class="my-5">Selamat Datang di Toko Sumber Lancar Motor</h1>

    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src={{ asset('images/banner2.jpg') }} class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src={{asset('images/banner1.jpg')}} class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
        </div>
    </div>

    <h2 class="my-5">Produk yang Tersedia</h2>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">Harga: Rp{{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div> --}}

@extends('layouts.app')

@section('content')
<div class="container py-5">
    {{-- Form Pencarian --}}
    <form action="{{ route('home') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>
    
    {{-- Carousel Gambar --}}
    <div id="carouselExampleIndicators" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner rounded shadow">
            <div class="carousel-item active">
                <img src="{{ asset('images/banner2.jpg') }}" class="d-block w-100" alt="Banner 1" style="max-height: 400px; object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/banner1.jpg') }}" class="d-block w-100" alt="Banner 2" style="max-height: 400px; object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/default-banner.jpg') }}" class="d-block w-100" alt="Banner 3" style="max-height: 400px; object-fit: cover;">
            </div>
        </div>
    </div>


    {{-- Judul --}}
    <h2 class="mb-4 fw-bold text-center">🛒 Produk yang Tersedia</h2>

    {{-- filter --}}
    <form action="{{ route('home') }}" method="GET" class="mb-4">
        <div class="input-group mb-5" style="max-width: 400px;">
            @php
                $brands = \App\Models\Product::select('brand')->distinct()->pluck('brand');
            @endphp
            <select name="brand" class="form-select">
                <option value="">-- Filter Merek --</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-outline-secondary">Terapkan</button>
        </div>
    </form>
    

    {{-- Tampilkan pesan jika tidak ada produk --}}
    @if($products->isEmpty())
        <div class="alert alert-warning text-center">Produk tidak ditemukan.</div>
    @endif

    {{-- Daftar Produk --}}
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($product->image)
                        <img src="data:image/jpeg;base64,{{ base64_encode($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/default-product.jpg') }}" class="card-img-top" alt="Default Image" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted small">{{ \Illuminate\Support\Str::limit($product->description, 80) }}</p>
                        <p class="card-text text-muted"> {{$product->brand}} </p>
                        <p class="mt-auto fw-bold text-primary">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-primary mt-2 rounded-pill">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
