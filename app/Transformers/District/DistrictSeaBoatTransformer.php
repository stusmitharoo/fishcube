<?php  

namespace App\Transformers\District;

use App\Models\District\DistrictSeaBoat;

class DistrictSeaBoatTransformer extends \League\Fractal\TransformerAbstract
{
	protected $availableIncludes = [
				];

	public function transform(DistrictSeaBoat $districtSeaBoat)
	{
		return [
			'id' => $districtSeaBoat->id,
			'name' => $districtSeaBoat->name,
			'image' => $districtSeaBoat->districtSeaBoatImage(),
		];
	}
}