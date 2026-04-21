<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AddressSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            RoomStateLookupSeeder::class,
            RoomSeeder::class,
            RoomStateLogSeeder::class,
            PictureSeeder::class,
            ExtraServiceSeeder::class,
            ReservationSeeder::class,
            PaymentStatusSeeder::class,
            ReceiptSeeder::class,
        ]);
    }
}
