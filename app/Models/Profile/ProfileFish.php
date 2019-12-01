<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;
use App\Models\Profile\ProfileDistrict;
use App\Models\Profile\ProfileCard;
use App\Models\Profile\Style;
use App\User;

class ProfileFish extends Model
{	
    protected $fillable = ['sort_order'];


     public static function getLocationFishs($userId, $districtId, $styleId)
    {
      return self::where(['user_id' =>  $userId, 'district_id'=> $districtId, 'style_id'=> $styleId])->get();
    }

	public static function getProfileFishs($userId, $profileDistrictId, $styleId){
  
    return self::where([
    	'user_id' =>  $userId,
        'profile_district_id' => $profileDistrictId,
        'style_id' => $styleId])->orderBy('sort_order','asc')->paginate(1);
    }

    public static function getViewFishs($userId, $profileDistrictId, $styleId){
  
    return self::where([
        'user_id' =>  $userId,
        'profile_district_id' => $profileDistrictId,
        'style_id' => $styleId])->orderBy('sort_order','asc')->paginate(1);
    }

    public static function getOrderFishs($userId, $profileDistrictId){
  
    return self::where([
        'user_id' =>  $userId,
        'profile_district_id' => $profileDistrictId])->orderBy('sort_order','asc')->get();
    }

    public static function getSelectorFishs($userId, $profileDistrictId, $styleId){
  
    return self::where([
        'user_id' =>  $userId,
        'profile_district_id' => $profileDistrictId,
        'style_id' => $styleId])->get();
    }

    public static function getFishExists($userId, $fishId, $profileDistrictId){
  
    return self::where([
        'user_id' =>  $userId,
        'profile_district_id' => $profileDistrictId,
        'fish_id' => $fishId]);
    }

	public function user()
	{
		return $this->belongsTo(User::class);
	}

    public function profileDistrict()
    {
        return $this->belongsTo(ProfileDistrict::class);
    }

    public function profileCards()
    {
        return $this->hasMany(Card::class);
    }

	 public function fishImage()
    {
        return '/images/fish/' . ($this->image);
    }
}