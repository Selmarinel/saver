<?php
/**
 * Created by PhpStorm.
 * User: selmarinel
 * Date: 06.02.17
 * Time: 18:17
 */

namespace Saver\Objects;

use Curl\Curl;

class CurlObject extends Curl
{

    protected $options = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => true,
        CURLOPT_NOBODY => true
    ];

    private function _initOptions()
    {
        foreach ($this->options as $option => $value) {
            $this->setOpt($option, $value);
        }
    }

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
}