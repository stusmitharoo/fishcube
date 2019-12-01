<?php

namespace App\Policies;

use App\User;
use App\Models\Card\card;
use Illuminate\Auth\Access\HandlesAuthorization;

class CardPolicy
{
    use HandlesAuthorization;

    public function touch(User $user,Card $card)
    {
        return $user->id === $card->user_id;
    }
}
