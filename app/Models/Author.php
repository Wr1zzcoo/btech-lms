<?php

namespace App\Models;

use App\Traits\HasReviews;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasReviews;

    protected $fillable = [
        'name',
        'email',
    ];

    // Relationships

    public function books()
    {
        return $this->belongsToMany(Book::class)
            ->using(AuthorBook::class)
            ->withPivot([
                'order'
            ])->orderBy('order', 'asc');
    }
}
