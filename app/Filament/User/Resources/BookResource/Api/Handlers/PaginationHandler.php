<?php

namespace App\Filament\User\Resources\BookResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filament\User\Resources\BookResource;
use App\Http\Resources\BookResource as ResourcesBookResource;
use Knuckles\Scribe\Attributes\Endpoint;

#[Endpoint("All Books", "Get all books")]
class PaginationHandler extends Handlers
{
    public static string | null $uri = '/';
    public static string | null $resource = BookResource::class;

    public static bool $public = true;

    public function handler()
    {
        $query = static::getEloquentQuery()
            ->with([
                'publisher',
                'authors'
            ]);
        $model = static::getModel();

        $query = QueryBuilder::for($query)
            ->allowedFields($this->getAllowedFields() ?? [])
            ->allowedSorts($this->getAllowedSorts() ?? [])
            ->allowedFilters($this->getAllowedFilters() ?? [])
            ->allowedIncludes($this->getAllowedIncludes() ?? [])
            ->paginate(request()->query('per_page'))
            ->appends(request()->query());

        return ResourcesBookResource::collection($query);
    }
}
