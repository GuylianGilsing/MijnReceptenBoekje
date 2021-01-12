<?php
namespace Bootstrap;

use App\Controllers\PageController;
use App\Middleware\TrailingSlashMiddleware;
use DI\Container;
use DI\ContainerBuilder;
use DI\Bridge\Slim\Bridge as SlimBridge;
use Storage\Bootstrap\Bootstrapper;
use Bootstrap\Modules\DotenvModule;
use Bootstrap\Modules\EloquentModule;
use Storage\Routing\Router;

// Create a dependency container
$containerBuilder = new ContainerBuilder;
$containerBuilder->useAnnotations(false);
$containerBuilder->useAutowiring(true);

$container = $containerBuilder->build();

// Create the app instance and set it as a dependency
$app = SlimBridge::create($container);
$container->set('app', $app);

// Bootstrap modules
$bootstrapper = new Bootstrapper;

$bootstrapper->registerModule(new DotenvModule);
$bootstrapper->registerModule(new EloquentModule);

$bootstrapper->bootstrap($container);

Router::registerSlimApp($app);
$app->add(TrailingSlashMiddleware::class);

$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(true, true, true);

require_once __DIR__.'/../routes/api.php';

Router::any('[{route: .*}]', [PageController::class, 'pageNotFound']);

$app->run();
