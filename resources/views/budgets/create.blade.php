@extends('layouts.app')

@section('title', 'Tambah Budget')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('budgets.index') }}">Budget</a></li>
            <li class="breadcrumb-item active">Tambah Budget</li>
        </ol>
    </nav>
    <h2 class="fw-bold">Tambah Budget</h2>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card stats-card">
            <div class="card-body">
                <form action="{{ route('budgets.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori Pengeluaran <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah Budget <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" 
                                   value="{{ old('amount') }}" step="0.01" min="0.01" required>
                        </div>
                        @error('amount')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="period" class="form-label">Periode <span class="text-danger">*</span></label>
                        <select name="period" id="period" class="form-select @error('period') is-invalid @enderror" required>
                            <option value="">Pilih Periode</option>
                            <option value="monthly" {{ old('period') == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                            <option value="yearly" {{ old('period') == 'yearly' ? 'selected' : '' }}>Tahunan</option>
                        </select>
                        @error('period')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" name="start_date" id="start_date" 
                               class="form-control @error('start_date') is-invalid @enderror" 
                               value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                        <input type="date" name="end_date" id="end_date" 
                               class="form-control @error('end_date') is-invalid @enderror" 
                               value="{{ old('end_date') }}" required>
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                        <a href="{{ route('budgets.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
