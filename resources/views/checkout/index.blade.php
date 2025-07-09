@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h1 class="mb-4">Checkout</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('cart'))
        @php $total = 0; @endphp

        @foreach (session('cart') as $item)
            @php $total += $item['price'] * $item['quantity']; @endphp

            <div class="card mb-3 shadow-sm">
                <div class="row g-0 align-items-center">
                    <div class="col-md-2 text-center p-2">
                        @if (!empty($item['image']))
                            <img src="data:image/png;base64,{{ $item['image'] }}" class="img-fluid rounded-start" style="max-height: 100px; object-fit: contain;">
                        @else
                            <img src="{{ asset('images/default.png') }}" class="img-fluid rounded-start" style="max-height: 100px;">
                        @endif
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['name'] }}</h5>
                            <p class="card-text mb-0">Harga: Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                            <p class="card-text">Jumlah: {{ $item['quantity'] }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-end pe-4">
                        <p class="fw-bold mt-3">Subtotal: Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Total --}}
        <div class="text-end fw-bold mb-4 fs-5">
            Total Belanja: Rp {{ number_format($total, 0, ',', '.') }}
        </div>

        <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
        
            {{-- Metode Pengiriman --}}
            <div class="mb-3">
                <label for="shipping_method" class="form-label">Metode Pengiriman</label>
                <select name="shipping_method" id="shipping_method" class="form-select" required onchange="updateShippingCost(this)">
                    <option value="">-- Pilih Metode --</option>
                    <option value="JNT" data-cost="15000">JNT - Rp 15.000</option>
                    <option value="JNE" data-cost="18000">JNE - Rp 18.000</option>
                    <option value="Sicepat" data-cost="20000">Sicepat - Rp 20.000</option>
                </select>
            </div>
        
            <input type="hidden" name="shipping_cost" id="shipping_cost" value="0">
        
            {{-- Upload Bukti --}}
            <div class="mb-3">
                <label for="payment_image" class="form-label">Upload Bukti Transfer</label>
                <input type="file" id="payment_image" name="payment_image" class="form-control" required accept="image/*">
            </div>
        
            {{-- Total Baru --}}
            <div class="text-end fw-bold fs-5 mb-3">
                Total + Ongkir: <span id="grand_total_display">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        
            <button type="submit" class="btn btn-success">Submit Pesanan</button>
        </form>
        
        

        {{-- Form Bukti Transfer --}}
        {{-- <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="payment_image" class="form-label">Upload Bukti Transfer</label>
                <input type="file" id="payment_image" name="payment_image" class="form-control" required accept="image/*">
            </div>
            <button type="submit" class="btn btn-success">Submit Pesanan</button>
        </form> --}}

        {{-- Kontak WhatsApp --}}
        <p class="mb-2">Konfirmasi pembayaran melalui Whatsapp hubungi:</p>
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/waLogo.png') }}" alt="WA Logo" style="width: 35px;" class="me-2">
            <span class="fw-medium">083854263778</span>
        </div>

    @else
        <p>Keranjang Anda Kosong.</p>
    @endif
    
    <script>
        function updateShippingCost(select) {
            const selected = select.options[select.selectedIndex];
            const cost = parseInt(selected.getAttribute('data-cost') || 0);
            const baseTotal = {{ $total }};
            document.getElementById('shipping_cost').value = cost;
            document.getElementById('grand_total_display').innerText = 'Rp ' + (baseTotal + cost).toLocaleString('id-ID');
        }
    </script>
</div>

@endsection


