<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\Profile\DistrictTransformer;
use App\Transformers\Profile\FishTransformer;
use App\Models\Profile\ProfileDistrict;
use App\Models\Profile\ProfileFish;
use App\User;

class OrderProfileController extends Controller
{

    public function districts(Request $request)
    {
    	$user = $request->user();
        $selectorDistricts = ProfileDistrict::getProfileDistricts($user->id);

    	return fractal()
    		->collection($selectorDistricts)
    		->parseIncludes([
                'style'
                ])
    		->transformWith(new DistrictTransformer)
    		->toArray();
    }   
    public function fishs(Request $request, ProfileDistrict $profileDistrict)
    { 
        $user = $request->user();
        $selectorFishs = ProfileFish::getOrderFishs($user->id, $profileDistrict->id);
     
        return fractal()
            ->collection($selectorFishs)
            ->parseIncludes([])
            ->transformWith(new FishTransformer)
            ->toArray();
    }
}