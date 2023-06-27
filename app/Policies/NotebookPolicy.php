<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Notebook;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class NotebookPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->id > 0;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Notebook $notebook): Response
    {
        // dump($user);

        return $notebook->user->is(Auth::user()) || $notebook->is_public
        // $user->id === $notebook->user_id
            ? Response::allow()
            : Response::denyAsNotFound('User note not found.');
            // : abort(403);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->id > 0;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Notebook $notebook): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Notebook $notebook): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Notebook $notebook): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Notebook $notebook): bool
    {
        //
    }
}
