<?php

namespace App\Core\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class BaseException extends \Exception
{
    public function resolve() {
        return new Response($this->getMessage(),500);
    }
}