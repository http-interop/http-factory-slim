<?php

namespace Http\Factory\Slim;

use Interop\Http\Factory\UriFactoryInterface;
use Slim\Http\Uri;

class UriFactory implements UriFactoryInterface
{
    public function createUri($uri = '')
    {
        return Uri::createFromString($uri);
    }
}
