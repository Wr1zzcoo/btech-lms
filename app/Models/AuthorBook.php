<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AuthorBook extends Pivot
{
    protected $fillable = [
        'author_id',
        'book_id',
        'order'
    ];
}
