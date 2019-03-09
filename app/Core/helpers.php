<?php

function d($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
    die;
}

function dj($arr) {
    echo json_encode($arr);
    die;
}

function app(): \App\Core\Container
{
    return \App\Core\Container::instance();
}

function env($key, $default = null)
{
    return getenv($key) ?: $default;
}

function base_url($path = '')
{
    return env('base_url') . $path;
}