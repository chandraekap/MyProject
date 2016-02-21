<?php
namespace App\Contracts;

use App\Role;

interface RoleRepository
{
    public function all();
    public function find($role_id);
    public function findByName($role_name);
    public function create($data);
    public function update(Role $role);
    public function delete(Role $role);
}