<?php

namespace LaravelEnso\Discussions\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use LaravelEnso\Core\Models\User;
use LaravelEnso\Discussions\Models\Discussion as Model;

class Discussion
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin() || $user->isSupervisor()) {
            return true;
        }
    }

    public function handle(User $user, Model $discussion)
    {
        return $user->id === (int) $discussion->created_by;
    }
}
