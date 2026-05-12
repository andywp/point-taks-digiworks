<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'andy.wijang@gmail.com'],
            [
                'name' => 'Andi Wijang Prasetyo',
                'username' => 'andy.wijang',
                'password' => Hash::make('andi//123'), // ganti password
                'role' => 'Developer',
            ]
            );
    }
}
