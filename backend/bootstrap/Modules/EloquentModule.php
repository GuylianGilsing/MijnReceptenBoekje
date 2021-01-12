<?php
namespace Bootstrap\Modules;

use DI\Container;
use Storage\Bootstrap\Module\ModuleInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container as LaravelContainer;

class EloquentModule implements ModuleInterface
{
    public function run(Container $container): void
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver'    => $container->get('database.driver'),
            'host'      => $container->get('database.host'),
            'database'  => $container->get('database.name'),
            'username'  => $container->get('database.username'),
            'password'  => $container->get('database.password'),
            'charset'   => $container->get('database.charset'),
            'collation' => $container->get('database.collation'),
            'prefix'    => $container->get('database.prefix'),
        ]);

        // Set the event dispatcher used by Eloquent models
        $capsule->setEventDispatcher(new Dispatcher(new LaravelContainer));

        // Make this Capsule instance available globally via static methods
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM
        $capsule->bootEloquent();
    }
}
