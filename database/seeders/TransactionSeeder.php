<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $incomeCategories = Category::where('type', 'income')->get();
        $expenseCategories = Category::where('type', 'expense')->get();

        if ($incomeCategories->isEmpty() || $expenseCategories->isEmpty()) {
            $this->command->warn('Please run CategorySeeder first!');
            return;
        }

        $userId = 1;

        $transactions = [];

        // Income transactions (Pemasukan Kampus)
        $incomeData = [
            ['category' => 'UKT (Uang Kuliah Tunggal)', 'amount' => 125000000, 'description' => 'Pembayaran UKT mahasiswa semester genap batch 1', 'days_ago' => 5],
            ['category' => 'UKT (Uang Kuliah Tunggal)', 'amount' => 98000000, 'description' => 'Pembayaran UKT mahasiswa semester genap batch 2', 'days_ago' => 12],
            ['category' => 'UKT (Uang Kuliah Tunggal)', 'amount' => 87500000, 'description' => 'Pembayaran UKT mahasiswa semester genap batch 3', 'days_ago' => 25],
            ['category' => 'Dana Hibah Pemerintah', 'amount' => 250000000, 'description' => 'Hibah DIKTI untuk penelitian dosen', 'days_ago' => 15],
            ['category' => 'Dana Hibah Pemerintah', 'amount' => 150000000, 'description' => 'Bantuan operational kampus dari pemerintah daerah', 'days_ago' => 45],
            ['category' => 'Sumbangan & Donasi', 'amount' => 50000000, 'description' => 'Donasi alumni untuk pembangunan lab komputer', 'days_ago' => 20],
            ['category' => 'Sumbangan & Donasi', 'amount' => 25000000, 'description' => 'Sumbangan yayasan untuk beasiswa mahasiswa', 'days_ago' => 35],
            ['category' => 'Kerjasama Industri', 'amount' => 75000000, 'description' => 'MoU kerjasama dengan PT. Tech Indonesia', 'days_ago' => 10],
            ['category' => 'Kerjasama Industri', 'amount' => 40000000, 'description' => 'Sponsorship program magang mahasiswa', 'days_ago' => 50],
            ['category' => 'Pendapatan Seminar/Workshop', 'amount' => 15000000, 'description' => 'Seminar Nasional Pendidikan 2024', 'days_ago' => 30],
            ['category' => 'Pendapatan Penelitian', 'amount' => 35000000, 'description' => 'Hasil kerjama penelitian dengan universitas luar negeri', 'days_ago' => 40],
        ];

        foreach ($incomeData as $data) {
            $category = $incomeCategories->firstWhere('name', $data['category']);
            if ($category) {
                $transactions[] = [
                    'user_id' => $userId,
                    'category_id' => $category->id,
                    'amount' => $data['amount'],
                    'type' => 'income',
                    'description' => $data['description'],
                    'transaction_date' => Carbon::now()->subDays($data['days_ago']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Expense transactions (Pengeluaran Kampus)
        $expenseData = [
            // Operasional
            ['category' => 'Operasional (Listrik, Air, Internet)', 'amount' => 12500000, 'description' => 'Tagihan listrik kampus bulan ini', 'days_ago' => 2],
            ['category' => 'Operasional (Listrik, Air, Internet)', 'amount' => 3500000, 'description' => 'Tagihan air PDAM kampus', 'days_ago' => 3],
            ['category' => 'Operasional (Listrik, Air, Internet)', 'amount' => 8500000, 'description' => 'Internet dedicated kampus 100 Mbps', 'days_ago' => 5],
            ['category' => 'Operasional (Listrik, Air, Internet)', 'amount' => 11800000, 'description' => 'Tagihan listrik bulan lalu', 'days_ago' => 32],

            // Perbaikan & Pemeliharaan
            ['category' => 'Perbaikan & Pemeliharaan Gedung', 'amount' => 25000000, 'description' => 'Perbaikan atap gedung rektorat', 'days_ago' => 8],
            ['category' => 'Perbaikan & Pemeliharaan Gedung', 'amount' => 15000000, 'description' => 'Pengecatan ulang gedung Fakultas FPBS', 'days_ago' => 20],
            ['category' => 'Perbaikan & Pemeliharaan Gedung', 'amount' => 8500000, 'description' => 'Service AC ruang kuliah gedung A', 'days_ago' => 15],

            // Kegiatan Kemahasiswaan
            ['category' => 'Kegiatan Kemahasiswaan (BEM, ORMAWA)', 'amount' => 15000000, 'description' => 'Dana BEM untuk kegiatan OSPEK 2024', 'days_ago' => 18],
            ['category' => 'Kegiatan Kemahasiswaan (BEM, ORMAWA)', 'amount' => 8000000, 'description' => 'Dana ORMAWA untuk lomba olahraga antar fakultas', 'days_ago' => 25],
            ['category' => 'Kegiatan Kemahasiswaan (BEM, ORMAWA)', 'amount' => 5000000, 'description' => 'Kegiatan bakti sosial mahasiswa', 'days_ago' => 35],

            // Gaji Staff Non-Tetap
            ['category' => 'Gaji Staff Non-Tetap', 'amount' => 35000000, 'description' => 'Gaji dosen honorer bulan ini', 'days_ago' => 1],
            ['category' => 'Gaji Staff Non-Tetap', 'amount' => 12000000, 'description' => 'Gaji staff kebersihan dan keamanan', 'days_ago' => 1],
            ['category' => 'Gaji Staff Non-Tetap', 'amount' => 35000000, 'description' => 'Gaji dosen honorer bulan lalu', 'days_ago' => 31],

            // Pengadaan Barang & Inventaris
            ['category' => 'Pengadaan Barang & Inventaris', 'amount' => 45000000, 'description' => 'Pembelian 30 unit komputer untuk lab', 'days_ago' => 7],
            ['category' => 'Pengadaan Barang & Inventaris', 'amount' => 8500000, 'description' => 'Pengadaan ATK untuk semua fakultas', 'days_ago' => 12],
            ['category' => 'Pengadaan Barang & Inventaris', 'amount' => 15000000, 'description' => 'Pembelian meja dan kursi untuk ruang kelas baru', 'days_ago' => 22],

            // Kegiatan Akademik
            ['category' => 'Kegiatan Akademik', 'amount' => 12000000, 'description' => 'Seminar proposal skripsi mahasiswa', 'days_ago' => 10],
            ['category' => 'Kegiatan Akademik', 'amount' => 18000000, 'description' => 'Workshop metode pembelajaran untuk dosen', 'days_ago' => 28],
            ['category' => 'Kegiatan Akademik', 'amount' => 8500000, 'description' => 'Ujian tengah semester (UTS)', 'days_ago' => 40],

            // Biaya Administrasi
            ['category' => 'Biaya Administrasi', 'amount' => 5000000, 'description' => 'Cetak ijazah dan transkrip mahasiswa', 'days_ago' => 14],
            ['category' => 'Biaya Administrasi', 'amount' => 3500000, 'description' => 'Biaya legalisir dokumen kampus', 'days_ago' => 21],

            // Kegiatan Dosen
            ['category' => 'Kegiatan Dosen', 'amount' => 25000000, 'description' => 'Dana penelitian dosen semester ini', 'days_ago' => 6],
            ['category' => 'Kegiatan Dosen', 'amount' => 12000000, 'description' => 'Pelatihan peningkatan kompetensi dosen', 'days_ago' => 38],

            // Pengembangan Fasilitas
            ['category' => 'Pengembangan Fasilitas Kampus', 'amount' => 85000000, 'description' => 'Pembangunan gazebo area mahasiswa', 'days_ago' => 16],
            ['category' => 'Pengembangan Fasilitas Kampus', 'amount' => 45000000, 'description' => 'Renovasi toilet gedung B dan C', 'days_ago' => 42],

            // Perpustakaan
            ['category' => 'Biaya Perpustakaan', 'amount' => 15000000, 'description' => 'Pembelian buku baru perpustakaan', 'days_ago' => 11],
            ['category' => 'Biaya Perpustakaan', 'amount' => 6500000, 'description' => 'Langganan jurnal online internasional', 'days_ago' => 26],

            // Kegiatan Fakultas
            ['category' => 'Kegiatan Fakultas', 'amount' => 18000000, 'description' => 'Dies Natalis Fakultas FPOK', 'days_ago' => 19],
            ['category' => 'Kegiatan Fakultas', 'amount' => 12000000, 'description' => 'Kegiatan pengabdian masyarakat fakultas', 'days_ago' => 33],

            // Lainnya
            ['category' => 'Lainnya', 'amount' => 5000000, 'description' => 'Biaya konsumsi rapat pimpinan', 'days_ago' => 4],
            ['category' => 'Lainnya', 'amount' => 8500000, 'description' => 'Transport tamu kerjasama kampus', 'days_ago' => 24],
        ];

        foreach ($expenseData as $data) {
            $category = $expenseCategories->firstWhere('name', $data['category']);
            if ($category) {
                $transactions[] = [
                    'user_id' => $userId,
                    'category_id' => $category->id,
                    'amount' => $data['amount'],
                    'type' => 'expense',
                    'description' => $data['description'],
                    'transaction_date' => Carbon::now()->subDays($data['days_ago']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        Transaction::insert($transactions);

        $this->command->info('Transactions seeded successfully! Total: ' . count($transactions));
    }
}
