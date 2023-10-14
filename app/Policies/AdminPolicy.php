<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    /**
     * Create a new policy instance.
     */
    /* public function __construct()
    {
        
    } */
    public function administrate(User $user){
        return $user->roleable_type == 'App\Models\Admin';
    }
}
