<?php

namespace App\Http\Controllers\Gallery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Card\Card;
use App\Models\Profile\Style;
use App\Models\Gallery\GalleryHeader;
use Auth;

class GalleryController extends Controller
{

    public function view()
    {
        $user = Auth::user();
        $galleryHeaders = GalleryHeader::getHeaders($user->id);

        return view('gallery.gallery', compact('galleryHeaders'));
    }

    public function choice()
    {
    	return view('gallery.galleryChoice');
    }

    public function listChoice()
    {
        return view('gallery.list.choice');
    }

    public function constructor(Card $card)
    {
        return view('gallery.galleryConstructor', compact('card'));
    }

    public function style(Style $style)
    {
        return view('gallery.galleryStyle', compact('style'));
    }

    public function update(Request $request, $id)
    {
      
        $this->validate($request, [
          'gallery_header_id' => 'required|integer',
        ]);

        $galleryId = $request->route('id');
        
        $gallery = Card::findOrFail($galleryId);

        $gallery->gallery_header_id = $request->gallery_header_id;

        $gallery->save();

       return $gallery->toJson();
    }

    public function linkUpdate(Request $request, $galleryId)
    {
        Card::where('gallery_header_id', '=', $galleryId)->update(['gallery_header_id' => null]);

        return;
    }
    
}
