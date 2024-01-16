<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPermissions
{
    /**
     * Give permissions to the user.
     *
     * @param  array  $permissions
     * @return static
     */
    public function givePermissionsTo(...$permissions): static
    {
        // Retrieve permission models based on provided names
        $permissions = $this->getAllPermissions($permissions);

        // If no permissions were found, return the user instance as is
        if($permissions === null) {
            return $this;
        }

        // Associate and save the permissions with the user
        $this->permissions()->saveMany($permissions);

        return $this;
    }

    /**
     * Withdraw permissions from the user.
     *
     * @param  array  $permissions
     * @return static
     */
    public function withdrawPermissionsTo(...$permissions): static
    {
        // Retrieve permission models based on provided names
        $permissions = $this->getAllPermissions($permissions);

        // Detach the specified permissions from the user
        $this->permissions()->detach($permissions);

        return $this;
    }

    /**
     * Refresh user permissions.
     *
     * @param  array  $permissions
     * @return HasPermissions
     */
    public function refreshPermissions(...$permissions): HasPermissions
    {
        // Detach all existing permissions
        $this->permissions()->detach();

        // Give new permissions to the user
        return $this->givePermissionsTo($permissions);
    }

    /**
     * Check if the user has a specific permission.
     *
     * @param string $permission
     * @return bool
     */
    public function hasPermissionTo(string $permission): bool
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    /**
     * Check if the user has a specific permission through roles.
     *
     * @param  string  $permission
     * @return bool
     */
    public function hasPermissionThroughRole($permission): bool
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the user has a specific role.
     *
     * @param  string  ...$roles
     * @return bool
     */
    public function hasRole(...$roles): bool
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Define the many-to-many relationship with roles.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    /**
     * Define the many-to-many relationship with permissions.
     *
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    /**
     * Check if the user has a specific permission.
     *
     * @param  string  $permission
     * @return bool
     */
    protected function hasPermission($permission): bool
    {
        return (bool) $this->permissions->where('name', $permission->name)->count();
    }

    /**
     * Retrieve permission models based on provided names.
     *
     * @param  array  $permissions
     * @return mixed
     */
    protected function getAllPermissions(array $permissions): mixed
    {
        return Permission::whereIn('name', $permissions)->get();
    }
}
