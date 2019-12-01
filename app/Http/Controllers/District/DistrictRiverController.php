<?php

namespace App\Http\Controllers\District;

use Illuminate\Http\Request;
use App\Models\District\DistrictRiver;
use App\Http\Controllers\Controller;
use App\Transformers\District\DistrictRiverTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class DistrictRiverController extends Controller
{
    public function district(DistrictRiver $districtRiver)
    {
    	$districtRiverPages = DistrictRiver::paginate(1);
    	$districtRiverPagesCollection = $districtRiverPages->getCollection();
    

    	return fractal()
    		->collection($districtRiverPagesCollection)
    		->parseIncludes(['districtRiver'])
    		->transformWith(new DistrictRiverTransformer)
    		->paginateWith(new IlluminatePaginatorAdapter($districtRiverPages))
    		->toArray();
    }
     public function index(Request $request)
    {
        $districtRivers = DistrictRiver::get();
    
        return fractal()
            ->collection($districtRivers)
            ->parseIncludes(['districtRiver'])
            ->transformWith(new DistrictRiverTransformer)
            ->toArray();
    }
    public function getThreeRivers($firstRiver, $secondRiver, $thirdRiver){
      
      $districtRivers = DistrictRiver::find([$firstRiver,$secondRiver,$thirdRiver]);

        return fractal()
            ->collection($districtRivers)
            ->parseIncludes(['districtRiver',])
            ->transformWith(new DistrictRiverTransformer)
            ->toArray();
      
    }

    public function river(DistrictRiver $districtRiver)
    {
        $river = DistrictRiver::find($districtRiver);

        return fractal()
            ->collection($river)
            ->transformWith(new DistrictRiverTransformer)
            ->toArray();
    }
}