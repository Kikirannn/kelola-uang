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

        // Budget untuk bulan ini
        $budgetData = [
            'Makanan & Minuman' => 1500000,
            'Transportasi' => 500000,
            'Belanja' => 800000,
            'Listrik & Air' => 500000,
            'Internet & Pulsa' => 400000,
            'Hiburan' => 500000,
            'Kesehatan' => 500000,
            'Pendidikan' => 1000000,
            'Olahraga' => 300000,
            'Tabungan' => 2000000,
        ];

        foreach ($budgetData as $categoryName => $amount) {
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

        Budget::insert($budgets);

        $this->command->info('Budgets seeded successfully! Total: ' . count($budgets));
    }
}
