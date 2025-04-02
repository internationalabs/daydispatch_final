<?php

namespace App\Http\Livewire\Backend\Payments;

use App\Http\Controllers\Payment\PayPalPaymentController;
use App\Http\Controllers\Payment\StripePaymentController;
use App\Models\Payments\SubscriptionPackages;
use App\Services\ListingServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Throwable;

class LoadPackages extends Component
{
    protected ListingServices $listingServices;

    public function mount(ListingServices $listingServices): void
    {
        $this->listingServices = $listingServices;
    }
    public function render()
    {
        $auth_user = Auth::guard('Authorized')->user();
        $Pacakges = SubscriptionPackages::first();
        return view('livewire.backend.payments.load-packages', compact('auth_user', 'Pacakges'))->layout('layouts.payment');
    }

    /**
     * @throws Throwable
     */
    public function SubscribeNow(Request $request): Redirector|Application|RedirectResponse
    {
        $listingService = new ListingServices();
        $Amount = (double)$request->Amount;
        $Package_ID = ($request->Package_ID === '2')? 'Heavy Load Subscription' : 'Dry Van Load Subscription';
        $User_ID = $request->ID;
        $Payment_Method = $request->Payment_Method;

        if ($Payment_Method === '0') {
            // Stripe
            return $this->StripePayment($Amount, $User_ID, $Package_ID, $listingService);
        }

        if ($Payment_Method === '1') {
            // PayPal
            return $this->PayPalPayment($Amount, $User_ID, $Package_ID, $listingService);
        }
        return back()->with('Error!', 'Payment Method Not Selected!');
    }

    /**
     * @throws Throwable
     */
    public function PayPalPayment($Amount, $user_id, $Package_ID, ListingServices $listingService): Redirector|Application|RedirectResponse
    {
        $PayPal = new PayPalPaymentController($listingService);
        $Payment_Response = $PayPal->LoadBoardSubscription($Amount, $user_id, $Package_ID);
        return redirect($Payment_Response->getTargetUrl());
    }

    public function StripePayment($Amount, $user_id, $Package_ID, ListingServices $listingService): Redirector|Application|RedirectResponse
    {
        $Stripe = new StripePaymentController($listingService);
        $Payment_Response = $Stripe->LoadBoardSubscription($Amount, $user_id, $Package_ID);
        return redirect($Payment_Response->getTargetUrl());
    }
}
