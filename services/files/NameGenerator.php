<?php

namespace Saver\Services\Files;

trait NameGenerator
{
    function generateMd5Name($name = null)
    {
        return md5(($name) ?: time());
    }
}