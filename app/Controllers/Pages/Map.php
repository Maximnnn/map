<?php

namespace App\Controllers\Pages;


use App\Controllers\Controller;

class Map extends Controller
{
    public function __invoke()
    {
        $this->addScript('https://maps.googleapis.com/maps/api/js?key=' . env('google_maps_key') .'&callback=initMap');
        return $this->view('map');
    }

}