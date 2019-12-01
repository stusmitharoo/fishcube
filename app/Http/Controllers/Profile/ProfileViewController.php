<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\Profile\DistrictTransformer;
use App\Transformers\Profile\FishTransformer;
use App\Transformers\Card\CardTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Models\Profile\ProfileDistrict;
use App\Models\Profile\ProfileFish;
use App\Models\Profile\Style;
use App\Models\Card\Card;
use App\User;
use Auth;
use Illuminate\Support\Facades\Storage;

class ProfileViewController extends Controller
{

    public function index($card, Request $request)
    {
        $view = User::viewable($card)->get();

        if(!$view->isEmpty()){
            return view('profile.view', [
            'card' => $view
            ]);
        }

        return back()->withInfo('This profile is private.');
        
    }

	public function districts(Request $request)
    {
        $userId = $request->route('id');
        $districts = ProfileDistrict::getViewDistricts($userId);

        $districtsCollection = $districts->getCollection();

    	return fractal()
    		->collection($districtsCollection)
    		->parseIncludes([
                ])
    		->transformWith(new DistrictTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($districts))
    		->toArray();
    }

    public function fish(Request $request, ProfileDistrict $profileDistrict, Style $style)
    { 
        $userId = $request->route('id');
        $fishs = ProfileFish::getViewFishs($userId, $profileDistrict->id, $style->id);
     

        $fishsCollection = $fishs->getCollection();

        return fractal()
            ->collection($fishsCollection)
            ->parseIncludes([''])
            ->transformWith(new FishTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($fishs))
            ->toArray();
    }

    public function card(Request $request)
    {
        $userId = $request->route('id'); 
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

}