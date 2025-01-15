<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Review extends Model
{
    // 1 to 5 star review
    protected $fillable = [
        'stars',
        'user_id',
        'title',
        'description',
        'reviewable_id',
        'reviewable_type'
    ];

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }
}
