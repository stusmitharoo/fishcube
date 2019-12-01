<?php  

namespace App\Transformers\District;

use App\Models\District\DistrictSeaShore;

class DistrictSeaShoreTransformer extends \League\Fractal\TransformerAbstract
{
	protected $availableIncludes = [
				];

	public function transform(DistrictSeaShore $districtSeaShore)
	{
		return [
			'id' => $districtSeaShore->id,
			'name' => $districtSeaShore->name,
			'image' => $districtSeaShore->districtSeaShoreImage(),
		];
	}
}