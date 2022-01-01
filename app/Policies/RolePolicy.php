<?php

namespace App\Policies;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class RolePolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user): bool
    {
      return $this->isAdmin($this->getRoleId($user));
    }
    public function create(User $user) :bool
    {
        return $this->isAdmin($this->getRoleId($user));
    }
    public function delete(User $user) : bool
    {
        return $this->isAdmin($this->getRoleId($user));
    }
    private function isAdmin($roleId): bool
    {
        $roles = DB::table('roles')->where('id','=',$roleId)->get();
        $isAdmin = $roles[0];
        return $isAdmin->role == "Admin";
    }
    private function getRoleId(User $user)
    {
        return $user->role_id;
    }
}
