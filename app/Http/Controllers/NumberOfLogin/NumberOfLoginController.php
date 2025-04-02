<?php

namespace App\Http\Controllers\NumberOfLogin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Livewire\Component;
use Session;
use Auth;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Token;
use App\Models\NumberOfLogin;
use App\Models\Payments\PaymentSystem;
use Carbon\Carbon;
use App\Models\Settings\UserRolesList;


class NumberOfLoginController extends Controller
{
    public function NumberOfLogin()
	{
	    $slot = '';
	    $Payment_Switches = PaymentSystem::where('id', 6)->find(6); // Use first() to get the first record that matches the conditions
	    $User_Roles = UserRolesList::orderBy('id', 'ASC')->get();

	    // Set default value if $Payment_Switches is null
	    // $paymentValue = $Payment_Switches ? $Payment_Switches->Payment : 0;

	    return view('livewire.backend.numberoflogin.number-of-login', compact('slot', 'Payment_Switches', 'User_Roles'));
	}

   public function storeNumberOfLogin(Request $request)
	{
		$user_id = Auth::guard('Authorized')->user()->id;
	    $stripeToken = $request->input('stripeToken');
	    $amount = $request->input('amount') * 100;

	    Stripe::setApiKey(config('services.stripe.secret'));

	    try {
	        $charge = \Stripe\Charge::create([
	            'amount' => $amount,
	            'currency' => 'usd',
	            'description' => 'Test payment from daydispatch.test.',
	            'source' => $stripeToken,
	        ]);
	   
	        // Extract the calculated_statement_descriptor or use a default value
    		$calculatedStatementDescriptor = $charge->calculated_statement_descriptor ?? 'Not Available';
    		
		    // Insert the data into the database
		    $num = NumberOfLogin::create([
		        'user_id' => $user_id,
		        'full_name' => $request->full_name,
		        'number_of_login' => $request->number_of_login,
		        'amount' => $request->amount,
		        'payment_type' => $calculatedStatementDescriptor,
		        'transaction_id' => $charge->id,
		        'created_at' => Carbon::now(),
		    ]);

			$user = Auth::guard('Authorized')->user();

			if ($user) {
				$user->number_of_login = $request->number_of_login;
				$user->save();
			}

	        // Session::flash('Success!', 'Payment successful!');
	        return back()->with('Success!', "Payment successful!");
	    } catch (\Exception $e) {
	        Session::flash('Error!', $e->getMessage());
	        return back();
	    }
	}
}
