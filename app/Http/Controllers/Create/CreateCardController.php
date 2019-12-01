<?php

namespace App\Http\Controllers\Create;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Card\Card;
use Validator;
use Session;
Use Auth;
use Image;
use Log;
use Input;
use Carbon\Carbon;

class CreateCardController extends Controller
{

    public function store(Request $request)
   	{

   		$this->validate($request, [
        'style_id' => 'required|integer',
        'district_id' => 'required|integer',
        'fish_id' => 'required|integer',
        'lbs' => 'required',
        'ozs' => 'required',
        'dr' => 'required',
        'capture_date' => 'required|date',
        'display_description' => 'required|string|max:40',
        'profile_description' => 'string|max:500',
      ]);

      $date = Carbon::parse($request->capture_date)->format('Y-m-d');

      $card = new Card;

      $card->style_id = $request->style_id;
      $card->district_id = $request->district_id;
      $card->fish_id = $request->fish_id;
      $card->lbs = $request->lbs;
      $card->ozs = $request->ozs;
      $card->dr = $request->dr;
      $card->capture_date = $date;
      $card->display_description = $request->display_description;
      $card->profile_description = $request->profile_description;
      $card->user_id = Auth::user()->id;


      $current_card_count = Card::getCardsCount(Auth::user()->id);

      if($this->canSave($request->user(), $current_card_count)){
        $card->save();
       
        return $card->toJson();
      }
         return redirect('/plans');

   	}

    public function canSave($user, $current_card_count){

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

    public function storeImage(Request $request) {


      // $this->validate($request, [
      //     'image' => 'required|image',
      // ]);


      $cardId = $request->route('id');

      $card = Card::findOrFail($cardId);

      if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('images/cards/' . $filename);
        Image::make($image)->save($location);

        $card->image = $filename;
      }

      $card->save();

       return $card->toJson();

    }
}
