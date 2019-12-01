<?php

namespace App\Models\District;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class DistrictStillwater extends Model
{
    use Searchable;

     public function stillwaterImage()
    {
    	return $this->hasMany(StillwaterImage::class);
    }

     public function districts()
    {
    	return $this->morphMany(District::class, 'districtable');
    }

     public function districtStillwaterImage()
    {
        return '/images/districts/' . ($this->image);
    }
}
