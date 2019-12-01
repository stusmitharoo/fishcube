<?php

namespace App\Http\Controllers\Terms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermsController extends Controller
{
    public function terms()
    {
    	return view('terms.terms');
    }

    public function privacy()
    {
    	return view('terms.privacy');
    }
}