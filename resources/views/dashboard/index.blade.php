@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="text-center">
        <h2 class="fw-bold mb-4">👋 Selamat datang, {{ Auth::user()->name }}!</h2>

        <div class="d-flex justify-content-center flex-wrap gap-3">
            <a href="{{ route('user.orders') }}" class="btn btn-primary btn-lg px-4 py-2 mx-3 shadow-sm rounded-pill">
                🧾 Lihat Pesanan Saya
            </a>
            <a href="{{ route('user.profile') }}" class="btn btn-outline-secondary btn-lg px-4 py-2 mx-3 shadow-sm rounded-pill">
                👤 Profil Saya
            </a>
            <form action="{{ route('user.logout') }}" method="POST" class="mx-3">
                @csrf
                <button type="submit" class="btn btn-danger btn-lg px-4 py-2 shadow-sm rounded-pill">
                    🚪 Logout
                </button>
            </form>
        </div>
    </div>
    <div class="" style="height: 50vh"></div>
</div>

<style>
    body {
        background-color: #f9f9f9;
    }
    .btn:hover {
        transform: translateY(-2px);
        transition: 0.3s;
        opacity: 0.95;
    }
</style>
@endsection
