<?php

namespace App\Filament\User\Resources\BorrowTransactionResource\Pages;

use App\Filament\User\Resources\BorrowTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBorrowTransactions extends ListRecords
{
    protected static string $resource = BorrowTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
