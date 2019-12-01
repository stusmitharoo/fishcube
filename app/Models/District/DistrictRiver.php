<?php

namespace App\Models\District;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class DistrictRiver extends Model
{
    use Searchable;

      public function riverImage()
    {
    	return $this->hasMany(RiverImage::class);
    }

     public function districts()
    {
    	return $this->morphMany(District::class, 'districtable');
    }

     public function districtRiverImage()
    {
        return '/images/districts/' . ($this->image);
    }
}
