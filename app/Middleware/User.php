<?php

namespace App\Middleware;


use App\Core\Pipeline\Handler;
use App\Core\Request;

class User extends Handler
{
    public function __invoke(Request $request)
    {
        if (!$session = $request->getSession())
            throw new \RuntimeException('session is not started');

        if ($user = \App\Models\User::query()->find($session->get('user')['id'] ?? 0)) {
            $request->login($user);
        };

        return $this->callNext($request);
    }

}