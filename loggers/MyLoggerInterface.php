<?php

namespace Saver\Loggers;

use Psr\Log\LoggerInterface;
use Monolog\Handler\HandlerInterface;

interface MyLoggerInterface extends LoggerInterface
{
    public function getStreamName();
    public function getLogFileName();
    public function pushHandler(HandlerInterface $handler);
}