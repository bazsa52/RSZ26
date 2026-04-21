<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use App\Models\Reservation;
use App\Models\User;
use Database\Factories\ReceiptFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = Reservation::all();
        $users = User::all();
        $payment_statuses = PaymentStatus::all();

        foreach ($reservations as $reservation) {
            $receipt = ReceiptFactory::new()->make();
            $receipt->reservation()->associate($reservation);
            $receipt->user()->associate($users->random());
            $receipt->paymentStatus()->associate($payment_statuses->random());
            $receipt->save();
        }
    }
}
