<?php
/**
 * Created by PhpStorm.
 * User: selmarinel
 * Date: 06.02.17
 * Time: 16:22
 */

namespace Saver;

use Saver\Services\CurlUploadService;

class SaverController
{
    public function saveFile($url)
    {
        $service = new CurlUploadService($url);
        $service->uploadFile();
    }
}