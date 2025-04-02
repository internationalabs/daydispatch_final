<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Auth\AuthorizedUsers;

class CheckActiveLogins
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('Authorized')->user();

        if ($user) {
            // Count current logins from the database
            $activeLogins = AuthorizedUsers::where('id', $user->id)->first()->is_login;

            // Check if it exceeds the allowed number_of_login
            if ($activeLogins <= $user->number_of_login) {
                return $next($request);
            } else {
                Auth::guard('Authorized')->logout();
                return redirect()->route('Auth.Forms')->with('Error!', 'You have reached the maximum number of allowed logins.');
            }
        }

        return $next($request);
    }
}
