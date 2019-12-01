<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Contact;

class AdminController extends Controller
{
    public function index(Request $request)
    {
    	return view('admin.adminPanel');
    }

    public function contact()
    {
    	return view('admin.contactForm')->with([
    		'contacts' => contact::get(),
    	]);
    }

    public function destroy(Request $request, Contact $contact)
    {
    	$contact->delete();

    	return view('admin.contactForm')->with([
    		'contacts' => contact::get(),
    	]);
    }
}