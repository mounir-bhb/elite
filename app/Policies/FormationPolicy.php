<?php

namespace App\Policies;

use App\Models\Formation;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class FormationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Formation $formation): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Gate::allows('create', Teacher::class);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Formation $formation): bool
    {
        return Gate::allows('create', Teacher::class) && $formation->teacher_id === $user->roleable_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Formation $formation): bool
    {
        return Gate::allows('create', Teacher::class) && $formation->teacher_id === $user->roleable_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Formation $formation): bool
    {
        return Gate::allows('create', Teacher::class) && $formation->teacher_id === $user->roleable_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Formation $formation): bool
    {
        return Gate::allows('create', Teacher::class) && $formation->teacher_id === $user->roleable_id;
    }
}
