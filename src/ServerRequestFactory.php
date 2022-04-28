<?php

namespace Http\Factory\Slim;

use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Slim\Psr7\Headers;
use Slim\Psr7\Request;

class ServerRequestFactory implements ServerRequestFactoryInterface
{
    public function createServerRequest(string $method, $uri, array $serverParams = []): ServerRequestInterface
    {
        if (!$uri instanceof UriInterface) {
            $uri = (new UriFactory())->createUri($uri);
        }

        $headers = new Headers([]);
        $cookies = [];
        $body = (new StreamFactory())->createStream();

        return new Request($method, $uri, $headers, $cookies, $serverParams, $body);
    }
}
