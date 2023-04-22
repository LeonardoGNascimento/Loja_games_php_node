<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(function ($router) {
                require base_path('app/src/Jogos/Routes/Jogos.php');
                require base_path('app/src/Jogos/Routes/Genero.php');
                require base_path('app/src/Produtora/Routes/Produtora.php');
                require base_path('app/src/Usuario/Routes/Usuario.php');
                require base_path('app/src/Venda/Routes/Venda.php');
            });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}