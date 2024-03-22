<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSharedTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
		$valid=config("auth.shared_token");
		if (empty($valid) || !is_string($valid) || strlen($valid) != 32){
			return abort(501);
		}
		if ($request['app_secret'] != $valid){
			return abort(401);			
		}
		unset($request['app_secret']);
        return $next($request);
    }
}
