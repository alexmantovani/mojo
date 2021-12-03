<?php

namespace App\Policies;

use App\User;
use App\Solution;
use Illuminate\Auth\Access\HandlesAuthorization;

class SolutionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Solution $solution)
    {
        return $user->id == $solution->user_id;
    }
}
