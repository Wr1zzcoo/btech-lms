<?php

namespace App\Filament\User\Resources\PublisherResource\Pages;

use App\Filament\User\Resources\PublisherResource;
use App\Models\Review;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use IbrahimBougaoua\FilamentRatingStar\Forms\Components\RatingStar;
use Illuminate\Support\Facades\Auth;

class ViewPublisher extends ViewRecord
{
    protected static string $resource = PublisherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('review')
                ->color('success')
                ->form([
                    Section::make()
                        ->schema([
                            RatingStar::make('stars')
                                ->required()
                                ->label('Rating'),
                            TextInput::make('title')
                                ->required(),
                            Textarea::make('description')
                                ->default(''),
                        ]),
                ])->action(function (array $data) {
                    Review::create([
                        ...$data,
                        'user_id' => Auth::id(),
                        'reviewable_id' => $this->getRecord()->id,
                        'reviewable_type' => $this->getModel(),
                    ]);
                    Notification::make()
                        ->title('Review created successfully')
                        ->color('success')
                        ->send();
                })
        ];
    }
}
