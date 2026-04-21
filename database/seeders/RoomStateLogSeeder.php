<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomStateLookup;
use Database\Factories\RoomStateLogFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomStateLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = RoomStateLookup::all();

        foreach (Room::all() as $room) {
            $log = RoomStateLogFactory::new()->make();
            $log->room()->associate($room);
            $log->state()->associate($states->random());
            $log->save();
        }
    }
}
