<?php

namespace App\Controllers\Api;


use App\Controllers\Controller;
use App\Core\Request;
use App\Services\MapService;

class Routes extends Controller
{
    public function __invoke(MapService $mapService, Request $request)
    {
        $filter = [
            'from' => $request->get('from', date('Y-m-d H:i:s', strtotime('-1 day'))),
            'till' => $request->get('till', date('Y-m-d H:i:s'))
        ];
        return $this->json($mapService->getRoutes($filter));
    }
}