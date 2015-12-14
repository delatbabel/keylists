<?php
/**
 * Class EnumsServiceProvider
 *
 * @author Del
 */
namespace Incube8\Enums;

use Illuminate\Support\ServiceProvider;

/**
 * Class EnumsServiceProvider
 *
 * Service providers are the central place of all Laravel application bootstrapping.
 * Your own application, as well as all of Laravel's core services are bootstrapped
 * via service providers.
 *
 * <h4>Example</h4>
 *
 * <code>
 *   // Example code goes here
 * </code>
 *
 * @see  Illuminate\Support\ServiceProvider
 * @link http://laravel.com/docs/5.1/providers
 */
class EnumsServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations' => $this->app->databasePath() . '/migrations'
        ], 'migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'slack');
    }
}
