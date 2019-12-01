<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\Profile\DistrictTransformer;
use App\Transformers\Profile\FishTransformer;
use App\Transformers\Profile\StyleTransformer;
use App\Transformers\card\CardTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Models\Profile\ProfileDistrict;
use App\Models\Profile\ProfileFish;
use App\Models\Profile\Style;
use App\Models\Card\Card;
use App\User;
use Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function index()
    {
        return view('profile.index');
    }

	public function show(Request $request)
    {
    	$districts = $request->user()->profileDistricts()->orderBy('order_no','asc')->paginate(1);

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
        $user = Auth::user(); 
        $fishs = ProfileFish::getProfileFishs($user->id, $profileDistrict->id, $style->id);
     

        $fishsCollection = $fishs->getCollection();

        return fractal()
            ->collection($fishsCollection)
            ->parseIncludes([''])
            ->transformWith(new FishTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($fishs))
            ->toArray();
    }

    public function style(Style $style)
    { 

        $styles = Style::get()->all();


        return fractal()
             ->collection($styles)
            ->transformWith(new StyleTransformer)
            ->toArray();
    }

}