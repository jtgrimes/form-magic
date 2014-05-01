<?php  namespace Jtgrimes\FormMagic;

use Illuminate\Support\ServiceProvider;

class FormMagicServiceProvider extends ServiceProvider{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('jtgrimes/form-magic');
        $this->app['form-magic'] = $this->app->share(function($app)
        {
            $config = $app['config'];
            $builder = $app['form'];
            $validator = $app['validation'];
            return new FormMagic($config,$builder,$validator);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('form-magic');
    }
} 