<?php

namespace App\Transformers\Fish;

use App\Models\Fish\SeaFish;

class SeaFishTransformer extends \League\Fractal\TransformerAbstract
{
	public function transform(SeaFish $seaFish)
	{
		return [
			'id' => $seaFish->id,
			'name' => $seaFish->name,
			'image' => $seaFish->seaFishImage(),
		];
	}
}