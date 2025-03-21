<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        '',
    ];

    //
    // get tax associated to order
    //

    public function tax(): BelongsToMany
    {
        return $this->belongsToMany(Tax::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
