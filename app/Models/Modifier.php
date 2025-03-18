<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modifier extends Model
{
    use HasFactory, SoftDeletes;

    public function modifierGroups():BelongsToMany
    {
        return $this->belongsToMany(ModifierGroup::class, 'modifier_modifier_group_mapper', 'id','id')->withTimestamps();
    }

}
