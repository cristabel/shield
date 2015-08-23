<?php namespace Cristabel\Shield\Providers;

use Illuminate\Auth\AuthServiceProvider;
use Illuminate\Foundation\AliasLoader;

use Cristabel\Shield\ShieldManager;

use View;

class ShieldServiceProvider extends AuthServiceProvider {

    public function register()
    {
        $this->app->alias('shieldauth',        'Cristabel\Shield\ShieldManager');
        $this->app->alias('shieldauth.driver', 'Cristabel\Shield\ShieldGuard');
        $this->app->alias('shieldauth.driver', 'Cristabel\Shield\Contracts\ShieldGuard');

        $this->registerViews();
        $this->registerFacades();

        parent::register();
    }

    public function boot()
    {
        $this->exportConfig();
        $this->exportMigrations();
        $this->exportSeeds();

        $this->publishRoutes();
        $this->registerComposers();
    }

    protected function registerAuthenticator()
    {
        $this->app->singleton('shieldauth', function ($app) {
            $app['shieldauth.loaded'] = true;

            return new ShieldManager($app);
        });

        $this->app->singleton('shieldauth.driver', function ($app) {
            return $app['shieldauth']->driver();
        });
    }

    protected function registerUserResolver()
    {
        $this->app->bind('Illuminate\Contracts\Auth\Authenticatable', function ($app) {
            return $app['shieldauth']->user();
        });
    }

    protected function registerRequestRebindHandler()
    {
        $this->app->rebinding('request', function ($app, $request) {
            $request->setUserResolver(function() use ($app) {
                return $app['shieldauth']->user();
            });
        });
    }

    protected function exportConfig()
    {
        $this->publishes([__DIR__.'/../Config' => base_path('config/cristabel')]);
    }

    protected function exportMigrations()
    {
        $this->publishes([__DIR__.'/../Database/migrations' => base_path('database/migrations')]);
    }

    protected function exportSeeds()
    {
        $this->publishes([__DIR__.'/../Database/seeds' => base_path('database/seeds')]);
    }

    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'shield');
    }

    protected function publishRoutes()
    {
        include(__DIR__.'/../Http/routes.php');
    }

    protected function registerComposers()
    {
        View::composers([
            'Cristabel\Shield\Http\ViewComposers\LayoutComposer' => 'shield::*',
            'Cristabel\Shield\Http\ViewComposers\UserAdministratorComposer' => 'shield::profile',
        ]);
    }

    protected function registerFacades()
    {
        AliasLoader::getInstance()->alias('ShieldAuth', 'Cristabel\Shield\Facades\ShieldAuth');
    }
}
