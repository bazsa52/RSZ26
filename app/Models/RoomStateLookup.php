<?php

namespace App\Models;

use Database\Factories\RoomStateLookupFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomStateLookup extends Model
{
    /** @use HasFactory<RoomStateLookupFactory> */
    use HasFactory, HasUuids;

    protected $primaryKey = 'room_state_id';

    protected $fillable = [
        'state',
    ];

    protected $casts = [
        'state' => RoomStateEnum::class,
    ];

    public function logs(): HasMany
    {
        return $this->hasMany(RoomStateLog::class, 'room_state_id');
    }
}
