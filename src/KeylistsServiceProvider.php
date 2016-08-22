<?php
/**
 * Class KeylistsServiceProvider
 *
 * @author Del
 */
namespace Delatbabel\Keylists;

use Delatbabel\Keylists\Console\Commands\LoadExchangeRates;
use Delatbabel\Keylists\Console\Commands\LoadISO3166Countries;
use Delatbabel\Keylists\Console\Commands\LoadTimezones;
use Illuminate\Support\ServiceProvider;

/**
 * Class KeylistsServiceProvider
 *
 * Service providers are the central place of all Laravel application bootstrapping.
 * Your own application, as well as all of Laravel's core services are bootstrapped
 * via service providers.
 *
 * @see  Illuminate\Support\ServiceProvider
 * @link http://laravel.com/docs/5.1/providers
 */
class KeylistsServiceProvider extends ServiceProvider
{
    /** @var array list of commands to be registered in the service provider */
    protected $moreCommands = [
        LoadISO3166Countries::class,
        LoadTimezones::class,
        LoadExchangeRates::class,
    ];

    /**
     * Bootstrap the application events.
     *
     * This method is called after all other service providers have been registered,
     * meaning you have access to all other services that have been registered by
     * the framework.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path() . '/migrations'
        ], 'migrations');
        $this->publishes([
            __DIR__ . '/../config' => config_path()
        ], 'config');

        $this->commands($this->moreCommands);
    }

    /**
     * Register the service provider.
     *
     * Within the register method, you should only bind things into the service container.
     * You should never attempt to register any event listeners, routes, or any other piece
     * of functionality within the register method. Otherwise, you may accidentally use a
     * service that is provided by a service provider which has not loaded yet.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
