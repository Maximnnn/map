<?php

namespace App\Core\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class ValidatorException extends BaseException
{
    public function resolve()
    {
        return new Response($this->getMessage(), Response::HTTP_BAD_REQUEST);
    }

}