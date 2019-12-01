<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\Card\CardTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Models\Card\Card;
use App\User;
use Auth;
use Illuminate\Support\Facades\Storage;

class ProfileCardController extends Controller
{

   public function profileCard(Request $request)
    {
        $userId = Auth::user()->id; 
        $profileDistrict = $request->route('profileDistrict');
        $profileFish = $request->route('profileFish');
        $style = $request->route('style');
        
        $cards = Card::getViewCards($userId, $profileDistrict, $profileFish, $style);   

        $cardsCollection = $cards->getCollection();

        return fractal()
            ->collection($cardsCollection)
            ->parseIncludes(['user'])
            ->transformWith(new CardTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($cards))
            ->toArray();
    }

     public function edit(Request $request, Card $card)
    {
        $this->authorize('touch', $card);

        return view('profile.edit', compact('card'));
    }

    public function update(Request $request, Card $card)
    {
        $this->authorize('touch', $card);

        $this->validate($request, [
        'lbs' => 'required',
        'ozs' => 'required',
        'dr' => 'required',
        'capture_date' => 'required|date',
        'display_description' => 'required|string|max:40',
        'profile_description' => 'string|max:500',
        ]);

        $cardId = $card->id;
        


        $card = Card::findOrFail($cardId);

        $card->lbs = $request->lbs;
        $card->ozs = $request->ozs;
        $card->dr = $request->dr;
        $card->capture_date = $request->capture_date;
        $card->display_description = $request->display_description;
        $card->profile_description = $request->profile_description;

        $card->save();

       return $card->toJson();
    }

    public function updateImage(Request $request, Card $card) {

        $this->authorize('touch', $card);

        $this->validate($request, [
            'image' => 'required|image',
        ]);


        $cardId = $card->id;

        $card = Card::findOrFail($cardId);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/cards/' . $filename);
            $oldFilename = $card->image;
            Storage::delete($oldFilename);
            Image::make($image)->save($location);

            $card->image = $filename;

      }

      $card->save();

      

       return $card->toJson();

    }

     public function delete()
    {
        
    }

}