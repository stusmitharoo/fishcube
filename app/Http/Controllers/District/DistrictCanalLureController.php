<?php

namespace App\Http\Controllers\District;

use Illuminate\Http\Request;
use App\Models\District\DistrictCanalLure;
use App\Http\Controllers\Controller;
use App\Transformers\District\DistrictCanalLureTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class DistrictCanalLureController extends Controller
{
    public function district(DistrictCanalLure $districtCanalLure)
    {
    	$districtCanalLurePages = DistrictCanalLure::paginate(1);
    	$districtCanalLurePagesCollection = $districtCanalLurePages->getCollection();
    

    	return fractal()
    		->collection($districtCanalLurePagesCollection)
    		->parseIncludes(['districtCanalLure'])
    		->transformWith(new DistrictCanalLureTransformer)
    		->paginateWith(new IlluminatePaginatorAdapter($districtCanalLurePages))
    		->toArray();
    }
     public function index(Request $request)
    {
        $districtCanalLures = DistrictCanalLure::get();
    
        return fractal()
            ->collection($districtCanalLures)
            ->parseIncludes(['districtCanalLure'])
            ->transformWith(new DistrictCanalLureTransformer)
            ->toArray();
    }
    public function getThreeCanalLures($firstCanalLure, $secondCanalLure, $thirdCanalLure){
      
      $districtCanalLures = DistrictCanalLure::find([$firstCanalLure,$secondCanalLure,$thirdCanalLure]);

        return fractal()
            ->collection($districtCanalLures)
            ->parseIncludes(['districtCanalLure',])
            ->transformWith(new DistrictCanalLureTransformer)
            ->toArray();
      
    }
    public function canalLure(DistrictCanalLure $districtCanalLure)
    {
        $canalLure = DistrictCanalLure::find($districtCanalLure);

        return fractal()
            ->collection($canalLure)
            ->transformWith(new DistrictCanalLureTransformer)
            ->toArray();
    }
}