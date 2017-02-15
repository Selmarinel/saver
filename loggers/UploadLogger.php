<?php

namespace Saver\Loggers;

use Monolog\Logger;
use Monolog\Handler\HandlerInterface;

class UploadLogger extends Logger implements MyLoggerInterface
{
    private $streamName = "upload";

    public function getStreamName()
    {
        return $this->streamName;
    }

    public function getLogFileName()
    {
        return $this->getStreamName() . ".log";
    }

    public function pushHandler(HandlerInterface $handler)
    {
        return parent::pushHandler($handler);
    }

}