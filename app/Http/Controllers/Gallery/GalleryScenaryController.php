<?php

namespace App\Http\Controllers\Gallery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\Gallery\GalleryScenaryTransformer;
use App\Models\Card\Card;
use App\User;
use Validator;
use Session;
Use Auth;
use Image;

class GalleryScenaryController extends Controller
{
    public function index()
    {
      $current_card_count = Card::getCardsCount(Auth::user()->id);

      if($this->canSave(Auth::user(), $current_card_count)){
       
        return view('gallery.galleryScenary');
      }
         return redirect('/plans');
    }

    public function scenary(Request $request, $styleId)
    {
    	$user = $request->user();
        $selectorScenary = Card::getScenaryImages($user->id, $styleId);

    	return fractal()
    		->collection($selectorScenary)
    		->transformWith(new GalleryScenaryTransformer)
    		->toArray();
    }

     public function store(Request $request)
    {

        $this->validate($request, [
        'style_id' => 'required|integer',
        'capture_date' => 'required|date',
        'display_description' => 'required|max:40',
      ]);


      $card = new Card;

      $card->style_id = $request->style_id;
      $card->capture_date = $request->capture_date;
      $card->display_description = $request->display_description;
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

    public function storeImage(Request $request)
    {

      $this->validate($request, [
          'image' => 'required',
      ]);


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
