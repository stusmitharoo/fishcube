<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Model;
use App\User;

class VideoView extends Model
{
	protected $fillable = [
		'user_id',
		'ip',
	];

	public function scopeLatestByUser($query, User $user)
	{
		return $query->byUser($user)->orderBy('created_at', 'desc')->take(1);
	}

	public function scopeByIp($query, $ip)
	{
		return $query->where('ip', $ip)->orderBy('created_at', 'desc')->take(1);
	}

	public function scopeByUser($query, User $user)
	{
		return $query->where('user_id', $user->id);
	}
}