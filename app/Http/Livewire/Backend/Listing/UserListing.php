<?php

namespace App\Http\Livewire\Backend\Listing;

use App\Helpers\DayDispatchHelper;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\RequestCarrierMail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Listing\AllUserListing;
use App\Models\Listing\WatchList;
use App\Models\Broker\RequestCarrier;
use App\Models\Carrier\RequestBroker;
use App\Models\Listing\ArchiveListing;
use App\Models\Listing\DeliverdOrders;
use App\Models\Listing\ListingPaymentInfo;
use App\Models\Listing\ListingPickupDeliverInfo;
use App\Models\Quote\Order;
use Illuminate\Support\Facades\Log;

class UserListing extends Component
{
    public function render(Request $request)
    {

        $auth_user = Auth::guard('Authorized')->user();
        $Search_vehicleType = null;
        $watchlist = WatchList::orderBy('id', 'DESC')->where('user_id', $auth_user->id)->get();
        $archivedListingIds = ArchiveListing::pluck('order_id')->toArray();
        $perPage = $request->input('per_page', 10);

        if ($auth_user->usr_type === 'Carrier') {

            if ($request->has('Search_vehicleType') && $request->Search_vehicleType != null) {
                $Search_vehicleType = $request->Search_vehicleType;

                if ($request->Search_vehicleType == 'vehicles') {
                    
                    $Lisiting = AllUserListing::where('user_id', $auth_user->id)->orderBy('id', 'DESC')->active()->where('Private_Listing', 0)->with('vehicles', 'request_carrier')->carrierlisting()->where('Listing_Type', 1)->paginate($perPage);

                } elseif ($request->Search_vehicleType == 'heavy_equipments') {
                    $Lisiting = AllUserListing::where('user_id', $auth_user->id)->orderBy('id', 'DESC')->active()->where('Private_Listing', 0)->with('heavy_equipments', 'request_carrier')->carrierlisting()->where('Listing_Type', 2)->paginate($perPage);
                } elseif ($request->Search_vehicleType == 'dry_vans') {
                    $Lisiting = AllUserListing::where('user_id', $auth_user->id)->orderBy('id', 'DESC')->active()->where('Private_Listing', 0)->with('dry_vans', 'request_carrier')->carrierlisting()->where('Listing_Type', 3)->paginate($perPage);
                } else {
                    $Lisiting = AllUserListing::where('user_id', $auth_user->id)->orderBy('id', 'DESC')->active()->where('Private_Listing', 0)->with('dry_vans', 'request_carrier')->carrierlisting()->where('Listing_Type', 3)->paginate($perPage);
                }
            } elseif ($request->has('get_comp_listing') && $request->get_comp_listing != null) {

                $CMP_ID = $request->get_comp_listing;
                $Lisiting = AllUserListing::where('user_id', $auth_user->id)->orderBy('id', 'DESC')->active()->where('Private_Listing', 0)->where('user_id', $CMP_ID)->paginate($perPage);
            } else {

                $Lisiting = AllUserListing::where('user_id', $auth_user->id)->orderBy('id', 'DESC')->active()->where('Private_Listing', 0)->carrierlisting()->paginate($perPage);
                // dd($Lisiting->toArray());
            }
        } else {
            if ($request->has('Search_vehicleType') && $request->Search_vehicleType != null) {
                $Search_vehicleType = $request->Search_vehicleType;

                if ($request->Search_vehicleType == 'vehicles') {
                    # code...
                    // $Lisiting = AllUserListing::where('user_id', $auth_user->id)->where('user_id', $auth_user->id)->orderBy('id', 'DESC')->active()->where('Private_Listing', 0)->with('vehicles', 'request_broker')->brokerlisting()->where('Listing_Type', 1)->where('user_id', $auth_user->id)->get();
                    $Lisiting = AllUserListing::where('user_id', $auth_user->id)->orderBy('id', 'DESC')->active()->where('Private_Listing', 0)->with('vehicles', 'request_broker')->brokerlisting()->where('Listing_Type', 1)->whereNotIn('id', $archivedListingIds)->paginate($perPage);
                } elseif ($request->Search_vehicleType == 'heavy_equipments') {
                    $Lisiting = AllUserListing::where('user_id', $auth_user->id)->orderBy('id', 'DESC')->active()->where('Private_Listing', 0)->with('heavy_equipments', 'request_broker')->brokerlisting()->where('Listing_Type', 2)->whereNotIn('id', $archivedListingIds)->paginate($perPage);
                } elseif ($request->Search_vehicleType == 'dry_vans') {
                    $Lisiting = AllUserListing::where('user_id', $auth_user->id)->orderBy('id', 'DESC')->active()->where('Private_Listing', 0)->with('dry_vans', 'request_broker')->brokerlisting()->where('Listing_Type', 3)->whereNotIn('id', $archivedListingIds)->paginate($perPage);
                } else {
                    $Lisiting = AllUserListing::where('user_id', $auth_user->id)->orderBy('id', 'DESC')->active()->where('Private_Listing', 0)->brokerlisting()->whereNotIn('id', $archivedListingIds)->paginate($perPage);
                }
            } elseif ($request->has('get_comp_listing') && $request->get_comp_listing != null) {

                $CMP_ID = $request->get_comp_listing;
                $Lisiting = AllUserListing::where('user_id', $auth_user->id)->orderBy('id', 'DESC')->active()->where('Private_Listing', 0)->where('user_id', $CMP_ID)->whereNotIn('id', $archivedListingIds)->paginate($perPage);
            } else {
                # code...
                $Lisiting = AllUserListing::where('user_id', $auth_user->id)->orderBy('id', 'DESC')->active()->where('Private_Listing', 0)->brokerlisting()->whereNotIn('id', $archivedListingIds)->paginate($perPage);
            }
        }
        // dd($Lisiting->toArray());

        return view('livewire.backend.listing.user-listing', compact('Lisiting', 'auth_user', 'Search_vehicleType', 'watchlist'))->layout('layouts.authorized');
    }

    public function requestCarrier(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $user_id = Auth::guard('Authorized')->user()->id;
            $CMP_Name = Auth::guard('Authorized')->user()->Company_Name;
            // $Listed_ID = $request->get_Listed_ID;
            $Listed_ID = $request->get_Ref_ID;

            // $Get_Ref_ID = $request->get_Ref_ID;

            $RequestCarrier = new RequestCarrier();
            $RequestCarrier->Requested_Email = $request->Requested_Email;
            $RequestCarrier->Requested_Comments = $request->Requested_Comments;
            $RequestCarrier->order_id = $Listed_ID;
            $RequestCarrier->CMP_id = $user_id;
            $RequestCarrier->user_id = $user_id;

            $mailData = [
                'title' => 'Mail from Day Dispatch',
                'body' => $request->Requested_Comments,
                'Broker_CMP' => $CMP_Name
            ];

            if (Mail::to($request->Requested_Email)->send(new RequestCarrierMail($mailData, $Listed_ID))) {
                if ($RequestCarrier->save()) {
                    DB::commit();
                    return redirect()->route('User.Listing')->with('Success!', "Your Request has been Sent to Carrier Successfully!");
                }
                DB::rollBack();
                return back()->with('Error!', "Your Request was not sent!");
            }
            DB::rollBack();
            return back()->with('Error!', "Email Not Sent!");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('Error!', "An error occurred: " . $e->getMessage());
        }
    }

    public function requestBroker(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $user_id = Auth::guard('Authorized')->user()->id;
            $Listed_ID = $request->get_Listed_ID;
            $Listing_Info = AllUserListing::where('id', $Listed_ID)->first();

            if ($request->has('request_ID')) {
                // If request_ID exists, update the existing record
                $RequestBroker = RequestBroker::findOrFail($request->request_ID);

                // Update the record with the new values
                $RequestBroker->Current_Price = (int) Str::replace(['$ ', ','], '', $request->Current_Price);
                $RequestBroker->Offer_Price = $request->Offer_Price;
                $RequestBroker->Date_Pickup_Mode = $request->Date_Pickup_Mode;
                $RequestBroker->Pickup_Date = $request->Pickup_Date;
                $RequestBroker->Date_Delivery_Mode = $request->Date_Delivery_Mode;
                $RequestBroker->Delivery_Date = $request->Delivery_Date;
                $RequestBroker->Bid_Comment = $request->Bid_Comment;
                $RequestBroker->type = $request->type ?? 'request';
                $RequestBroker->user_id = $Listing_Info->user_id;

                // Save the updated record
                $RequestBroker->save();
            } else {
                // If request_ID does not exist, create a new record
                $RequestBroker = new RequestBroker();
                $RequestBroker->Current_Price = (int) Str::replace(['$ ', ','], '', $request->Current_Price);
                $RequestBroker->Offer_Price = $request->Offer_Price;
                $RequestBroker->Date_Pickup_Mode = $request->Date_Pickup_Mode;
                $RequestBroker->Pickup_Date = $request->Pickup_Date;
                $RequestBroker->Date_Delivery_Mode = $request->Date_Delivery_Mode;
                $RequestBroker->Delivery_Date = $request->Delivery_Date;
                $RequestBroker->Bid_Comment = $request->Bid_Comment;
                $RequestBroker->order_id = $Listed_ID;
                $RequestBroker->CMP_id = $user_id;
                $RequestBroker->type = $request->type ?? 'request';
                $RequestBroker->user_id = $Listing_Info->user_id;

                // Save the new record
                $RequestBroker->save();
            }

            // Send notification if the request is saved or updated
            $flag = DayDispatchHelper::SendNotificationOnStatusChanged('Requested', $Listed_ID);
            if ($flag) {
                DB::commit();
                return back()->with('Success!', 'Your Request has been Sent to Broker Successfully!');
            }

            throw new \RuntimeException('Error occurred while sending the notification.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('Error!', 'Your Request was not sent: ' . $e->getMessage());
        }
    }

    public function getAllLaneCarrier(Request $request): string
    {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();

                $data = AllUserListing::orderBy('id', 'DESC')
                    ->active()
                    ->whereHas('routes', function ($query) use ($request) {
                        $query->where([
                            ['Origin_ZipCode', $request->Listed_From_Route],
                            ['Dest_ZipCode', $request->Listed_To_Route]
                        ])
                            ->orWhere([
                                ['Origin_ZipCode', $request->Listed_To_Route],
                                ['Dest_ZipCode', $request->Listed_From_Route]
                            ]);
                    })
                    ->whereNot('id', $request->Listed_ID)
                    ->where('Private_Listing', 0)
                    ->carrierlisting()
                    ->get();

                DB::commit();

                return view('partials.listing.all_lane_carriers', ['data' => $data])->render();
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['error' => 'No Carriers Available'], 500);
            }
        }

        return response()->json(['error' => 'Ajax Failed to Request!'], 400);
    }


    public function bulkAction(Request $request)
    {
        $selectedIds = $request->input('selected_ids', []);
        $action = $request->input('action_option');
        $newPrice = $request->input('update_new_price');

        $newPickupDate = $request->input('new_pickup_date');
        $newDeliveryDate = $request->input('new_delivery_date');

        // Debug the request data
        // dd($selectedIds, $action);

        if (empty($selectedIds)) {
            return redirect()->back()->with('error', 'No items selected.');
        }
        $user_id = Auth::guard('Authorized')->user()->id;
        switch ($action) {
            case 'delete':
                // $listing = AllUserListing::find($selectedIds);
                AllUserListing::whereIn('id', $selectedIds)->update(['Listing_Status' => 'Deleted']);
                break;
            case 'archive':
                foreach ($selectedIds as $id) {
                    $listing = AllUserListing::find($id);

                    if ($listing) {
                        ArchiveListing::create([
                            'user_id' => $user_id,
                            'order_id' => $id,
                        ]);
                    }
                }
                break;
            case 'archive_delivered':
                foreach ($selectedIds as $id) {
                    ArchiveListing::create([
                        'user_id' => $user_id,
                        'order_id' => $id,
                    ]);
                }
                break;
            case 'restore':
                foreach ($selectedIds as $id) {
                    $RecordUpdate = ArchiveListing::where('order_id', $id)
                        ->where('user_id', $user_id)
                        ->first();

                    if ($RecordUpdate) {
                        $RecordUpdate->delete();
                    }
                }
                break;
            case 'update_price':
                $listings = ListingPaymentInfo::whereIn('order_id', $selectedIds)->get();

                foreach ($listings as $listing) {
                    $currentPrice = $listing->Price_Pay_Carrier;
                    $updatedPrice = $currentPrice + $newPrice;

                    $listing->update(['Price_Pay_Carrier' => $updatedPrice]);
                }

                break;
            case 'update_dates':
                $updates = [];

                if ($newPickupDate !== null) {
                    $updates['Pickup_Date'] = $newPickupDate;
                }

                if ($newDeliveryDate !== null) {
                    $updates['Delivery_Date'] = $newDeliveryDate;
                }

                if (!empty($updates)) {
                    ListingPickupDeliverInfo::whereIn('order_id', $selectedIds)->update($updates);
                } else {
                    return redirect()->back()->with('Error!', 'No valid dates provided for update.');
                }
                break;
            default:
                return redirect()->back()->with('Error!', 'Invalid action.');
        }
        return redirect()->back()->with('Success!', 'Bulk action completed successfully.');
    }



    public function fetchListings(Request $request)
    {
        $selectedIds = $request->input('selected_ids', []);

        if (empty($selectedIds)) {
            return response()->json(['error' => 'No items selected.'], 400);
        }

        $listings = ListingPaymentInfo::whereIn('order_id', $selectedIds)
            ->pluck('Price_Pay_Carrier', 'order_id');

        return response()->json($listings);
    }

    public function fetchListingsDates(Request $request)
    {
        $selectedIds = $request->input('selected_ids', []);

        if (empty($selectedIds)) {
            return response()->json(['error' => 'No items selected.'], 400);
        }

        $listings = ListingPickupDeliverInfo::whereIn('order_id', $selectedIds)
            ->get(['order_id', 'Pickup_Date', 'Delivery_Date'])
            ->keyBy('order_id');

        // $listings = ListingPickupDeliverInfo::whereIn('order_id', $selectedIds)
        //     ->pluck(['Pickup_Date','Delivery_Date'], 'order_id');

        return response()->json($listings);
    }

    // public function requestBroker(Request $request): RedirectResponse
    // {
    //     try {
    //         DB::beginTransaction();

    //         $user_id = Auth::guard('Authorized')->user()->id;
    //         $Listed_ID = $request->get_Listed_ID;
    //         $Listing_Info = AllUserListing::where('id', $Listed_ID)->first();

    //         $RequestBroker = new RequestBroker();
    //         $RequestBroker->Current_Price = (int) Str::replace(['$ ', ','], '', $request->Current_Price);
    //         $RequestBroker->Offer_Price = $request->Offer_Price;
    //         $RequestBroker->Date_Pickup_Mode = $request->Date_Pickup_Mode;
    //         $RequestBroker->Pickup_Date = $request->Pickup_Date;
    //         $RequestBroker->Date_Delivery_Mode = $request->Date_Delivery_Mode;
    //         $RequestBroker->Delivery_Date = $request->Delivery_Date;
    //         $RequestBroker->Bid_Comment = $request->Bid_Comment;
    //         $RequestBroker->order_id = $Listed_ID;
    //         $RequestBroker->CMP_id = $user_id;
    //         $RequestBroker->type = $request->type ?? 'request';
    //         $RequestBroker->user_id = $Listing_Info->user_id;

    //         if ($RequestBroker->save()) {
    //             $flag = DayDispatchHelper::SendNotificationOnStatusChanged('Requested', $Listed_ID);
    //             if ($flag) {
    //                 DB::commit();
    //                 return back()->with('Success!', 'Your Request has been Sent to Broker Successfully!');
    //                 // return redirect()->route('User.Listing')->with('Success!', 'Your Request has been Sent to Broker Successfully!');
    //             }
    //         }
    //         throw new \RuntimeException('Error occurred while saving the request.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return back()->with('Error!', 'Your Request was not sent: ' . $e->getMessage());
    //     }
    // }

}
