<?php

namespace App\Models\District;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class DistrictSeaBoat extends Model
{
      use Searchable;
      
      public function seaBoatCard()
    {
    	return $this->hasMany(SeaBoatCard::class);
    }

     public function districts()
    {
    	return $this->morphMany(District::class, 'districtable');
    }

     public function districtSeaBoatImage()
    {
        return '/images/districts/' . ($this->image);
    }
}
