<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;

    use HasUuids;

    protected $fillable = [
        'room_id',
        'reservation_date',
        'startTime',
        'endTime',
        'comment',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
