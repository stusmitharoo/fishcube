<?php

namespace App\Http\Controllers\Map;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapController extends Controller
{
    public function district()
    {
      return view('map.district');
    }

    public function river()
    {
      return view('map.river');
    }

    public function canal()
    {
      return view('map.canal');
    }

    public function sea()
    {
      return view('map.sea');
    }
}