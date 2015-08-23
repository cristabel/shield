<?php namespace Cristabel\Shield;

use Illuminate\Auth\AuthManager;
use Illuminate\Auth\EloquentUserProvider;

use Cristabel\Shield\ShieldGuard as Guard;

class ShieldManager extends AuthManager {

    protected function callCustomCreator($driver)
    {
        $custom = parent::callCustomCreator($driver);

        if( $custom instanceof Guard ) {
            return $custom;
        }

        return new Guard($custom, $this->app['session.store']);
    }

    public function createDatabaseDriver()
    {
        $provider = $this->createDatabaseProvider();

        return new Guard($provider, $this->app['session.store']);
    }

    protected function createDatabaseProvider()
    {
        $connection = $this->app['db']->connection();
        $table = $this->app['config']['cristabel.shield.table'];

        return new DatabaseUserProvider($connection, $this->app['hash'], $table);
    }

    public function createEloquentDriver()
    {
        $provider = $this->createEloquentProvider();

        return new Guard($provider, $this->app['session.store']);
    }

    protected function createEloquentProvider()
    {
        $model = $this->app['config']['cristabel.shield.model'];

        return new EloquentUserProvider($this->app['hash'], $model);
    }

    public function getDefaultDriver()
    {
        return $this->app['config']['cristabel.shield.driver'];
    }

    public function setDefaultDriver($name)
    {
        $this->app['config']['cristabel.shield.driver'] = $name;
    }

}
