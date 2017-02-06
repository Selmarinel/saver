<?php
/**
 * Created by PhpStorm.
 * User: selmarinel
 * Date: 06.02.17
 * Time: 16:36
 */

namespace Saver\Services;


class CurlUploadService extends AbstractUploadService implements UploadServiceInterface
{
    private $url;
    private $ch;

    const SUCCESS = 200;

    public function __construct($url)
    {
        $this->url = $url;
        $this->ch = curl_init($this->url);
    }

    public function uploadFile($url)
    {
        $this->checkCurl();
    }

    /**
     * @throws \Exception
     */
    public function checkCurl()
    {
        try {
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($this->ch, CURLOPT_HEADER, true);
            curl_setopt($this->ch, CURLOPT_NOBODY, true);
            curl_exec($this->ch);
            if (curl_getinfo($this->ch, CURLINFO_HTTP_CODE) != self::SUCCESS) {
                throw new \Exception("Returned with fail");
            }
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}