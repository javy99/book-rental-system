<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        // Create 8 regular users
        \App\Models\User::factory(8)->create();

        // Create 2 librarians
        \App\Models\User::factory()->librarian()->count(2)->create();
    }
}
