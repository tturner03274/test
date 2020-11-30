<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, User $targetUser)
    {
        // Cant delete yourself
        if ($user == $targetUser) return false;

        // Super Admin can delete anyone
        if ($user->hasRole('super-admin')) return true;

        // Admin cannot delete other admins or super admin
        if ($user->hasRole('admin') && !$targetUser->hasRole(['admin', 'super-admin'])) return true;

        return false;
    }

    public function activateSuspend(User $user, User $targetUser)
    {
        // Cant change your own status yourself
        if ($user == $targetUser) return false;

        // Super Admin can update anyone
        if ($user->hasRole('super-admin')) return true;

        // Admin cannot update other admins or super admin
        if ($user->hasRole('admin') && !$targetUser->hasRole(['admin', 'super-admin'])) return true;

        return false;
    }
}
