<?php

namespace Saver\Services\Upload;

use Saver\Services\Files\FileInterface;
use Saver\Objects\CurlObject;
use Saver\Exceptions\CurlUploadException;
use Saver\Services\System\WindowsSystem;

class CurlUploadService extends AbstractUploadService implements UploadServiceInterface
{
    public function __construct(FileInterface $file)
    {
        parent::__construct($file);
        $this->uploaderObject = new CurlObject();
    }

    protected function checkUrl($url)
    {
        $this->uploaderObject->get($url);
        if ($this->uploaderObject->error) {
            $this->uploaderObject->close();
            throw new CurlUploadException($this->uploaderObject->errorMessage);
        }
        return true;
    }

    protected function checkMime()
    {
        if ($this->checkMimeType($this->uploaderObject->getMime())) {
            $this->fileObject->setMimeType(self::$mime[$this->uploaderObject->getMime()]);
            return true;
        }
        $this->uploaderObject->close();
        return false;
    }

    public function saveFile($url, $path = null, $name = null)
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

    public function uploadFileFromUrl($url, $path = null, $name = null)
    {
        if ($this->checkUrl($url) && $this->checkMime()) {
            $this->saveFile($url, $path, $name);
        }
    }

}