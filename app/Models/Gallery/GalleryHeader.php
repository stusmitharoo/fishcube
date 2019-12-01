<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery\GalleryPicture;
use App\Models\Card\Card;
use App\User;

class GalleryHeader extends Model
{	

    public static function getGalleryHeaders($userId){
        return self::where([
            'user_id' =>  $userId])->paginate(1);
    }

    public static function getListHeaders($styleId, $districtId){
        return self::where([
            'style_id' =>  $styleId,
            'district_id' =>  $districtId])->paginate(5);
    }

    public static function getConstructorHeaders($userId, $styleId, $districtId){
        return self::where([
            'user_id' =>  $userId,
            'style_id' =>  $styleId,
            'district_id' =>  $districtId])->paginate(5);
    }

    public static function getHeaders($userId){
        return self::where([
            'user_id' =>  $userId])->get();
    }

    public function user()
	{
		return $this->belongsTo(User::class);
	}

    public function card()
    {
        return $this->hasMany(Card::class);
    }

    public function galleryPictures()
    {
        return $this->hasMany(GalleryPicture::class)->orderBy('sort_order', 'asc');
    }

	 public function headerImage()
    {
        return '/images/cards/' . ($this->image);
    }
}