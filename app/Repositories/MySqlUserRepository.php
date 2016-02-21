<?php
namespace App\Repositories;

use App\Contracts\RoleRepository;
use App\Contracts\UserRepository;
use App\Role;
use App\User;
use App\UserRoles;
use Illuminate\Support\Facades\Auth;

class MySqlUserRepository implements UserRepository
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all()
    {
        $result = $this->user->all();

        return $result;
    }

    public function find($user_id)
    {
        $result = $this->user->find($user_id);

        return $result;
    }

    public function findByEmail($email)
    {
        $result = $this->user->where('email', '=', $email)->first();

        return $result;
    }

    public function findUsersByRole($role_name, $sort_by, $order, $search_name = null)
    {
        $role_repo = app(RoleRepository::class);
        $role = $role_repo->findByName($role_name);
        $user = Auth::user();
        $filter_result = $role->users()->where('users.id', '!=', $user->id)->orderBy($sort_by, $order);
        if(!empty($search_name))
            $filter_result = $role->users()->where('first_name', 'LIKE', '%'.$search_name.'%')->orWhere('last_name', 'LIKE', '%'.$search_name.'%')
                ->where('users.id', '!=', $user->id)->orderBy($sort_by, $order);

        $result = $filter_result->paginate(10);
        return $result;
    }

    public function create($data)
    {
        $result = $this->user->create($data);
        $role_repo = app(MySqlRoleRepository::class);
        $role = $role_repo->findByName("buyer");
        $user_roles = app(MySqlUserRolesRepository::class);
        $user_roles->create($result->id, $role->id);

        return $result;
    }

    public function update(User $user)
    {

    }

    public function delete(User $user)
    {

    }

    public function addRole(User $user)
    {
        $role_repo = app(MySqlRoleRepository::class);
        $role = $role_repo->findByName('seller');
        $user_roles = app(MySqlUserRolesRepository::class);
        $user_roles->create($user->id, $role->id);

        return $user;
    }
}