<?php

namespace App\Http\Controllers\Location;

use Illuminate\Http\Request;
use App\Models\Profile\Style;
use App\Http\Controllers\Controller;

class LocationChoiceController extends Controller
{
     public function show()
    {
    	return view('location.choice');
    }

    public function index(Style $style) {

    return view('location.selector', compact('style'));
  }
}