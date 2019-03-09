<?php


namespace App\Controllers\Api;


use App\Controllers\Controller;
use App\Core\Request;
use App\Services\MapService;

class Units extends Controller
{
    public function __invoke(MapService $service, Request $request)
    {
        return $this->json($service->getUnits($request->get('filter', [])));
    }
}