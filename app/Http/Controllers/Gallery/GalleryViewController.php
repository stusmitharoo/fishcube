<?php

namespace App\Http\Controllers\Gallery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gallery\GalleryHeader;
use App\Models\Gallery\GalleryPicture;
use App\Transformers\Gallery\GalleryHeaderTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Models\Profile\Style;
use App\User;
use Validation;
use Auth;

class GalleryViewController extends Controller
{
    public function choice()
    {
        return view('gallery.view.choice');
    }

    public function index(Style $style)
    {
        return view('gallery.list.index', compact('style'));
    }

    public function viewIndex(Style $style)
    {
        return view('gallery.view.index', compact('style'));
    }

    public function list(Request $request, $styleId, $districtId )
    {
        $galleryHeader = GalleryHeader::getListHeaders($styleId, $districtId);
      
        $galleryHeaderCollection = $galleryHeader->getCollection();

        return fractal()
           ->collection($galleryHeaderCollection)
           ->parseIncludes(['user'])
           ->transformWith(new GalleryHeaderTransformer)
           ->paginateWith(new IlluminatePaginatorAdapter($galleryHeader))
           ->toArray();
    }

    public function show(Request $request, GalleryHeader $galleryHeader)
    {
        $userId = $galleryHeader->user_id;
        $view = User::viewable($userId)->get();

        if(!$view->isEmpty()){

            $galleryPictures = GalleryPicture::getHeaderPictures($userId, $galleryHeader->id);
            return view('gallery.view.flipGuest', compact('galleryHeader', 'galleryPictures'));
        }

        return back()->withInfo('This gallery is private try searching for another.');
        
    }

    public function flip(Request $request, GalleryHeader $galleryHeader)
    {
        $user = Auth::user();
        $galleryPictures = GalleryPicture::getHeaderPictures($user->id, $galleryHeader->id);
        return view('gallery.view.flip', compact('galleryHeader', 'galleryPictures')); 
    }

    public function collage(GalleryHeader $galleryHeader)
    {
        $user = Auth::user();
        $galleryPictures = GalleryPicture::getHeaderPictures($user->id, $galleryHeader->id);

            return view('gallery.view.collage', compact('galleryPictures', 'galleryHeader'));
    }

    public function collageShow(GalleryHeader $galleryHeader)
    {
        $userId = $galleryHeader->user_id;
        $view = User::viewable($userId)->get();

        if(!$view->isEmpty()){

            $galleryPictures = GalleryPicture::getHeaderPictures($userId, $galleryHeader->id);

                return view('gallery.view.collageGuest', compact('galleryPictures', 'galleryHeader'));
        }

        return back()->withInfo('This gallery is private try searching for another.');
    }
    
}