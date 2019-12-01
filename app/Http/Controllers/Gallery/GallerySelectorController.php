<?php

namespace App\Http\Controllers\Gallery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Gallery\GalleryHeader;
use App\Models\Gallery\GalleryPicture;
use App\Models\Card\Card;
use Validator;
Use Auth;

class GallerySelectorController extends Controller
{

     public function header(Request $request)
    {

        $this->validate($request, [
        'name' => 'required|max:30',
        'date' => 'required|date',
        'style_id' => 'required|integer',
        'district_id' => 'required|integer',

        //'image' => 'required|',
      ]);


      $header = new GalleryHeader;

      $header->name = $request->name;
      $header->date = $request->date;
      $header->image = $request->image;
      $header->style_id = $request->style_id;
      $header->district_id = $request->district_id;
      $header->user_id = Auth::user()->id;

      $header->save();

       return $header->toJson();
    }
    public function gallery(Request $request)
    {

        $this->validate($request, [
        'gallery_header_id' => 'required|integer',
        'sort_order' => 'required|integer',
        'date' => 'required|date',
        'name' => 'required|string',
        //'image' => 'required|',
      ]);


      $gallery = new GalleryPicture;

      $gallery->gallery_header_id = $request->gallery_header_id;
      $gallery->sort_order = $request->sort_order;
      $gallery->date = $request->date;
      $gallery->name = $request->name;
      $gallery->image = $request->image;
      $gallery->user_id = Auth::user()->id;

      $gallery->save();

       return $gallery->toJson();
    }

    public function update(Request $request, $id)
    {
      
        $this->validate($request, [
          'gallery_header_id' => 'required|integer',
        ]);

        $cardId = $request->route('id');
        
        $card = Card::findOrFail($cardId);

        $card->gallery_header_id = $request->gallery_header_id;

        $card->save();

       return $card->toJson();
    }

     
}