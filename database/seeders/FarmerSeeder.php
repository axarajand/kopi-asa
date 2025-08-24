<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FarmerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(5)->create([
            'role' => 'farmer',
        ]);

        // User::create([
        //     'name' => 'Budi Sanjaya',
        //     'email' => 'budi@gmail.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'farmer',
        // ]);
    }
}