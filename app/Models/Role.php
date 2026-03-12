<?php

namespace App\Models;

use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    /** @use HasFactory<RoleFactory> */
    use HasFactory, HasUuids;

    protected $primaryKey = 'role_id';

    protected $fillable = [
        'role_name',
    ];

    protected $casts = [
        'role_name' => RoleEnum::class,
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_role_jump', 'role_id', 'user_id');
    }
}
