<?php

declare(strict_types=1);

namespace Ermakk\CSComponent\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

final class CSComponentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . DIRECTORY_SEPARATOR.'..'. DIRECTORY_SEPARATOR.'..'. DIRECTORY_SEPARATOR.'resources'. DIRECTORY_SEPARATOR.'views', 'ms-cs-component');

        Blade::componentNamespace('Ermakk\CSComponent\Components', 'ms-cs-component');

        $this->publishes([
            __DIR__ . DIRECTORY_SEPARATOR.'..'. DIRECTORY_SEPARATOR.'..'. DIRECTORY_SEPARATOR.'resources'. DIRECTORY_SEPARATOR.'views'
            => resource_path('views'. DIRECTORY_SEPARATOR.'vendor'. DIRECTORY_SEPARATOR.'ms-cs-component'),

            __DIR__ . DIRECTORY_SEPARATOR.'..'. DIRECTORY_SEPARATOR.'..'. DIRECTORY_SEPARATOR.'public'
            => public_path('vendor'. DIRECTORY_SEPARATOR.'ms-cs-component'),
        ], ['ms-cs-component', 'laravel-assets']);
    }
}
