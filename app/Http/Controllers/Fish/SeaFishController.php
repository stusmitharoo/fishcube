<?php

namespace App\Http\Controllers\Fish;

use Illuminate\Http\Request;
use App\Models\Fish\SeaFish;
use App\Http\Controllers\Controller;
use App\Transformers\Fish\SeaFishTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class SeaFishController extends Controller
{
    public function index()
    {
    	$seaFishs = SeaFish::paginate(1);
    	$seaFishsCollection = $seaFishs->getCollection();

    	return fractal()
    		->collection($seaFishsCollection)
    		->parseIncludes(['seaFish',])
    		->transformWith(new SeaFishTransformer)
    		->paginateWith(new IlluminatePaginatorAdapter($seaFishs))
    		->toArray();
    }

     public function getThreeSeaFishs($firstFish, $secondFish, $thirdFish){
      
      $seaFishs = SeaFish::find([$firstFish,$secondFish,$thirdFish]);

        return fractal()
            ->collection($seaFishs)
            ->parseIncludes(['seaFish',])
            ->transformWith(new SeaFishTransformer)
            ->toArray();
      
    }

    public function seaFish(SeaFish $seaFish)
    {
        $seaFish = SeaFish::find($seaFish);

        return fractal()
            ->collection($seaFish)
            ->transformWith(new SeaFishTransformer)
            ->toArray();
    }
}