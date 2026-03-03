<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Szolgaltatas extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'szolgaltatasok';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'price',
        'leiras',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    protected $attributes = [
        'name' => '-',
        'price' => 0.00,
        'leiras' => '-',
    ];
}
?>