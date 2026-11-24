<?php

namespace App\Policies;

use App\Models\ActivityLog;
use App\Models\User;

/** Audit trail: Super Admin may read it; nobody may edit or delete entries (old ones are pruned automatically). */
class ActivityLogPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, ActivityLog $log): bool
    {
        return $user->isSuperAdmin();
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, ActivityLog $log): bool
    {
        return false;
    }

    public function delete(User $user, ActivityLog $log): bool
    {
        return false;
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }
}
