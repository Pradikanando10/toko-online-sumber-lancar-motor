@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h3 class="mb-0"><i class="bi bi-person-circle me-2"></i>Profil Saya</h3>
                </div>
                <div class="card-body text-center">
                    {{-- Foto Pengguna --}}
                    @if ($user->photo)
                        <img src="data:image/jpeg;base64,{{ base64_encode($user->photo) }}"
                            class="rounded-circle mb-3"
                            style="width: 120px; height: 120px; object-fit: cover;" alt="Foto Profil">
                    @else
                        <img src="{{ asset('images/default-user.png') }}"
                            class="rounded-circle mb-3"
                            style="width: 120px; height: 120px; object-fit: cover;" alt="Default Foto">
                    @endif



                    {{-- Info Profil --}}
                    <p><strong>Nama:</strong> {{ $user->name }}</p>
                    <p><strong>Alamat:</strong> {{ $user->address }}</p>
                    <p><strong>Nomor HP:</strong> {{ $user->phone ?? '-' }}</p>
                </div>
            </div>
            <div style="height: 30vh"></div>
        </div>
    </div>
</div>
@endsection
