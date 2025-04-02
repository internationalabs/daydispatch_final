<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AgentPermission
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        if (Auth::guard('Agent')->check() && auth()->user()->permissions->contains('permission_name', $permission)) 
        {
            return $next($request);
        }
        // return abort(403, 'Unauthorized');
        return redirect()->route('Auth.Agent.Forms')->with('Error!', 'Un-Authorized Agent!');
    }
}
