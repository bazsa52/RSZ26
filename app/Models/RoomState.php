<?php

namespace App\Models;

use Database\Factories\RoomStateFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomState extends Model
{
    /** @use HasFactory<RoomStateFactory> */
    use HasFactory, HasUuids;

    protected $primaryKey = 'room_state_id';

    protected $fillable = [
        'state',
    ];

    protected $casts = [
        'state' => RoomStateEnum::class,
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class, 'room_state_id');
    }
}
