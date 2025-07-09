@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <h1>Daftar Pesanan (Admin)</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Nama Pengguna</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Nama Produk</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Tanggal Pesanan</th>
                <th>Bukti Transfer</th>
                <th>No Resi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $order->user->address ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $order->user->phone ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $order->product_name }}</td>
                    <td>Rp {{ number_format($order->total_price, 2, ',', '.') }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        @if($order->paymentProofs->count() > 0)
                            @foreach($order->paymentProofs as $proof)
                                <img src="{{ asset('storage/'.$proof->image_path) }}" 
                                     alt="Bukti Transfer" 
                                     style="max-width: 120px; cursor:pointer; margin-bottom:8px;" 
                                     onclick="showImageModal('{{ asset('storage/'.$proof->image_path) }}')">
                            @endforeach
                        @else
                            <span>Tidak ada bukti transfer</span>
                        @endif
                    </td>
                    <td>{{ $order->no_resi ?? 'Tidak Diketahui' }}</td>
                    <td>
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Di Kirim</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- MODAL GAMBAR -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bukti Transfer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center">
        <img id="modalImage" src="" class="img-fluid rounded shadow">
      </div>
    </div>
  </div>
</div>

<!-- SCRIPTS MODAL -->
<script>
    function showImageModal(src) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = src;
        const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    }
</script>

<!-- Tambahkan ini jika belum ada Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
