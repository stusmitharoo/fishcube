<?php

namespace App\Http\Controllers\District;

use Illuminate\Http\Request;
use App\Models\District\DistrictRiverLure;
use App\Http\Controllers\Controller;
use App\Transformers\District\DistrictRiverLureTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class DistrictRiverLureController extends Controller
{
    public function district(DistrictRiverLure $districtRiverLure)
    {
    	$districtRiverLurepages = DistrictRiverLure::paginate(1);
    	$districtRiverLurepagesCollection = $districtRiverLurepages->getCollection();
    

    	return fractal()
    		->collection($districtRiverLurepagesCollection)
    		->parseIncludes(['districtRiverLure'])
    		->transformWith(new DistrictRiverLureTransformer)
    		->paginateWith(new IlluminatePaginatorAdapter($districtRiverLurepages))
    		->toArray();
    }
     public function index(Request $request)
    {
        $districtRiverLures = DistrictRiverLure::get();
    
        return fractal()
            ->collection($districtRiverLures)
            ->parseIncludes(['districtRiverLure'])
            ->transformWith(new DistrictRiverLureTransformer)
            ->toArray();
    }
    public function getThreeRiverLures($firstRiverLure, $secondRiverLure, $thirdRiverLure){
      
      $districtRiverLures = DistrictRiverLure::find([$firstRiverLure,$secondRiverLure,$thirdRiverLure]);

        return fractal()
            ->collection($districtRiverLures)
            ->parseIncludes(['districtRiverLure',])
            ->transformWith(new DistrictRiverLureTransformer)
            ->toArray();
      
    }

    public function riverLure(DistrictRiverLure $districtRiverLure)
    {
        $riverLure = DistrictRiverLure::find($districtRiverLure);

        return fractal()
            ->collection($riverLure)
            ->transformWith(new DistrictRiverLureTransformer)
            ->toArray();
    }
}