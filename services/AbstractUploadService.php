<?php
/**
 * Created by PhpStorm.
 * User: selmarinel
 * Date: 06.02.17
 * Time: 16:42
 */

namespace Saver\Services;

use Dotenv\Dotenv;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use Saver\Exceptions\ExceptionInterface;

/**
 * Class AbstractUploadService
 * @package Saver\Services
 */
abstract class AbstractUploadService
{
    protected $url;
    private $log;

    public function __construct($url)
    {
        $this->url = $url;
        $this->log = new Logger("upload");
        /**
         * Todo: Fix ENV and Configs
         */
        $dotenv = new Dotenv(__DIR__ . "\..");
        $dotenv->load();

        $this->log->pushHandler(new StreamHandler(getenv('LOG_PATH') . '/upload.log', Logger::WARNING));
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

    protected function logAction(ExceptionInterface $exception)
    {
        $this->log->warning($exception->getMessage());
    }
}