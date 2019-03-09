<?php

namespace App\Middleware;


use App\Core\Pipeline\Handler;

class ControllerRunner extends Handler
{
    protected $controller;

    public function __construct(string $controller)
    {
        $this->controller = $controller;
    }

    public function __invoke()
    {
        return app()->call($this->controller);
    }

}