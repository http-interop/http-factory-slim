<?php

namespace Http\Factory\Slim;

use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;
use Slim\Http\UploadedFile;

class UploadedFileFactory implements UploadedFileFactoryInterface
{
    public function createUploadedFile(
        StreamInterface $stream,
        int $size = null,
        int $error = \UPLOAD_ERR_OK,
        string $clientFilename = null,
        string $clientMediaType = null
    ): UploadedFileInterface {
        if ($size === null) {
            $size = $stream->getSize();
        }

        $meta = $stream->getMetadata();
        $file = $meta['uri'];

        if ($file === 'php://temp') {
            // Slim needs an actual path to the file
            $file = tempnam(sys_get_temp_dir(), 'factory-test');
            file_put_contents($file, $stream->getContents());
        }

        return new UploadedFile($file, $clientFilename, $clientMediaType, $size, $error);
    }
}
