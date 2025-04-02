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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Throwable;

class PayPalPaymentController extends Controller
{
    protected ListingServices $listingServices;

    public function __construct(ListingServices $listingServices)
    {
        $this->listingServices = $listingServices;
    }

    /**
     * @throws Throwable
     */
    public function handlePayment(Request $request): Redirector|Application|RedirectResponse
    {
        $provider = new PayPalClient([]);
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);

        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => 'USD',
                        'value' => ((float)$request->Reg_Fee)
                    ]
                ]
            ],
            'application_context' => [
                'cancel_url' => route('cancel.payment'),
                'return_url' => route('success.payment')
            ]
        ]);

        if ($order['status'] === 'CREATED') {
            try {
                DB::beginTransaction();

                $UserRegFee = new UserRegFee();
                $UserRegFee->Payment_ID = $order['id'];
                $UserRegFee->Payment = $request->Reg_Fee;
                $UserRegFee->user_id = $request->User_ID;
                $UserRegFee->save();

                DB::commit();

                return redirect($order['links'][1]['href']);
            } catch (Throwable $e) {
                DB::rollBack();
                return back()->with('Error!', 'Something went wrong! Please try again.');
            }
        }

        return back()->with('Error!', 'Something went wrong! Please try again.');
    }

    public function paymentCancel(Request $request): RedirectResponse
    {
        if ($request->token) {
            try {
                DB::beginTransaction();

                UserRegFee::where('Payment_ID', $request->token)
                    ->update(['status' => 0]);

                DB::commit();

                return back()->with('Warning!', 'Your payment has been canceled!');
            } catch (Throwable $e) {
                DB::rollBack();
                return back()->with('Error!', 'Something went wrong! Please try again.');
            }
        }

        return back()->with('Error!', 'Your payment has not been canceled!');
    }

    /**
     * @throws Throwable
     */
    public function paymentSuccess(Request $request): RedirectResponse
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            try {
                DB::beginTransaction();

                UserRegFee::where('Payment_ID', $response['id'])
                    ->update(['status' => 1]);

                $User_Info = AuthorizedUsers::where('id', $user_id)->first();
                $User_Info->is_reg_fee_paid = 1;
                $User_Info->update();

                $UserRegFee = UserRegFee::where('Payment_ID', $response['id'])->first();

                $User_Invoice = new UserInvoices();
                $User_Invoice->Payment_Type = 'Registration Fee';
                $User_Invoice->Transaction_ID = $response['id'];
                $User_Invoice->Status = 1;
                $User_Invoice->Payment = $UserRegFee->Payment;
                $User_Invoice->user_id = $UserRegFee->user_id;
                $User_Invoice->save();

                DB::commit();

                return view('responses.checkout-success', compact('UserRegFee'))->layout('layouts.payment');
            } catch (Throwable $e) {
                DB::rollBack();
                return back()->with('Error!', 'Something went wrong! Please try again.');
            }
        }

        return back()->with('Error!', $response['message'] ?? 'Transaction not completed!');
    }

// Dispatch Fee

    /**
     * @throws Throwable
     */
    public function DispatchOrderFee($Amount, $User_ID, $Order_ID): string|Redirector|RedirectResponse|Application
    {
        $provider = new PayPalClient([]);
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);

        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => 'USD',
                        'value' => ((float)$Amount)
                    ]
                ]
            ],
            'application_context' => [
                'cancel_url' => route('dispatch.cancel.payment'),
                'return_url' => route('dispatch.success.payment')
            ]
        ]);

        if ($order['status'] === 'CREATED') {
            try {
                DB::beginTransaction();

                $DispatchOrderFee = new DispatchOrderFee();
                $DispatchOrderFee->Payment_ID = $order['id'];
                $DispatchOrderFee->Payment = $Amount;
                $DispatchOrderFee->user_id = $User_ID;
                $DispatchOrderFee->order_id = $Order_ID;
                $DispatchOrderFee->save();

                DB::commit();

                return redirect($order['links'][1]['href']);
            } catch (Throwable $e) {
                DB::rollBack();
                return 'Something went wrong! Please try again.';
            }
        }

        return 'Something went wrong! Please try again.';
    }

    public function DispatchOrderFeeCancel(Request $request): bool
    {
        if ($request->token) {
            try {
                DB::beginTransaction();

                DispatchOrderFee::where('Payment_ID', $request->token)
                    ->update(['status' => 0]);

                DB::commit();

                return 'Your payment has been canceled!';
            } catch (Throwable $e) {
                DB::rollBack();
                return 'Something went wrong! Please try again.';
            }
        }

        return 'Your payment has not been canceled!';
    }

    /**
     * @throws Throwable
     */
    public function DispatchOrderFeeSuccess(Request $request): RedirectResponse
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            try {
                DB::beginTransaction();

                DispatchOrderFee::where('Payment_ID', $response['id'])
                    ->update(['status' => 1]);

                $DispatchOrderFee = DispatchOrderFee::where('Payment_ID', $response['id'])->first();

                $User_Invoice = new UserInvoices();
                $User_Invoice->Payment_Type = 'Dispatching Fee';
                $User_Invoice->Transaction_ID = $response['id'];
                $User_Invoice->Status = 1;
                $User_Invoice->Payment = $DispatchOrderFee->Payment;
                $User_Invoice->user_id = $DispatchOrderFee->user_id;

                if ($User_Invoice->save()) {
                    if ($this->listingServices->assignDispatch()) {
                        DB::commit();
                        return redirect()->route('Dispatch.Listing')->with('Success!', "Your Listing has been Dispatched Successfully!");
                    }
                    DB::rollBack();
                    return back()->with('Error!', 'Order not dispatched!');
                }
                DB::rollBack();
                return back()->with('Error!', 'Order invoice not created!');
            } catch (Throwable $e) {
                DB::rollBack();
                return back()->with('Error!', 'Something went wrong! Please try again.');
            }
        }

        return back()->with('Error!', $response['message'] ?? 'Transaction not completed!');
    }

// Subscription Fee

    /**
     * @throws Throwable
     */
    public function LoadBoardSubscription($Amount, $User_ID, $Package_ID): string|Redirector|RedirectResponse|Application
    {
        $provider = new PayPalClient([]);
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);

        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    'product_data' => [
                        'name' => 'Subscription Fee For '.$Package_ID.' of Day Dispatch ',
                    ],
                    "amount" => [
                        "currency_code" => 'USD',
                        'value' => ((float)$Amount)
                    ]
                ]
            ],
            'application_context' => [
                'cancel_url' => route('package.cancel.payment'),
                'return_url' => route('package.success.payment')
            ]
        ]);

        if ($order['status'] === 'CREATED') {
            try {
                DB::beginTransaction();

                $SubscriptionFee = new SubscriptionFee();
                $SubscriptionFee->Payment_ID = $order['id'];
                $SubscriptionFee->Payment = $Amount;
                $SubscriptionFee->user_id = $User_ID;
                $SubscriptionFee->Package_Name = $Package_ID;
                $SubscriptionFee->save();

                DB::commit();

                return redirect($order['links'][1]['href']);
            } catch (Throwable $e) {
                DB::rollBack();
                return 'Something went wrong! Please try again.';
            }
        }

        return 'Something went wrong! Please try again.';
    }

    public function SubscriptionCancel(Request $request): bool
    {
        if ($request->token) {
            try {
                DB::beginTransaction();

                SubscriptionFee::where('Payment_ID', $request->token)
                    ->update(['status' => 0]);

                DB::commit();

                return 'Your payment has been canceled!';
            } catch (Throwable $e) {
                DB::rollBack();
                return 'Something went wrong! Please try again.';
            }
        }

        return 'Your payment has not been canceled!';
    }

    /**
     * @throws Throwable
     */
    public function SubscriptionSuccess(Request $request): RedirectResponse
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            try {
                DB::beginTransaction();

                SubscriptionFee::where('Payment_ID', $response['id'])
                    ->update(['status' => 1]);

                $SubscriptionFee = SubscriptionFee::where('Payment_ID', $response['id'])->first();

                $User_Invoice = new UserInvoices();
                $User_Invoice->Payment_Type = $SubscriptionFee->Package_Name;
                $User_Invoice->Transaction_ID = $response['id'];
                $User_Invoice->Status = 1;
                $User_Invoice->Payment = $SubscriptionFee->Payment;
                $User_Invoice->user_id = $SubscriptionFee->user_id;

                if ($User_Invoice->save()) {
                    DB::commit();
                    return redirect()->route('Packages')->with('Success!', 'Package subscription success!');
                }
                DB::rollBack();
                return back()->with('Error!', 'Package invoice not created!');
            } catch (Throwable $e) {
                DB::rollBack();
                return back()->with('Error!', 'Something went wrong! Please try again.');
            }
        }

        return back()->with('Error!', $response['message'] ?? 'Transaction not completed!');
    }

}

