<?php

namespace App\Http\Controllers\District;

use Illuminate\Http\Request;
use App\Models\District\DistrictCanal;
use App\Http\Controllers\Controller;
use App\Transformers\District\DistrictCanalTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class DistrictCanalController extends Controller
{
    public function district(DistrictCanal $districtCanal)
    {
    	$districtCanalPages = DistrictCanal::paginate(1);
    	$districtCanalPagesCollection = $districtCanalPages->getCollection();
    

    	return fractal()
    		->collection($districtCanalPagesCollection)
    		->parseIncludes(['districtCanal', 'district'])
    		->transformWith(new DistrictCanalTransformer)
    		->paginateWith(new IlluminatePaginatorAdapter($districtCanalPages))
    		->toArray();
    }
    
     public function index(Request $request)
    {
        $districtCanals = DistrictCanal::get();
    
        return fractal()
            ->collection($districtCanals)
            ->parseIncludes([])
            ->transformWith(new DistrictCanalTransformer)
            ->toArray();
    }

     public function getThreeCanals($firstCanal, $secondCanal, $thirdCanal){
      
      $districtCanals = DistrictCanal::find([$firstCanal,$secondCanal,$thirdCanal]);

        return fractal()
            ->collection($districtCanals)
            ->parseIncludes(['districtCanal',])
            ->transformWith(new DistrictCanalTransformer)
            ->toArray();
      
    }

    public function canal(DistrictCanal $districtCanal)
    {
        $canal = DistrictCanal::find($districtCanal);

        return fractal()
            ->collection($canal)
            ->transformWith(new DistrictCanalTransformer)
            ->toArray();
    }
}