<?php

namespace Saver\Services\Upload;


interface UploadServiceInterface
{
    public function uploadFileFromUrl($url, $path, $name);
}