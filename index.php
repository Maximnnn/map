<?php

define('ROOT', __DIR__);

require_once __DIR__ . '/app/Core/helpers.php';
require_once __DIR__ . '/vendor/autoload.php';


$request = \App\Core\Request::createFromGlobals();

$response = app()->make(\App\Core\Core::class)->handle($request);

/**@var $response \Symfony\Component\HttpFoundation\Response*/
$response->send();