<?php

namespace App\Policies;

use App\Enums\PermissionType;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewAny(Admin $admin){
        return $admin->hasPermissionTo(PermissionType::VIEW_ADMIN);
    }

    public function view(Admin $admin){
        return $admin->hasPermissionTo(PermissionType::VIEW_ADMIN);
    }

    public function create(Admin $admin){
        return $admin->hasPermissionTo(PermissionType::CREATE_ADMIN);
    }

    public function update(Admin $admin){
        return $admin->hasPermissionTo(PermissionType::UPDATE_ADMIN);
    }

    public function delete(Admin $admin){
        return $admin->hasPermissionTo(PermissionType::DELETE_ADMIN);
    }
}
