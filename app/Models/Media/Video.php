<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Media\VideoView;

class Video extends Model
{
	protected $fillable = [
		'title',
		'description',
		'uid',
		'video_filename',
		'video_id',
		'processed',
		'allow_votes',
		'processed_percentage',
		'style_id',
		'district_id',
		'user_id'
	];

	public static function getUserVideos($userId, $styleId, $districtId)
    {
      return self::where(['user_id' =>  $userId, 'district_id'=> $districtId, 'style_id'=> $styleId])->paginate(5);
    }

    public static function getVideos($styleId, $districtId)
    {
      return self::where(['style_id'=> $styleId, 'district_id'=> $districtId])->paginate(5);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function views()
    {
        return $this->hasMany(VideoView::class);
    }

    public function isProcessed()
    {
    	return $this->processed;
    }

    public function getThumbnail()
    {
    	if(!$this->isProcessed()) {
    		return config('amazon.buckets.videos') . '/default.jpg';
    	}

    	    return config('amazon.buckets.videos') . '/' . $this->video_id . '_1.jpg';

    }

    public function getStreamUrl()
    {
        return config('amazon.buckets.videos') . '/' . $this->video_id . '.mp4';
    }

    public function viewCount()
    {
        return $this->views->count();
    }
    
    public static function getVideosCount($userId)
    {
      return self::where(['user_id' => $userId])->count();
    }
}
