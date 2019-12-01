<?php

namespace App\Policies;

use App\User;
use App\Models\Media\Blog;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    public function touch(User $user, Blog $blog)
    {
        return $user->id === $blog->user_id;
    }
}
