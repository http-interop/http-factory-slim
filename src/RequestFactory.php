<?php

namespace Http\Factory\Slim;

use Interop\Http\Factory\RequestFactoryInterface;
use Interop\Http\Factory\ServerRequestFactoryInterface;
use Interop\Http\Factory\ServerRequestFromGlobalsFactoryInterface;
use Slim\Http\Environment;
use Slim\Http\Headers;
use Slim\Http\Request;
use Slim\Http\Uri;

class RequestFactory implements RequestFactoryInterface , ServerRequestFactoryInterface, ServerRequestFromGlobalsFactoryInterface
{
    public function createRequest($method, $uri)
    {
        return $this->createServerRequest($method, $uri);
    }

    public function createServerRequest($method, $uri)
    {
        if (is_string($uri)) {
            $uri = Uri::createFromString($uri);
        }
        $headers = new Headers();
        $body = (new StreamFactory())->createStream('');

        return new Request($method, $uri, $headers, [], [], $body, []);
    }

    public function createServerRequestFromGlobals()
    {
        return Request::createFromEnvironment(new Environment($_SERVER));
    }
}
