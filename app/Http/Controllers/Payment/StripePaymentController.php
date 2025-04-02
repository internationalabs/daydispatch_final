<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Auth\AuthorizedUsers;
use App\Models\Payments\DispatchOrderFee;
use App\Models\Payments\SubscriptionFee;
use App\Models\Payments\UserInvoices;
use App\Models\Payments\UserRegFee;
use App\Services\ListingServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\View\View;

class StripePaymentController extends Controller
{
    protected ListingServices $listingServices;

    public function __construct(ListingServices $listingServices)
    {
        $this->listingServices = $listingServices;
    }

    public function stripeRegistrationFee(Request $request): Redirector|Application|RedirectResponse
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            DB::beginTransaction();

            $session = Session::create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Registration Fee For Day Dispatch',
                        ],
                        'unit_amount' => ((float)$request->Reg_Fee) * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('Stripe.Success', ['User_ID' => $request->User_ID]),
                'cancel_url' => route('Stripe.Cancel', []),
            ]);

            $UserRegFee = new UserRegFee();
            $UserRegFee->Payment_ID = $session->id;
            $UserRegFee->Payment = $request->Reg_Fee;
            $UserRegFee->user_id = $request->User_ID;

            $UserRegFee->save();

            DB::commit();

            return redirect($session->url);
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->with('Error!', 'Something went wrong! Please try again.');
        }
    }

    public function success(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $UserRegFee = UserRegFee::where('user_id', $request->User_ID)->firstOrFail();

            if (!$UserRegFee) {
                throw new NotFoundHttpException();
            }

            if ($UserRegFee->status === 0) {
                $UserRegFee->status = 1;
                $UserRegFee->update();

                $User_Info = AuthorizedUsers::where('id', $UserRegFee->user_id)->first();
                $User_Info->is_reg_fee_paid = 1;
                $User_Info->update();

                $User_Invoice = new UserInvoices();
                $User_Invoice->Payment_Type = 'Registration Fee';
                $User_Invoice->Transaction_ID = $UserRegFee->Payment_ID;
                $User_Invoice->Status = 1;
                $User_Invoice->Payment = $UserRegFee->Payment;
                $User_Invoice->user_id = $UserRegFee->user_id;

                $User_Invoice->save();
            }

            DB::commit();

            // return view('responses.checkout-success', compact('UserRegFee'))->layout('layouts.payment');
            return redirect()->route('checkout.success')->with('UserRegFee', $UserRegFee);
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->with('Error!', 'Something went wrong! Please try again.');
        }
    }

    public function cancel(): RedirectResponse
    {
        $user_id = Auth::guard('Agent')->user()->id;

        try {
            DB::beginTransaction();

            UserRegFee::where('user_id', $user_id)->where('status', 0)->delete();

            DB::commit();

            return back()->with('Error!', 'Something went wrong! Please try again.');
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->with('Error!', 'Something went wrong! Please try again.');
        }
    }

    public function DispatchOrderFee($Amount, $User_ID, $Order_ID): Redirector|Application|RedirectResponse
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            DB::beginTransaction();

            $session = Session::create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Registration Fee For Day Dispatch',
                        ],
                        'unit_amount' => ((float)$Amount) * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('Dispatch.Stripe.Success', ['User_ID' => $User_ID]),
                'cancel_url' => route('Dispatch.Stripe.Cancel', []),
            ]);

            $DispatchOrderFee = new DispatchOrderFee();
            $DispatchOrderFee->Payment_ID = $session->id;
            $DispatchOrderFee->Payment = $Amount;
            $DispatchOrderFee->user_id = $User_ID;
            $DispatchOrderFee->order_id = $Order_ID;

            $DispatchOrderFee->save();

            DB::commit();

            return redirect($session->url);
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->with('Error!', 'Something went wrong! Please try again.');
        }
    }

    public function DispatchOrderFeeSuccess(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $DispatchOrderFee = DispatchOrderFee::where('user_id', $request->User_ID)->first();
            $DispatchOrderFee->status = 1;
            $DispatchOrderFee->update();

            $User_Invoice = new UserInvoices();
            $User_Invoice->Payment_Type = 'Dispatching Fee';
            $User_Invoice->Transaction_ID = $DispatchOrderFee->Payment_ID;
            $User_Invoice->Status = 1;
            $User_Invoice->Payment = $DispatchOrderFee->Payment;
            $User_Invoice->user_id = $DispatchOrderFee->user_id;

            $User_Invoice->save();

            if ($this->listingServices->assignDispatch()) {
                DB::commit();
                return redirect()->route('Dispatch.Listing')->with('Success!', "Your Listing has been Dispatched Successfully!");
            }

            DB::rollBack();
            return back()->with('Error!', 'Order Not Dispatched!');
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->with('Error!', 'Something went wrong! Please try again.');
        }
    }

    public function DispatchOrderFeeCancel(): RedirectResponse
    {
        $user_id = Auth::guard('Agent')->user()->id;

        try {
            DB::beginTransaction();

            DispatchOrderFee::where('user_id', $user_id)->where('status', 0)->delete();

            DB::commit();

            return back()->with('Error!', 'Something went wrong! Please try again.');
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->with('Error!', 'Something went wrong! Please try again.');
        }
    }

    public function LoadBoardSubscription($Amount, $User_ID, $Package_ID): Redirector|Application|RedirectResponse
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            DB::beginTransaction();

            $session = Session::create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Subscription Fee For ' . $Package_ID . ' of Day Dispatch ',
                        ],
                        'unit_amount' => ((float)$Amount) * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('package.success.payment'),
                'cancel_url' => route('package.cancel.payment'),
            ]);

            $UserSubscription = new SubscriptionFee();
            $UserSubscription->Payment_ID = $session->id;
            $UserSubscription->Payment = $Amount;
            $UserSubscription->user_id = $User_ID;
            $UserSubscription->package_id = $Package_ID;

            $UserSubscription->save();

            DB::commit();

            return redirect($session->url);
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->with('Error!', 'Something went wrong! Please try again.');
        }
    }

    public function SubscriptionSuccess(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $UserSubscription = SubscriptionFee::where('user_id', $request->User_ID)->first();
            $UserSubscription->status = 1;
            $UserSubscription->update();

            $User_Invoice = new UserInvoices();
            $User_Invoice->Payment_Type = 'Subscription Fee';
            $User_Invoice->Transaction_ID = $UserSubscription->Payment_ID;
            $User_Invoice->Status = 1;
            $User_Invoice->Payment = $UserSubscription->Payment;
            $User_Invoice->user_id = $UserSubscription->user_id;

            $User_Invoice->save();

            DB::commit();

            return redirect()->route('LoadBoard')->with('Success!', "Your Subscription has been activated Successfully!");
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->with('Error!', 'Something went wrong! Please try again.');
        }
    }

    public function SubscriptionCancel(): RedirectResponse
    {
        $user_id = Auth::guard('Agent')->user()->id;

        try {
            DB::beginTransaction();

            SubscriptionFee::where('user_id', $user_id)->where('status', 0)->delete();

            DB::commit();

            return back()->with('Error!', 'Something went wrong! Please try again.');
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->with('Error!', 'Something went wrong! Please try again.');
        }
    }

}
