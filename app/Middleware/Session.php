<?php

namespace App\Middleware;


use App\Core\Pipeline\Handler;
use App\Core\Request;


class Session extends Handler
{
    public function __invoke(Request $request)
    {
        $request->setSession(new \Symfony\Component\HttpFoundation\Session\Session());

        return $this->callNext($request);
    }

}