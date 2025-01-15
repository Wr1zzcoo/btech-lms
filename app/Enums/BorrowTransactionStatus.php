<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum BorrowTransactionStatus: string implements HasLabel
{
    case REQUESTED = 'requested';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case WAITING = 'waiting';
    case RETURNED = 'returned';

    public function getLabel(): ?string
    {
        return ucfirst($this->value);
    }
}
