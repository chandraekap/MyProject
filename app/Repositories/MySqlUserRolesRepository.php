<?php
namespace App\Repositories;

use App\Contracts\RoleRepository;
use App\Contracts\UserRepository;
use App\Contracts\UserRolesRepository;
use App\UserRoles;

class MySqlUserRolesRepository implements UserRolesRepository
{
    private $user_roles;

    public function __construct(UserRoles $user_roles)
    {
        $this->user_roles = $user_roles;
    }


    public function create($user_id, $role_id)
    {
        $data = [
            'user_id' => $user_id,
            'role_id' => $role_id
        ];
        $result = $this->user_roles->create($data);

        return $result;
    }

    public function findByRoleName($role_name)
    {
        $role_repo = app(MySqlRoleRepository::class);
        $role = $role_repo->findByName($role_name);
        $result = $this->user_roles->where('role_id', '=', $role->id)->get();

        return $result;
    }
}