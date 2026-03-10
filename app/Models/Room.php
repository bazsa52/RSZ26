<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'capacity',
        'price_per_night',
    ];

    protected $casts = [
        'price_per_night' => 'bigInteger',
        'capacity' => 'integer',
    ];

    public function state(): HasOne
    {
        return $this->hasOne(RoomState::class);
    }

    public function extraServices(): HasMany
    {
        return $this->hasMany(ExtraService::class);
    }
}
