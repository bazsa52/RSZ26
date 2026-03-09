<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomIds = DB::table('rooms')->pluck('id')->all();

        if (count($roomIds) === 0) {
            Room::factory()->count(3)->create();

            $roomIds = DB::table('rooms')->pluck('id')->all();
        }

        Reservation::factory()
            ->count(30)
            ->create()
            ->each(function (Reservation $reservation) use ($roomIds): void {
                $reservation->room_id = $roomIds[array_rand($roomIds)];
                $reservation->save();
            });
    }
}
