<?php
namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

class TrailingSlashMiddleware
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $overflowingSlashRegex = '~\/{2,}~';
        $trailingSlashRegex = '~\/+$~';
        $path = $request->getUri()->getPath();

        // Make sure that we only redirect when invalid paths are detected
        preg_match($overflowingSlashRegex, $path, $overFlowMatches);
        preg_match($trailingSlashRegex, $path, $trailingSlashMatches);

        if(count($overFlowMatches) <= 0 && count($overFlowMatches) <= 0)
            return $handler->handle($request);

        // Fix the url and redirect
        $fixedPath = preg_replace($overflowingSlashRegex, '/', $path);
        $fixedPath = preg_replace($trailingSlashRegex, '', $fixedPath);

        $response = new Response(301);
        return $response->withHeader('Location', $fixedPath);
    }
}
