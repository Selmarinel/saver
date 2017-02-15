<?php
/**
 * Created by PhpStorm.
 * User: selmarinel
 * Date: 06.02.17
 * Time: 18:17
 */

namespace Saver\Objects;

use Curl\Curl;

class CurlObject extends Curl implements ObjectInterface
{

    private $options = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => true,
        CURLOPT_NOBODY => true
    ];

    public function __construct($base_url = null)
    {
        parent::__construct($base_url);
        $this->_initOptions();
    }

    /**
     * @return mixed
     */
    public function getMime()
    {
        return $this->getInfo(CURLINFO_CONTENT_TYPE);
    }

    public function getMessage()
    {
        return $this->errorMessage;
    }

    public function getError()
    {
        return $this->error;
    }

    public function close()
    {
        parent::close();
    }

    public function get($url)
    {
        parent::get($url);
    }

    private function _initOptions()
    {
        foreach ($this->options as $option => $value) {
            $this->setOpt($option, $value);
        }
    }
}