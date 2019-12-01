<?php

namespace App\Models\District;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class DistrictCanalLure extends Model
{
      use Searchable;
      
      public function canalLureImage()
    {
    	return $this->hasMany(CanalLureImage::class);
    }


     public function districtCanalLureImage()
    {
        return '/images/districts/' . ($this->image);
    }
}