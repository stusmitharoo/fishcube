<?php

namespace App\Policies;

use App\User;
use App\Models\Gallery\GalleryHeader;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalleryHeaderPolicy
{
    use HandlesAuthorization;

     public function touch(User $user,GalleryHeader $galleryHeader)
    {
        return $user->id === $galleryHeader->user_id;
    }
}
