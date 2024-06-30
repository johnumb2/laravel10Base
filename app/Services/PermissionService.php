<?php

namespace App\Services;

use App\Models\Permission;
use App\Models\User;

class PermissionService
{
    /**
     * Check if the user has the given permission.
     *
     * @param User $user
     * @param string $permission
     *
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        // Grab the currently authenticated user
        $user = auth()->user();

        // Get the permission id from Permission model using the permission name
        $permissionId = Permission::where('name', $permission)->value('id');

        // Check if the user has the given permission
        return in_array($permissionId, $user->permissions()->pluck('permission_id')->toArray());
    }
}
