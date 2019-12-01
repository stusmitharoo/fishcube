<?php  

namespace App\Transformers\District;

use App\Models\District\DistrictRiverLure;

class DistrictRiverLureTransformer extends \League\Fractal\TransformerAbstract
{
	protected $availableIncludes = [
				];

	public function transform(DistrictRiverLure $districtRiverLure)
	{
		return [
			'id' => $districtRiverLure->id,
			'name' => $districtRiverLure->name,
			'image' => $districtRiverLure->districtRiverLureImage(),
		];
	}
}