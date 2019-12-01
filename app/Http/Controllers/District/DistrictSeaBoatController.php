<?php

namespace App\Http\Controllers\District;

use Illuminate\Http\Request;
use App\Models\District\DistrictSeaBoat;
use App\Http\Controllers\Controller;
use App\Transformers\District\DistrictSeaBoatTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class DistrictSeaBoatController extends Controller
{
    public function district(DistrictSeaBoat $DistrictSeaBoat)
    {
    	$districtSeaBoatPages = DistrictSeaBoat::paginate(1);
    	$districtSeaBoatPagesCollection = $districtSeaBoatPages->getCollection();
    

    	return fractal()
    		->collection($districtSeaBoatPagesCollection)
    		->parseIncludes(['districtSeaBoat'])
    		->transformWith(new DistrictSeaBoatTransformer)
    		->paginateWith(new IlluminatePaginatorAdapter($districtSeaBoatPages))
    		->toArray();
    }
     public function index(Request $request)
    {
        $districtSeaBoats = DistrictSeaBoat::get();
    
        return fractal()
            ->collection($districtSeaBoats)
            ->parseIncludes(['districtSeaBoat'])
            ->transformWith(new DistrictSeaBoatTransformer)
            ->toArray();
    }
    public function getThreeSeaBoats($firstSeaBoat, $secondSeaBoat, $thirdSeaBoat){
      
      $districtSeaBoats = DistrictSeaBoat::find([$firstSeaBoat,$secondSeaBoat,$thirdSeaBoat]);

        return fractal()
            ->collection($districtSeaBoats)
            ->parseIncludes(['districtSeaBoat',])
            ->transformWith(new DistrictSeaBoatTransformer)
            ->toArray();
      
    }

    public function seaBoat(DistrictSeaBoat $districtSeaBoat)
    {
        $seaBoat = DistrictSeaBoat::find($districtSeaBoat);

        return fractal()
            ->collection($seaBoat)
            ->transformWith(new DistrictSeaBoatTransformer)
            ->toArray();
    }
}