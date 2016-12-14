<?php

namespace Http\Factory\Slim;

use Interop\Http\Factory\UploadedFileFactoryInterface;
use Slim\Http\UploadedFile;

class UploadedFileFactory implements UploadedFileFactoryInterface
{
    public function createUploadedFile(
        $file,
        $size = null,
        $error = \UPLOAD_ERR_OK,
        $clientFilename = null,
        $clientMediaType = null
    ) {
        if ($size === null) {
            if (is_string($file)) {
                $size = filesize($file);
            } else {
                $stats = fstat($file);
                $size = $stats['size'];
            }
        }

        if (is_resource($file)) {
            $meta = stream_get_meta_data($file);
            $file = $meta['uri'];
        }

        return new UploadedFile($file, $clientFilename, $clientMediaType, $size, $error);
    }
}
