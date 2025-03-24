<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Modifier;

class ModifierGroup extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get all of the modifiers for the ModifierGroup
     */
    public function modifiers(): HasMany
    {
        return $this->hasMany(Modifier::class, 'modifier_group_id', 'id');
    }

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'name',
        'description',
    ];
}
