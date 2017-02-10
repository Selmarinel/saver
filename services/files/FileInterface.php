<?php

namespace Saver\Services\Files;


interface FileInterface
{
    public function saveFile();

    public function init();

    public function complete();

    public function getFileName();

    public function setFileName($name);

    public function getFullPath();

    public function setMimeType($mime);

    public function getFileHandler();
}