<?php

namespace Http\Factory\Slim;

use Interop\Http\Factory\ServerRequestFactoryInterface;
use Psr\Http\Message\UriInterface;
use Slim\Http\FactoryDefault;

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

    public function createServerRequest(array $server, $method = null, $uri = null)
    {
        if (null !== $method) {
            $server['REQUEST_METHOD'] = $method;
        }

        if (!isset($server['REQUEST_METHOD'])) {
            throw new \InvalidArgumentException('Cannot determine HTTP method');
        }

        // Prevent the factory from reading the global POST
        $post = $_POST;
        $_POST = [];

        $request = $this->factoryDefault->makeRequest($server);

        // Restore POST
        $_POST = $post;
        unset($post);

        if (null !== $uri) {
            if (is_string($uri)) {
                $uri = (new UriFactory)->createUri($uri);

            } elseif (!$uri instanceof UriInterface) {
                throw new \InvalidArgumentException('URI must be a valid URI string or an instanceof '.UriInterface::class);
            }

            $request = $request->withUri($uri);
        }

        return $request;
    }
}
