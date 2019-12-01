<?php

namespace App\Policies;

use App\User;
use App\Models\Media\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    public function touch(User $user, Video $video)
    {
        return $user->id === $video->user_id;
    }
}
