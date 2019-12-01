<?php

namespace App\Policies;

use App\User;
use App\Models\Gallery\GalleryPicture;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalleryPicturePolicy
{
    use HandlesAuthorization;

     public function touch(User $user,GalleryPicture $galleryPicture)
    {
        return $user->id === $galleryPicture->user_id;
    }
}
