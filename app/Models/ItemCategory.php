<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemCategory extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * Get all of the item for the ItemCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function item($id): HasMany
    {
        return $this->hasMany(Item::class, 'category_id', $id);
    }
}
