<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    public function handle(Request $request, Closure $next, $role)
    {
        if(!Auth::check())
            return redirect($this->getRootUri($request->getRequestUri()));

        if ($request->user()->tipo == $role) {
            return $next($request);
        }

        return redirect($request->user()->getHomePage());
    }

    public function getRootUri($requestUri)
    {
        $rootUri = explode("/", $requestUri);

        if($rootUri[1] == "peluqueria" || $rootUri[1] == "admin")
            return $rootUri[1];

        return '/';
    }

}
