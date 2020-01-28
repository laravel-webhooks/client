<?php

namespace LaravelWebhooks\Client;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMigrations();

        $this->registerPublishing();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Register the package migrations.
     *
     * @return void
     */
    protected function registerMigrations(): void
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(
                realpath(__DIR__.'/../database/migrations')
            );
        }
    }

    /**
     * Register the package publishable resources.
     *
     * @return void
     */
    protected function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                realpath(__DIR__.'/../database/migrations') => $this->app->databasePath('migrations'),
            ], 'laravel-webhooks:client.migrations');
        }
    }
}
