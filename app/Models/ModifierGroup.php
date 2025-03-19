<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModifierGroup extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get all of the modifiers for the ModifierGroup
     */
    public function modifiers(): BelongsToMany
    {
        return $this->belongsToMany(Modifier::class,'modifier_modifier_group_mapper', 'id', 'id')->withTimestamps();
    }

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'created_at',
        'id'
    ];

    protected $fillable = [
        'name',
        'description',
    ];
}
