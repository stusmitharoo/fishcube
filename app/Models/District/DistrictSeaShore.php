<?php

namespace App\Models\District;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class DistrictSeaShore extends Model
{
      use Searchable;
      
      public function seaShoreImage()
    {
    	return $this->hasMany(SeaShoreImage::class);
    }

     public function districts()
    {
    	return $this->morphMany(District::class, 'districtable');
    }

     public function districtSeaShoreImage()
    {
        return '/images/districts/' . ($this->image);
    }
}
