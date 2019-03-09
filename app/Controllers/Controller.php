<?php

namespace App\Controllers;

use App\Core\Exceptions\BaseException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    private $js = [];
    private $pageData = [];

    protected function addScript($script) {
        $this->js[] = $script;
    }

    protected function addPageData($key, $value) {
        $this->pageData[$key] = $value;
    }

    protected function view(string $view, $data = []) {
        $content = app()->make('smarty')->render($view, $data, $this->js, $this->pageData);

        return app()->make(Response::class, compact('content'));
    }

    protected function json($data) {
        return app()->make(JsonResponse::class, compact('data'));
    }

    protected function validate(array $data, array $rules) {
        return app()->make('validator')->check($data, $rules);
    }

    protected function jsonError($message) {
        throw new BaseException(json_encode([
            'error' => 1,
            'message' => $message
        ]));
    }

    protected function redirect($path = 'login')
    {
        return new RedirectResponse(base_url($path));
    }

}