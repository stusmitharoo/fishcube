<?php

namespace App\Http\Controllers\Gallery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\Gallery\GalleryCardTransformer;
use App\Transformers\Profile\FishTransformer;
use App\Transformers\Gallery\GalleryHeaderTransformer;
use App\Transformers\Gallery\GalleryPictureTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Models\Card\Card;
use App\Models\Gallery\GalleryHeader;
use App\Models\Gallery\GalleryPicture;
use App\Models\Profile\ProfileFish;
use App\User;
use Auth;

class ImageGalleryController extends Controller
{

    public function galleryCard(Request $request, $districtId ,$styleId)
    {
    	$user = $request->user();
        $selectorCards = Card::getGalleryCards($user->id, $districtId, $styleId );

    	return fractal()
    		->collection($selectorCards)
    		->transformWith(new GalleryCardTransformer)
    		->toArray();
    }

    public function locationFish(Request $request, $districtId ,$styleId)
    {
        $user = $request->user();
        $selectorCards = ProfileFish::getLocationFishs($user->id, $districtId, $styleId );

        return fractal()
            ->collection($selectorCards)
            ->transformWith(new FishTransformer)
            ->toArray();
    }

    public function header(Request $request)
    {
        $user = $request->user();
        $headers = GalleryHeader::getGalleryHeaders($user->id);
        $headersCollection = $headers->getCollection();

        return fractal()
            ->collection($headersCollection)
            ->parseIncludes([
                ])
            ->transformWith(new GalleryHeaderTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($headers))
            ->toArray();
    }

    public function galleryPicture(Request $request, $headerId)
    {
        $user = $request->user();
        $galleryPictures = GalleryPicture::getGalleryPictures($user->id, $headerId);
        $galleryPicturesCollection = $galleryPictures->getCollection();

        return fractal()
            ->collection($galleryPicturesCollection)
            ->parseIncludes([
                ])
            ->transformWith(new GalleryPictureTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($galleryPictures))
            ->toArray();
    }
}