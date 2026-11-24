<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Site content (products, gallery, settings data, leads, comments, contacts...):
 * full CRUD for Admin and Super Admin, no access for Content Writers.
 */
abstract class AdminContentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, Model $model): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Model $model): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Model $model): bool
    {
        return $user->isAdmin();
    }

    public function deleteAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Model $model): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Model $model): bool
    {
        return $user->isSuperAdmin();
    }

    // Relation manager actions (e.g. adding products to an LMS column, drag-to-reorder)
    public function associate(User $user, ?Model $model = null): bool
    {
        return $user->isAdmin();
    }

    public function associateAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function dissociate(User $user, ?Model $model = null): bool
    {
        return $user->isAdmin();
    }

    public function dissociateAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function reorder(User $user): bool
    {
        return $user->isAdmin();
    }
}
