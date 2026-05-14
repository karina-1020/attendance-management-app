<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Actions\Fortify\CreateNewUser;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Contracts\LoginResponse;
use App\Actions\Fortify\LoginResponse as CustomLoginResponse;

class FortifyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        Fortify::loginView(function () {
            return view('login');
        });

        Fortify::registerView(function () {
            return view('register');
        });

        // ログアウト後
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/login');
            }
        });
    }
    public function register()
    {
    $this->app->singleton(
        \Laravel\Fortify\Contracts\LoginResponse::class,
        \App\Actions\Fortify\LoginResponse::class
    );
    }
}