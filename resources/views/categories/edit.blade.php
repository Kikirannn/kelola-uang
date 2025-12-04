@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Kategori</a></li>
                <li class="breadcrumb-item active">Edit Kategori</li>
            </ol>
        </nav>
        <h2 class="fw-bold">Edit Kategori</h2>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card stats-card">
                <div class="card-body">
                    <form action="{{ route('categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $category->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Tipe <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                                <option value="">Pilih Tipe</option>
                                <option value="income" {{ old('type', $category->type) == 'income' ? 'selected' : '' }}>
                                    Pemasukan</option>
                                <option value="expense" {{ old('type', $category->type) == 'expense' ? 'selected' : '' }}>
                                    Pengeluaran</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="color" class="form-label">Warna <span class="text-danger">*</span></label>
                            <input type="color" name="color" id="color"
                                class="form-control form-control-color @error('color') is-invalid @enderror"
                                value="{{ old('color', $category->color) }}" required>
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon (Bootstrap Icons)</label>
                            <input type="text" name="icon" id="icon"
                                class="form-control @error('icon') is-invalid @enderror"
                                value="{{ old('icon', $category->icon) }}" placeholder="contoh: wallet, cart, house">
                            <small class="text-muted">Lihat icon di <a href="https://icons.getbootstrap.com/"
                                    target="_blank">Bootstrap Icons</a></small>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Update
                            </button>
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection