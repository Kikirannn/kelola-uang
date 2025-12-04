@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold">Profil Pengguna</h2>
        <p class="text-muted">Kelola informasi akun Anda</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card stats-card mb-4">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">Informasi Profil</h5>

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>

            <div class="card stats-card border-danger">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-danger mb-4">Hapus Akun</h5>
                    <p class="text-muted">
                        Setelah akun Anda dihapus, semua data termasuk transaksi, kategori, dan budget akan dihapus secara
                        permanen.
                    </p>

                    <form method="POST" action="{{ route('profile.destroy') }}"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan!')">
                        @csrf
                        @method('DELETE')

                        <div class="mb-3">
                            <label for="password" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Masukkan password untuk konfirmasi" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Hapus Akun
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection