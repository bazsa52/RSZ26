<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use App\Models\PaymentStatusEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (PaymentStatusEnum::cases() as $status) {
            PaymentStatus::create(['status' => $status->value]);
        }
    }
}
