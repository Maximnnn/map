<?php

namespace App\Services;


use App\Models\User;

class MapOnCredentials
{
    private $token;

    public function __construct(User $user)
    {
        $this->token = $user->token;
    }

    public function getToken()
    {
        return $this->token;
    }

}