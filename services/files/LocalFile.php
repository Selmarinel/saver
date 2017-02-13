<?php

namespace Saver\Services\Files;

class LocalFile extends AbstractFile implements FileInterface
{
    public function init($path = null)
    {
        parent::init($path);
        $this->setFileHandler();
    }

    public function complete()
    {
        if ($this->fileHandler) {
            fclose($this->fileHandler);
        }
    }

    private function setFileHandler()
    {
        $this->fileHandler = fopen($this->getFullPath(), "w+");
    }

    public function getFileHandler()
    {
        return $this->fileHandler;
    }

}