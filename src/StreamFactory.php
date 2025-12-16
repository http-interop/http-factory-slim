<?php

namespace Http\Factory\Slim;

use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Slim\Http\Stream;

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
        } catch (\Throwable $e) {
            throw new \RuntimeException(
                sprintf(
                    'Unable to open "%s" using mode "%s": "%s',
                    $file,
                    $mode,
                    $e->getMessage(),
                ),
                0,
                $e,
            );
        }

        return $this->createStreamFromResource($resource);
    }

    public function createStreamFromResource($resource): StreamInterface
    {
        return new Stream($resource);
    }
}
