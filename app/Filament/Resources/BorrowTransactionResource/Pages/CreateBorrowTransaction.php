<?php

namespace App\Filament\Resources\BorrowTransactionResource\Pages;

use App\Filament\Resources\BorrowTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBorrowTransaction extends CreateRecord
{
    protected static string $resource = BorrowTransactionResource::class;
}
