<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Item;

class ItemCategory extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * Get all of the item for the ItemCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function item():HasMany
    {
        return $this->hasMany(Item::class, 'category_id', 'id');
    }

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'created_at',
    ];


}
