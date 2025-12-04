@extends('layouts.app')

@section('title', 'Anggaran')

@section('content')
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold">Anggaran Kampus</h2>
                <p class="text-muted">Kelola dan monitor anggaran keuangan kampus per kategori</p>
            </div>
            <a href="{{ route('budgets.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Anggaran
            </a>
        </div>
    </div>

    <!-- Budgets List -->
    <div class="row g-4">
        @forelse($budgets as $budget)
            <div class="col-12">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <h5 class="mb-1">{{ $budget->category->name }}</h5>
                                <p class="text-muted mb-0">
                                    <i class="bi bi-calendar"></i>
                                    {{ $budget->start_date->format('d/m/Y') }} - {{ $budget->end_date->format('d/m/Y') }}
                                    <span class="badge bg-secondary ms-2">{{ ucfirst($budget->period) }}</span>
                                </p>
                            </div>
                            <div class="col-md-6 mt-3 mt-md-0">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">
                                        Terpakai: Rp {{ number_format($budget->total_spent, 0, ',', '.') }}
                                    </span>
                                    <span class="fw-bold">
                                        Anggaran: Rp {{ number_format($budget->amount, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="progress" style="height: 25px;">
                                    @php
                                        $percentage = $budget->percentage;
                                        $progressClass = 'bg-success';
                                        if ($percentage >= 90) {
                                            $progressClass = 'bg-danger';
                                        } elseif ($percentage >= 75) {
                                            $progressClass = 'bg-warning';
                                        }
                                    @endphp
                                    <div class="progress-bar {{ $progressClass }}" role="progressbar"
                                        style="width: {{ min($percentage, 100) }}%">
                                        {{ number_format($percentage, 1) }}%
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mt-3 mt-md-0 text-end">
                                <a href="{{ route('budgets.edit', $budget) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('budgets.destroy', $budget) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus budget ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card stats-card">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-piggy-bank text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-3">Belum ada anggaran</p>
                        <a href="{{ route('budgets.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Anggaran Pertama
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($budgets->hasPages())
        <div class="mt-4">
            {{ $budgets->links() }}
        </div>
    @endif
@endsection