<?php

namespace App\Http\Controllers\Species;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpeciesController extends Controller
{
    public function coarse()
    {
      return view('species.coarsefish');
    }

    public function sea()
    {
      return view('species.seafish');
    }
}