<?php  

namespace App\Transformers\Gallery;

use App\Models\Gallery\GalleryPicture;


class GalleryPictureTransformer extends \League\Fractal\TransformerAbstract
{

		
	public function transform(GalleryPicture $galleryPicture)
	{
		return [
			'id' => $galleryPicture->id,
			'user_id' => $galleryPicture->user_id,
			'header_id' => $galleryPicture->gallery_header_id,
			'order_no' => $galleryPicture->order_no,
			'name' => $galleryPicture->name,
			'species' => $galleryPicture->species,
			'date' => $galleryPicture->date,
			'image' => $galleryPicture->pictureImage(),
		];
	}
}