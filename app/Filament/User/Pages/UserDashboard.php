<?php

namespace App\Filament\User\Pages;

use Filament\Http\Middleware\Authenticate;
use Filament\Pages\Page;
use Filament\Panel;

class UserDashboard extends Page
{
    protected static string $routePath = '/';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.user.pages.user-dashboard';

    public static function getRouteMiddleware(Panel $panel): string | array
    {

        return [
            ...parent::getRouteMiddleware($panel),
            Authenticate::class,
        ];
    }
}
