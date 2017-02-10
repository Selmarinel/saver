<?php

namespace Saver\Services\Files;


abstract class AbstractFile
{
    protected $fileHandler;
    protected $fileName;
    protected $mime;

    protected function getDefaultName()
    {
        return md5(time());
    }

    public function getFileName()
    {
        if (!$this->fileName) {
            $this->fileName = $this->getDefaultName();
        }
        return $this->fileName;
    }

    public function getMimeType()
    {
        return $this->mime;
    }

    public function setMimeType($mime)
    {
        $this->mime = $mime;
    }

    public function setFileName($name)
    {
        $this->fileName = ($name) ?: $this->getDefaultName();
    }

    public function getFullPath()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR
        . "tmp" . DIRECTORY_SEPARATOR . $this->getFileName() . "." . $this->getMimeType();
    }
}