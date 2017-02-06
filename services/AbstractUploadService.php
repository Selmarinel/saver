<?php
/**
 * Created by PhpStorm.
 * User: selmarinel
 * Date: 06.02.17
 * Time: 16:42
 */

namespace Saver\Services;

use Dotenv\Dotenv;

abstract class AbstractUploadService
{

    private static $mime = [
        'image/png' => 'png',
        'image/jpeg' => 'jpeg',
        'image/gif' => 'gif'
    ];

    /**
     * @param $mime
     * @throws \Exception
     */
    protected function checkMimeType($mime)
    {
        if (!in_array($mime, array_keys(self::$mime))) {
            throw new \Exception("Unsupported mime type");
        }
    }
}