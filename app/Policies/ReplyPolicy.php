<?php

namespace App\Policies;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Reply $reply)
    {
        return $user->id === $reply->user_id || $user->isAdmin();
    }

    public function delete(User $user, Reply $reply)
    {
        return $user->id === $reply->user_id || $user->isAdmin();
    }
}