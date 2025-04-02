<?php

namespace App\Http\Middleware\Custom;

use App\Models\Payments\PaymentSystem;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class Authorized
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
//    public function handle(Request $request, Closure $next): Response|RedirectResponse
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('Authorized')->check()) {
            return redirect()->route('Auth.Forms')->with('Error!', 'Un-Authorized User!');
        }

        // Check user type and retrieve payment info
        $check_status = PaymentSystem::where('Payment_Type', 'Pay User For New Seats')->first();
        $payment_status = $check_status->Payment_Switch;
        if ($payment_status === 1) {
        } else {

            if (Auth::guard('Authorized')->user()->is_login === 0) {
                Auth::guard('Authorized')->logout();
                return redirect()->route('Auth.Forms');
            }
        }

        if (Auth::guard('Authorized')->user()->usr_type === 'Carrier') {
            $Payment_Info = PaymentSystem::where('Payment_Type', 'Carrier Registration Fee')->first();
        } else {
            $Payment_Info = PaymentSystem::where('Payment_Type', 'Broker Registration Fee')->first();
        }
        // if (($Payment_Info->Payment_Switch !== 1) && Auth::guard('Authorized')->user()->is_reg_fee_paid === 0) {
        //     return redirect()->route('User.Reg.Fee')->with(
        //         [
        //             'Error!' => 'Plz Paid Registration Fee \n to Continue!',
        //         ]
        //     );
        // }
        return $next($request);
    }
}
