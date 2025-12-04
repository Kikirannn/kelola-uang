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
            // Income Categories (Pemasukan Kampus)
            [
                'user_id' => $userId,
                'name' => 'UKT (Uang Kuliah Tunggal)',
                'type' => 'income',
                'icon' => 'wallet2',
                'color' => '#10b981',
            ],
            [
                'user_id' => $userId,
                'name' => 'Dana Hibah Pemerintah',
                'type' => 'income',
                'icon' => 'bank',
                'color' => '#059669',
            ],
            [
                'user_id' => $userId,
                'name' => 'Sumbangan & Donasi',
                'type' => 'income',
                'icon' => 'gift',
                'color' => '#34d399',
            ],
            [
                'user_id' => $userId,
                'name' => 'Kerjasama Industri',
                'type' => 'income',
                'icon' => 'building',
                'color' => '#6ee7b7',
            ],
            [
                'user_id' => $userId,
                'name' => 'Pendapatan Seminar/Workshop',
                'type' => 'income',
                'icon' => 'people',
                'color' => '#a7f3d0',
            ],
            [
                'user_id' => $userId,
                'name' => 'Pendapatan Penelitian',
                'type' => 'income',
                'icon' => 'book',
                'color' => '#d1fae5',
            ],

            // Expense Categories (Pengeluaran Kampus)
            [
                'user_id' => $userId,
                'name' => 'Operasional (Listrik, Air, Internet)',
                'type' => 'expense',
                'icon' => 'lightning-charge',
                'color' => '#ef4444',
            ],
            [
                'user_id' => $userId,
                'name' => 'Perbaikan & Pemeliharaan Gedung',
                'type' => 'expense',
                'icon' => 'tools',
                'color' => '#dc2626',
            ],
            [
                'user_id' => $userId,
                'name' => 'Kegiatan Kemahasiswaan (BEM, ORMAWA)',
                'type' => 'expense',
                'icon' => 'star',
                'color' => '#f97316',
            ],
            [
                'user_id' => $userId,
                'name' => 'Gaji Staff Non-Tetap',
                'type' => 'expense',
                'icon' => 'person-badge',
                'color' => '#f59e0b',
            ],
            [
                'user_id' => $userId,
                'name' => 'Pengadaan Barang & Inventaris',
                'type' => 'expense',
                'icon' => 'cart',
                'color' => '#eab308',
            ],
            [
                'user_id' => $userId,
                'name' => 'Kegiatan Akademik',
                'type' => 'expense',
                'icon' => 'mortarboard',
                'color' => '#84cc16',
            ],
            [
                'user_id' => $userId,
                'name' => 'Biaya Administrasi',
                'type' => 'expense',
                'icon' => 'file-text',
                'color' => '#22c55e',
            ],
            [
                'user_id' => $userId,
                'name' => 'Kegiatan Dosen',
                'type' => 'expense',
                'icon' => 'person-workspace',
                'color' => '#3b82f6',
            ],
            [
                'user_id' => $userId,
                'name' => 'Pengembangan Fasilitas Kampus',
                'type' => 'expense',
                'icon' => 'building-add',
                'color' => '#8b5cf6',
            ],
            [
                'user_id' => $userId,
                'name' => 'Biaya Perpustakaan',
                'type' => 'expense',
                'icon' => 'book-half',
                'color' => '#06b6d4',
            ],
            [
                'user_id' => $userId,
                'name' => 'Kegiatan Fakultas',
                'type' => 'expense',
                'icon' => 'globe',
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
