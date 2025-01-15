<?php

namespace App\Models;

use App\Traits\HasReviews;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Publisher extends Model
{

    use HasReviews;

    protected $fillable = [
        'name',
    ];

    // Relationships
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
