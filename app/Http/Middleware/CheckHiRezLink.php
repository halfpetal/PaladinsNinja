<?php

namespace PaladinsNinja\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckHiRezLink
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->paladins_player_id == null || Auth::user()->paladins_player_id <= 0) {
            return redirect()->route('hirez-link.show');
        }

        if(\Route::currentRouteName() == 'hirez-link.show' && Auth::user()->paladins_player_id > 0) {
            return redirect('/');
        }

        return $next($request);
    }
}
