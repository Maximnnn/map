<?php

namespace App\Controllers\Api;

use App\Controllers\Controller;
use App\Core\Request;
use App\Core\SimpleValidator;
use App\Models\User;

class Register extends Controller
{
    public function __invoke(Request $request)
    {
        /**@var $validator SimpleValidator*/
        $validator = $this->validate($request->query->all(), [
            'name'     => ['required', 'string', 'notempty'],
            'password' => ['required', 'string', 'notempty'],
            'email'    => ['required', 'string', 'notempty'],
            'token'    => ['required', 'string', 'notempty']
        ]);

        if ($validator->hasErrors()) {
            $this->jsonError(implode(', ', $validator->getErrors()));
        }

        try {
            $user = User::create([
                'name' => $request->get('name'),
                'password' => sha1($request->get('password')),
                'email' => $request->get('email'),
                'token' => $request->get('token')
            ]);
        } catch (\Exception $e) {
            $this->jsonError('this email already registered');
        }

        $request->login($user);

        return $this->json(['user' => $user, 'success' => true]);
    }

}