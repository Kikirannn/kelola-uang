@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold">Dashboard</h2>
        <p class="text-muted">Selamat datang, {{ auth()->user()->name }}!</p>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card stats-card" style="background: linear-gradient(135deg, #10b981, #059669);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1 opacity-75">Total Pemasukan</p>
                            <h3 class="fw-bold mb-0">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
                        </div>
                        <div class="stats-icon bg-white bg-opacity-25">
                            <i class="bi bi-arrow-down-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stats-card" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1 opacity-75">Total Pengeluaran</p>
                            <h3 class="fw-bold mb-0">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3>
                        </div>
                        <div class="stats-icon bg-white bg-opacity-25">
                            <i class="bi bi-arrow-up-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stats-card" style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1 opacity-75">Saldo</p>
                            <h3 class="fw-bold mb-0">Rp {{ number_format($balance, 0, ',', '.') }}</h3>
                        </div>
                        <div class="stats-icon bg-white bg-opacity-25">
                            <i class="bi bi-wallet2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card stats-card">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">Grafik Pemasukan & Pengeluaran (6 Bulan Terakhir)</h5>
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card stats-card">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">Pengeluaran per Kategori (Bulan Ini)</h5>
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="card stats-card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-bold mb-0">Transaksi Terakhir</h5>
                <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-eye"></i> Lihat Semua
                </a>
            </div>

            @if($recentTransactions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th class="text-end">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTransactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $transaction->type }}">
                                            {{ $transaction->category->name }}
                                        </span>
                                    </td>
                                    <td>{{ $transaction->description ?: '-' }}</td>
                                    <td
                                        class="text-end fw-bold {{ $transaction->type == 'income' ? 'text-success' : 'text-danger' }}">
                                        {{ $transaction->type == 'income' ? '+' : '-' }}
                                        Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-3">Belum ada transaksi</p>
                    <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Transaksi
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Monthly Chart
        const monthlyCtx = document.getElementById('monthlyChart');
        const monthlyData = @json($monthlyData);

        new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: monthlyData.map(d => d.month),
                datasets: [{
                    label: 'Pemasukan',
                    data: monthlyData.map(d => d.income),
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4
                }, {
                    label: 'Pengeluaran',
                    data: monthlyData.map(d => d.expense),
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        // Category Chart
        const categoryCtx = document.getElementById('categoryChart');
        const categoryData = @json($expenseByCategory);

        if (categoryData.length > 0) {
            new Chart(categoryCtx, {
                type: 'doughnut',
                data: {
                    labels: categoryData.map(d => d.name),
                    datasets: [{
                        data: categoryData.map(d => d.total),
                        backgroundColor: categoryData.map(d => d.color)
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        } else {
            categoryCtx.parentElement.innerHTML = '<p class="text-center text-muted mt-4">Belum ada data</p>';
        }
    </script>
@endpush