<?php

namespace App\Models;

use Database\Factories\RoomStateLogFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomStateLog extends Model
{
    /** @use HasFactory<RoomStateLogFactory> */
    use HasFactory, HasUuids;

    protected $primaryKey = 'room_state_log_id';

    protected $fillable = [
        'room_id',
        'room_state_id',
        'start_date',
        'end_date',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(RoomStateLookup::class, 'room_state_id');
    }
}
