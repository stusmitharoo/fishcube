<?php

namespace App\Models\District;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class DistrictCanal extends Model
{
      use Searchable;

      public function canalImage()
    {
    	return $this->hasMany(CanalImage::class);
    }


     public function districtCanalImage()
    {
        return '/images/districts/' . ($this->image);
    }
}
