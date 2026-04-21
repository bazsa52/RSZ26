<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RoomStateEnum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomStateLog>
 */
class RoomStateLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_date' => \Date::now(),
            'end_date' => \Date::now()->addMonths(fake()->numberBetween(5, 12)),
        ];
    }
}
