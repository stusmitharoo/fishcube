<?php

namespace App\Http\Controllers\District;

use Illuminate\Http\Request;
use App\Models\District\DistrictSeaShore;
use App\Http\Controllers\Controller;
use App\Transformers\District\DistrictSeaShoreTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class DistrictSeaShoreController extends Controller
{
    public function district(DistrictSeaShore $districtSeaShore)
    {
    	$districtSeaShorePages = DistrictSeaShore::paginate(1);
    	$districtSeaShorePagesCollection = $districtSeaShorePages->getCollection();
   

    	return fractal()
    		->collection($districtSeaShorePagesCollection)
    		->parseIncludes(['districtSeaShore'])
    		->transformWith(new DistrictSeaShoreTransformer)
    		->paginateWith(new IlluminatePaginatorAdapter($districtSeaShorePages))
    		->toArray();
    }
     public function index(Request $request)
    {
        $districtSeaShores = DistrictSeaShore::get();
    
        return fractal()
            ->collection($districtSeaShores)
            ->parseIncludes(['districtSeaShore'])
            ->transformWith(new DistrictSeaShoreTransformer)
            ->toArray();
    }
     public function getThreeSeaShores($firstSeaShore, $secondSeaShore, $thirdSeaShore){
      
      $districtSeaShores = DistrictSeaShore::find([$firstSeaShore,$secondSeaShore,$thirdSeaShore]);

        return fractal()
            ->collection($districtSeaShores)
            ->parseIncludes(['districtSeaShore',])
            ->transformWith(new DistrictSeaShoreTransformer)
            ->toArray();
      
    }

    public function seaShore(DistrictSeaShore $districtSeaShore)
    {
        $seaShore = DistrictSeaShore::find($districtSeaShore);

        return fractal()
            ->collection($seaShore)
            ->transformWith(new DistrictSeaShoreTransformer)
            ->toArray();
    }
}