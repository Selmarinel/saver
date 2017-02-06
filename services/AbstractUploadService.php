<?php
/**
 * Created by PhpStorm.
 * User: selmarinel
 * Date: 06.02.17
 * Time: 16:42
 */

namespace Saver\Services;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use Saver\Exceptions\ExceptionInterface;
use Saver\Exceptions\HoaException;
use Saver\Exceptions\MyException;

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
        $this->log->pushHandler(new StreamHandler(__DIR__.'/upload.log', Logger::WARNING));
    }

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
        try {
            if (!in_array($mime, array_keys(self::$mime))) {
                throw new HoaException("Unsupported mime type");
            }
        } catch (HoaException $hoaException){
            $this->logAction($hoaException);
            throw new HoaException($hoaException->getMessage());
        } catch (MyException $exception){
            $this->logAction($exception);
            throw new MyException($exception->getMessage());
        }
    }

    protected function logAction(ExceptionInterface $exception)
    {
        $this->log->warning($exception->getMessage());
    }
}