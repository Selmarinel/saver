<?php

namespace Saver\Services\Files;

class LocalFile implements FileInterface
{
    private $fileHandler;
    private $fileName;
    private $mime;
    private $path;

    public function getFileName()
    {
        if (!$this->fileName) {
            $this->fileName = $this->getDefaultName();
        }
        return $this->fileName;
    }

    public function setFileName($name)
    {
        $this->fileName = ($name) ?: $this->getDefaultName();
    }

    public function getMimeType()
    {
        return $this->mime;
    }

    public function setMimeType($mime)
    {
        $this->mime = $mime;
    }

    public function getFullPath()
    {
        return $this->path . DIRECTORY_SEPARATOR . $this->getFileName() . "." . $this->getMimeType();
    }

    public function init($path = null)
    {
        $this->path = ($path) ?: getenv('TMP_DIR');
        $this->setFileHandler();
    }

    public function complete()
    {
        if ($this->fileHandler) {
            fclose($this->fileHandler);
        }
    }

    private function generateMd5Name($name = null)
    {
        return md5(($name) ?: time());
    }

    private function getDefaultName()
    {
        return $this->generateMd5Name();
    }

    private function setFileHandler()
    {
        $this->fileHandler = fopen($this->getFullPath(), "w+");
    }

}