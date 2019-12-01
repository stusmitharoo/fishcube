<?php  

namespace App\Transformers\District;

use App\Models\District\DistrictRiver;

class DistrictRiverTransformer extends \League\Fractal\TransformerAbstract
{
	protected $availableIncludes = [
				];

	public function transform(DistrictRiver $districtRiver)
	{
		return [
			'id' => $districtRiver->id,
			'name' => $districtRiver->name,
			'image' => $districtRiver->districtRiverImage(),
		];
	}
}