<?php

namespace Http\Factory\Slim;

use PHPUnit\Framework\Error\Warning;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use RuntimeException;
use Slim\Psr7\Stream;
use ValueError;

class StreamFactory implements StreamFactoryInterface
{
    public function createStream(string $content = ''): StreamInterface
    {
        $resource = fopen('php://temp', 'r+');
        fwrite($resource, $content);
        rewind($resource);

        return $this->createStreamFromResource($resource);
    }

    public function createStreamFromFile(string $file, string $mode = 'r'): StreamInterface
    {
        try {
            $resource = fopen($file, $mode);

            return $this->createStreamFromResource($resource);
        } catch (ValueError|Warning $error) {
            throw new RuntimeException(previous: $error);
        }

    }

    public function createStreamFromResource($resource): StreamInterface
    {
        return new Stream($resource);
    }
}
