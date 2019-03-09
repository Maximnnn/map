<?php

namespace App\Core;


use App\Models\User;

class Request extends \Symfony\Component\HttpFoundation\Request
{
    protected $user = null;

    public function user()
    {
        return $this->user;
    }

    public function login(User $user = null)
    {
        $this->session->set('user', $user ? $user->toArray() : null);
        $this->user = $user;
    }

    public function logout()
    {
        $this->session->set('user', null);
    }

}