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

    public static function booted()
    {
        self::creating(function (Review $review) {
            if (is_null($review->description)) {
                $review->description = '';
            }
        });
    }

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
