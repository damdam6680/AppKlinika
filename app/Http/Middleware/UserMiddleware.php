<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Sprawdzenie, czy użytkownik jest zalogowany
        if (auth()->check()) {

            // Sprawdzenie, czy użytkownik ma rolę administratora (id_role = 1)
            if (auth()->user()->is_admin) {
                return $next($request);
            }

            // Przekierowanie użytkownika na odpowiednią stronę lub obsłużenie braku dostępu dla administratora
            return redirect()->route('admin.access.denied');
        }

        // Przekierowanie użytkownika na stronę logowania lub inny odpowiednią obsługę braku dostępu
        return redirect()->route('login');
    }
}
