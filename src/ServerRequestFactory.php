<?php

namespace Http\Factory\Slim;

use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Slim\Http\FactoryDefault;
use Slim\Http\Headers;
use Slim\Http\Request as ServerRequest;

class ServerRequestFactory implements ServerRequestFactoryInterface
{
    /**
     * @var FactoryDefault
     */
    private $factoryDefault;

    public function __construct()
    {
        $this->factoryDefault = new FactoryDefault();
    }

    public function createServerRequest(string $method, $uri, array $serverParams = []): ServerRequestInterface
    {
        if (!$uri instanceof UriInterface) {
            $uri = (new UriFactory())->createUri($uri);
        }

        $headers = new Headers([]);
        $cookies = [];
        $body = (new StreamFactory())->createStream();

        return new ServerRequest($method, $uri, $headers, $cookies, $serverParams, $body);
    }
}
