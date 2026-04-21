<?php

namespace Database\Factories;

use Faker\Provider\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PaymentStatusEnum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentStatus>
 */
class PaymentStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => PaymentStatusEnum::NotPaid,
        ];
    }
}
