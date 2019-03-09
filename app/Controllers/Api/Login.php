<?php

namespace App\Controllers\Api;

use App\Controllers\Controller;
use App\Core\Request;
use App\Models\User;

class Login extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::query()
            ->where('email', $request->get('email'))
            ->where('password', sha1($request->get('password')))
            ->first();

        if ($user) {
            $request->login($user);

            return $this->json($user);
        } else {
            $this->jsonError('wrong password or email');
        }
    }
}