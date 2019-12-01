<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Braintree_ClientToken;
use App\Http\Controllers\Controller;

class BraintreeTokenController extends Controller
{
    public function token()
    {
    	return response()->json([
    		'data' => [
    		'token' => Braintree_ClientToken::generate(),
    		]
    	]);
    }
}