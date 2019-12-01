<?php

namespace App\Models\Card;

use App\Models\Fish\CoarseFish;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile\ProfileDistrict;
use App\Models\Gallery\GalleryHeader;
use App\Models\Profile\ProfileFish;
use App\Models\Profile\Style;
use App\Models\Media\Blog;
use App\User;

class Card extends Model
{
  protected $fillable = ['image', 'lbs', 'ozs', 'dr', 'capture_date', 'display_description', 'profile_description', 'gallery_header_id', 'video_id', 'blog_id'];


	public function scopeWheightFirst($query)
	{
		return $query->orderBy('lbs', 'desc')->orderBy('ozs', 'desc')->orderBy('dr', 'desc')->orderBy('capture_date', 'desc');
	}

  public function scopeDateFirst($query)
  {
    return $query->orderBy('capture_date', 'desc')->orderBy('lbs', 'desc')->orderBy('ozs', 'desc')->orderBy('dr', 'desc');
  }

    public static function getCards($fishId, $districtId, $styleId)
    {
      return self::where(['fish_id' =>  $fishId, 'district_id'=> $districtId, 'style_id'=> $styleId])->wheightFirst()->paginate(1);
    }

    public static function getBlogCards($userId, $blogId)
    {
      return self::where(['user_id' =>  $userId, 'blog_id'=> $blogId,])->paginate(7);
    }

    public static function getBlogLinkCard($blogId)
    {
      return self::where(['blog_id'=> $blogId,])->get();
    }

    public static function getViewCards($userId, $profileDistrict, $profileFish,$style)
    {
      return self::where(['user_id' =>  $userId, 'district_id' => $profileDistrict, 'fish_id' =>  $profileFish, 'style_id' => $style])->wheightFirst()->paginate(1);
    }

    public static function getGalleryCards($userId, $districtId, $styleId)
    {
      return self::where(['user_id' =>  $userId, 'district_id'=> $districtId, 'style_id'=> $styleId])->dateFirst()->get();
    }

    public static function getScenaryImages($userId, $styleId)
     {
      return self::where(['user_id' =>  $userId, 'style_id' =>  $styleId])->get();
    }

    public static function getCardsCount($userId)
    {
      return self::where(['user_id' => $userId])->count();
    }

    public function scopeBlogThumbnail($query, $blogId)
  {
    return $query->where('blog_id', $blogId)->orderBy('created_at', 'desc');
  }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function galleryHeader()
    {
        return $this->belongsTo(GalleryHeader::class);
    }

     public function profileDistrict()
    {
        return $this->belongsTo(ProfileDistrict::class);
    }

     public function profileFish()
    {
        return $this->belongsTo(ProfileFish::class);
    }

    public function CardImage()
    {
       return '/images/cards/' . ($this->image);
    }

}
