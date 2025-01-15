<?php

namespace App\Models;

use App\Enums\BorrowTransactionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BorrowTransaction extends Model
{
    protected $fillable = [
        // Borrower
        'user_id',
        'book_id',
        'borrowed_at',
        'return_by',
        'returned_at',

        // Admin details
        'status',
        'accepted_by_id',
        'accepted_at',

        'return_received_id'
    ];

    protected function casts()
    {
        return [
            'borrowed_at' => 'datetime',
            'return_by' => 'datetime',
            'returned_at' => 'datetime',
            'status' => BorrowTransactionStatus::class,
            'accepted_at' => 'datetime',
        ];
    }

    // Booted

    public static function booted()
    {
        self::creating(function (BorrowTransaction $transaction) {
            $transaction->status = BorrowTransactionStatus::REQUESTED;
        });

        self::saving(function (BorrowTransaction $transaction) {
            if (
                is_null($transaction->accepted_by_id)
                &&
                $transaction->status == BorrowTransactionStatus::ACCEPTED
            ) {
                $transaction->accepted_by_id = Auth::id();
                $transaction->accepted_at = now();
            }

            if (
                is_null($transaction->return_received_id)
                &&
                $transaction->status == BorrowTransactionStatus::RETURNED
            ) {
                $transaction->return_received_id = Auth::id();
                $transaction->returned_at = now();
            }
        });
    }

    // Relationships
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function acceptedBy()
    {
        return $this->belongsTo(User::class, 'accepted_by_id', 'id');
    }
}
