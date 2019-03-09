<?php
require_once __DIR__ . '/app/Core/helpers.php';
require_once __DIR__ . '/vendor/autoload.php';

app()->make(\App\Core\Core::class);

Illuminate\Database\Capsule\Manager::schema()->create('users', function (\Illuminate\Database\Schema\Blueprint $table) {

    $table->increments('id');
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->string('token');
    $table->rememberToken();
    $table->timestamps();

});