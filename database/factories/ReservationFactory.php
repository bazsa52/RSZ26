<?php

namespace Database\Factories;

use Date;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_date' => Date::now(),
            'end_date' => Date::now()->addDays(fake()->numberBetween(5, 12)),
            'comment' => fake()->text(),
        ];
    }
}
