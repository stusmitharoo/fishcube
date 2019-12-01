<?php

namespace App\Http\Controllers\District;

use Illuminate\Http\Request;
use App\Models\District\DistrictStillwater;
use App\Http\Controllers\Controller;
use App\Transformers\District\DistrictStillwaterTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class DistrictStillwaterController extends Controller
{
    public function district(DistrictStillwater $districtStillwater)
    {
    	$districtStillwaterpages = DistrictStillwater::paginate(1);
    	$districtStillwaterpagesCollection = $districtStillwaterpages->getCollection();
    
        return fractal()
    		->collection($districtStillwaterpagesCollection)
    		->parseIncludes(['districtStillwater'])
    		->transformWith(new DistrictStillwaterTransformer)
    		->paginateWith(new IlluminatePaginatorAdapter($districtStillwaterpages))
    		->toArray();
    }
    public function index(Request $request)
    {
        $districtStillwaters = DistrictStillwater::get();
    
        return fractal()
            ->collection($districtStillwaters)
            ->parseIncludes(['districtStillwater'])
            ->transformWith(new DistrictStillwaterTransformer)
            ->toArray();
    }
     public function getThreeStillwaters($firstStillwater, $secondStillwater, $thirdStillwater){
      
      $districtStillwaters = DistrictStillwater::find([$firstStillwater,$secondStillwater,$thirdStillwater]);

        return fractal()
            ->collection($districtStillwaters)
            ->parseIncludes(['districtStillwater',])
            ->transformWith(new DistrictStillwaterTransformer)
            ->toArray();
      
    }

    public function stillwater(DistrictStillwater $districtStillwater)
    {
        $stillwater = DistrictStillwater::find($districtStillwater);

        return fractal()
            ->collection($stillwater)
            ->transformWith(new DistrictStillwaterTransformer)
            ->toArray();
    }
}