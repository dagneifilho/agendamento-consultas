<?php

namespace App\Providers;

use App\Interfaces\EspecialidadesServiceInterface;
use App\Interfaces\PacientesServiceInterface;
use App\Services\EspecialidadesService;
use App\Services\PacientesService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped(EspecialidadesServiceInterface::class, EspecialidadesService::class);
        $this->app->scoped(PacientesServiceInterface::class, PacientesService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
