<?php

namespace App\Filament\Resources\BorrowTransactionResource\Pages;

use App\Enums\BorrowTransactionStatus;
use App\Filament\Resources\BorrowTransactionResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewBorrowTransaction extends ViewRecord
{
    protected static string $resource = BorrowTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
            Action::make('acceptBorrow')
                ->label('Accept')
                ->requiresConfirmation()
                ->color('success')
                ->visible(function () {
                    $status = $this->getRecord()->status;
                    return $status == BorrowTransactionStatus::REQUESTED || $status == BorrowTransactionStatus::WAITING;
                })
                ->action(function () {
                    $this->getRecord()->update([
                        'status' => BorrowTransactionStatus::ACCEPTED
                    ]);
                }),
            Action::make('rejectBorrow')
                ->label('Reject')
                ->requiresConfirmation()
                ->color('danger')
                ->visible(function () {
                    $status = $this->getRecord()->status;
                    return $status == BorrowTransactionStatus::REQUESTED || $status == BorrowTransactionStatus::WAITING;
                })
                ->action(function () {
                    $this->getRecord()->update([
                        'status' => BorrowTransactionStatus::REJECTED
                    ]);
                }),

            Action::make('waitBorrow')
                ->label('Wait')
                ->requiresConfirmation()
                ->color('warning')
                ->visible(function () {
                    $status = $this->getRecord()->status;
                    return $status == BorrowTransactionStatus::REQUESTED;
                })
                ->action(function () {
                    $this->getRecord()->update([
                        'status' => BorrowTransactionStatus::WAITING
                    ]);
                }),

            Action::make('returnBorrow')
                ->label('Return')
                ->requiresConfirmation()
                ->color('success')
                ->visible(function () {
                    $status = $this->getRecord()->status;
                    return $status == BorrowTransactionStatus::ACCEPTED;
                })
                ->action(function () {
                    $this->getRecord()->update([
                        'status' => BorrowTransactionStatus::RETURNED
                    ]);
                }),
        ];
    }
}
