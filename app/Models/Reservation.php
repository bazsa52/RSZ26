<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservation extends Model
{
    use HasFactory, HasUuids;

    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    protected $fillable = [
        'start_date',
        'end_date',
        'comment',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function room(): HasOne
    {
        return $this->hasOne(Room::class);
    }

    public function extraServices(): HasMany
    {
        return $this->hasMany(ExtraService::class);
    }
}
