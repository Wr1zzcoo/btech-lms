<?php
namespace App\Filament\User\Resources\PublisherResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\User\Resources\PublisherResource;
use Illuminate\Routing\Router;


class PublisherApiService extends ApiService
{
    protected static string | null $resource = PublisherResource::class;

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
