<?php

namespace App\Models;

use Database\Factories\ExtraServiceFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ExtraService extends Model
{
    /** @use HasFactory<ExtraServiceFactory> */
    use HasFactory, HasUuids;

    protected $primaryKey = 'extra_service_id';

    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    protected $casts = [
        'price' => 'integer',
    ];

    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class, 'reservation_service_jump', 'extra_service_id', 'reservation_id');
    }
}
