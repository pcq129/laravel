<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Modifier;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class ModifierGroup extends Model
{
    use HasFactory, SoftDeletes;

    public function modifiers(): BelongsToMany
    {
        return $this->belongsToMany(Modifier::class, 'modifier_modifier_group', 'modifier_group_id', 'modifier_id');
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
