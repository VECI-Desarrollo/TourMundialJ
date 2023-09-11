<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function admin(User $user)
    {
        return $user->rol === 'admin';
    }

/////////////////// user watcher
    public function watcher(User $user)
    {
        return $user->rol === 'watcher';
    }



}
