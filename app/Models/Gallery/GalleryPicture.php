<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery\GalleryHeader;
use App\User;

class GalleryPicture extends Model
{	
    protected $fillable = ['name', 'sort_order', 'image', 'date'];

    
	public static function getGalleryPictures($userId, $headerId){
        return self::where([
        	'user_id' =>  $userId,
            'gallery_header_id' => $headerId])->orderby('sort_order','asc')->paginate(1);
    }

    public static function getHeaderPictures($userId, $galleryHeaderId){
        return self::where([
            'user_id' =>  $userId,
            'gallery_header_id' => $galleryHeaderId])->get();
    }

    public function user()
	{
		return $this->belongsTo(User::class);
	}

    public function galleryHeader()
    {
        return $this->belongsTo(GalleryHeader::class);
    }

	 public function pictureImage()
    {
        return '/images/cards/' . ($this->image);
    }
}