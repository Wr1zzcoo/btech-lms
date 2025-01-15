<?php

namespace App\Filament\User\Resources\BookResource\Pages;

use App\Filament\User\Resources\BookResource;
use App\Models\BorrowTransaction;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Http\Middleware\Authenticate;
use Filament\Notifications\Notification;
use Filament\Panel;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Auth;

class ViewBook extends ViewRecord
{
    protected static string $resource = BookResource::class;

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
            // Actions\EditAction::make(),
            Action::make('borrow')
                ->hidden(function () {
                    return is_null(Auth::user());
                })
                ->requiresConfirmation()
                ->action(function () {
                    $book = $this->getRecord();
                    $user = Auth::user();

                    BorrowTransaction::create([
                        'user_id' => $user->id,
                        'book_id' => $book->id,
                    ]);

                    Notification::make()
                        ->title('Borrow requested successfully.')
                        ->success()
                        ->send();
                })
        ];
    }
}
