<?php

namespace App\Policies;

use App\Models\GasRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GasRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('outlet-manager');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GasRequest $gasRequest): bool
    {
        return $user->outlet_id == $gasRequest->outlet_id && $user->hasRole('outlet-manager'); 
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GasRequest $gasRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GasRequest $gasRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GasRequest $gasRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GasRequest $gasRequest): bool
    {
        return false;
    }
}
