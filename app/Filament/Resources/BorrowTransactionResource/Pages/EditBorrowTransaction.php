<?php

namespace App\Filament\Resources\BorrowTransactionResource\Pages;

use App\Filament\Resources\BorrowTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBorrowTransaction extends EditRecord
{
    protected static string $resource = BorrowTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
