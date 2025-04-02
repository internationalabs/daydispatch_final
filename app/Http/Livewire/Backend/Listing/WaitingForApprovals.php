<?php

namespace App\Http\Livewire\Backend\Listing;

use App\Helpers\DayDispatchHelper;
use App\Http\Controllers\Payment\PayPalPaymentController;
use App\Http\Controllers\Payment\StripePaymentController;
use App\Models\Carrier\RequestBroker;
use App\Models\Payments\PaymentSystem;
use App\Services\ListingServices;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Services\OrderRatings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing\{AllUserListing, ListingAgreement, WaitingForApproval, Dispatch};
use Illuminate\Pagination\LengthAwarePaginator;
use Throwable;

class WaitingForApprovals extends Component
{
    protected ListingServices $listingServices;
    protected OrderRatings $orderRatings;

    public function mount(ListingServices $listingServices, OrderRatings $orderRatings): void
    {
        $this->listingServices = $listingServices;
        $this->orderRatings = $orderRatings;
    }

    public function render(Request $request)
    {
        $Search_vehicleType = null;
        $auth_user = Auth::guard('Authorized')->user();
        // $perPage = $request->input('per_page', 10);

        $Lisiting = $this->listingServices->getWaitingOrders();
        
        if ($auth_user->usr_type === 'Carrier') {
            if ($request->has('Search_vehicleType') && $request->Search_vehicleType != null) {
                $Search_vehicleType = $request->Search_vehicleType;
                if ($request->Search_vehicleType == 'vehicles') {
                    $Lisiting = WaitingForApproval::whereDoesntHave('all_listing.agreement')->orderBy('id', 'DESC')->with('all_listing')->where('CMP_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 1);
                    })->get();
                } elseif ($request->Search_vehicleType == 'heavy_equipments') {
                    $Lisiting = WaitingForApproval::whereDoesntHave('all_listing.agreement')->orderBy('id', 'DESC')->with('all_listing')->where('CMP_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 2);
                    })->get();
                } elseif ($request->Search_vehicleType == 'dry_vans') {
                    $Lisiting = WaitingForApproval::whereDoesntHave('all_listing.agreement')->orderBy('id', 'DESC')->with('all_listing')->where('CMP_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 3);
                    })->get();
                } else {
                    $Lisiting = $Lisiting->where('CMP_id', $auth_user->id);
                }
            } else {
                $Lisiting = $Lisiting->where('CMP_id', $auth_user->id);
            }

            foreach ($Lisiting as $listing) {
                $authorized_user = $listing->authorized_user;
                if ($authorized_user) {
                    $userRating = $this->orderRatings->getUserRating($authorized_user->id);
                    $authorized_user->avg_rating = $userRating
                        ? (array_sum([
                            $userRating->ratings_avg_timeliness,
                            $userRating->ratings_avg_communication,
                            $userRating->ratings_avg_documentation,
                        ]) / 3)
                        : null;

                    $authorized_user->ratings_count = $this->orderRatings->getUserRatingRecords($authorized_user->id)->count();
                }
            }
        } else {
            if ($request->has('Search_vehicleType') && $request->Search_vehicleType != null) {
                $Search_vehicleType = $request->Search_vehicleType;
                if ($request->Search_vehicleType == 'vehicles') {
                    $Lisiting = WaitingForApproval::whereDoesntHave('all_listing.agreement')->orderBy('id', 'DESC')->with('all_listing')->where('user_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 1);
                    })->get();
                } elseif ($request->Search_vehicleType == 'heavy_equipments') {
                    $Lisiting = WaitingForApproval::whereDoesntHave('all_listing.agreement')->orderBy('id', 'DESC')->with('all_listing')->where('user_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 2);
                    })->get();

                } elseif ($request->Search_vehicleType == 'dry_vans') {
                    $Lisiting = WaitingForApproval::whereDoesntHave('all_listing.agreement')->orderBy('id', 'DESC')->with('all_listing')->where('user_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 3);
                    })->get();

                } else {
                    $Lisiting = $Lisiting->where('user_id', $auth_user->id);

                }
            } else {
                $Lisiting = $Lisiting->where('user_id', $auth_user->id);
            }

            foreach ($Lisiting as $listing) {
                $requested_user = $listing->authorized_user;
                if ($requested_user) {
                    $userRating = $this->orderRatings->getUserRating($requested_user->id);
                    $requested_user->avg_rating = $userRating
                        ? (array_sum([
                            $userRating->ratings_avg_timeliness,
                            $userRating->ratings_avg_communication,
                            $userRating->ratings_avg_documentation,
                        ]) / 3)
                        : null;

                    $requested_user->ratings_count = $this->orderRatings->getUserRatingRecords($requested_user->id)->count();
                }
            }
        }

        $Lisiting = new LengthAwarePaginator(
            $Lisiting->forPage($request->input('page', 1), $request->input('per_page', 10)), 
            $Lisiting->count(), 
            $request->input('per_page', 10), 
            $request->input('page', 1), 
            ['path' => $request->url(), 'query' => $request->query()]
        );
        // dd($Lisiting->toArray());

        return view('livewire.backend.listing.waiting-for-approval', compact('Lisiting', 'Search_vehicleType'))->layout('layouts.authorized');
    }

    /**
     * @throws Throwable
     */

    public function assignDispatch(Request $request): Redirector|Application|RedirectResponse
    {
        try {
            return DB::transaction(function () use ($request) {
                $listingService = new ListingServices();
                $user_id = Auth::guard('Authorized')->user()->id;
                $Order_Type = (int) $request->Order_Type;
                $Amount = 0;
                $Payment_Method = (int) $request->Payment_Method;

                $session_data = [
                    'Agreement_Name' => $request->Agreement_Name,
                    'Agreement_Signature' => $request->Agreement_Sign,
                    'Sign' => $request->signatureShw,
                    'user_id' => $request->CMP_ID,
                    'order_id' => $request->Order_ID,
                    'CMP_id' => $user_id
                ];

                Session::put($session_data);

                if ($Order_Type === 1) {
                    $Payment_Info = PaymentSystem::where('Payment_Type', 'Vehicle Load')->where('Payment_Switch', 0)->first();
                    if ($Payment_Info !== null) {
                        $Amount = $Payment_Info->Payment;
                        if ($Payment_Method === 1) {
                            return $this->StripePayment($Amount, $user_id, $request, $listingService);
                        }

                        if ($Payment_Method === 2) {
                            return $this->PayPalPayment($Amount, $user_id, $request, $listingService);
                        }
                    }
                    return $this->DispatchingAssignOrder($request, $user_id, $listingService);
                }

                if ($Order_Type === 2) {
                    $Payment_Info = PaymentSystem::where('Payment_Type', 'Heavy Load')->where('Payment_Switch', 0)->first();
                    return $this->DispatchOrderPayment($Payment_Info, $request, $user_id, $Payment_Method, $listingService);
                }

                if ($Order_Type === 3) {
                    $Payment_Info = PaymentSystem::where('Payment_Type', 'Dry Van Load')->where('Payment_Switch', 0)->first();
                    return $this->DispatchOrderPayment($Payment_Info, $request, $user_id, $Payment_Method, $listingService);
                }

                return back()->with('Error!', "Something Went Wrong!");
            });
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return back()->with('Error!', "An error occurred. Please try again later.");
        }
    }

    /**
     * @throws Throwable
     */
    public function DispatchOrderPayment($Payment_Info, Request $request, $user_id, $Payment_Method, ListingServices $listingService): Redirector|RedirectResponse|Application
    {
        try {
            return DB::transaction(function () use ($Payment_Info, $request, $user_id, $Payment_Method, $listingService) {
                if ($Payment_Info !== null) {
                    $Amount = ($request->Order_Amount * $Payment_Info->Payment) / 100;
                    if ($Payment_Method === 1) {
                        return $this->StripePayment($Amount, $user_id, $request, $listingService);
                    }
                    if ($Payment_Method === 2) {
                        return $this->PayPalPayment($Amount, $user_id, $request, $listingService);
                    }
                }
                return $this->DispatchingAssignOrder($request, $user_id, $listingService);
            });
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return back()->with('Error!', "An error occurred. Please try again later.");
        }
    }

    /**
     * @throws Throwable
     */
    public function PayPalPayment($Amount, $user_id, Request $request, ListingServices $listingService): Redirector|Application|RedirectResponse
    {
        try {
            return DB::transaction(static function () use ($Amount, $user_id, $request, $listingService) {
                $PayPal = new PayPalPaymentController($listingService);
                $Payment_Response = $PayPal->DispatchOrderFee($Amount, $user_id, $request->Order_ID);
                return redirect($Payment_Response->getTargetUrl());
            });
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return back()->with('Error!', "An error occurred. Please try again later.");
        }
    }

    public function StripePayment($Amount, $user_id, Request $request, ListingServices $listingService): Redirector|Application|RedirectResponse
    {
        try {
            return DB::transaction(static function () use ($Amount, $user_id, $request, $listingService) {
                $Stripe = new StripePaymentController($listingService);
                $Payment_Response = $Stripe->DispatchOrderFee($Amount, $user_id, $request->Order_ID);

                return redirect($Payment_Response->getTargetUrl());
            });
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return back()->with('Error!', "An error occurred. Please try again later.");
        }
    }

    public function DispatchingAssignOrder(Request $request, int $user_id, ListingServices $listingServices): RedirectResponse
    {
        try {
            // Begin the database transaction
            DB::beginTransaction();

            $Dispatch = new Dispatch();
            $ListingAgreement = new ListingAgreement();

            $AllUserListing = AllUserListing::where('id', $request->Order_ID)->first();
            $AllUserListing->Listing_Status = 'Dispatch';

            $RecordUpdate = WaitingForApproval::where('order_id', $request->Order_ID)->first();

            RequestBroker::where('order_id', $request->Order_ID)
                ->update([
                    'is_cancel' => 1
                ]);

            $Dispatch->user_id = $RecordUpdate->user_id;
            $Dispatch->order_id = $request->Order_ID;
            $Dispatch->CMP_id = $RecordUpdate->CMP_id;

            $ListingAgreement->Agreement_Name = $request->Agreement_Name;
            $ListingAgreement->Agreement_Signature = $request->Agreement_Sign;
            $ListingAgreement->Sign = $request->signatureShw;
            $ListingAgreement->user_id = $request->CMP_ID;
            $ListingAgreement->order_id = $request->Order_ID;
            $ListingAgreement->CMP_id = $user_id;

            if ($AllUserListing->update() && $ListingAgreement->save()) {
                $listingServices->OrderHistory('Dispatch', null, null, $request->Order_ID, $RecordUpdate->user_id, $RecordUpdate->CMP_id);
                if ($Dispatch->save() && $RecordUpdate->delete()) {
                    $flag = DayDispatchHelper::SendNotificationOnStatusChanged('Dispatch', $request->Order_ID);
                    if ($flag) {
                        DB::commit();
                        return redirect()->route('Dispatch.Listing')->with('success', "Your Listing has been Dispatched Successfully!");
                    }
                    DB::rollBack();
                    return back()->with('error', "Something went Wrong with Notifications!");
                }
                DB::rollBack();
                return back()->with('error', "Your Listing hasn't Waiting's!");
            }
            DB::rollBack();
            return back()->with('error', "Listing not Updated!");
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->with('error', "An error occurred. Please try again later.");
        }
    }


}
