<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ItemCategory;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get the category that owns the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category($id): BelongsTo
    {
        return $this->belongsTo(ItemCategory::class, 'category_id', $id);
    }

}
