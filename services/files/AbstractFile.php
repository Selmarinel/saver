<?php

namespace Saver\Services\Files;

abstract class AbstractFile implements FileInterface
{
    use NameGenerator;

    protected $fileHandler;
    protected $fileName;
    protected $mime;
    protected $path;

    public function init($path = null)
    {
        $this->path = ($path) ?: getenv('TMP_DIR');
    }

    public function saveFile()
    {
        //save File
    }

    public function complete()
    {
        //complete
    }

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

    protected function getDefaultName()
    {
        return $this->generateMd5Name();
    }
}