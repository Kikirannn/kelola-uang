@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}">Transaksi</a></li>
            <li class="breadcrumb-item active">Tambah Transaksi</li>
        </ol>
    </nav>
    <h2 class="fw-bold">Tambah Transaksi</h2>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card stats-card">
            <div class="card-body">
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="type" class="form-label">Tipe Transaksi <span class="text-danger">*</span></label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="">Pilih Tipe</option>
                            <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Pemasukan</option>
                            <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-type="{{ $category->type }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }} ({{ $category->type == 'income' ? 'Pemasukan' : 'Pengeluaran' }})
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah <span class="text-danger">*</span></label>
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
                        <label for="transaction_date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="transaction_date" id="transaction_date" 
                               class="form-control @error('transaction_date') is-invalid @enderror" 
                               value="{{ old('transaction_date', date('Y-m-d')) }}" required>
                        @error('transaction_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" rows="3" 
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Catatan tambahan (opsional)">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Filter categories based on transaction type
    const typeSelect = document.getElementById('type');
    const categorySelect = document.getElementById('category_id');
    const allOptions = Array.from(categorySelect.options);

    typeSelect.addEventListener('change', function() {
        const selectedType = this.value;
        
        // Reset select
        categorySelect.innerHTML = '<option value="">Pilih Kategori</option>';
        
        if (selectedType) {
            // Filter and add matching options
            allOptions.forEach(option => {
                if (option.dataset.type === selectedType) {
                    categorySelect.appendChild(option.cloneNode(true));
                }
            });
        } else {
            // Add all options back
            allOptions.forEach(option => {
                if (option.value) {
                    categorySelect.appendChild(option.cloneNode(true));
                }
            });
        }
    });
</script>
@endpush
