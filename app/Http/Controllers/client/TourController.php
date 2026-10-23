<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\client\tour;

class TourController extends Controller
{
    private $tour;

    public function __construct()
    {
        $this->tour = new tour();
    }
    public function index()
    {
        $title = 'Tour';
        $tour = $this->tour->getAllTour();
        $domain = $this->tour->getDomain();
        return view(view: 'clients.Tour', data: compact('title','tour','domain'));
    }

}
