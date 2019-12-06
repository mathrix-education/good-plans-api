<?php

namespace App\Providers;

use App\Console\Kernel;
use App\Exceptions\Handler;
use Barryvdh\Cors\HandleCors;
use Illuminate\Contracts\Console\Kernel as KernelContract;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application;
use Mathrix\Lumen\Zero\Providers\ObserverServiceProvider;
use Mathrix\Lumen\Zero\Providers\PolicyServiceProvider;
use Mathrix\Lumen\Zero\Providers\RegistrarServiceProvider;

/**
 * @property Application $app
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(ExceptionHandler::class, Handler::class);
        $this->app->singleton(KernelContract::class, Kernel::class);

        $this->app->middleware([HandleCors::class]);

        // Mathrix Lumen Zero Providers
        $this->app->register(ObserverServiceProvider::class);
        $this->app->register(PolicyServiceProvider::class);
        $this->app->register(RegistrarServiceProvider::class);
    }
}
