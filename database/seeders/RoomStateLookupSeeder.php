<?php

namespace Database\Seeders;

use App\Models\RoomStateEnum;
use Database\Factories\RoomStateLookupFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomStateLookupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RoomStateEnum::cases() as $state) {
            RoomStateLookupFactory::new()->create(['state' => $state->value]);
        }
    }
}
