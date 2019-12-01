<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
    	return view('invoices.index')->with([
    		'invoices' => $request->user()->invoices(),
    	]);
    }

    public function show($invoiceId, Request $request)
    {
    	return $request->user()->downloadInvoice($invoiceId, [
    		'vendor' => 'Fishcube Ltd',
    		'product' => 'Subscription',
    	]);
    }
}
