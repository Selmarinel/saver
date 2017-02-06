<?php
/**
 * Created by PhpStorm.
 * User: selmarinel
 * Date: 06.02.17
 * Time: 16:36
 */

namespace Saver\Services;

use Curl\Curl;
use Saver\Core\LocalFile;
use Saver\Exceptions\MyException as MyException;
use Saver\Objects\CurlObject;

/**
 * Class CurlUploadService
 * @package Saver\Services
 */
class CurlUploadService extends AbstractUploadService implements UploadServiceInterface
{

    protected $url;
    /**
     * @var CurlObject
     */
    protected $curlObject;

    public function __construct($url)
    {
        parent::__construct($url);
        $this->init();
        $this->url = $url;
    }

    /**
     * @throws MyException
     */
    public function init()
    {
        try {
            $this->curlObject = new CurlObject();
        } catch (MyException $exception) {
            $this->logAction($exception);
            throw new MyException($exception->getMessage());
        }
    }

    /**
     * @throws MyException
     */
    public function checkUrl()
    {
        $this->curlObject->get($this->url);
        if ($this->curlObject->error) {
            $this->curlObject->close();
            throw new MyException($this->curlObject->errorMessage, $this->curlObject->errorCode);
        }
        if (!$this->checkMimeType($this->curlObject->getMime())) {
            $this->curlObject->close();
            throw new MyException("Unsupported mime/type");
        }
        return true;
    }

    public function saveFile()
    {
        /**
         * Todo Change path to save
         */
        try {
            $fileName = __DIR__ . '/../tmp/' . md5(time()) . "." . self::$mime[$this->curlObject->getMime()];
            $file = new LocalFile();
            $file->setFileName($fileName);
            $file->init();
            $this->curlObject->setOpts([
                CURLOPT_URL => $this->url,
                CURLOPT_FILE => $file->getFileHandler(),
                CURLOPT_REFERER => $this->url,
                CURLOPT_AUTOREFERER => 1,
                CURLOPT_HEADER => false,
                CURLOPT_NOBODY => false,
            ]);
            $this->curlObject->exec();
            $this->curlObject->close();
        } catch (MyException $exception){
            throw new MyException($exception->getMessage());
        }
    }

    public function uploadFile()
    {
        try {
            $this->checkUrl();
            $this->saveFile();
        } catch (MyException $exception) {
            $this->logAction($exception);
            $this->curlObject->close();
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
            $this->curlObject->close();
        }
    }

}