<?php

namespace Http\Factory\Slim;

use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use Slim\Psr7\Uri;

class UriFactory implements UriFactoryInterface
{
    public function createUri(string $uri = ''): UriInterface
    {
        if (!is_string($uri)) {
            throw new \InvalidArgumentException(sprintf(
                'URI passed to constructor must be a string; received "%s"',
                (is_object($uri) ? get_class($uri) : gettype($uri))
            ));
        }

        $parts = parse_url($uri);

        if (false === $parts) {
            throw new \InvalidArgumentException(
                'The source URI string appears to be malformed'
            );
        }

        return new Uri(
            isset($parts['scheme']) ? $parts['scheme'] : '',
            isset($parts['host']) ? $parts['host'] : '',
            isset($parts['port']) ? $parts['port'] : null,
            isset($parts['path']) ? $parts['path'] : '',
            isset($parts['query']) ? $parts['query'] : '',
            isset($parts['fragment']) ? $parts['fragment'] : '',
            isset($parts['user']) ? $parts['user'] : '',
            isset($parts['pass']) ? $parts['pass'] : ''
        );
    }
}
