<?php

namespace Http\Factory\Slim;

use Interop\Http\Factory\StreamFactoryInterface;
use Slim\Http\Stream;

class StreamFactory implements StreamFactoryInterface
{
    public function createStream($content)
    {
        if (is_resource($content)) {
            $resource = $content;
        } else {
            $resource = fopen('php://temp', 'r+');
            fwrite($resource, $content);
        }

        return new Stream($resource);
    }
}
