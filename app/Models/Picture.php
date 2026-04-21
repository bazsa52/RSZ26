<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Picture extends Model
{
    /** @use HasFactory<\Database\Factories\PictureFactory> */
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = ['image_path'];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
