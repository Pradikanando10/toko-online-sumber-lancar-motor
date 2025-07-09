@extends('layouts.app')

@section('content')

<div class="container my-5">
    <div class="row g-4 align-items-start">
        {{-- Gambar Produk --}}
        <div class="col-md-5 text-center">
            @if (!empty($product->image))
                <img src="data:image/jpeg;base64,{{ base64_encode($product->image) }}" 
                     class="img-fluid rounded shadow-sm" 
                     style="max-height: 300px; object-fit: contain;">
            @else
                <img src="{{ asset('images/default.png') }}" 
                     class="img-fluid rounded shadow-sm" 
                     style="max-height: 300px;">
            @endif
        </div>

        {{-- Detail Produk --}}
        <div class="col-md-7">
            <h2 class="fw-bold mb-3">{{ $product->name }}</h2>

            <ul class="list-unstyled mb-4">
                <li><strong>Harga:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</li>
                <li><strong>Stok:</strong> {{ $product->stock }}</li>
            </ul>

            {{-- Form Tambah ke Keranjang --}}
            @if(Auth::check())
                <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah:</label>
                        <input type="number" name="quantity" class="form-control w-50" value="1" min="1">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-cart-plus"></i> Tambahkan ke Keranjang
                        </button>
                        <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            @else
                {{-- Tombol jika belum login --}}
                <div class="mb-3">
                    <label class="form-label">Jumlah:</label>
                    <input type="number" class="form-control w-50" value="1" disabled>
                </div>
                <div class="d-flex gap-2">
                    <button onclick="loginAlert()" class="btn btn-success">
                        <i class="bi bi-cart-plus"></i> Tambahkan ke Keranjang
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                </div>
            @endif

            {{-- Merk --}}
            <div class="border-top pt-3">
                <h4 class="mb-2">Merk</h4>
                <p class="text-muted">{{ $product->brand }}</p>
            </div>            

            {{-- Deskripsi Produk --}}
            <div class="border-top pt-3">
                <h4 class="mb-2">Deskripsi Produk</h4>
                <p class="text-muted">{{ $product->description }}</p>
            </div>
        </div>
    </div>
</div>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function loginAlert() {
        Swal.fire({
            icon: 'warning',
            title: 'Login Diperlukan',
            text: 'Anda harus login terlebih dahulu untuk menambahkan ke keranjang.',
            showCancelButton: true,
            confirmButtonText: 'Login Sekarang',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}";
            }
        });
    }
</script>


@endsection

