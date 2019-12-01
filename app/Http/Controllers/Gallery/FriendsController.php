<?php

namespace App\Http\Controllers\Gallery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FriendsController extends Controller
{
    public function index()
    {
    	return view('gallery.friendslist');
    }
}
