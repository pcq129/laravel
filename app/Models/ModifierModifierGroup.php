<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModifierModifierGroup extends Model
{
    use HasFactory, SoftDeletes;
   public $incrementing = true;
   public $table = "modifier_modifier_group";
}
