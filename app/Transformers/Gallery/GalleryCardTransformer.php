<?php  

namespace App\Transformers\Gallery;

use App\Models\Card\Card;
use App\Transformers\UserTransformer;


class GalleryCardTransformer extends \League\Fractal\TransformerAbstract
{
	protected $availableIncludes = [
					
				];

		
	public function transform(Card $card)
	{
		return [
			'id' => $card->id,
			'user_id' => $card->user_id,
			'style_id' => $card->style_id,
			'gallery_header_id' => $card->gallery_header_id,
			'video_id' => $card->video_id,
			'blog_id' => $card->blog_id,
	    	'profile_district_id' => $card->profile_district_id,
	    	'profile_fish_id' => $card->profile_fish_id,
			'district_id' => $card->district_id,
			'fish_id' => $card->fish_id,
			'lbs' => $card->lbs,
			'ozs' => $card->ozs,
			'dr' => $card->dr,
			'capture_date' => $card->capture_date,
			'profile_description' => $card->profile_description,
			'display_description' => $card->display_description,
			'image_id' => $card->image,
			'image' => $card->CardImage(),
		];
	}

	public function includeUser(Card $card)
	{
		return $this->item($card->user, new UserTransformer);
	}
}