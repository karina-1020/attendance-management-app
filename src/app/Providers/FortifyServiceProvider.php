<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Actions\Fortify\CreateNewUser;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LogoutResponse;

class FortifyServiceProvider extends ServiceProvider{

public function boot()
{
    Fortify::createUsersUsing(CreateNewUser::class);
    Fortify::loginView(function () {
        return view('login');
    });
    Fortify::registerView(function () {
        return view('register');
    });
    // :white_check_mark: 追加：ログアウト後の遷移先を固定
    $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
        public function toResponse($request)
        {
            return redirect('/login');
        }
    });
}
}