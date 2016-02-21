<?php
namespace App\Services;


use App\Contracts\RoleRepository;
use App\Role;

class RoleService
{
    private $role_repo;

    public function __construct(RoleRepository $role_repo)
    {
        $this->role_repo = $role_repo;
    }

    public function getRoleByName($role_name)
    {
        $response = $this->role_repo->findByName($role_name);

        return $response;
    }

}