<?php
namespace App\Filament\User\Resources\BorrowTransactionResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\User\Resources\BorrowTransactionResource;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = BorrowTransactionResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    public function handler(Request $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}