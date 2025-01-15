<?php

namespace App\Filament\User\Resources\PublisherResource\Pages;

use App\Filament\User\Resources\PublisherResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPublishers extends ListRecords
{
    protected static string $resource = PublisherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
