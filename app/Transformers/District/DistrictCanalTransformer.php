<?php  

namespace App\Transformers\District;

use App\Models\District\DistrictCanal;


class DistrictCanalTransformer extends \League\Fractal\TransformerAbstract
{
	protected $availableIncludes = [
				];

	public function transform(DistrictCanal $districtCanal)
	{
		return [
			'id' => $districtCanal->id,
			'name' => $districtCanal->name,
			'image' => $districtCanal->districtCanalImage(),
		];
	}
	
}