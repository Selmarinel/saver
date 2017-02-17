<?php

namespace Saver\Exceptions;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Saver\Loggers\MyLoggerInterface;

class MyException extends \Exception implements ExceptionInterface
{
    /**
     * @var MyLoggerInterface
     */
    private $log;

    private function getLogPath()
    {
        return (getenv('SAVER_LOG_PATH')) ?: __DIR__ . "/../logs/";
    }

    protected function setLogger(MyLoggerInterface $logger)
    {
        $this->log = $logger;
        $this->log->pushHandler(new StreamHandler($this->getLogPath() . $this->log->getLogFileName(), Logger::WARNING));
    }

    public function setLog()
    {
        if ($this->log instanceof MyLoggerInterface) {
            $this->log->log(Logger::WARNING, $this->getMessage());
        }
    }
}