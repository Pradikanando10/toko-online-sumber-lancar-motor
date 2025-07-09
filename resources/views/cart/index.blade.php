@extends('layouts.app')

@section('content')

{{-- <ul>
    @if(session('cart'))
        @foreach (session('cart') as $id => $item)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2>{{ $item['name'] }}</h2>
                        <p>Harga: Rp {{ $item['price'] }}</p>
                        <p>Jumlah: {{ $item['quantity'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <P>Keranjang Anda Kosong.</P>
    @endif
</ul> --}}

{{-- @if($cart) --}}
    {{-- @foreach($cart as $item) --}}
        {{-- <div class="card p-3 mb-3 d-flex justify-center" style="max-width: 400px;">
            @if(!empty($item['image']))
                <img src="data:image/png;base64,{{ $item['image'] }}" class="card-img-top mb-3" style="max-height: 200px; object-fit: contain;">
            @else
                <p><em>Tidak ada gambar</em></p>
            @endif
        
            <h3>{{ $item['name'] }}</h3>
            <p>Harga: Rp {{ number_format($item['price'], 2) }}</p>
            <p>Jumlah: {{ $item['quantity'] }}</p>
        </div> 
    @endforeach--}}

    {{-- <a class="btn btn-primary" href="{{ route('home') }}">Lanjutkan Belanja</a>
    <a class="btn btn-success" href="{{ route('checkout') }}">Pesan Sekarang</a> --}}
    
    {{-- @if(!empty($cart) && count($cart) > 0)
    <div class="container my-5">
        <h1 class="my-5">Keranjang Anda</h1>

        @php $total = 0; @endphp

        @foreach ($cart as $id => $item)
            @php
                $product = \App\Models\Product::find($id);
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            @endphp

            <div class="card mb-4 shadow-sm">
                <div class="row g-0">
                    <div class="col-md-3 d-flex align-items-center justify-content-center bg-light p-3">
                        @if($product && $product->image)
                            <img src="data:image/png;base64,{{ base64_encode($product->image) }}" class="img-fluid rounded" style="max-height: 120px;" alt="{{ $item['name'] }}">
                        @else
                            <img src="{{ asset('images/default-product.jpg') }}" class="img-fluid rounded" style="max-height: 120px;" alt="Default Image">
                        @endif
                    </div>

                    <div class="col-md-6 p-3">
                        <h5 class="mb-1">{{ $item['name'] }}</h5>
                        <p class="mb-1 text-muted">Harga: Rp {{ number_format($item['price'], 0, ',', '.') }}</p>

                        <div class="d-flex align-items-center gap-2 mt-3">
                            <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center mr-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm me-2" style="width: 80px;">
                                <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                            </form>

                            //<form action="{{ route('cart.remove') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>//

                            <form action="{{ route('cart.remove') }}" method="POST" class="d-inline delete-form">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <button type="submit" class="btn btn-sm btn-outline-danger delete-btn">Hapus</button>
                            </form>
                            
                        </div>
                    </div>

                    <div class="col-md-3 d-flex align-items-center justify-content-center bg-light p-3">
                        <p class="mb-0">Total: Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="text-end mb-4">
            <h4>Total Belanja: Rp {{ number_format($total, 0, ',', '.') }}</h4>
        </div>

        <div class="mb-5">
            <a href="{{ route('home') }}" class="btn btn-primary">Lanjutkan Belanja</a>
            //<a href="{{ route('checkout') }}" class="btn btn-success">Pesan Sekarang</a>//
            <a href="{{ route('checkout') }}" id="btnCheckout" class="btn btn-success">Pesan Sekarang</a>
        </div>
    </div>
@else
    <div class="d-flex justify-content-center pt-5">
        <p style="font-size: 24px; font-weight: bold;">Keranjang kosong.</p>
    </div>
@endif --}}

@if(!empty($cart) && count($cart) > 0)
<div class="container my-5">
    <h1 class="my-5">Keranjang Anda</h1>

    @php $total = 0; @endphp

    @foreach ($cart as $id => $item)
        @php
            $product = \App\Models\Product::find($id);
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
        @endphp

        <div class="card mb-4 shadow-sm">
            <div class="row g-0">
                <div class="col-md-3 d-flex align-items-center justify-content-center bg-light p-3">
                    @if($product && $product->image)
                        <img src="data:image/png;base64,{{ base64_encode($product->image) }}" class="img-fluid rounded" style="max-height: 120px;" alt="{{ $item['name'] }}">
                    @else
                        <img src="{{ asset('images/default-product.jpg') }}" class="img-fluid rounded" style="max-height: 120px;" alt="Default Image">
                    @endif
                </div>

                <div class="col-md-6 p-3">
                    <h5 class="mb-1">{{ $item['name'] }}</h5>
                    <p class="mb-1 text-muted">Harga: Rp {{ number_format($item['price'], 0, ',', '.') }}</p>

                    <div class="d-flex align-items-center gap-2 mt-3">
                        {{-- Update otomatis saat jumlah berubah --}}
                        <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center mr-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $id }}">
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                   class="form-control form-control-sm me-2"
                                   style="width: 80px;"
                                   onchange="this.form.submit()">
                        </form>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('cart.remove') }}" method="POST" class="d-inline delete-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $id }}">
                            <button type="submit" class="btn btn-sm btn-outline-danger delete-btn">Hapus</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-3 d-flex align-items-center justify-content-center bg-light p-3">
                    <p class="mb-0">Total: Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    @endforeach

    <div class="text-end mb-4">
        <h4>Total Belanja: Rp {{ number_format($total, 0, ',', '.') }}</h4>
    </div>

    <div class="mb-5">
        <a href="{{ route('home') }}" class="btn btn-primary">Lanjutkan Belanja</a>
        <a href="{{ route('checkout') }}" id="btnCheckout" class="btn btn-success">Pesan Sekarang</a>
    </div>
</div>
@else
<div class="d-flex justify-content-center pt-5">
    <p style="font-size: 24px; font-weight: bold;">Keranjang kosong.</p>
</div>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('btnCheckout').addEventListener('click', function (e) {
        e.preventDefault(); // Mencegah langsung pindah halaman

        Swal.fire({
            title: 'Yakin ingin memesan sekarang?',
            text: "Pesanan akan diproses dan tidak dapat dibatalkan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, pesan sekarang!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = this.getAttribute('href');
            }
        });
    });

    document.querySelectorAll('.delete-btn').forEach(function(button) {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const form = this.closest('form');

            Swal.fire({
                title: 'Yakin ingin menghapus item ini?',
                text: "Item akan dihapus dari keranjang.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>


@endsection