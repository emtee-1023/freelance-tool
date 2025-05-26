<?php

namespace Database\Factories;

use App\Models\FiverrAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FiverrAccount>
 */
class FiverrAccountFactory extends Factory
{
    protected $model = FiverrAccount::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->name(),
            'link' => 'https://www.inlaw-legal.tech',
        ];
    }
}
