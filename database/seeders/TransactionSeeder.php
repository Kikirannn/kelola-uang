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

        // Income transactions - more specific
        $incomeData = [
            ['category' => 'Gaji', 'amount' => 5000000, 'description' => 'Gaji bulan ini', 'days_ago' => 5],
            ['category' => 'Gaji', 'amount' => 5000000, 'description' => 'Gaji bulan lalu', 'days_ago' => 35],
            ['category' => 'Gaji', 'amount' => 5000000, 'description' => 'Gaji 2 bulan lalu', 'days_ago' => 65],
            ['category' => 'Bonus', 'amount' => 2000000, 'description' => 'Bonus kinerja Q4', 'days_ago' => 10],
            ['category' => 'Freelance', 'amount' => 1500000, 'description' => 'Proyek website client A', 'days_ago' => 15],
            ['category' => 'Freelance', 'amount' => 2000000, 'description' => 'Design logo & branding', 'days_ago' => 45],
            ['category' => 'Investasi', 'amount' => 500000, 'description' => 'Dividen saham', 'days_ago' => 20],
            ['category' => 'Hadiah', 'amount' => 1000000, 'description' => 'Hadiah ulang tahun', 'days_ago' => 50],
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

        // Expense transactions - more realistic
        $expenseData = [
            // Makanan & Minuman
            ['category' => 'Makanan & Minuman', 'amount' => 45000, 'description' => 'Lunch di kantin', 'days_ago' => 1],
            ['category' => 'Makanan & Minuman', 'amount' => 85000, 'description' => 'Makan malam keluarga', 'days_ago' => 2],
            ['category' => 'Makanan & Minuman', 'amount' => 35000, 'description' => 'Kopi & snack', 'days_ago' => 3],
            ['category' => 'Makanan & Minuman', 'amount' => 150000, 'description' => 'Groceries mingguan', 'days_ago' => 7],
            ['category' => 'Makanan & Minuman', 'amount' => 200000, 'description' => 'Belanja bulanan', 'days_ago' => 30],

            // Transportasi
            ['category' => 'Transportasi', 'amount' => 50000, 'description' => 'Bensin motor', 'days_ago' => 5],
            ['category' => 'Transportasi', 'amount' => 25000, 'description' => 'Parkir & tol', 'days_ago' => 6],
            ['category' => 'Transportasi', 'amount' => 150000, 'description' => 'Gojek/Grab bulanan', 'days_ago' => 8],

            // Belanja
            ['category' => 'Belanja', 'amount' => 350000, 'description' => 'Beli baju baru', 'days_ago' => 12],
            ['category' => 'Belanja', 'amount' => 125000, 'description' => 'Sepatu olahraga', 'days_ago' => 25],
            ['category' => 'Belanja', 'amount' => 80000, 'description' => 'Aksesoris HP', 'days_ago' => 40],

            // Listrik & Air
            ['category' => 'Listrik & Air', 'amount' => 350000, 'description' => 'Tagihan listrik bulan ini', 'days_ago' => 10],
            ['category' => 'Listrik & Air', 'amount' => 100000, 'description' => 'Tagihan air PDAM', 'days_ago' => 11],

            // Internet & Pulsa
            ['category' => 'Internet & Pulsa', 'amount' => 350000, 'description' => 'Paket internet unlimited', 'days_ago' => 5],
            ['category' => 'Internet & Pulsa', 'amount' => 50000, 'description' => 'Pulsa telepon', 'days_ago' => 15],

            // Hiburan
            ['category' => 'Hiburan', 'amount' => 50000, 'description' => 'Netflix subscription', 'days_ago' => 1],
            ['category' => 'Hiburan', 'amount' => 75000, 'description' => 'Nonton bioskop', 'days_ago' => 18],
            ['category' => 'Hiburan', 'amount' => 200000, 'description' => 'Hangout dengan teman', 'days_ago' => 22],

            // Kesehatan
            ['category' => 'Kesehatan', 'amount' => 150000, 'description' => 'Beli obat & vitamin', 'days_ago' => 14],
            ['category' => 'Kesehatan', 'amount' => 300000, 'description' => 'Cek kesehatan rutin', 'days_ago' => 35],

            // Pendidikan
            ['category' => 'Pendidikan', 'amount' => 200000, 'description' => 'Beli buku programming', 'days_ago' => 20],
            ['category' => 'Pendidikan', 'amount' => 500000, 'description' => 'Kursus online Udemy', 'days_ago' => 45],

            // Olahraga
            ['category' => 'Olahraga', 'amount' => 150000, 'description' => 'Membership gym bulanan', 'days_ago' => 3],
            ['category' => 'Olahraga', 'amount' => 75000, 'description' => 'Peralatan olahraga', 'days_ago' => 28],

            // Tabungan
            ['category' => 'Tabungan', 'amount' => 1000000, 'description' => 'Transfer ke tabungan', 'days_ago' => 5],
            ['category' => 'Tabungan', 'amount' => 1000000, 'description' => 'Transfer ke tabungan', 'days_ago' => 35],

            // Lainnya
            ['category' => 'Lainnya', 'amount' => 100000, 'description' => 'Donasi sosial', 'days_ago' => 16],
            ['category' => 'Lainnya', 'amount' => 250000, 'description' => 'Hadiah ultah teman', 'days_ago' => 42],
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
