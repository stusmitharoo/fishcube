<?php

namespace App\Http\Controllers\Share;

use Illuminate\Http\Request;
use App\Models\Card\Card;
use App\Http\Controllers\Controller;
use Auth;

class ShareController extends Controller
{
    public function card(Card $card)
    {
    	$user = Auth::user();

    	return view('share.card', compact('card','user'));
    }
}