<?php

namespace App\Models\District;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class DistrictRiverLure extends Model
{
      use Searchable;
      
      public function riverLureImage()
    {
    	return $this->hasMany(RiverLureImage::class);
    }

     public function districts()
    {
    	return $this->morphMany(District::class, 'districtable');
    }

     public function districtRiverLureImage()
    {
        return '/images/districts/' . ($this->image);
    }
}
