<?php

namespace Database\Seeders;

use App\Models\Room;
use Database\Factories\PictureFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Room::all() as $room) {
            $picture = PictureFactory::new()->make();
            $picture->room()->associate($room);
            $picture->save();
        }
    }
}
