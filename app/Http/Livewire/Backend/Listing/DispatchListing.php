<?php

namespace App\Http\Livewire\Backend\Listing;

use App\Helpers\DayDispatchHelper;
use App\Models\Listing\DispatchDriver;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing\AllUserListing;
use App\Models\Listing\WaitingForApproval;
use App\Models\Listing\ListingPaymentInfo;
use App\Models\Listing\ListingVehciles;
use App\Models\Carrier\RequestBroker;
use App\Models\Listing\ListingHeavyEquipment;
use App\Models\Listing\ListingDryVan;
use App\Models\Listing\ListingAdditionalInfo;
use App\Models\Listing\ListingOrignLocation;
use App\Models\Listing\ListingDestinationLocation;
use App\Models\Listing\ListingPickupDeliverInfo;
use App\Models\Profile\MyContract;
use App\Models\Auth\AuthorizedUsers;
use App\Mail\NotifyAllUsers;
use App\Models\Extras\Notification;
use Illuminate\Support\Str;
use App\Models\Listing\ListingRoutes;
use App\Notifications\ListingAssigned;



class DispatchListing extends Component
{
    public function render(Request $request)
    {
        $req_user = request()->has('req_user') ? request()->req_user : null;

        $authorized_user = null;
        if ($req_user !== null) {
            $req_user = AuthorizedUsers::where('id', $req_user)->first();
        }
        // dd($request->toArray(), $req_user->toArray());

        $Listed_ID = $request->List_ID;
        $user_id = Auth::guard('Authorized')->user()->id;
        $MyContract = MyContract::where('user_id', $user_id)->get();

        $Lisiting = AllUserListing::with(
            "authorized_user",
            "paymentinfo",
            "additional_info",
            "pickup_delivery_info",
            "vehicles",
            "heavy_equipments",
            "dry_vans",
            "dry_vans_services",
            "routes",
            "request_broker",
            "listing_origin_location",
            "listing_destination_locations"
        )->where('Listing_Status', 'Listed')
            ->where('id', $Listed_ID)
            ->where('user_id', $user_id)
            ->orderBy('id', 'DESC')
            ->firstOrFail();
        // dd($Lisiting);


        return view('livewire.backend.listing.dispatch-listing', compact('Listed_ID', 'Lisiting', 'MyContract', 'req_user'))->layout('layouts.authorized');
    }

    public function assignWaitings(Request $request): RedirectResponse
    {

        // dd($request->toArray());
        // dd($request->input('Port_Dest_Auction_Method'));  // is me mujhe meri value mil gaye hai
        // update part for DESTINATION LOCATION

        $user_id = Auth::guard('Authorized')->user()->id;
        $Listed_ID = $request->List_ID;


        $data = [
            'Destination_Location' => $request->Destination_Location,
            'Dest_User_Name' => $request->Dest_User_Name,
            'Dest_User_Email' => $request->Dest_User_Email,
            'Dest_Local_Phone' => $request->Dest_Local_Phone,
            'Dest_Auction_Phone' => $request->Dest_Auction_Phone,
            'Dest_Stock_Number' => $request->Dest_Stock_Number,
            'Dest_Business_Location' => $request->Dest_Business_Location,
            'Dest_Business_Phone' => $request->Dest_Business_Phone,
        ];

        if ($request->has('Auction_Method_def') && !empty($request->input('Auction_Method_def'))) {
            $data['Dest_Auction_Method'] = $request->input('Auction_Method_def');
        } elseif ($request->has('Dest_Auction_Method') && !empty($request->input('Dest_Auction_Method'))) {
            $data['Dest_Auction_Method'] = $request->input('Dest_Auction_Method');
        } elseif ($request->has('Port_Dest_Auction_Method')) {
            $data['Dest_Auction_Method'] = $request->input('Port_Dest_Auction_Method');
        }


        ListingDestinationLocation::where('order_id', $Listed_ID)->update($data);
        // dd('success');

        // update part for ORIGIN LOCATION 
        $data = [
            'Orign_Location' => $request->Orign_Location,
            'User_Name' => $request->User_Name,
            'User_Email' => $request->User_Email,
            'Local_Phone' => $request->Local_Phone,
            'Location' => $request->Delivery_Start_Time,
            'Auction_Method' => $request->Dealer_Auction_Method,
            // 'Auction_Method' => $request->Auction_Method_abc,
            'Auction_Phone' => $request->Auction_Phone,
            'Stock_Number' => $request->Stock_Number,
            'Business_Location' => $request->Business_Location,
            'Business_Phone' => $request->Business_Phone,
            'Location' => $request->Location,
        ];
        if ($request->has('Auction_Method')) {
            $data['Auction_Method'] = $request->input('Auction_Method');
        } elseif ($request->has('Auction_Method')) {
            $data['Auction_Method'] = $request->input('Auction_Method_abc');
        }


        ListingOrignLocation::where('order_id', $Listed_ID)->update($data);



        // Extract 'From' and 'To' from the request
        $From = Str::afterLast($request->Origin_ZipCode, ', ');
        $To = Str::afterLast($request->Dest_ZipCode, ', ');

        // Calculate the miles
        $miles = DayDispatchHelper::twopoints_on_earth($From, $To);

        $data = [
            'Origin_Address' => $request->Origin_Address,
            'Origin_Address_II' => $request->Origin_Address_II,
            'Origin_ZipCode' => $request->Origin_ZipCode,
            'Destination_Address' => $request->Destination_Address,
            'Destination_Address_II' => $request->Destination_Address_II,
            'Dest_ZipCode' => $request->Dest_ZipCode,
            'Miles' => $miles,


        ];
        ListingRoutes::where('order_id', $Listed_ID)->update($data);




        // dd($request->input('Dest_Auction_Method'));





        // update part for VEHICLE PICKUP INFORMATION

        ListingPickupDeliverInfo::where('order_id', $Listed_ID)->update([
            'Pickup_Date' => $request->Pickup_Date,
            'Delivery_Date' => $request->Delivery_Date,

            'Pickup_Start_Time' => $request->Pickup_Start_Time,
            'Pickup_End_Time' => $request->Pickup_End_Time,
            'Delivery_Start_Time' => $request->Delivery_Start_Time,
            'Delivery_End_Time' => $request->Delivery_End_Time,

        ]);


        try {
            DB::beginTransaction();


            $WaitingForApproval = new WaitingForApproval();
            $AllUserListing = AllUserListing::where('id', $Listed_ID)->where('user_id', $user_id)->first();
            $ListingAdditionalInfo = ListingAdditionalInfo::where('order_id', $Listed_ID)->first();
            $ListingAdditionalInfo->Additional_Terms = $request->Additional_Terms;
            $ListingAdditionalInfo->Special_Instructions = $request->Special_Terms;
            $ListingAdditionalInfo->Notes_Customer = $request->Special_Notes;
            $ListingAdditionalInfo->Contract = $request->Listing_Contract;

            $ListingAdditionalInfo->save();

            $AllUserListing->Listing_Status = 'Waiting For Approval';

            $ListingPaymentInfo = ListingPaymentInfo::where('order_id', $Listed_ID)->first();
            if ($request->has('Booking_Price')) {
                $ListingPaymentInfo->Order_Booking_Price = (int) $request->Booking_Price;
            }
            if ($request->has('Deposite_Amount')) {
                $ListingPaymentInfo->Deposite_Amount = (int) $request->Deposite_Amount;
            }
            if ($request->has('Payment_Mode')) {
                $ListingPaymentInfo->Payment_Method_Mode = $request->Payment_Mode;
            }
            if ($request->has('Price_Pay')) {
                $ListingPaymentInfo->Price_Pay_Carrier = (int) $request->Price_Pay;
            }
            if ($request->has('COD_Amount')) {
                $ListingPaymentInfo->COD_Amount = (int) $request->COD_Amount;
            }
            if ($request->has('Bal_Amount')) {
                $ListingPaymentInfo->Balance_Amount = (int) $request->Bal_Amount;
            }
            if ($request->has('COD_Payment_Mode')) {
                $ListingPaymentInfo->COD_Method_Mode = $request->COD_Payment_Mode;
            }
            if ($request->has('Balance_Payment_Mode')) {
                $ListingPaymentInfo->Bal_Method_Mode = $request->Balance_Payment_Mode;
            }
            if ($request->has('Location_Mode')) {
                $ListingPaymentInfo->COD_Location_Amount = $request->Location_Mode;
            }
            if ($request->has('Bal_Payment_Time')) {
                $ListingPaymentInfo->BAL_Payment_Time = $request->Bal_Payment_Time;
            }
            if ($request->has('Payment_Terms')) {
                $ListingPaymentInfo->BAL_Payment_Terms = $request->Payment_Terms;
            }
            if ($request->has('Desc_For_Vehcile')) {
                $ListingPaymentInfo->Payment_Desc = $request->Desc_For_Vehcile;
            }
            $ListingPaymentInfo->save();

            if ($request->postType === 1 || $request->postType === '1') {
                foreach ($request->Vehcile_Year as $key => $value) {
                    $Reg_By = is_null($request->Vin_Number[$key]) ? 'YMM' : 'Vin Number';
                    if (!empty($request->Vehcile_ID[$key])) {
                        ListingVehciles::where('id', $request->Vehcile_ID[$key])
                            ->update(
                                [
                                    'Reg_By' => $Reg_By,
                                    'Vin_Number' => $request->Vin_Number[$key],
                                    'Vehcile_Year' => $request->Vehcile_Year[$key],
                                    'Vehcile_Make' => $request->Vehcile_Make[$key],
                                    'Vehcile_Model' => $request->Vehcile_Model[$key],
                                    'Vehcile_Color' => $request->Vehcile_Color[$key],
                                    'Vehcile_Type' => $request->Vehcile_Type[$key],
                                    'Vehcile_Condition' => $request->Vehcile_Condition[$key],
                                    'Trailer_Type' => $request->Trailer_Type[$key],
                                ]
                            );
                    } else {
                        ListingVehciles::create(
                            [
                                'Reg_By' => $Reg_By,
                                'Vin_Number' => $request->Vin_Number[$key],
                                'Vehcile_Year' => $request->Vehcile_Year[$key],
                                'Vehcile_Make' => $request->Vehcile_Make[$key],
                                'Vehcile_Model' => $request->Vehcile_Model[$key],
                                'Vehcile_Color' => $request->Vehcile_Color[$key],
                                'Vehcile_Type' => $request->Vehcile_Type[$key],
                                'Vehcile_Condition' => $request->Vehcile_Condition[$key],
                                'Trailer_Type' => $request->Trailer_Type[$key],
                                'order_id' => $Listed_ID,
                                'user_id' => $user_id,
                            ]
                        );
                    }
                    $flag = true;
                }
            } else if ($request->postType === 2 || $request->postType === '2') {
                foreach ($request->Equipment_Year as $key => $value) {
                    if (!empty($request->Vehcile_ID[$key])) {
                        ListingHeavyEquipment::where('id', $request->Vehcile_ID[$key])
                            ->update(
                                [
                                    'Equipment_Year' => $request->Equipment_Year[$key],
                                    'Equipment_Make' => $request->Equipment_Make[$key],
                                    'Equipment_Model' => $request->Equipment_Model[$key],
                                    'Equipment_Condition' => $request->Equipment_Condition[$key],
                                    'Trailer_Type' => $request->Trailer_Type[$key],
                                    'Equip_Length' => $request->Equip_Length[$key],
                                    'Equip_Width' => $request->Equip_Width[$key],
                                    'Equip_Height' => $request->Equip_Height[$key],
                                    'Equip_Weight' => $request->Equip_Weight[$key],
                                    'Shipment_Preferences' => $request->Shipment_Preferences[$key],
                                ]
                            );
                    } else {
                        ListingHeavyEquipment::create(
                            [
                                'Equipment_Year' => $request->Equipment_Year[$key],
                                'Equipment_Make' => $request->Equipment_Make[$key],
                                'Equipment_Model' => $request->Equipment_Model[$key],
                                'Equipment_Condition' => $request->Equipment_Condition[$key],
                                'Trailer_Type' => $request->Trailer_Type[$key],
                                'Equip_Length' => $request->Equip_Length[$key],
                                'Equip_Width' => $request->Equip_Width[$key],
                                'Equip_Height' => $request->Equip_Height[$key],
                                'Equip_Weight' => $request->Equip_Weight[$key],
                                'Shipment_Preferences' => $request->Shipment_Preferences[$key],
                                'order_id' => $Listed_ID,
                                'user_id' => $user_id,
                            ]
                        );
                    }
                    $flag = true;
                }
            } else if ($request->postType === 3 || $request->postType === '3') {
                foreach ($request->Freight_Weight as $key => $value) {
                    if (!empty($request->Vehcile_ID[$key])) {
                        ListingDryVan::where('id', $request->Vehcile_ID[$key])
                            ->update(
                                [
                                    'Freight_Class' => $request->Freight_Class[$key],
                                    'Freight_Weight' => $request->Freight_Weight[$key],
                                    'is_hazmat_Check' => !empty($request->is_hazmat_Check[$key]) ? $request->is_hazmat_Check[$key] : 0,
                                    'Shipment_Preferences' => $request->Shipment_Preferences[$key],
                                ]
                            );
                    } else {
                        ListingDryVan::create(
                            [
                                'Freight_Class' => $request->Freight_Class[$key],
                                'Freight_Weight' => $request->Freight_Weight[$key],
                                'is_hazmat_Check' => !empty($request->is_hazmat_Check[$key]) ? $request->is_hazmat_Check[$key] : 0,
                                'Shipment_Preferences' => $request->Shipment_Preferences[$key],
                                'order_id' => $Listed_ID,
                                'user_id' => $user_id,
                            ]
                        );
                    }
                    $flag = true;
                }
            }

            if ($AllUserListing->update()) {
                $WaitingForApproval->user_id = $user_id;
                $WaitingForApproval->order_id = $Listed_ID;
                $WaitingForApproval->CMP_id = $request->Dispatch_Company_ID;

                if ($WaitingForApproval->save()) {
                    DispatchDriver::create([
                        'Driver_Name' => $request->Driver_Name,
                        'Driver_Email' => $request->Driver_Email,
                        'Driver_Phone' => $request->Driver_Phone,
                        'order_id' => $Listed_ID,
                        'user_id' => $user_id
                    ]);

                    // dd(AuthorizedUsers::find($request->Dispatch_Company_ID)->toArray());
                    $user = AuthorizedUsers::find($request->Dispatch_Company_ID);

                    $flag = DayDispatchHelper::SendNotificationOnStatusChanged('Waiting For Approval', $Listed_ID);
                    // $flag = $user->notify(new ListingAssigned($AllUserListing->Ref_ID));
                    if ($flag) {
                        DB::commit();
                        return redirect()->route('Waitings.Listing')->with('Success!', "Your Listing has been Dispatched Successfully!");
                    }
                    DB::rollBack();
                    return back()->with('Error!', "Something went Wrong with Notifications!");
                }
                DB::rollBack();
                return back()->with('Error!', "Your Listing hasn't been Dispatched");
            }
            DB::rollBack();
            return back()->with('Error!', "Listing not updated!");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('Error!', "An error occurred. Please try again later.");
        }
    }

    public function delete_req(Request $request)
    {
        $req = RequestBroker::findOrFail($request->req_id);
        $req_user = AuthorizedUsers::where('id', '!=', $req->requested_user->id)->first();
        $order = AllUserListing::findOrFail($req->order_id);
        $req->delete();

        $notification = new Notification();
        $notification->notification = 'Request made by ' . $req_user->Company_Name . ' against Order #' . $order->Ref_ID . ' has been deleted';
        $notification->order_id = $order->id;
        $notification->user_id = $req_user->id;
        $notification->save();

        return back()->with('success', "Request Declined");
    }
}
