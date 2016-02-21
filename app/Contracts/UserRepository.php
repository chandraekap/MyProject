<?php
namespace App\Contracts;

use App\User;

interface UserRepository
{
    public function all();
    public function find($user_id);
    public function create($data);
    public function update(User $user);
    public function delete(User $user);
}