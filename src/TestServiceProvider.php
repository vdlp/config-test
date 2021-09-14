<?php

namespace Vdlp\ConfigTest;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath($raw = __DIR__.'/../config/test.php') ?: $raw;

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('test.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('test');
        }

        $this->mergeConfigFrom($source, 'test');
    }
}
