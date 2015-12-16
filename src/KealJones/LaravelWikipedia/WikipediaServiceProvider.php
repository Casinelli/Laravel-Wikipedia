<?php
/**
 * Class and Function List:
 * Function list:
 * - boot()
 * - register()
 * - provides()
 * Classes list:
 * - WikipediaServiceProvider extends ServiceProvider
 */
namespace KealJones\LaravelWikipedia;

use Illuminate\Support\ServiceProvider;

class WikipediaServiceProvider extends ServiceProvider
{
    
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    
    public function boot()
    {
        
        //
        
        
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        
        //
        
        
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
