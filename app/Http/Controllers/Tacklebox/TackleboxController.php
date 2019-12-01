<?php

namespace App\Http\Controllers\Tacklebox;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TackleboxController extends Controller
{
    public function index()
    {
    	return view('tacklebox.index');
    }
    
}