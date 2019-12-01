<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;
use App\Models\Card\Card;
use App\Http\Controllers\Controller;
use App\Transformers\Card\CardTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class WaterCardController extends Controller
{
    public function index(Request $request)
    {
        $districtId = $request->route('district');
        $fishId = $request->route('fish');
        $styleId = $request->route('style');

        $waterCards = Card::getCards($fishId, $districtId, $styleId);
      
        $waterCardsCollection = $waterCards->getCollection();

        return fractal()
           ->collection($waterCardsCollection)
           ->parseIncludes(['user'])
           ->transformWith(new CardTransformer)
           ->paginateWith(new IlluminatePaginatorAdapter($waterCards))
           ->toArray();
    }
}