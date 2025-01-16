<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Auth\Login;
use Filament\Pages\Page;

class UserLoginPage extends Login
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.user.pages.user-login-page';

    protected static string $routePath = '/login';
}
