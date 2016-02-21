<?php
namespace App\Services;


use App\Contracts\UserRepository;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $user_repo;

    public function __construct(UserRepository $user_repo)
    {
        $this->user_repo = $user_repo;
    }

    public function doRegisterUser($data)
    {
        $excepts = ['_token', 'confirm_password'];
        $data = $data->except($excepts);
        $data['password'] = Hash::make($data['password']);
        $new_user = $this->user_repo->create($data);

        $response = [
            'status' => 200,
            'data'  => $new_user
        ];

        return $response;
    }

    public function attachUserRole(User $user)
    {
        if(empty($user))
            return $user;

        $user_with_roles = $this->user_repo->getRoles($user);

        return $user_with_roles;
    }

    public function getUsersByRole($role_name, $sort_by, $asc, $search_name = null)
    {
        $order = (empty($asc))?'asc':'desc';
        $users =  $this->user_repo->findUsersByRole($role_name, $sort_by, $order, $search_name);

        return $users;
    }

    public function getUserByEmail($email)
    {
        $response = $this->user_repo->findByEmail($email);

        return $response;
    }

    public function isSeller(User $user)
    {
        $is_seller = false;
        $roles = $user->roles;
        foreach ($roles as $role)
        {
            if($role->name === 'seller')
            {
                $is_seller = true;
                break;
            }
        }

        $user->setAttribute('is_seller', $is_seller);

        return $user;
    }

    public function addUserRole(User $user)
    {
        $response = $this->user_repo->addRole($user);

        return $response;
    }
}