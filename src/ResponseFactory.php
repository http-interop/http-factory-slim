<?php

namespace Http\Factory\Slim;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;

class ResponseFactory implements ResponseFactoryInterface
{
    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
    {
        return (new Response())
            ->withStatus($code, $reasonPhrase);
    }
}
