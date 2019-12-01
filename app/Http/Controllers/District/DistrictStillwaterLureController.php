<?php

namespace App\Http\Controllers\District;

use Illuminate\Http\Request;
use App\Models\District\DistrictStillwaterLure;
use App\Http\Controllers\Controller;
use App\Transformers\District\DistrictStillwaterLureTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class DistrictStillwaterLureController extends Controller
{
    public function district(DistrictStillwaterLure $districtStillwaterLure)
    {
    	$districtStillwaterLurePages = DistrictStillwaterLure::paginate(1);
    	$districtStillwaterLurePagesCollection = $districtStillwaterLurePages->getCollection();
    
        return fractal()
    		->collection($districtStillwaterLurePagesCollection)
    		->parseIncludes(['districtStillwaterLure'])
    		->transformWith(new DistrictStillwaterLureTransformer)
    		->paginateWith(new IlluminatePaginatorAdapter($districtStillwaterLurePages))
    		->toArray();
    }
    public function index(Request $request)
    {
        $districtStillwaterLures = DistrictStillwaterLure::get();
    
        return fractal()
            ->collection($districtStillwaterLures)
            ->parseIncludes(['districtStillwaterLure'])
            ->transformWith(new DistrictStillwaterLureTransformer)
            ->toArray();
    }
     public function getThreeStillwaterLures($firstStillwaterLure, $secondStillwaterLure, $thirdStillwaterLure){
      
      $districtStillwaterLures = DistrictStillwaterLure::find([$firstStillwaterLure,$secondStillwaterLure,$thirdStillwaterLure]);

        return fractal()
            ->collection($districtStillwaterLures)
            ->parseIncludes(['districtStillwaterLure',])
            ->transformWith(new DistrictStillwaterLureTransformer)
            ->toArray();
      
    }

    public function stillwaterLure(DistrictStillwaterLure $districtStillwaterLure)
    {
        $stillwaterLure = DistrictStillwaterLure::find($districtStillwaterLure);

        return fractal()
            ->collection($stillwaterLure)
            ->transformWith(new DistrictStillwaterLureTransformer)
            ->toArray();
    }
}