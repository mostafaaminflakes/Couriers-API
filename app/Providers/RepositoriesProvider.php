<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CourierGateway;
use App\Repositories\DhlRepository;
use App\Repositories\SmsaRepository;
use App\Repositories\AramexRepository;
use App\Repositories\ShipboxRepository;
use App\Repositories\UpsRepository;

class RepositoriesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CourierGateway::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register couriers within the service provider
        $this->app->make(CourierGateway::class)->register("smsa", new SmsaRepository());
        $this->app->make(CourierGateway::class)->register("dhl", new DhlRepository());
        $this->app->make(CourierGateway::class)->register("aramex", new AramexRepository());
        $this->app->make(CourierGateway::class)->register("shipbox", new ShipboxRepository());
        $this->app->make(CourierGateway::class)->register("ups", new UpsRepository());
    }
}
