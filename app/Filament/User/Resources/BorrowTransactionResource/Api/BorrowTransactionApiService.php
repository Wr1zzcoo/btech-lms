<?php
namespace App\Filament\User\Resources\BorrowTransactionResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\User\Resources\BorrowTransactionResource;
use Illuminate\Routing\Router;


class BorrowTransactionApiService extends ApiService
{
    protected static string | null $resource = BorrowTransactionResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
