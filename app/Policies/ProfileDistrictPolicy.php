<?php

namespace App\Policies;

use App\User;
use App\Models\Profile\ProfileDistrict;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfileDistrictPolicy
{
    use HandlesAuthorization;

    public function touch(User $user, ProfileDistrict $profileDistrict)
    {
        return $user->id === $profileDistrict->user_id;
    }
}
