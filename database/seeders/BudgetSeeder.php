<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenseCategories = Category::where('type', 'expense')->get();

        if ($expenseCategories->isEmpty()) {
            $this->command->warn('Please run CategorySeeder first!');
            return;
        }

        $userId = 1;

        $budgets = [];

        // Budget kampus untuk bulan ini (monthly)
        $monthlyBudgetData = [
            'Operasional (Listrik, Air, Internet)' => 30000000,
            'Gaji Staff Non-Tetap' => 50000000,
            'Biaya Administrasi' => 10000000,
            'Kegiatan Dosen' => 15000000,
        ];

        foreach ($monthlyBudgetData as $categoryName => $amount) {
            $category = $expenseCategories->firstWhere('name', $categoryName);

            if ($category) {
                $budgets[] = [
                    'user_id' => $userId,
                    'category_id' => $category->id,
                    'amount' => $amount,
                    'period' => 'monthly',
                    'start_date' => Carbon::now()->startOfMonth(),
                    'end_date' => Carbon::now()->endOfMonth(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Budget semester (6 bulan)
        $semesterBudgetData = [
            'Kegiatan Kemahasiswaan (BEM, ORMAWA)' => 80000000,
            'Kegiatan Akademik' => 120000000,
            'Biaya Perpustakaan' => 50000000,
        ];

        $semesterStart = Carbon::now()->month <= 6
            ? Carbon::create(Carbon::now()->year, 1, 1)
            : Carbon::create(Carbon::now()->year, 7, 1);

        $semesterEnd = Carbon::now()->month <= 6
            ? Carbon::create(Carbon::now()->year, 6, 30)
            : Carbon::create(Carbon::now()->year, 12, 31);

        foreach ($semesterBudgetData as $categoryName => $amount) {
            $category = $expenseCategories->firstWhere('name', $categoryName);

            if ($category) {
                $budgets[] = [
                    'user_id' => $userId,
                    'category_id' => $category->id,
                    'amount' => $amount,
                    'period' => 'semester',
                    'start_date' => $semesterStart,
                    'end_date' => $semesterEnd,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Budget tahunan
        $yearlyBudgetData = [
            'Perbaikan & Pemeliharaan Gedung' => 200000000,
            'Pengadaan Barang & Inventaris' => 250000000,
            'Pengembangan Fasilitas Kampus' => 500000000,
            'Kegiatan Fakultas' => 150000000,
        ];

        foreach ($yearlyBudgetData as $categoryName => $amount) {
            $category = $expenseCategories->firstWhere('name', $categoryName);

            if ($category) {
                $budgets[] = [
                    'user_id' => $userId,
                    'category_id' => $category->id,
                    'amount' => $amount,
                    'period' => 'yearly',
                    'start_date' => Carbon::now()->startOfYear(),
                    'end_date' => Carbon::now()->endOfYear(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        Budget::insert($budgets);

        $this->command->info('Budgets seeded successfully! Total: ' . count($budgets));
    }
}
