<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use session;
use Auth;
use Image;

class ProfileSettingsController extends Controller
{
   
    public function index()
    {
        
        return view('auth.profileSettings', ['user' => Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'max:100|email', 
            'image'=> 'mimes:jpeg,jpg,png|max:5000'

        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->view = $request->view;
        
        $user->update();

      return redirect()->route('profile.index');
    }

    
}