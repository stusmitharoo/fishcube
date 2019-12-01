<?php  

namespace App\Transformers\Gallery;

use App\Models\Gallery\GalleryHeader;
use App\Transformers\UserTransformer;


class GalleryHeaderTransformer extends \League\Fractal\TransformerAbstract
{
	protected $availableIncludes = [
					'user'
				];

		
	public function transform(GalleryHeader $galleryHeader)
	{
		return [
			'id' => $galleryHeader->id,
			'user_id' => $galleryHeader->user_id,
			'card_id' => $galleryHeader->card_id,
			'name' => $galleryHeader->name,
			'date' => $galleryHeader->date,
			'image' => $galleryHeader->headerImage(),
		];
	}

	public function includeUser(GalleryHeader $galleryHeader)
	{
		return $this->item($galleryHeader->user, new UserTransformer);
	}
}