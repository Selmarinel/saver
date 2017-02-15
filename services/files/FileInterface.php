<?php

namespace Saver\Services\Files;


interface FileInterface
{
    public function init($path = null);

    public function complete();

    public function getFileName();

    public function setFileName($name);

    public function getFullPath();

    public function setMimeType($mime);

    public function getMimeType();
}