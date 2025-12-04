<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = 1; // Will be updated to match the first user

        $categories = [
            // Income Categories
            [
                'user_id' => $userId,
                'name' => 'Gaji',
                'type' => 'income',
                'icon' => 'wallet2',
                'color' => '#10b981',
            ],
            [
                'user_id' => $userId,
                'name' => 'Bonus',
                'type' => 'income',
                'icon' => 'gift',
                'color' => '#059669',
            ],
            [
                'user_id' => $userId,
                'name' => 'Freelance',
                'type' => 'income',
                'icon' => 'laptop',
                'color' => '#34d399',
            ],
            [
                'user_id' => $userId,
                'name' => 'Investasi',
                'type' => 'income',
                'icon' => 'graph-up',
                'color' => '#6ee7b7',
            ],
            [
                'user_id' => $userId,
                'name' => 'Hadiah',
                'type' => 'income',
                'icon' => 'gift-fill',
                'color' => '#a7f3d0',
            ],

            // Expense Categories
            [
                'user_id' => $userId,
                'name' => 'Makanan & Minuman',
                'type' => 'expense',
                'icon' => 'cup-straw',
                'color' => '#ef4444',
            ],
            [
                'user_id' => $userId,
                'name' => 'Transportasi',
                'type' => 'expense',
                'icon' => 'car-front',
                'color' => '#f97316',
            ],
            [
                'user_id' => $userId,
                'name' => 'Belanja',
                'type' => 'expense',
                'icon' => 'cart',
                'color' => '#f59e0b',
            ],
            [
                'user_id' => $userId,
                'name' => 'Listrik & Air',
                'type' => 'expense',
                'icon' => 'lightning-charge',
                'color' => '#eab308',
            ],
            [
                'user_id' => $userId,
                'name' => 'Internet & Pulsa',
                'type' => 'expense',
                'icon' => 'wifi',
                'color' => '#84cc16',
            ],
            [
                'user_id' => $userId,
                'name' => 'Hiburan',
                'type' => 'expense',
                'icon' => 'controller',
                'color' => '#8b5cf6',
            ],
            [
                'user_id' => $userId,
                'name' => 'Kesehatan',
                'type' => 'expense',
                'icon' => 'heart-pulse',
                'color' => '#ec4899',
            ],
            [
                'user_id' => $userId,
                'name' => 'Pendidikan',
                'type' => 'expense',
                'icon' => 'book',
                'color' => '#3b82f6',
            ],
            [
                'user_id' => $userId,
                'name' => 'Olahraga',
                'type' => 'expense',
                'icon' => 'bicycle',
                'color' => '#06b6d4',
            ],
            [
                'user_id' => $userId,
                'name' => 'Tabungan',
                'type' => 'expense',
                'icon' => 'piggy-bank',
                'color' => '#14b8a6',
            ],
            [
                'user_id' => $userId,
                'name' => 'Lainnya',
                'type' => 'expense',
                'icon' => 'three-dots',
                'color' => '#6366f1',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('Categories seeded successfully!');
    }
}
