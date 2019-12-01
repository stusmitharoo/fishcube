<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\Profile\DistrictTransformer;
use App\Models\Profile\ProfileDistrict;
use App\Models\Profile\ProfileFish;
use App\Models\Profile\Style;
use Illuminate\Validation\Rule;
use App\User;
use Auth;
use Validator;

class ProfileSelectorController extends Controller
{

    public function districts(Request $request, Style $style)
    {
    	$user = $request->user();
        $selectorDistricts = ProfileDistrict::getSelectorDistricts($user->id, $style->id);

    	return fractal()
    		->collection($selectorDistricts)
    		->parseIncludes([
                'style'
                ])
    		->transformWith(new DistrictTransformer)
    		->toArray();
    }

    public function store(Request $request)
     {
        $userId = $request->user()->id;
        $styleId = $request->style_id;
        $districtId = $request->district_id;

        $districtExists = ProfileDistrict::getDistrictExists($userId, $styleId, $districtId)->first();

        if(!$districtExists) {

            $this->validate($request,[
                'name' => 'required|max:40',
                'image' => 'required|max:40',
                'district_id' =>  [
                    'required',
                    'max:11',
                    Rule::unique('profile_districts')->where(function ($query) use ($styleId, $userId, $districtId) {
                        $query->where('style_id', $styleId)
                                ->where('user_id',$userId)
                                ->where('district_id',$districtId);
                    })
                ],
                'style_id' => 'required|max:11',
                ]);


            $selectDistrict = new ProfileDistrict;
            $selectDistrict->name = $request->name;
            $selectDistrict->image = $request->image;
            $selectDistrict->district_id = $request->district_id;
            $selectDistrict->style_id = $request->style_id;
            $selectDistrict->user_id = $request->user()->id;

                $selectDistrict->save();
                return $selectDistrict->toJson();
        }
            return $districtExists->toJson();
    }
}
