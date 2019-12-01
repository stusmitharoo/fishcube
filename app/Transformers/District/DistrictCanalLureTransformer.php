<?php  

namespace App\Transformers\District;

use App\Models\District\DistrictCanalLure;

class DistrictCanalLureTransformer extends \League\Fractal\TransformerAbstract
{
	protected $availableIncludes = [
				];

	public function transform(DistrictCanalLure $districtCanalLure)
	{
		return [
			'id' => $districtCanalLure->id,
			'name' => $districtCanalLure->name,
			'image' => $districtCanalLure->districtCanalLureImage(),
		];
	}

}