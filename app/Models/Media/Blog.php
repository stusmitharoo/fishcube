<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Model;
use App\Models\Card\Card;
use App\User;

class Blog extends Model
{
    public static function getUserBlogs($userId, $styleId, $districtId)
    {
      return self::where(['user_id' =>  $userId, 'district_id'=> $districtId, 'style_id'=> $styleId])->paginate(5);
    }

    public static function getBlogs($styleId, $districtId)
    {
      return self::where(['style_id'=> $styleId, 'district_id'=> $districtId])->paginate(5);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function card()
    {
    	return $this->belongsTo(Card::class);
    }

    public function getBlogThumbnail(Blog $blog)
    {
        $blogId = $blog->id;
        $cardImage = Card::blogThumbnail($blogId)->first();

        return '/images/cards/' . ($cardImage->image);
    }
}
