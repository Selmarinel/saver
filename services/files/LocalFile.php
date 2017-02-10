<?php

namespace Saver\Services\Files;

class LocalFile extends AbstractFile implements FileInterface
{
    /**
     *
     */
    public function init()
    {
        $this->setFileHandler();
    }

    /**
     *
     */
    public function complete()
    {
        if ($this->fileHandler) {
            fclose($this->fileHandler);
        }
    }

    /**
     *
     */
    private function setFileHandler()
    {
        $this->fileHandler = fopen($this->getFullPath(), "w+");
    }

    /**
     * @return mixed
     */
    public function getFileHandler()
    {
        return $this->fileHandler;
    }

    /**
     *
     */
    public function saveFile()
    {
        if (!$this->fileName) {

        }
    }

}