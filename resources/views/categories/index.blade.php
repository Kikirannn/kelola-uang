@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold">Kategori Keuangan Kampus</h2>
                <p class="text-muted">Kelola kategori transaksi keuangan kampus</p>
            </div>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Kategori
            </a>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="card stats-card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('categories.index') }}">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" placeholder="Cari kategori..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="type" class="form-select">
                            <option value="">Semua Tipe</option>
                            <option value="income" {{ request('type') == 'income' ? 'selected' : '' }}>Pemasukan</option>
                            <option value="expense" {{ request('type') == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="row g-4">
        @forelse($categories as $category)
            <div class="col-md-6 col-lg-4">
                <div class="card stats-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon me-3"
                                    style="background-color: {{ $category->color }}; width: 50px; height: 50px;">
                                    <i class="bi bi-{{ $category->icon ?? 'tag' }} text-white"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">{{ $category->name }}</h5>
                                    <span class="badge badge-{{ $category->type }}">
                                        {{ $category->type == 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                                    </span>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('categories.edit', $category) }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <p class="text-muted small mb-0">
                            <i class="bi bi-receipt"></i> {{ $category->transactions()->count() }} transaksi
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card stats-card">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-3">Tidak ada kategori ditemukan</p>
                        <a href="{{ route('categories.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Kategori Pertama
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($categories->hasPages())
        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    @endif
@endsection