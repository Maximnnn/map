<?php

namespace App\Services;


interface MapGetterInterface
{
    public function getRoutes(array $filter): array;
    public function getUnits(array $filter): array;
}