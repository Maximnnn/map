<?php

namespace App\Controllers\Api;


use App\Controllers\Controller;
use App\Core\Request;
use App\Services\MapService;

class Routes extends Controller
{
    public function __invoke(MapService $mapService, Request $request)
    {
        $filter = array_filter([
            'from' => $request->get('from'),
            'till' => $request->get('till')
        ]);
        return $this->json($mapService->getRoutes($filter));
    }
}