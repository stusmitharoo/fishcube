<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile\Style;

class WaterController extends Controller
{
    public function show(Style $style)
    {
    	return view('waters.water', compact('style'));
    }
}