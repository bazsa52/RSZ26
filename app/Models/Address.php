<?php

namespace App\Models;

use Database\Factories\AddressFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    /** @use HasFactory<AddressFactory> */
    use HasFactory, HasUuids;

    protected $primaryKey = 'user_id';
    protected $fillable = [
        'zip_code',
        'city',
        'street',
        'house_number',
        'extra_info',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'address_id');
    }
}
