<?php  

namespace App\Transformers\profile;

use App\Models\Profile\Style;

class StyleTransformer extends \League\Fractal\TransformerAbstract
{

	public function transform(Style $style)
	{
		return [
			'id' => $style->id,
			'name' => $style->name,
		];
	}
}