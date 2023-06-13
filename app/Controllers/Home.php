<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'page' => 'v_dashboard',
        ];
        return view('v_template', $data);
    }

    public function viewMap()
    {
        $data = [
            'judul' => 'View Map',
            'page' => 'v_view_map',
        ];
        return view('v_template', $data);
    }

    public function baseMap()
    {
        $data = [
            'judul' => 'Base Map',
            'page' => 'v_base_map',
        ];
        return view('v_template', $data);
    }

    public function marker()
    {
        $data = [
            'judul' => 'Marker',
            'page' => 'v_marker',
        ];
        return view('v_template', $data);
    }
    
    public function circle()
    {
        $data = [
            'judul' => 'Circle',
            'page' => 'v_circle',
        ];
        return view('v_template', $data);
    }
    
    public function polyline()
    {
        $data = [
            'judul' => 'Polyline',
            'page' => 'v_polyline',
        ];
        return view('v_template', $data);
    }
    
    public function polygon()
    {
        $data = [
            'judul' => 'Polygon',
            'page' => 'v_polygon',
        ];
        return view('v_template', $data);
    }
    
    public function geojson()
    {
        $data = [
            'judul' => 'GeoJSON',
            'page' => 'v_geojson',
        ];
        return view('v_template', $data);
    }
    
    public function getCoordinat()
    {
        $data = [
            'judul' => 'Get Coordinat',
            'page' => 'v_get_coordinat',
        ];
        return view('v_template', $data);
    }
    
    public function geolocation()
    {
        $data = [
            'judul' => 'Geolocation',
            'page' => 'v_geolocation',
        ];
        return view('v_template', $data);
    }
    
    public function rute()
    {
        $data = [
            'judul' => 'Rute',
            'page' => 'v_rute',
        ];
        return view('v_template', $data);
    }
    
    public function rute2()
    {
        $data = [
            'judul' => 'Rute Dari Lokasi User',
            'page' => 'v_rute2',
        ];
        return view('v_template', $data);
    }
}
