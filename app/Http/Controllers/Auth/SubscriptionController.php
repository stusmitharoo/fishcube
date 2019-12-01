<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plan;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view ('subscription.index');
    } 

    public function create(Request $request)
    {
    	$plan = Plan::findOrFail($request->plan);

    	 if ($request->user()->subscribedToPlan($plan->braintree_plan, 'main')) {
            return redirect()->route('profile.index');
        }

        if (!$request->user()->subscribed('main')) {
        	$request->user()->newSubscription('main', $plan->braintree_plan)->create($request->payment_method_nonce);
        } else {
        	$request->user()->subscription('main')->swap($plan->braintree_plan);
        }

    	return redirect()->route('profile.index');
    }

    public function cancel(Request $request)
    {
        $request->user()->subscription('main')->cancel();

        return redirect()->route('subscription.index');
    }

    public function resume(Request $request)
    {
        $request->user()->subscription('main')->resume();

        return redirect()->route('subscription.index');
    }
}
