<?php

namespace App\Providers;

use App\Services\Interfaces\ItemServiceInterface;
use App\Services\ItemService;
use Illuminate\Support\ServiceProvider;

class ItemServiceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ItemServiceInterface::class,
            ItemService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
