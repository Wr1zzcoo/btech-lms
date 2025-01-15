<?php

namespace App\Filament\User\Resources\BorrowTransactionResource\Pages;

use App\Filament\User\Resources\BorrowTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBorrowTransaction extends ViewRecord
{
    protected static string $resource = BorrowTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }
}
