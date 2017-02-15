<?php

namespace Saver\Objects;


interface ObjectInterface
{
    public function getMime();
    public function getError();
    public function close();
}