<?php

namespace App\Http\Controllers\Create;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Card\Card;
use App\Models\Profile\Style;
use Auth;

class ChoiceController extends Controller
{
  public function index(Style $style) {

    return view('card.create', compact('style'));
  }

	 public function show() {

    	$current_card_count = Card::getCardsCount(Auth::user()->id);

      if($this->canSave(Auth::user(), $current_card_count)){
       
        return view('card.createChoice');
      }
         return redirect('/plans')->withInfo('Please upgrade you plan to continue adding cards');
    }
  
    public function canSave($user, $current_card_count) {

      if($current_card_count < 25){
        return true;
      }

      if($user->hasExpertSubscription()){
        return true;
      }

       if($user->subscribed('main') && $current_card_count < 250 ){
        return true;
      }

      return false;
    }

}
