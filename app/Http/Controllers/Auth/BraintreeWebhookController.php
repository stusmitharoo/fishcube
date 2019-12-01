<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Cashier\Http\Controllers\WebhookController;

class BraintreeWebhookController extends WebhookController
{
    public function handle(Request $request)
    {
    	$event = camel_case($request->event);

    	if(method_exists($this, $event)) {
    		$this->{$event}($request);
    	}
    }

}
