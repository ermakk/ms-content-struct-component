<?php

declare(strict_types=1);

namespace Ermakk\CSComponent\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

final class CSComponentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . DIRECTORY_SEPARATOR.'..'. DIRECTORY_SEPARATOR.'..'. DIRECTORY_SEPARATOR.'resources'. DIRECTORY_SEPARATOR.'views', 'moonshine-cs-component');

        Blade::componentNamespace('Ermakk\CSComponent\Components', 'moonshine-cs-component');

        $this->publishes([
            __DIR__ . DIRECTORY_SEPARATOR.'..'. DIRECTORY_SEPARATOR.'..'. DIRECTORY_SEPARATOR.'resources'. DIRECTORY_SEPARATOR.'views'
            => public_path('..'. DIRECTORY_SEPARATOR.'resources'. DIRECTORY_SEPARATOR.'views'. DIRECTORY_SEPARATOR.'vendor'. DIRECTORY_SEPARATOR.'moonshine-cs-component'),
        ], ['moonshine-cs-component', 'laravel-assets']);
    }
}
