<?php  

namespace App\Transformers\profile;

use App\Transformers\Profile\StyleTransformer;
use App\Models\Profile\ProfileDistrict;

class DistrictTransformer extends \League\Fractal\TransformerAbstract
{
	protected $availableIncludes = [
					'style'
				];


	public function transform(ProfileDistrict $profileDistrict)
	{
		return [
			'id' => $profileDistrict->id,
			'user_id' => $profileDistrict->user_id,
			'name' => $profileDistrict->name,
			'image' => $profileDistrict->districtImage(),
			'district_id' => $profileDistrict->district_id,
			'style_id' => $profileDistrict->style_id,
			'order_no' => $profileDistrict->order_no,
		];
	}

	public function includeStyle(ProfileDistrict $profileDistrict)
	{
		return $this->item($profileDistrict->style, new StyleTransformer);
	}
}