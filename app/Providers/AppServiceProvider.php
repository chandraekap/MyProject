<?php

namespace App\Providers;

use App\Contracts\MessageDetailRepository;
use App\Contracts\MessageRepository;
use App\Contracts\NotificationRepository;
use App\Contracts\RoleRepository;
use App\Contracts\UserRepository;
use App\Contracts\UserRolesRepository;
use App\Message;
use App\MessageDetail;
use App\Notification;
use App\Repositories\MySqlMessageDetailRepository;
use App\Repositories\MySqlMessageRepository;
use App\Repositories\MySqlNotificationRepository;
use App\Repositories\MySqlRoleRepository;
use App\Repositories\MySqlUserRepository;
use App\Repositories\MySqlUserRolesRepository;
use App\Role;
use App\Services\MessageService;
use App\Services\NotificationService;
use App\Services\RegistrationService;
use App\Services\RoleService;
use App\Services\UserService;
use App\User;
use App\UserRoles;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Bind Service
        $this->app->bind(UserService::class, function()
        {
            $user = new User();
            $user_repo = new MySqlUserRepository($user);

            return new UserService($user_repo);
        });

        $this->app->bind(RoleService::class, function()
        {
            $role = new Role();
            $role_repo = new MySqlRoleRepository($role);

            return new RoleService($role_repo);
        });

        $this->app->bind(MessageService::class, function()
        {
            $message = new Message();
            $message_repo = new MySqlMessageRepository($message);

            return new MessageService($message_repo);
        });

        $this->app->bind(NotificationService::class, function()
        {
            $notification = new Notification();
            $notification_repo = new MySqlNotificationRepository($notification);

            return new NotificationService($notification_repo);
        });

        //Bind Repository
        $this->app->bind(UserRepository::class, function()
        {
            $user = new User();

            return new MySqlUserRepository($user);
        });

        $this->app->bind(RoleRepository::class, function()
        {
            $role = new Role();

            return new MySqlRoleRepository($role);
        });

        $this->app->bind(UserRolesRepository::class, function()
        {
            $user_roles = new UserRoles();

            return new MySqlUserRolesRepository($user_roles);
        });

        $this->app->bind(MessageRepository::class, function()
        {
            $message = new Message();

            return new MySqlMessageRepository($message);
        });

        $this->app->bind(MessageDetailRepository::class, function()
        {
            $message_detail = new MessageDetail();

            return new MySqlMessageDetailRepository($message_detail);
        });

        $this->app->bind(NotificationRepository::class, function()
        {
            $notification = new Notification();

            return new MySqlNotificationRepository($notification);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
