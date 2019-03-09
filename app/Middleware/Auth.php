<?php

namespace App\Middleware;


use App\Core\Pipeline\Handler;
use App\Core\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Auth extends Handler
{
    public function __invoke(Request $request)
    {
        if (!$request->user())
            return new RedirectResponse(base_url('login'));

        return $this->callNext($request);
    }

}