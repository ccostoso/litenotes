<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class NotePolicy
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
    public function view(User $user, Note $note): Response
    {
        // dump($user);

        return $note->user->is(Auth::user()) || $note->is_public
        // $user->id === $note->user_id
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
    public function update(User $user, Note $note): Response
    {
        return $user->id === $note->user_id
        ? Response::allow()
        // : Response::deny('You do not have authorization to update this note.');
        : abort(403);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Note $note): Response
    {
        return $user->id === $note->user_id
        ? Response::allow()
        // : Response::deny('You do not have authorization to delete this note.');
        : abort(403);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Note $note): Response
    {
        return $user->id === $note->user_id
        ? Response::allow()
        // : Response::deny('You do not have authorization to restore this note.');
        : abort(403);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Note $note): Response
    {
        return $user->id === $note->user_id
        ? Response::allow()
        // : Response::deny('You do not have authorization to delete this note.');
        : abort(403);
    }
}
