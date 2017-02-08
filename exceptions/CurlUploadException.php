<?php

namespace Saver\Exceptions;

use Saver\Loggers\UploadLogger;

class CurlUploadException extends MyException implements ExceptionInterface
{
    public function __construct($message = "", $code = 0, Exception $previous = null) {
        parent::__construct($message,$code,$previous);
        $this->setLogger(new UploadLogger("CurlUpload"));
    }
}