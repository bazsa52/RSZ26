<?php

namespace App\Models;

use Database\Factories\PaymentStatusFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentStatus extends Model
{
    /** @use HasFactory<PaymentStatusFactory> */
    use HasFactory, HasUuids;

    protected $primaryKey = 'payment_status_id';

    protected $fillable = ['status'];

    protected $casts = [
        'status' => PaymentStatusEnum::class,
    ];

    public function receipts(): HasMany
    {
        return $this->hasMany(Receipt::class, 'payment_status_id');
    }
}
