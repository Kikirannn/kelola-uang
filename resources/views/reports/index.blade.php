@extends('layouts.app')

@section('title', 'Laporan Keuangan')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold">Laporan Keuangan</h2>
        <p class="text-muted">Analisis dan laporan keuangan lengkap</p>
    </div>

    <!-- Filter -->
    <div class="card stats-card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('reports.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Dari Tanggal</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate }}">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Sampai Tanggal</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Tampilkan Laporan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card stats-card" style="background: linear-gradient(135deg, #10b981, #059669);">
                <div class="card-body text-white">
                    <h6 class="opacity-75">Total Pemasukan</h6>
                    <h3 class="fw-bold">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stats-card" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                <div class="card-body text-white">
                    <h6 class="opacity-75">Total Pengeluaran</h6>
                    <h3 class="fw-bold">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stats-card" style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                <div class="card-body text-white">
                    <h6 class="opacity-75">Selisih</h6>
                    <h3 class="fw-bold">Rp {{ number_format($totalIncome - $totalExpense, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row g-4 mb-4">
        <div class="col-lg-7">
            <div class="card stats-card">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">Grafik Harian</h5>
                    <canvas id="dailyChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card stats-card">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">Pengeluaran per Kategori</h5>
                    <canvas id="expenseChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card stats-card">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">Detail Pengeluaran per Kategori</h5>
                    @if($expenseByCategory->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-end">%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($expenseByCategory as $item)
                                        <tr>
                                            <td>
                                                <span class="badge" style="background-color: {{ $item->color }}">
                                                    {{ $item->name }}
                                                </span>
                                            </td>
                                            <td class="text-end">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                            <td class="text-end">
                                                {{ $totalExpense > 0 ? number_format(($item->total / $totalExpense) * 100, 1) : 0 }}%
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-muted">Tidak ada data pengeluaran</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card stats-card">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">Detail Pemasukan per Kategori</h5>
                    @if($incomeByCategory->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-end">%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($incomeByCategory as $item)
                                        <tr>
                                            <td>
                                                <span class="badge" style="background-color: {{ $item->color }}">
                                                    {{ $item->name }}
                                                </span>
                                            </td>
                                            <td class="text-end">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                            <td class="text-end">
                                                {{ $totalIncome > 0 ? number_format(($item->total / $totalIncome) * 100, 1) : 0 }}%
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-muted">Tidak ada data pemasukan</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Daily Chart
        const dailyCtx = document.getElementById('dailyChart');
        const dailyData = @json($dailyData);

        new Chart(dailyCtx, {
            type: 'line',
            data: {
                labels: dailyData.map(d => d.date),
                datasets: [{
                    label: 'Pemasukan',
                    data: dailyData.map(d => d.income),
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Pengeluaran',
                    data: dailyData.map(d => d.expense),
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    tension: 0.4,
                    fill: true
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

        // Expense Pie Chart
        const expenseCtx = document.getElementById('expenseChart');
        const expenseData = @json($expenseByCategory);

        if (expenseData.length > 0) {
            new Chart(expenseCtx, {
                type: 'pie',
                data: {
                    labels: expenseData.map(d => d.name),
                    datasets: [{
                        data: expenseData.map(d => d.total),
                        backgroundColor: expenseData.map(d => d.color)
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
            expenseCtx.parentElement.innerHTML = '<p class="text-center text-muted mt-4">Belum ada data</p>';
        }
    </script>
@endpush