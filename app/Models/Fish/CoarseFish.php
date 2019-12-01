<?php

namespace App\Models\Fish;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class CoarseFish extends Model
{
    use Searchable;
    
    public function stillwaterImage()
    {
    	return $this->hasMany(StillwaterImage::class);
    }
    public function stillwaterLuremage()
    {
    	return $this->hasMany(StillwaterLureImage::class);
    }
    public function riverImage()
    {
    	return $this->hasMany(RiverImage::class);
    }
    public function riverLureImage()
    {
    	return $this->hasMany(RiverLureImage::class);
    }
    public function canalImage()
    {
    	return $this->hasMany(CanalImage::class);
    }
    public function canalLureImage()
    {
    	return $this->hasMany(CanalLure::class);
    }
    public function coarseFishImage()
    {
        return '/images/fish/' . ($this->image);
    }
}
