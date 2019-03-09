<?php

namespace App\Services;


class MapService
{
    protected $getter;

    public function __construct(MapGetterInterface $getter)
    {
        $this->getter =$getter;
    }

    public function getRoutes(array $filter): array
    {
        return $this->getter->getRoutes($filter);
    }

    public function getUnits(array $filter = []): array
    {
        return $this->getter->getUnits($filter);
    }
}