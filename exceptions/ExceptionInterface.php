<?php
/**
 * Created by PhpStorm.
 * User: selmarinel
 * Date: 06.02.17
 * Time: 17:05
 */

namespace Saver\Exceptions;


interface ExceptionInterface
{
    public function getMessage();
    public function getCode();
}