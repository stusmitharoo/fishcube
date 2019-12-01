<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Models\ActivationToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\UserRequestedActivationEmail;

class ActivationController extends Controller
{
    public function activate(ActivationToken $token)
    {
    	$token->user()->update([
    		'active' => true
    	]);

    	Auth::login($token->user);

        $token->delete();

    	return redirect('/profile');
    }

    public function resend(Request $request)
    {
        $user = User::byEmail($request->email)->firstOrFail();

        if ($user->active) {
            return redirect('/login');
        }

        event(new UserRequestedActivationEmail($user));

        return redirect('/login')->withInfo('Activation email has been resent.');
    }
}

