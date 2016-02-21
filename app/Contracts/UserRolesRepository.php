<?php
namespace App\Contracts;

interface UserRolesRepository
{
    public function create($user_id, $role_id);
}