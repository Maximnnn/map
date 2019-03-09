<?php
namespace App\Controllers\Pages;


use App\Controllers\Controller;

class Home extends Controller
{
    public function __invoke()
    {
        return $this->view('home');
    }

}