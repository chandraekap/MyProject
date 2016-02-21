<?php
namespace App\Repositories;

use App\Contracts\RoleRepository;
use App\Role;

class MySqlRoleRepository implements RoleRepository
{
    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function all()
    {
        $result = $this->role->all();

        return $result;
    }

    public function find($role_id)
    {
        $result = $this->role->find($role_id);

        return $result;
    }

    public function findByName($role_name)
    {
        // TODO: Implement findByName() method.
        $result = $this->role->where('name', '=', $role_name)->first();

        return $result;
    }

    public function create($data)
    {
        $result = $this->role->create($data);

        return $result;
    }

    public function update(Role $role)
    {

    }

    public function delete(Role $role)
    {

    }
}