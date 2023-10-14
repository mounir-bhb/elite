<?php

namespace App\Policies;

use App\Models\User;

class TeacherPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function create(User $user){
        return $user->roleable_type == 'App\Models\Teacher';
    }
}
