<?php

namespace App\Transformers\Fish;

use App\Models\Fish\CoarseFish;

class CoarseFishTransformer extends \League\Fractal\TransformerAbstract
{
	public function transform(CoarseFish $coarseFish)
	{
		return [
			'id' => $coarseFish->id,
			'name' => $coarseFish->name,
			'image' => $coarseFish->coarseFishImage(),
		];
	}
}