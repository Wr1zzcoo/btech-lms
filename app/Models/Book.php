<?php

namespace App\Models;

use App\Traits\HasReviews;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasReviews;
    protected $fillable = [
        'name',
        'quantity',
        'publisher_id',
        'available_quantity',
        'is_available'
    ];

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
        ];
    }

    // Booted

    public static function booted()
    {
        self::creating(function (Book $book) {
            $book->available_quantity = $book->quantity;
        });
    }

    // Relationships

    public function authors()
    {
        return $this->belongsToMany(Author::class)
            ->using(AuthorBook::class)
            ->withPivot([
                'order'
            ])->orderBy('order', 'asc');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function borrowTransactions()
    {
        return $this->hasMany(BorrowTransaction::class);
    }
}
