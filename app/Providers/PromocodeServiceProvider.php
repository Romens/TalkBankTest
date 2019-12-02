<?php

namespace App\Providers;

use App\Services\PromocodeService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class PromocodeServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(PromocodeService::class, function() {
            return new PromocodeService(
                config('app.promocodes_alphabet'),
                config('app.max_promocodes_length')
            );
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            PromocodeService::class
        ];
    }

}
