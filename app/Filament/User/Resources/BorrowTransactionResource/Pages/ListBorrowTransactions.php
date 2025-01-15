<?php

namespace App\Filament\User\Resources\BorrowTransactionResource\Pages;

use App\Filament\User\Resources\BorrowTransactionResource;
use Filament\Actions;
use Filament\Http\Middleware\Authenticate;
use Filament\Panel;
use Filament\Resources\Pages\ListRecords;

class ListBorrowTransactions extends ListRecords
{
    protected static string $resource = BorrowTransactionResource::class;

    public static function getRouteMiddleware(Panel $panel): string | array
    {

        return [
            ...parent::getRouteMiddleware($panel),
            Authenticate::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
