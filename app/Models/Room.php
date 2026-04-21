<?php

namespace App\Models;

use Database\Factories\RoomFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    /** @use HasFactory<RoomFactory> */
    use HasFactory, HasUuids;

    protected $primaryKey = 'room_id';

    protected $fillable = [
        'name',
        'description',
        'capacity',
        'price_per_night',
    ];

    protected $casts = [
        'price_per_night' => 'integer',
        'capacity' => 'integer',
    ];

    public function state(): RoomStateEnum
    {
        return RoomStateEnum::tryFrom($this->stateLog()->latest()->first()?->state()->state);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'room_id');
    }

    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class, 'room_id');
    }

    public function stateLog(): HasMany
    {
        return $this->hasMany(RoomStateLog::class, 'room_id');
    }
}
