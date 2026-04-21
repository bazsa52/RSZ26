<?php

namespace Database\Seeders;

use App\Models\Room;
use Database\Factories\ReservationFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = Room::all();
        ReservationFactory::new()->count(10)->make()->each(function ($reservation) use ($rooms) {
            $reservation->room()->associate($rooms->random());
            $reservation->save();
        });
    }
}
