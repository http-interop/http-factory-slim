<?php

namespace Http\Factory\Slim;

use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use Slim\Http\Headers;
use Slim\Http\Request;

class RequestFactory implements RequestFactoryInterface
{
    public function createRequest(string $method, $uri): RequestInterface
    {
        if (is_string($uri)) {
            $uri = (new UriFactory)->createUri($uri);

        } elseif (!$uri instanceof UriInterface) {
            throw new \InvalidArgumentException('URI must be a valid URI string or an instanceof '.UriInterface::class);
        }

        $headers = new Headers();
        $body = (new StreamFactory())->createStream('');

        return new Request($method, $uri, $headers, [], [], $body, []);
    }
}
