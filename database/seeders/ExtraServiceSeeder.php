<?php

namespace Database\Seeders;

use Database\Factories\ExtraServiceFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtraServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExtraServiceFactory::new()->count(10)->create();
    }
}
