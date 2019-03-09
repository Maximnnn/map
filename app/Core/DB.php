<?php

namespace App\Core;


use Illuminate\Database\Capsule\Manager;

class DB
{
    public function __invoke()
    {
        $capsule = new Manager();
        $capsule->addConnection([
            "driver"   => env('db', 'mysql'),
            "host"     => env('db_host', '127.0.0.1'),
            "database" => env('db_name'),
            "username" => env('db_username', 'root'),
            "password" => env('db_password', '')
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        $capsule->bootEloquent();
        return $capsule;
    }

}