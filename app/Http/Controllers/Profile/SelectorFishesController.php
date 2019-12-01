<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile\ProfileFish;
use App\Models\Profile\ProfileDistrict;
use App\Models\Profile\Style;
use Illuminate\Validation\Rule;
use App\Transformers\profile\FishTransformer;
use App\User;
use Auth;
use Validator;

class SelectorFishesController extends Controller
{

     public function fishes(Request $request, ProfileDistrict $profileDistrict, Style $style)
    { 
        $user = $request->user();
        $selectorFishs = ProfileFish::getSelectorFishs($user->id, $profileDistrict->id, $style->id);
     
        return fractal()
            ->collection($selectorFishs)
            ->parseIncludes([])
            ->transformWith(new FishTransformer)
            ->toArray();
    }

    public function store(Request $request)
     {
        $userId = $request->user()->id;
        $fishId = $request->fish_id;
        $profileDistrictId = $request->profile_district_id;

        $fishExists = ProfileFish::getFishExists($userId, $fishId, $profileDistrictId)->first();

        if(!$fishExists) {

            $this->validate($request,[
                'name' => 'required|max:40',
                'image' => 'required|max:40',
                'district_id' => 'required|max:11',
                'style_id' => 'required|max:11',
                'profile_district_id' => [
                    'required',
                    'max:11',
                    Rule::unique('profile_fish')->where(function ($query) use ($fishId, $userId, $profileDistrictId) {
                        $query->where('fish_id', $fishId)
                                ->where('user_id',$userId)
                                ->where('profile_district_id',$profileDistrictId);
                    })
                ],
                'fish_id' => 'required|max:11',
                ]);

            $selectFish = new ProfileFish;
            $selectFish->name = $request->name;
            $selectFish->image = $request->image;
            $selectFish->district_id = $request->district_id;
            $selectFish->profile_district_id = $request->profile_district_id;
            $selectFish->fish_id = $request->fish_id;
            $selectFish->style_id = $request->style_id;
            $selectFish->user_id = Auth::user()->id;
         
            $selectFish->save();
            
            return $selectFish->toJson();
        }
            return $fishExists->toJson();
    }
}