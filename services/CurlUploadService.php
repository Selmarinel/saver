<?php
/**
 * Created by PhpStorm.
 * User: selmarinel
 * Date: 06.02.17
 * Time: 16:36
 */

namespace Saver\Services;

use Saver\Exceptions\HoaException as Exception;
use Saver\Exceptions\MyException as MyException;

class CurlUploadService extends AbstractUploadService implements UploadServiceInterface
{
    private $ch;
    private $mime;
    private $info;

    const SUCCESS = 200;

    protected $options = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => true,
        CURLOPT_NOBODY => true
    ];

    public function __construct($url)
    {
        parent::__construct($url);
    }

    public function init()
    {
        try {
            $this->ch = curl_init($this->url);
            curl_setopt_array($this->ch, $this->options);
            curl_exec($this->ch);
            $this->info = curl_getinfo($this->ch);

        } catch (MyException $exception){
            $this->logAction($exception);
            throw new MyException($exception->getMessage());
        }
    }

    public function uploadFile($url)
    {

    }

    /**
     * @throws \Exception
     */
    public function checkFileFromUrl()
    {
        try {
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($this->ch, CURLOPT_HEADER, true);
            curl_setopt($this->ch, CURLOPT_NOBODY, true);
            curl_exec($this->ch);
            if (curl_getinfo($this->ch, CURLINFO_HTTP_CODE) != self::SUCCESS) {
                curl_close($this->ch);
                throw new Exception("Returned with fail");
            }
            $this->mime = curl_getinfo($this->ch, CURLINFO_CONTENT_TYPE);
            curl_close($this->ch);
        } catch (Exception $hoaException){
            curl_close($this->ch);
            $this->logAction($hoaException);
            throw new Exception($hoaException->getMessage());
        } catch (MyException $exception){
            curl_close($this->ch);
            $this->logAction($exception);
            throw new MyException($exception->getMessage());
        }
    }

}