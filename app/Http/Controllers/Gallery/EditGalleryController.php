<?php

namespace App\Http\Controllers\Gallery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gallery\GalleryHeader;
use App\Models\Gallery\GalleryPicture;
use App\User;
use Validation;

class EditGalleryController extends Controller
{
    public function index(GalleryHeader $galleryHeader)
    {
    	$this->authorize('touch', $galleryHeader);

      $galleryHeader->load('galleryPictures');
      return view('gallery.edit', compact('galleryHeader'));

    }

    public function update(Request $request, GalleryHeader $galleryHeader)
    {
      $this->authorize('touch', $galleryHeader);

      $this->validate($request, [
          'name' => 'required|max:30',
          'date' => 'required|date',
          'galleryPictures.*.name' => 'required|max:20',
          'galleryPictures.*.sort_order' => 'required',
          'galleryPictures.*.image' => 'required'
        ]);

      $galleryHeader->name = $request->name;
      $galleryHeader->date = $request->date;

      $galleryHeader->save();

      $galleryHeader->galleryPictures->each(function ($galleryPicture, $index) use ($request) {
          $galleryPicture->update(array_only($request->galleryPictures[$index], ['name', 'sort_order','image','date']));
      });

    }

    public function destroy(Request $request, GalleryPicture $galleryPicture)
    {
      $this->authorize('touch', $galleryPicture);

      $galleryPicture->delete();

      return;
    }

    public function destroyHeader(Request $request, GalleryHeader $galleryHeader)
    {
      $this->authorize('touch', $galleryHeader);

      $galleryHeader->delete();

      return;
    }
     
}