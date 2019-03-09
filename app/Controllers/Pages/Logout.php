<?php

namespace App\Controllers\Pages;


use App\Controllers\Controller;
use App\Core\Request;

class Logout extends Controller
{
    public function __invoke(Request $request)
    {
        $request->logout();
        return $this->redirect();
    }
}