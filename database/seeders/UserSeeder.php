<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'ftool@example.com',
            'phone_number' => '123456789',
            'city' => 'Nairobi',
            'country' => 'kenya',
            'password' => Hash::make('@#202507'),
            'user_type' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
}
