<?php

namespace Saver;

use Saver\Exceptions\CurlUploadException;
use Saver\Exceptions\MyException;
use Saver\Services\CurlUploadService;

class SaverController
{
    public function saveFile($url)
    {
        try {
            $service = new CurlUploadService($url);
            $service->uploadFile();
        } catch (CurlUploadException $exception){
            $exception->setLog();
            echo $exception->getMessage();
        } catch (MyException $exception){
            throw $exception;
        }
    }
}