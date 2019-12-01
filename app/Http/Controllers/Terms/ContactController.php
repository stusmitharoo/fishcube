<?php

namespace App\Http\Controllers\Terms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Contact;
use Validator;

class ContactController extends Controller
{

    public function index()
    {
    	return view('terms.contactUs');
    }

	public function store(Request $request)
    {
    	$this->validate($request, [
        'subject' => 'required',
        'email' => 'required|email',
        'content' => 'required|string|max:500',
      ]);


      $contact = new Contact;

      $contact->subject = $request->subject;
      $contact->email = $request->email;
      $contact->content = $request->content;

      $contact->save();

        return redirect('/contactUs')->withInfo('Your message has been sent fishcube will respond within 24 hrs');
    }    

}