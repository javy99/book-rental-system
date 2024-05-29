<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BookSeeder::class,
            GenreSeeder::class,
            BorrowSeeder::class,
            LibrarianSeeder::class,
        ]);
    }
}