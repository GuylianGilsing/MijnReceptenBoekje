<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;

class BaseController
{
    protected function formattedJsonResponse(array $payload, int $status) : ResponseInterface
    {
        $response = new Response($status);
        
        $responsePayload = ['status' => $status];
        $responsePayload += $payload;
        $responsePayload['time'] = time();

        $responsePayload = json_encode($responsePayload);

        $response->getBody()->write($responsePayload);
        return $response->withHeader('Content-Type', 'application/json')
                        ->withStatus(404);
    }
}
