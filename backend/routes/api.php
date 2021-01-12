<?php
namespace Routes;

use App\Controllers\PageController;
use Slim\Routing\RouteCollectorProxy;
use Storage\Routing\Router;

Router::group('/api', function(RouteCollectorProxy $group){
    $group->get('', [PageController::class, 'homePage']);
});
