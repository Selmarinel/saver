<?php

namespace Saver\Services\Upload;

use Saver\Objects\ObjectInterface;
use Saver\Services\Files\FileInterface;
use Saver\Services\System\SystemInterface;

abstract class AbstractUploadService
{
    public function __construct(FileInterface $file){
        $this->fileObject = $file;
    }

    protected static $mime = [
        'image/png' => 'png',
        'image/jpeg' => 'jpg',
        'image/gif' => 'gif'
    ];

    protected function checkMimeType($mime)
    {
        if (!in_array($mime, array_keys(self::$mime))) {
            return false;
        }
        return true;

    }

    /**
     * @var ObjectInterface
     */
    protected $uploaderObject;
    /**
     * @var FileInterface
     */
    protected $fileObject;
    /**
     * @var SystemInterface
     */
    protected $fileSystem;
}