<?php

namespace Saver;

use Saver\Services\Upload\UploadServiceInterface;

class Saver
{

    private $uploadService;

//    private $fileSystem;
    public function __construct(UploadServiceInterface $service)
    {
        $this->uploadService = $service;
    }

    public function saveFromUrl($url, $path = null, $name = null)
    {
        try {
            $this->uploadService->uploadFileFromUrl($url, $path, $name);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}