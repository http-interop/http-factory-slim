<?php

namespace Http\Factory\Slim;

use Interop\Http\Factory\ResponseFactoryInterface;
use Slim\Http\Response;

class ResponseFactory implements ResponseFactoryInterface
{
    public function createResponse($code = 200)
    {
        return new Response($code);
    }
}
