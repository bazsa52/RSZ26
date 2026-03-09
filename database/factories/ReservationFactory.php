<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reservation>
 */
class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = \Date::now()->addDays(fake()->numberBetween(1, 10));

        return [
            'room_id' => Room::factory(),
            'reservation_date' => \Date::now(),
            'start_time' => $start,
            'end_time' => $start->addDays(fake()->numberBetween(10, 15)),
            'comment' => fake()->sentence(),
        ];
    }
}
