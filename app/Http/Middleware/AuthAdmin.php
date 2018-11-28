<?php

namespace App\Http\Middleware;

use Closure;

class AuthAdmin
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
        if (auth()->guard('admin')->guest())
        {
            //if ($request->ajax() || $request->wantsJson())
            if ($request->wantsJson())
            {
                return response('Unauthorized', 401);
            }
            else
            {
                if ($request->ajax()) {
                    return response()->json([
                        'status' => '000000'
                    ]);
                } else {
                    return redirect()->guest('admin/login');
                }
            }
        }

        return $next($request);
    }
}
