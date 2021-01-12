<?php
namespace App\Controllers;

use DI\Container;
use Psr\Http\Message\ResponseInterface;

class PageController extends BaseController
{
    public function __construct(Container $container)
    {
        
    }

    public function homePage(ResponseInterface $response) : ResponseInterface
    {
        $responsePayload = [
            'message' => "Hello World!"
        ];

        return $this->formattedJsonResponse($responsePayload, 200);
    }

    public function pageNotFound(ResponseInterface $response) : ResponseInterface
    {
        $responsePayload = [
            'message' => "404, page not found."
        ];

        return $this->formattedJsonResponse($responsePayload, 404);
    }
}
