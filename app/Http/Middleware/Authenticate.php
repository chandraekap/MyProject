<?php

namespace App\Http\Middleware;

use App\Services\NotificationService;
use App\Services\UserService;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\View;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/login');
            }
        }

        $user = $this->auth->user();
        $user_service = app(UserService::class);
        $checked_user = $user_service->isSeller($user);

        $notification_service = app(NotificationService::class);
        $unread_notification = $notification_service->getUnreadNotificationCount($user);

        View::share(['user' => $checked_user , 'unread_notification' => $unread_notification]);

        return $next($request);
    }
}
