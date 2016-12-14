<?php

namespace Http\Factory\Slim;

use Interop\Http\Factory\RequestFactoryInterface;
use Psr\Http\Message\UriInterface;
use Slim\Http\Headers;
use Slim\Http\Request;

class RequestFactory implements RequestFactoryInterface
{
    public function createRequest($method, $uri)
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
