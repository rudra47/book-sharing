<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class UserAuth
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
        $segments = request()->segments();
        // dd($segments[0] == 'user');

        if((Auth::check()))
        {
            return $next($request);
        }
        else
        {
            if($request->ajax()) {
                if($request->wantsJson()) {
                    return json_encode(array('auth' => 0));
                } else {
                    return 0;
                }
            } else {
                if ($segments[0] == 'user') {
                    return redirect()->route("user.login");
                }else {
                    return redirect()->route("login");
                }
            }
        }
    }
}
