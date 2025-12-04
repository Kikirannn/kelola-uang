<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a default user for testing (Bendahara Kampus)
        $user = \App\Models\User::factory()->create([
            'name' => 'Bendahara IKIP Siliwangi',
            'email' => 'bendahara@ikipsiliwangi.ac.id',
            'password' => Hash::make('password123'), // Password custom
            'role' => 'bendahara',
            'department' => 'Bagian Keuangan',
        ]);

        // Run seeders
        $this->call([
            CategorySeeder::class,
            TransactionSeeder::class,
            BudgetSeeder::class,
        ]);
    }
}
