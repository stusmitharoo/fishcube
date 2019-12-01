<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plan;

class PlanController extends Controller
{
    Public function index() 
    {

    	return view('plans.index')->with([
    		'plans' => Plan::get(),
    	]);
    }

    public function show(Plan $plan, Request $request)
    {
        if ($request->user()->subscribedToPlan($plan->braintree_plan, 'main')) {
            return redirect()->route('home');
        }

    	return view('plans.show')->with([
    		'plan' =>$plan,
    	]);
    }
}
