<?php

namespace App\Controllers\Pages;


use App\Controllers\Controller;
use App\Core\Request;

class Register extends Controller
{

    public function __invoke(Request $request)
    {
        return $this->view('register');
    }
}