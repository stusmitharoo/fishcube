<?php  

namespace App\Transformers\District;

use App\Models\District\DistrictStillwaterLure;

class DistrictStillwaterLureTransformer extends \League\Fractal\TransformerAbstract
{
	protected $availableIncludes = [
				];

	public function transform(DistrictStillwaterLure $districtStillwaterLure)
	{
		return [
			'id' => $districtStillwaterLure->id,
			'name' => $districtStillwaterLure->name,
			'image' => $districtStillwaterLure->districtStillwaterLureImage(),
		];
	}
}