<?php  

namespace App\Transformers\Gallery;

use App\Models\Card\Card;


class GalleryScenaryTransformer extends \League\Fractal\TransformerAbstract
{

		
	public function transform(Card $card)
	{
		return [
			'id' => $card->id,
			'user_id' => $card->user_id,
			'name' => $card->display_description,
			'date' => $card->capture_date,
			'image' => $card->image,
		];
	}
}