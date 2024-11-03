<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'level' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'name' => 'resepsionis',
            'email' => 'resepsionis@gmail.com',
            'level' => 'resepsionis',
            'username' => 'resepsionis',
            'password' => bcrypt('resepsionis'),
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'level' => 'user',
            'username' => 'user',
            'password' => bcrypt('user'),
        ]);
    }
}
