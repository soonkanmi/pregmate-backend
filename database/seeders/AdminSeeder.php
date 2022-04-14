<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'email' => 'admin@pregmate.com'
        ], [
            'name' => 'Administrator',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'status' => 1,
            'phone' => '1234456789'
        ]);
    }
}
