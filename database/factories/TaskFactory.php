<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Client;
use App\Models\FiverrAccount;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amt = $this->faker->numberBetween(100, 10000);

        return [
            'description' => $this->faker->text(50),
            'assigned_to' => User::query()->where('user_type', 'admin')->inRandomOrder()->first()?->id,
            'client_id' => Client::inRandomOrder()->first()?->id,
            'amount' => $amt,
            'freelancer_pay' => round($amt * 0.4, 2),
            'deadline' => Carbon::now()->addDays(rand(5, 10))->setTime(rand(8, 16), 0),
            'status' => $this->faker->randomElement(['pending assignment', 'in progress', 'completed', 'cancelled']),
            'fiver_account_id' => FiverrAccount::inRandomOrder()->first()?->id,
        ];
    }
}
