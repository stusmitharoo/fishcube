<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;
use App\Models\Profile\ProfileFish;
use App\Models\Card\Card;
use App\Models\Profile\Style;
use App\User;

class ProfileDistrict extends Model
{	
	protected $fillable = ['order_no'];


	public static function getProfileDistricts($userId){
    return self::where([
    	'user_id' =>  $userId])->orderBy('order_no','asc')->get();
    }

    public static function getViewDistricts($userId){
    return self::where([
    	'user_id' =>  $userId])->orderBy('order_no','asc')->paginate(1);
    }

    public static function getSelectorDistricts($userId, $styleId){
    return self::where([
    	'user_id' =>  $userId, 
    	'style_id' => $styleId])->get();
    }

    public static function getDistrictExists($userId, $styleId, $districtId){
    return self::where([
    	'user_id' =>  $userId, 
    	'style_id' => $styleId,
    	'district_id' => $districtId]);
    }

    public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function style()
	{
		return $this->belongsTo(Style::class);
	}

	public function profileFishs()
	{
		return $this->hasMany(ProfileFish::class)->orderBy('sort_order','asc');
	}

	public function cards()
	{
		return $this->hasMany(Card::class);
	}

	 public function districtImage()
    {
        return '/images/districts/' . ($this->image);
    }
}