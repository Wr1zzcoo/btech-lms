<?php

namespace App\Filament\User\Resources\AuthorResource\Pages;

use App\Filament\User\Resources\AuthorResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAuthor extends ViewRecord
{
    protected static string $resource = AuthorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }
}
