<?php

namespace Database\Factories;

use App\Models\RoomStateEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomState>
 */
class RoomStateLookupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'state' => RoomStateEnum::Available,
        ];
    }
}
