<?php  

namespace App\Transformers\Media;

use App\Models\Media\Video;
use App\Transformers\UserTransformer;


class VideoTransformer extends \League\Fractal\TransformerAbstract
{
	protected $availableIncludes = [
					'user'
				];

		
	public function transform(Video $video)
	{
		return [
			'id' => $video->id,
			'user_id' => $video->user_id,
			'style_id' => $video->style_id,
			'district_id' => $video->district_id,
			'date' => $video->date,
			'title' => $video->title,
			'description' => $video->description,
			'thumbnail' => $video->getThumbnail(),

		];
	}

	public function includeUser(Video $video)
	{
		return $this->item($video->user, new UserTransformer);
	}
}