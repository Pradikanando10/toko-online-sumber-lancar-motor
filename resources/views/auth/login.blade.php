@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 85vh;">
    <div class="col-md-6">
        <div class="card shadow rounded">
            <div class="card-body">
                <h3 class="mb-4 text-center fw-bold">👤 Login Pengguna</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" id="btnRegister" class="btn btn-success">Register</button>
                        <a href="{{ route('admin.login') }}" class="btn btn-danger">Admin Login</a>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('btnRegister').addEventListener('click', function () {
        Swal.fire({
            title: 'Pemberitahuan Wilayah',
            text: 'Toko online ini hanya melayani wilayah Mojokerto. Luar wilayah belum didukung.',
            icon: 'info',
            confirmButtonText: 'Saya Mengerti'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('register') }}";
            }
        });
    });
</script>
@endsection
