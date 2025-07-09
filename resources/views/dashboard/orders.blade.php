@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-3">Pesanan Saya</h1>

    @if($orders->isEmpty())
        <p>Tidak ada pesanan yang ditemukan.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    {{-- <th>ID Pesanan</th> --}}
                    <th>Nama Pesanan</th>
                    <th>Harga</th>
                    <th>Tanggal Pesanan</th>
                    <th>No Resi</th>
                    <th>Jenis Pengiriman</th>
                    <th>Status</th>
                    <th>Lacak</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        {{-- <td>{{ $order->id }}</td> --}}
                        <td>{{ $order->product_name }}</td>
                        <td>Rp {{ $order->total_price }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->no_resi }}</td>
                        <td>{{ $order->shipping_method }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <td>
                                @php
                                    $trackingLink = '';
                                    if ($order->shipping_method === 'JNE') {
                                        $trackingLink = 'https://www.jne.co.id/id/tracking/trace/' . $order->tracking_number;
                                    } elseif ($order->shipping_method === 'JNT') {
                                        $trackingLink = 'https://www.jet.co.id/track?awb=' . $order->tracking_number;
                                    } elseif ($order->shipping_method === 'Sicepat') {
                                        $trackingLink = 'https://www.sicepat.com/checkAwb?awb=' . $order->tracking_number;
                                    }
                                @endphp
                            
                                @if($trackingLink)
                                    <a href="{{ $trackingLink }}" target="_blank" class="btn btn-sm btn-info">
                                        Lacak
                                    </a>
                                @else
                                    <span class="text-muted">Tidak tersedia</span>
                                @endif
                            </td>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection