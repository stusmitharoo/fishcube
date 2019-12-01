<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;
use App\Models\Profile\ProfileDistrict;
use App\User;


class Style extends Model
{	
	public function profileDistricts()
	{
		return $this->hasMany(ProfileDistrict::class);
	}
	public function styles()
	{
		return $this->hasMany(Style::class);
	}
}