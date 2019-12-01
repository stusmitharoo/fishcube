<?php  

namespace App\Transformers\profile;

use App\Transformers\Profile\DistrictTransformer;
use App\Transformers\Profile\StyleTransformer;
use App\Models\Profile\ProfileDistrict;
use App\Models\Profile\ProfileFish;

class FishTransformer extends \League\Fractal\TransformerAbstract
{
	protected $availableIncludes = [
					'district'
				];

	public function transform(ProfileFish $profileFish)
	{
		return [
			'id' => $profileFish->id,
			'user_id' => $profileFish->user_id,
			'district_id' => $profileFish->district_id,
			'profile_district_id' => $profileFish->profile_district_id,
			'fish_id' => $profileFish->fish_id,
			'name' => $profileFish->name,
			'style_id' => $profileFish->style_id,
			'sort_order' => $profileFish->sort_order,
			'image' => $profileFish->fishImage(),
			
		];
	}
	public function includeDistrict(ProfileFish $profileFish)
	{
		return $this->item($profileFish->district, new DistrictTransformer);
	}

}