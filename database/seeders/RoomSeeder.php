<?php

namespace Database\Seeders;

use Database\Factories\RoomFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomFactory::new()->count(10)->create();
    }
}
