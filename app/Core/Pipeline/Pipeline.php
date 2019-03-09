<?php

namespace App\Core\Pipeline;

class Pipeline extends Handler
{
    public function run($data)
    {
        return $this->callNext($data);
    }
}