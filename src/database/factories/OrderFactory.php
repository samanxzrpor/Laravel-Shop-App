<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'total_amount' => $this->faker->randomFloat(),
            'ref_code' => $this->faker->randomFloat(),
            'status' => $this->faker->randomElement(['waiting' , 'processing' , 'finished']),
            'user_id' => User::factory()
        ];
    }
}
