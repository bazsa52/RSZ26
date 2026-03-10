<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomState extends Model
{
    /** @use HasFactory<\Database\Factories\RoomStateFactory> */
    use HasFactory, HasUuids;

    protected $fillable = [
        'state',
    ];

    protected $casts = [
        'state' => RoomStatus::class,
    ];
}
