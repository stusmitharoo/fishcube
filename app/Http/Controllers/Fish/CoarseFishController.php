<?php

namespace App\Http\Controllers\fish;

use Illuminate\Http\Request;
use App\Models\Fish\CoarseFish;
use App\Http\Controllers\Controller;
use App\Transformers\Fish\CoarseFishTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class CoarseFishController extends Controller
{
    public function index()
    {
    	$coarseFishs = CoarseFish::paginate(1);
    	$coarseFishsCollection = $coarseFishs->getCollection();

    	return fractal()
    		->collection($coarseFishsCollection)
    		->parseIncludes(['coarseFish',])
    		->transformWith(new CoarseFishTransformer)
    		->paginateWith(new IlluminatePaginatorAdapter($coarseFishs))
    		->toArray();
    }

    public function coarseFish(CoarseFish $coarseFish)
    {
        $coarseFish = CoarseFish::find($coarseFish);

        return fractal()
            ->collection($coarseFish)
            ->transformWith(new CoarseFishTransformer)
            ->toArray();
    }

      public function getThreeCoarseFishs($firstFish, $secondFish, $thirdFish){
      
      $coarseFishs = CoarseFish::find([$firstFish,$secondFish,$thirdFish]);

        return fractal()
            ->collection($coarseFishs)
            ->parseIncludes(['coarseFish',])
            ->transformWith(new CoarseFishTransformer)
            ->toArray();
      
    }
}
