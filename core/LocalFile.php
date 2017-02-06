<?php
/**
 * Created by PhpStorm.
 * User: selmarinel
 * Date: 06.02.17
 * Time: 16:26
 */

namespace Saver\Core;


class LocalFile extends AbstractFile implements AbstractFileInterface
{
    protected $fileName;

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName)
   {
        $this->fileName = $fileName;
    }

    protected $mime;
    protected $fileHandler;

    public function init()
    {
        $this->setFileHandler();
    }

    public function complete()
    {
        if ($this->fileHandler) {
            fclose($this->fileHandler);
        }
    }

    public function setFileHandler()
    {
        $this->fileHandler = fopen($this->fileName, "w+");
    }

    public function getFileHandler()
    {
        return $this->fileHandler;
    }

    public function saveFile()
    {
        if (!$this->fileName) {

        }
    }

    public function save()
    {

    }
}