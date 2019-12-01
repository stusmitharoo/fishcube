<?php

namespace App\Models\Fish;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class SeaFish extends Model
{
    use Searchable;
    
    public function seaShoreImage()
    {
    	return $this->hasMany(SeaShoreImage::class);
    }
    public function seaBoatImage()
    {
    	return $this->hasMany(SeaBoatImage::class);
    }
    public function seaFishImage()
    {
        return '/images/fish/' . ($this->image);
    }
}
