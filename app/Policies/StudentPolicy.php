<?php

namespace App\Policies;

use App\Models\User;

class StudentPolicy
{
    /**
     * Create a new policy instance.
     */
    /* public function __construct()
    {
        //
    } */
    public function surfe(User $user){
        return $user->roleable_type == 'App\Models\Student';
    }
}
