<?php


namespace puresoft\jibimo\laravel;


use Illuminate\Support\ServiceProvider;

class JibimoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/jibimo.php' => config_path('jibimo.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('puresoft\jibimo\laravel\Jibimo', function () {
            return new Jibimo;
        });
    }
}