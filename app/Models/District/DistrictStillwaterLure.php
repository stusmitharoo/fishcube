<?php

namespace App\Models\District;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class DistrictStillwaterLure extends Model
{
      use Searchable;
      
      public function stillwaterLureImage()
    {
    	return $this->hasMany(StillwaterLureImage::class);
    }

     public function districts()
    {
    	return $this->morphMany(District::class, 'districtable');
    }

     public function districtStillwaterLureImage()
    {
        return '/images/districts/' . ($this->image);
    }
}
