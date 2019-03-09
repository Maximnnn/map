<?php

namespace App\Core\Pipeline;


abstract class Handler
{
    protected $next;

    public function next(Handler $next)
    {
        $this->next = $next;
        return $next;
    }

    protected function callNext($data)
    {
        if (!$this->next)
            throw new \RuntimeException('error');
        return app()->call($this->next, compact('data'));
    }

}