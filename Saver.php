<?php

namespace Saver;

use Dotenv\Dotenv;
use Saver\Exceptions\CurlUploadException;
use Saver\Exceptions\MyException;
use Saver\Services\Upload\UploadServiceInterface;

class Saver
{

    private $uploadService;

    private $dotenv;

//    private $fileSystem;

    public function __construct(UploadServiceInterface $service)
    {
        $this->uploadService = $service;
        if (!getenv("SAVER_TMP_DIR")) {
            $this->dotenv = new Dotenv(__DIR__);
            $this->dotenv->load();
        }

    }

    public function saveFromUrl($url, $path = null, $name = null)
    {
        try {
            $this->uploadService->uploadFileFromUrl($url, $path, $name);
        } catch (CurlUploadException $curlUploadException) {
            throw $curlUploadException;
        } catch (MyException $myException) {
            throw $myException;
        }
    }
}