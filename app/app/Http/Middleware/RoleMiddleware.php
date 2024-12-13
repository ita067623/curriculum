<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (auth()->check() && auth()->user()->role == $role) {
            return $next($request);
        }

        // ロールが一致しない場合、リダイレクト
        return redirect('/')->with('error', '権限がありません。');
    }
}
