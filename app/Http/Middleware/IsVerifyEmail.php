<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IsVerifyEmail
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
        if (!Auth::guard('Authorized')->user()->is_email_verified) {
            auth()->logout();
            return redirect()->route('Auth.Forms')
                    ->with('message', 'You need to confirm your account. We have sent you an activation code, please check your email.');
          }
        return $next($request);
    }
}
