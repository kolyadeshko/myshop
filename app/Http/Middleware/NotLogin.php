<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NotLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // проверяем чтобы пользователь не был авторизован
        if (auth() -> check())
        {
            $request -> session() -> flash(
                'message',
                "Вы не можете перейти на страницу авторизации/регистрации по скольку вы уже авторизованы"
            );
            return back();
        }
        return $next($request);
    }
}
