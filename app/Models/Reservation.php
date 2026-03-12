<?php

namespace App\Models;

use Database\Factories\ReservationFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservation extends Model
{
    /** @use HasFactory<ReservationFactory> */
    use HasFactory, HasUuids;

    protected $primaryKey = 'reservation_id';

    protected $fillable = [
        'start_date',
        'end_date',
        'comment',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function extraServices(): BelongsToMany
    {
        return $this->belongsToMany(ExtraService::class, 'reservation_service_jump', 'reservation_id', 'extra_service_id');
    }

    public function receipt(): HasOne
    {
        return $this->hasOne(Receipt::class, 'user_id');
    }
}
