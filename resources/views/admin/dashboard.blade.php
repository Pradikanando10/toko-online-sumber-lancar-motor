@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang di dashboard admin!</p>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Jumlah Pesanan</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $orderCount }}</h5>
                    <p class="card-text">Total pesanan yang telah dibuat.</p>
                    <a href="{{ route('admin.orders') }}" class="btn btn-light">Lihat Daftar Pesanan</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Jumlah Produk</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $productCount }}</h5>
                    <p class="card-text">Total produk yang tersedia di toko.</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-light">Kelola Produk</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik Penjualan --}}
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Grafik Penjualan (30 Hari Terakhir)</div>
                <div class="card-body">
                    <canvas id="salesChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const salesDates = {!! json_encode($salesDates) !!};
    const salesCounts = {!! json_encode($salesCounts) !!};

    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: salesDates,
            datasets: [{
                label: 'Jumlah Pesanan',
                data: salesCounts,
                fill: true,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                tension: 0.2
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    ticks: {
                        maxTicksLimit: 10,
                        autoSkip: true
                    }
                },
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
</script>
@endsection
