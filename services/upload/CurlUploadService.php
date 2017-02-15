<?php

namespace Saver\Services\Upload;

use Saver\Objects\ObjectInterface;
use Saver\Services\Files\FileInterface;
use Saver\Objects\CurlObject;
use Saver\Exceptions\CurlUploadException;
use Saver\Services\System\SystemInterface;
use Saver\Services\System\WindowsSystem;

class CurlUploadService implements UploadServiceInterface
{

    private static $mime = [
        'image/png' => 'png',
        'image/jpeg' => 'jpg',
        'image/gif' => 'gif'
    ];
    /**
     * @var ObjectInterface
     */
    private $uploaderObject;
    /**
     * @var FileInterface
     */
    private $fileObject;
    /**
     * @var SystemInterface
     */
    private $fileSystem;

    public function __construct(FileInterface $file)
    {
        $this->fileObject = $file;
        $this->uploaderObject = new CurlObject();
    }

    public function uploadFileFromUrl($url, $path = null, $name = null)
    {
        if ($this->checkUrl($url) && $this->checkMime()) {
            $this->saveFile($url, $path, $name);
        }
    }

    private function checkUrl($url)
    {
        $this->uploaderObject->get($url);
        if ($this->uploaderObject->getError()) {
            $this->uploaderObject->close();
            throw new CurlUploadException($this->uploaderObject->getMessage());
        }
        return true;
    }

    private function checkMime()
    {
        if ($this->checkMimeType($this->uploaderObject->getMime())) {
            $this->fileObject->setMimeType(self::$mime[$this->uploaderObject->getMime()]);
            return true;
        }
        $this->uploaderObject->close();
        return false;
    }

    private function checkMimeType($mime)
    {
        if (!in_array($mime, array_keys(self::$mime))) {
            return false;
        }
        return true;

    }

    private function saveFile($url, $path = null, $name = null)
    {
        try {
            /**
             * hack
             */
            $this->fileSystem = new WindowsSystem();
            /***************************************/

            $this->fileObject->setFileName($name);
            $this->fileObject->init($path);

            $this->uploaderObject->setOpts([
                CURLOPT_URL => $url,
                CURLOPT_FILE => $this->fileObject->getFileHandler(),
                CURLOPT_REFERER => $url,
                CURLOPT_AUTOREFERER => 1,
                CURLOPT_HEADER => false,
                CURLOPT_NOBODY => false,
            ]);
            $this->uploaderObject->exec();
            $this->uploaderObject->close();
        } catch (CurlUploadException $exception) {
            throw $exception;
        }
    }

}