<?php

namespace App\Policies;

use App\User;
use App\Models\Profile\ProfileFish;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfileFishPolicy
{
    use HandlesAuthorization;

    public function touch(User $user, ProfileFish $profileFish)
    {
        return $user->id === $profileFish->user_id;
    }
}
