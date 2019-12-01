<?php

namespace App\Http\Controllers\Gallery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Gallery\GalleryHeader;
use App\Transformers\Gallery\GalleryHeaderTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class GalleryLinkController extends Controller
{

    public function headers(Request $request, $styleId, $districtId)
    {
        $user = $request->user();
        $headers = GalleryHeader::getConstructorHeaders($user->id, $styleId, $districtId);
        $headersCollection = $headers->getCollection();

      return fractal()
        ->collection($headersCollection)
        ->transformWith(new GalleryHeaderTransformer)
        ->paginateWith(new IlluminatePaginatorAdapter($headers))
        ->toArray();
    }
     
}