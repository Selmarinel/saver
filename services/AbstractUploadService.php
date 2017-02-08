<?php

namespace Saver\Services;

/**
 * Class AbstractUploadService
 * @package Saver\Services
 */
abstract class AbstractUploadService
{
    protected $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    protected static $mime = [
        'image/png' => 'png',
        'image/jpeg' => 'jpg',
        'image/gif' => 'gif'
    ];

    protected function checkMimeType($mime)
    {
        if (!in_array($mime, array_keys(self::$mime))) {
            return false;
        }
        return true;

    }
}