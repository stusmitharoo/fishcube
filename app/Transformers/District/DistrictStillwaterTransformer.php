<?php  

namespace App\Transformers\District;

use App\Models\District\DistrictStillwater;

class DistrictStillwaterTransformer extends \League\Fractal\TransformerAbstract
{
	protected $availableIncludes = [
				];

	public function transform(DistrictStillwater $districtStillwater)
	{
		return [
			'id' => $districtStillwater->id,
			'name' => $districtStillwater->name,
			'image' => $districtStillwater->districtStillwaterImage(),
		];
	}
}