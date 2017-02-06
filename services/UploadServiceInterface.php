<?php
/**
 * Created by PhpStorm.
 * User: selmarinel
 * Date: 06.02.17
 * Time: 16:34
 */

namespace Saver\Services;


interface UploadServiceInterface
{
    /**
     * @return mixed
     */
    public function uploadFile();

    /**
     * @return mixed
     */
    public function init();
}