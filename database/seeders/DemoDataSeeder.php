<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\FiverrAccount;
use App\Models\Task;
use App\Models\User;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::factory()->count(10)->create();
        FiverrAccount::factory()->count(3)->create();
        Task::factory()->count(50)->create();
        User::factory()->count(15)->create();
    }
}
