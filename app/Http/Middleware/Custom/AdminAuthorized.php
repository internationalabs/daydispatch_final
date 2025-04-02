<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuthorized
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('Admin')->check()) {
            return redirect()->route('Auth.Admin.Forms')->with('Error!', 'Un-Authorized Admin!');
        }
        return $next($request);
    }
}
