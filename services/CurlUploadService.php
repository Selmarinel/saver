<?php
/**
 * Created by PhpStorm.
 * User: selmarinel
 * Date: 06.02.17
 * Time: 16:36
 */

namespace Saver\Services;

use Saver\Core\LocalFile;
use Saver\Exceptions\CurlUploadException as UploadException;
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

    /**
     * CurlUploadService constructor.
     * @param $url
     */
    public function __construct($url)
    {
        parent::__construct($url);
        $this->url = $url;
        $this->init();
    }

    /**
     * @throws UploadException
     */
    public function init()
    {
        try {
            $this->curlObject = new CurlObject();
        } catch (UploadException $exception) {
            throw $exception;
        }
    }

    /**
     * @throws UploadException
     */
    public function checkUrl()
    {
        $this->curlObject->get($this->url);
        if ($this->curlObject->error) {
            $this->curlObject->close();
            throw new UploadException($this->curlObject->errorMessage, $this->curlObject->errorCode);
        }
        if (!$this->checkMimeType($this->curlObject->getMime())) {
            $this->curlObject->close();
            throw new UploadException("Unsupported mime/type");
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
        } catch (UploadException $exception){
            throw $exception;
        }
    }

    public function uploadFile()
    {
        try {
            $this->checkUrl();
            $this->saveFile();
        } catch (UploadException $exception) {
            $this->curlObject->close();
            throw $exception;
        }
    }

}