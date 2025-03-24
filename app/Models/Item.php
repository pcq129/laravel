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
    public function Category(): BelongsTo
    {
        return $this->belongsTo(ItemCategory::class, 'category_id', 'id');
    }

    // public function onlyCategoryName(): BelongsTo
    // {
    //     $category =  $this->belongsTo(ItemCategory::class, 'category_id', 'id');
    //     dd($category);
    //     return $category->name;
    // }

    // public function addCategory($id): HasOne
    // {
    //     return $this->hasOne(ItemCategory::class, 'category_id', $id);
    // }

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'created_at',
    ];

}
