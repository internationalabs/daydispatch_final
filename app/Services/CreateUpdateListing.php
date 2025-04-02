<?php

namespace App\Services;

use App\Helpers\DayDispatchHelper;
use App\Models\Listing\AllUserListing;
use App\Models\Listing\CancelledOrders;
use App\Models\Listing\ListingAdditionalInfo;
use App\Models\Listing\ListingDestinationLocation;
use App\Models\Listing\ListingDryVan;
use App\Models\Listing\ListingDryVanServices;
use App\Models\Listing\ListingHeavyEquipment;
use App\Models\Listing\ListingOrignLocation;
use App\Models\Listing\ListingPaymentInfo;
use App\Models\Listing\ListingPickupDeliverInfo;
use App\Models\Listing\ListingRoutes;
use App\Models\Listing\ListingVehciles;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Auth\AuthorizedUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyAllUsers;
use App\Models\Extras\Notification;

class CreateUpdateListing
{
    // Add New Listing For User
    public function AddNewListing(Request $request): RedirectResponse
    {
        // dd($request->toArray());
        if (isset($request->Vehcile_Year) && $request->Vehcile_Year != null) {
            $Vehcile_Year_count = count($request->Vehcile_Year);
        } else {
            $Vehcile_Year_count = 0;
        }

        if (isset($request->Vehcile_Year_ymm) && $request->Vehcile_Year_ymm != null) {
            $Vehcile_Year_ymm_count = count($request->Vehcile_Year_ymm);
        } else {
            $Vehcile_Year_ymm_count = 0;
        }

        $vehicle_count = $Vehcile_Year_count + $Vehcile_Year_ymm_count;

        DB::beginTransaction();
        $auth_user = Auth::guard('Authorized')->user();
        $user_id = Auth::guard('Authorized')->user()->id;
        $AllUserListing = new AllUserListing();
        $ListingPaymentInfo = new ListingPaymentInfo();
        $ListingAddtionalInfo = new ListingAdditionalInfo();
        $ListingPickupDeliverInfo = new ListingPickupDeliverInfo();
        $ListingRoutes = new ListingRoutes();
        $ListingOrignLocation = new ListingOrignLocation();
        $listing_destination_locations = new ListingDestinationLocation();

        $AllUserListing->user_id = $user_id;
        
        if($auth_user && $auth_user->admin_verify == 0){
            $AllUserListing->Custom_Listing = 0;
            $AllUserListing->Private_Listing = 1;
        }else{
            $AllUserListing->Custom_Listing = is_null($request->Custom_Listing) ? 0 : 1;
            $AllUserListing->Private_Listing = is_null($request->Private_Listing) ? 0 : 1;
            $AllUserListing->Posted_Date = $request->Custom_Date;
        }
        // if ($request->Custom_Listing == 0) {
        //     $AllUserListing->Listing_Status = 'Time Quote';
        // }elseif ($request->Private_Listing == 0) {
        //     $AllUserListing->Listing_Status = 'Pvt Listing';
        // }else{
        // }
        // dd($AllUserListing->Custom_Listing, $AllUserListing->Private_Listing);
        
        $AllUserListing->Listing_Status = 'Listed';
        $AllUserListing->Ref_ID = $request->Ref_ID;
        $AllUserListing->Listing_Type = $request->post_type;
        $AllUserListing->expire_at = Carbon::now()->addDays(5);
        $AllUserListing->vehicle_count = $vehicle_count;
        // dd($AllUserListing->Private_Listing);

        if ($AllUserListing->save()) {
            $ListingOrignLocation->user_id = $user_id;
            $ListingOrignLocation->order_id = $AllUserListing->id;
            $this->OriginLocation($request, $ListingOrignLocation);
            if ($ListingOrignLocation->save()) {
                $listing_destination_locations->user_id = $user_id;
                $listing_destination_locations->order_id = $AllUserListing->id;
                $this->DestinationLocation($request, $listing_destination_locations);
                if ($listing_destination_locations->save()) {
                    $ListingRoutes->user_id = $user_id;
                    $ListingRoutes->order_id = $AllUserListing->id;
                    $this->ListingRoutes($request, $ListingRoutes);

                    if ($ListingRoutes->save()) {
                        $flag = false;
                        if ($request->post_type === 1 || $request->post_type === '1') {
                            if (is_array($request->Vehcile_Year)) {
                                foreach ($request->Vehcile_Year as $key => $value) {
                                    $Reg_By = is_null($request->Vin_Number[$key]) ? 'YMM' : 'Vin Number';
                                    ListingVehciles::create([
                                        'Reg_By' => $Reg_By,
                                        'Vin_Number' => $request->Vin_Number[$key],
                                        'Vehcile_Year' => $request->Vehcile_Year[$key],
                                        'Vehcile_Make' => $request->Vehcile_Make[$key],
                                        'Vehcile_Model' => $request->Vehcile_Model[$key],
                                        'Vehcile_Color' => $request->Vehcile_Color[$key],
                                        'Vehcile_Type' => $request->Vehcile_Type[$key],
                                        'Vehcile_Condition' => $request->Vehcile_Condition[$key],
                                        'Trailer_Type' => $request->Trailer_Type[$key],
                                        'order_id' => $AllUserListing->id,
                                        'user_id' => $user_id,
                                    ]);
                                    $flag = true;
                                }
                            }
                            if (is_array($request->Vehcile_Year_ymm)) {
                                foreach ($request->Vehcile_Year_ymm as $key => $value) {
                                    $Reg_By = is_null($request->Vin_Number[$key]) ? 'YMM' : 'Vin Number';
                                    ListingVehciles::create([
                                        'Reg_By' => $Reg_By,
                                        'Vin_Number' => $request->Vin_Number[$key],
                                        'Vehcile_Year' => $request->Vehcile_Year_ymm[$key],
                                        'Vehcile_Make' => $request->Vehcile_Make_ymm[$key],
                                        'Vehcile_Model' => $request->Vehcile_Model_ymm[$key],
                                        'Vehcile_Color' => $request->Vehcile_Color[$key],
                                        'Vehcile_Type' => $request->Vehcile_Type[$key],
                                        'Vehcile_Condition' => $request->Vehcile_Condition[$key],
                                        'Trailer_Type' => $request->Trailer_Type[$key],
                                        'order_id' => $AllUserListing->id,
                                        'user_id' => $user_id,
                                    ]);
                                    $flag = true;
                                }
                            }
                        } else if ($request->post_type === 2 || $request->post_type === '2') {
                            foreach ($request->Equipment_Year as $key => $value) {
                                ListingHeavyEquipment::create([
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
                                    'order_id' => $AllUserListing->id,
                                    'user_id' => $user_id,
                                ]);
                                $flag = true;
                            }
                        } else if ($request->post_type === 3 || $request->post_type === '3') {
                            foreach ($request->Freight_Weight as $key => $value) {
                                ListingDryVan::create(
                                    [
                                        'Freight_Class' => $request->Freight_Class[$key],
                                        'Freight_Weight' => $request->Freight_Weight[$key],
                                        'is_hazmat_Check' => !empty($request->is_hazmat_Check[$key]) ? $request->is_hazmat_Check[$key] : 0,
                                        'Shipment_Preferences' => $request->Shipment_Preferences[$key],
                                        'Trailer_Type_Dry' => $request->Trailer_Type_Dry[$key],
                                        'order_id' => $AllUserListing->id,
                                        'user_id' => $user_id,
                                    ]
                                );
                                $flag = true;
                            }
                            // dd($request->Pickup_Service);
                            if ($request->has('Pickup_Service') && count($request->Pickup_Service) > 0) {
                                foreach ($request->Pickup_Service as $key => $value) {
                                    ListingDryVanServices::create([
                                        'Pickup_Service' => $request->Pickup_Service[$key],
                                        'Delivery_Service' => $request->Delivery_Service[$key],
                                        'order_id' => $AllUserListing->id,
                                        'user_id' => $user_id
                                    ]);
                                    $flag = true;
                                }
                            }
                        }
                        if ($flag) {
                            $ListingPickupDeliverInfo->user_id = $user_id;
                            $ListingPickupDeliverInfo->order_id = $AllUserListing->id;
                            $ListingPickupDeliverInfo->Pickup_Date = $request->Pickup_Date;
                            $ListingPickupDeliverInfo->Pickup_Date_mode = $request->PickUp_mode;
                            $ListingPickupDeliverInfo->Delivery_Date = $request->Delivery_Date;
                            $ListingPickupDeliverInfo->Delivery_Date_mode = $request->Delivery_mode;
                            $ListingPickupDeliverInfo->Pickup_Start_Time = $request->Pickup_Start_Time;
                            $ListingPickupDeliverInfo->Pickup_End_Time = $request->Pickup_End_Time;
                            $ListingPickupDeliverInfo->Delivery_Start_Time = $request->Delivery_Start_Time;
                            $ListingPickupDeliverInfo->Delivery_End_Time = $request->Delivery_End_Time;
                            if ($ListingPickupDeliverInfo->save()) {
                                $this->PaymentInfo($request, $ListingPaymentInfo);
                                $ListingPaymentInfo->order_id = $AllUserListing->id;
                                $ListingPaymentInfo->user_id = $user_id;
                                if ($ListingPaymentInfo->save()) {
                                    $ListingAddtionalInfo->user_id = $user_id;
                                    $ListingAddtionalInfo->order_id = $AllUserListing->id;
                                    $ListingAddtionalInfo->Additional_Terms = $request->Additional_Terms;
                                    $ListingAddtionalInfo->Special_Instructions = $request->Special_Terms;
                                    $ListingAddtionalInfo->Notes_Customer = $request->Special_Notes;
                                    $ListingAddtionalInfo->Contract = $request->Listing_Contract;
                                    $ListingAddtionalInfo->Vehcile_Desc = $request->Vehcile_Desc;

                                    // Send Email to All Carriers
                                    $Lisiting = AllUserListing::with('vehicles', 'heavy_equipments', 'dry_vans')->where('id', $AllUserListing->id)->first();
                                    if ($Lisiting->post_type === 1 || $Lisiting->post_type === '1') {
                                        if ($Lisiting->vehicles) {
                                            if (count($Lisiting->vehicles) === 1) {
                                                $mailData['vehicle'] = $Lisiting->vehicles[0]->Vehcile_Year . ' ' . $Lisiting->vehicles[0]->Vehcile_Make . ' ' . $Lisiting->vehicles[0]->Vehcile_Model;
                                            } else {
                                                $mailData['vehicle'] = count($Lisiting->vehicles);
                                            }
                                        }
                                    } elseif ($Lisiting->post_type === 2 || $Lisiting->post_type === '2') {
                                        if ($Lisiting->heavy_equipments) {
                                            if (count($Lisiting->heavy_equipments) === 1) {
                                                $mailData['vehicle'] = $Lisiting->heavy_equipments[0]->Equipment_Year . ' ' . $Lisiting->heavy_equipments[0]->Equipment_Make . ' ' . $Lisiting->heavy_equipments[0]->Equipment_Model;
                                            } else {
                                                $mailData['vehicle'] = count($Lisiting->heavy_equipments);
                                            }
                                        }
                                    } elseif ($Lisiting->post_type === 3 || $Lisiting->post_type === '3') {
                                        if ($Lisiting->dry_vans) {
                                            if (count($Lisiting->dry_vans) === 1) {
                                                $mailData['vehicle'] = $Lisiting->dry_vans[0]->Freight_Class;
                                            } else {
                                                $mailData['vehicle'] = count($Lisiting->dry_vans);
                                            }
                                        }
                                    }

                                    $users = AuthorizedUsers::where('usr_type', 'Carrier')
                                        ->where('id', '!=', $user_id)
                                        ->get();

                                    $mailData = [
                                        'id' => $Lisiting->id,
                                        'Ref_ID' => $Lisiting->Ref_ID,
                                        'Assign_User_Name' => $Lisiting->authorized_user->Company_Name,
                                        'Status' => $Lisiting->Listing_Status,
                                        'Created_At' => $Lisiting->updated_at,
                                        'Assign_User_Email' => $Lisiting->authorized_user->email,
                                        'Listed_Price' => $Lisiting->paymentinfo->Order_Booking_Price,
                                        'Listed_User_Name' => $Lisiting->authorized_user->email,
                                        'Payment_Method' => $Lisiting->paymentinfo->Order_Booking_Price,
                                        'Origin_Address' => $Lisiting->routes->Origin_Address,
                                        'Origin_Address_II' => $Lisiting->routes->Origin_Address_II,
                                        'Origin_ZipCode' => $Lisiting->routes->Origin_ZipCode,
                                        'Destination_Address' => $Lisiting->routes->Destination_Address,
                                        'Destination_Address_II' => $Lisiting->routes->Destination_Address_II,
                                        'Dest_ZipCode' => $Lisiting->routes->Dest_ZipCode,
                                    ];

                                    // Send email and save notification to each user
                                    foreach ($users as $user) {

                                        if ($auth_user->is_custom_notify) {
                                            $Notification = new Notification();
                                            $Notification->Notification = 'New Order #' . $mailData['Ref_ID'] . ' Has Been ' . $mailData['Status'] . '!';
                                            $Notification->order_id = $mailData['id'];
                                            $Notification->user_id = $user->id;
                                            $Notification->save();
                                        }

                                        // if ($auth_user->is_email_notify) {
                                        //     Mail::to($user->email)->send(new NotifyAllUsers($mailData));
                                        // }
                                    }
                                    // End Send Email to All Carriers

                                    if ($ListingAddtionalInfo->save()) {
                                        // dd('1', $flag);
                                        if (!empty($request->Vehcile_Images)) {
                                            $flaga = false;
                                            $last_id = $AllUserListing->id;
                                            foreach ($request->file('Vehcile_Images') as $key => $ImageFile) {
                                                $imageGalleryName = $ImageFile->getClientOriginalName();
                                                $ImageFile->move(public_path('Uploads/Attachments/' . $last_id . '/'), $imageGalleryName);
                                                $FileName = 'Uploads/Attachments/' . $last_id . '/' . $imageGalleryName;
                                                $insertAttachment = "INSERT INTO `listing_attachments`(`Image_Name`, `order_id`, `user_id`) VALUES ('" . $FileName . "', '" . $AllUserListing->id . "', '" . $user_id . "')";
                                                DB::insert($insertAttachment);
                                                $flaga = true;
                                            }
                                            if ($flaga) {
                                                DayDispatchHelper::SendNotificationOnStatusChanged2('Listed', $last_id);
                                                DB::commit();
                                                // dd('2', $flaga, $request->toArray());
                                                // if ($AllUserListing->Listing_Status === 'Time Quote') {
                                                //     return redirect()->route('Time.Qoute')->with('Success!', 'Your Time Quote Inserted Successfully!');
                                                // }
                                                return redirect()->route('User.Listing')->with('Success!', "New Listing Inserted Successfully!");
                                            }
                                            DB::rollBack();
                                            return back()->with('Error!', "Attachment are Not Attach to Listing");
                                        }
                                        // dd('3', $flag, $request->toArray());
                                        $last_id = $AllUserListing->id;
                                        DayDispatchHelper::SendNotificationOnStatusChanged2('Listed', $last_id);
                                        DB::commit();
                                        // if ($AllUserListing->Listing_Status === 'Time Quote') {
                                        //     return redirect()->route('Time.Qoute')->with('Success!', 'Your Time Quote Inserted Successfully!');
                                        // }
                                        return redirect()->route('User.Listing')->with('Success!', "New Listing Inserted Successfully!");
                                    }

                                    DB::rollBack();
                                    return back()->with('Error!', "Additional Info Not Inserted");
                                }
                                DB::rollBack();
                                return back()->with('Error!', "Payment Info Not Inserted");
                            }
                            DB::rollBack();
                            return back()->with('Error!', "Pick & Delivery Info Not Inserted");
                        }
                        DB::rollBack();
                        return back()->with('Error!', "Vehicles Not Inserted");
                    }
                    DB::rollBack();
                    return back()->with('Error!', "Listing Routes Not Inserted");
                }
                DB::rollBack();
                return back()->with('Error!', "Destination Location Listing Not Inserted");
            }
            DB::rollBack();
            return back()->with('Error!', "Origin Location Listing Not Inserted");
        }
        DB::rollBack();
        return back()->with('Error!', "General User Listing Not Inserted");
    }

    public function updateListing(Request $request): RedirectResponse
    {
        // dd($request->toArray());
        if (isset($request->Vehcile_Year) && $request->Vehcile_Year != null) {
            $Vehcile_Year_count = count($request->Vehcile_Year);
        } else {
            $Vehcile_Year_count = 0;
        }
        if (isset($request->Vehcile_Year_ymm) && $request->Vehcile_Year_ymm != null) {
            $Vehcile_Year_ymm_count = count($request->Vehcile_Year_ymm);
        } else {
            $Vehcile_Year_ymm_count = 0;
        }
        $vehicle_count = $Vehcile_Year_count + $Vehcile_Year_ymm_count;

        DB::beginTransaction();
        $user_id = Auth::guard('Authorized')->user()->id;
        $Listed_ID = $request->List_ID;
        $ListingPaymentInfo = ListingPaymentInfo::where('order_id', $Listed_ID)->first();
        $ListingAddtionalInfo = ListingAdditionalInfo::where('order_id', $Listed_ID)->first();
        $ListingPickupDeliverInfo = ListingPickupDeliverInfo::where('order_id', $Listed_ID)->first();
        $ListingRoutes = ListingRoutes::where('order_id', $Listed_ID)->first();
        $ListingOrignLocation = ListingOrignLocation::where('order_id', $Listed_ID)->first();
        $listing_destination_locations = ListingDestinationLocation::where('order_id', $Listed_ID)->first();

        $Record_Update = CancelledOrders::where('order_id', $Listed_ID)->first();

        $AllUserListing = AllUserListing::where('id', $Listed_ID)->first();
        $AllUserListing->vehicle_count = $vehicle_count;
        $AllUserListing->save();
        $AllUserListing = AllUserListing::where('id', $Listed_ID)->first();
        $AllUserListing->Posted_Date = $request->Custom_Date;
        $AllUserListing->update();

        $date = Carbon::now();
        if (!empty($Record_Update)) {
            $AllUserListing = AllUserListing::where('id', $Record_Update->order_id)->first();
            $AllUserListing->Listing_Status = 'Listed';
            if ($AllUserListing->update()) {
                DayDispatchHelper::SendNotificationOnStatusChanged2('Listed', $Listed_ID);
                $Record_Update->delete();
            }
        }

        if (isset($request->isExpire) && $request->isExpire === '1') {
            $AllUserListing = AllUserListing::where('id', $Listed_ID)->first();
            $AllUserListing->Listing_Status = 'Listed';
            $AllUserListing->expire_at = $date->addDays(5);
            $AllUserListing->created_at = $date;
            if ($AllUserListing->update()) {
                DayDispatchHelper::SendNotificationOnStatusChanged2('Listed', $Listed_ID);
            }
        }

        $this->OriginLocation($request, $ListingOrignLocation);
        if ($ListingOrignLocation->update()) {
            $this->DestinationLocation($request, $listing_destination_locations);
            if ($listing_destination_locations->update()) {
                $this->ListingRoutes($request, $ListingRoutes);
                if ($ListingRoutes->update()) {
                    $flag = false;
                    if ($request->postType === 1 || $request->postType === '1') {
                        if (is_array($request->Vehcile_Year)) {
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
                        }
                        if (is_array($request->Vehcile_Year_ymm)) {
                            foreach ($request->Vehcile_Year_ymm as $key => $value) {
                                $Reg_By = is_null($request->Vin_Number[$key]) ? 'YMM' : 'Vin Number';
                                if (!empty($request->Vehcile_ID[$key])) {
                                    ListingVehciles::where('id', $request->Vehcile_ID[$key])
                                        ->update(
                                            [
                                                'Reg_By' => $Reg_By,
                                                'Vin_Number' => $request->Vin_Number[$key],
                                                'Vehcile_Year' => $request->Vehcile_Year_ymm[$key],
                                                'Vehcile_Make' => $request->Vehcile_Make_ymm[$key],
                                                'Vehcile_Model' => $request->Vehcile_Model_ymm[$key],
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
                                            'Vehcile_Year' => $request->Vehcile_Year_ymm[$key],
                                            'Vehcile_Make' => $request->Vehcile_Make_ymm[$key],
                                            'Vehcile_Model' => $request->Vehcile_Model_ymm[$key],
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
                        }

                        // Uploading additional images
                        if (!empty($request->Vehcile_Images)) {
                            $flaga = false;
                            $last_id = $Listed_ID;
                            foreach ($request->file('Vehcile_Images') as $key => $ImageFile) {
                                $imageGalleryName = $ImageFile->getClientOriginalName();
                                $ImageFile->move(public_path('Uploads/Attachments/' . $last_id . '/'), $imageGalleryName);
                                $FileName = 'Uploads/Attachments/' . $last_id . '/' . $imageGalleryName;
                                $insertAttachment = "INSERT INTO `listing_attachments`(`Image_Name`, `order_id`, `user_id`) VALUES ('" . $FileName . "', '" . $Listed_ID . "', '" . $user_id . "')";
                                DB::insert($insertAttachment);
                                $flaga = true;
                            }
                            if ($flaga) {
                                DayDispatchHelper::SendNotificationOnStatusChanged2('Listed', $last_id);
                            } else {
                                DB::rollBack();
                                return back()->with('Error!', "Attachment are Not Attach to Listing");
                            }
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
                                            'Trailer_Type_Dry' => $request->Trailer_Type_Dry[$key],
                                        ]
                                    );
                            } else {
                                ListingDryVan::create(
                                    [
                                        'Freight_Class' => $request->Freight_Class[$key],
                                        'Freight_Weight' => $request->Freight_Weight[$key],
                                        'is_hazmat_Check' => !empty($request->is_hazmat_Check[$key]) ? $request->is_hazmat_Check[$key] : 0,
                                        'Shipment_Preferences' => $request->Shipment_Preferences[$key],
                                        'Trailer_Type_Dry' => $request->Trailer_Type_Dry[$key],
                                        'order_id' => $Listed_ID,
                                        'user_id' => $user_id,
                                    ]
                                );
                            }
                            $flag = true;
                        }
                    }
                    if ($flag) {
                        $ListingPickupDeliverInfo->Pickup_Date = $request->Pickup_Date;
                        $ListingPickupDeliverInfo->Pickup_Date_mode = $request->PickUp_mode;
                        $ListingPickupDeliverInfo->Delivery_Date = $request->Delivery_Date;
                        $ListingPickupDeliverInfo->Delivery_Date_mode = $request->Delivery_mode;
                        $ListingPickupDeliverInfo->Pickup_Start_Time = $request->Pickup_Start_Time;
                        $ListingPickupDeliverInfo->Pickup_End_Time = $request->Pickup_End_Time;
                        $ListingPickupDeliverInfo->Delivery_Start_Time = $request->Delivery_Start_Time;
                        $ListingPickupDeliverInfo->Delivery_End_Time = $request->Delivery_End_Time;
                        if ($ListingPickupDeliverInfo->update()) {
                            $this->PaymentInfo($request, $ListingPaymentInfo);
                            if ($ListingPaymentInfo->update()) {
                                $ListingAddtionalInfo->Additional_Terms = $request->Additional_Terms;
                                $ListingAddtionalInfo->Special_Instructions = $request->Special_Terms;
                                $ListingAddtionalInfo->Notes_Customer = $request->Special_Notes;
                                $ListingAddtionalInfo->Contract = $request->Listing_Contract;
                                $ListingAddtionalInfo->Vehcile_Desc = $request->Vehcile_Desc;

                                $AllUserListing = AllUserListing::where('id', $Listed_ID)->first();
                                if ($AllUserListing) {
                                    $AllUserListing->touch();
                                    $AllUserListing->save();
                                }

                                if ($ListingAddtionalInfo->update()) {
                                    DB::commit();
                                    if ($AllUserListing->Listing_Status === 'Time Quote') {
                                        return redirect()->route('Time.Qoute')->with('Success!', 'Your Time Quote Updated Successfully!');
                                    }
                                    return redirect()->route('User.Listing')->with('Success!', "Your Listing Updated Successfully!");
                                }
                                DB::rollBack();
                                return back()->with('Error!', "Additional Info Not Inserted");
                            }
                            DB::rollBack();
                            return back()->with('Error!', "Payment Info Not Inserted");
                        }
                        DB::rollBack();
                        return back()->with('Error!', "Pick & Delivery Info Not Inserted");
                    }
                    DB::rollBack();
                    return back()->with('Error!', "Vehicles Not Inserted");
                }
                DB::rollBack();
                return back()->with('Error!', "Listing Routes Not Inserted");
            }
            DB::rollBack();
            return back()->with('Error!', "Destination Location Listing Not Inserted");
        }
        DB::rollBack();
        return back()->with('Error!', "Origin Location Listing Not Inserted");
    }

    /**
     * @param Request $request
     * @param ListingOrignLocation $ListingOrignLocation
     * @return void
     */
    public function OriginLocation(Request $request, ListingOrignLocation $ListingOrignLocation): void
    {
        $ListingOrignLocation->Orign_Location = $request->Orign_Location;
        $ListingOrignLocation->User_Name = $request->User_Name;
        $ListingOrignLocation->User_Email = $request->User_Email;
        // $ListingOrignLocation->Local_Phone = implode(',', $request->Local_Phone);
        $ListingOrignLocation->Local_Phone = implode(',', array_filter($request->Local_Phone, function($value) {
            return $value !== null;
        }));
        $ListingOrignLocation->Stock_Number = $request->Stock_Number;
        // dd($ListingOrignLocation->Local_Phone);
        // $ListingOrignLocation->Location = $request->Location;


        // if ($request->has('Auction_Method') && $request->Auction_Method != null) {

        //     $ListingOrignLocation->Auction_Method = $request->Auction_Method;

        // } elseif ($request->has('Dealer_Auction_Method') && $request->Dealer_Auction_Method != null) {

        //     $ListingOrignLocation->Auction_Method = $request->Dealer_Auction_Method;

        // }

        // if ($request->has('Auction_Phone') && $request->Auction_Phone != null) {

        //     $ListingOrignLocation->Auction_Phone = $request->Auction_Phone;

        // } elseif ($request->has('Dealer_Auction_Phone') && $request->Dealer_Auction_Phone != null) {

        //     $ListingOrignLocation->Auction_Phone = $request->Dealer_Auction_Phone;

        // }

        // if ($request->has('Stock_Number') && $request->Stock_Number != null) {

        //     $ListingOrignLocation->Stock_Number = $request->Stock_Number;

        // } elseif ($request->has('Dealer_Stock_Number') && $request->Dealer_Stock_Number != null) {

        //     $ListingOrignLocation->Stock_Number = $request->Dealer_Stock_Number;

        // }

        // if ($request->has('Business_Phone') && $request->Business_Phone != null) {

        //     $ListingOrignLocation->Business_Phone = $request->Business_Phone;

        // }

        // if ($request->has('Business_Location') && $request->Business_Location != null) {

        //     $ListingOrignLocation->Business_Location = $request->Business_Location;

        // }

    }

    /**
     * @param Request $request
     * @param ListingDestinationLocation $listing_destination_locations
     * @return void
     */
    // public function DestinationLocation(Request $request, ListingDestinationLocation $listing_destination_locations): void
    // {
    //     $listing_destination_locations->Destination_Location = $request->Destination_Location;
    //     $listing_destination_locations->Dest_User_Name = $request->Dest_User_Name;
    //     $listing_destination_locations->Dest_User_Email = $request->Dest_User_Email;
    //     $listing_destination_locations->Dest_Local_Phone = $request->Dest_Local_Phone;
    //     $listing_destination_locations->Dest_Location = $request->Dest_Location;
    //     if ($request->has('Dest_Auction_Method') && $request->Dest_Auction_Method != null) {
    //         # code...
    //         $listing_destination_locations->Dest_Auction_Method = $request->Dest_Auction_Method;
    //     } elseif ($request->has('Port_Dest_Auction_Method') && $request->Port_Dest_Auction_Method != null) {
    //         $listing_destination_locations->Dest_Auction_Method = $request->Port_Dest_Auction_Method;

    //     } elseif ($request->has('Dealer_Dest_Auction_Method') && $request->Dealer_Dest_Auction_Method != null) {
    //         $listing_destination_locations->Dest_Auction_Method = $request->Dealer_Dest_Auction_Method;

    //     }
    //     if ($request->has('Dest_Auction_Phone') && $request->Dest_Auction_Phone != null) {
    //         $listing_destination_locations->Dest_Auction_Phone = $request->Dest_Auction_Phone;

    //     } elseif ($request->has('Dealer_Dest_Auction_Phone') && $request->Dealer_Dest_Auction_Phone != null) {
    //         $listing_destination_locations->Dest_Auction_Method = $request->Dealer_Dest_Auction_Phone;

    //     } elseif ($request->has('Port_Dest_Auction_Phone') && $request->Port_Dest_Auction_Phone != null) {
    //         $listing_destination_locations->Dest_Auction_Method = $request->Port_Dest_Auction_Phone;

    //     }
    //     if ($request->has('Dest_Stock_Number') && $request->Dest_Stock_Number != null) {
    //         $listing_destination_locations->Dest_Stock_Number = $request->Dest_Stock_Number;

    //     } elseif ($request->has('Dealer_Dest_Stock_Number') && $request->Dealer_Dest_Stock_Number != null) {
    //         $listing_destination_locations->Dest_Stock_Number = $request->Dealer_Dest_Stock_Number;

    //     } elseif ($request->has('Port_Dest_Stock_Number') && $request->Port_Dest_Stock_Number != null) {
    //         $listing_destination_locations->Dest_Stock_Number = $request->Port_Dest_Stock_Number;

    //     }

    //     if ($request->has('Dest_Business_Phone') && $request->Dest_Business_Phone != null) {

    //         $listing_destination_locations->Dest_Business_Phone = $request->Dest_Business_Phone;

    //     }

    //     if ($request->has('Dest_Business_Location') && $request->Dest_Business_Location != null) {

    //         $listing_destination_locations->Dest_Business_Location = $request->Dest_Business_Location;

    //     }
    //     $listing_destination_locations->Dest_Stock_Number = $request->Dest_Stock_Number;
    // }

    public function DestinationLocation(Request $request, ListingDestinationLocation $listing_destination_locations): void
    {
        $maxIndex = 15; // maximum index for numbered variables

        // Variables that can have numbers at the end
        // $numberedVars = [
        //     'Dest_Auction_Method',
        //     'Dest_Auction_Phone',
        //     'Dest_Stock_Number'
        // ];

        // // Iterate through numbered variables
        // foreach ($numberedVars as $var) {
        //     $value = null;

        //     // Check for numbered version
        //     for ($i = 0; $i <= $maxIndex; $i++) {
        //         $variableName = $var . $i;
        //         if ($request->has($variableName) && $request->$variableName !== null) {
        //             $value = $request->$variableName;
        //             break; // Stop loop once a value is found
        //         }
        //     }

        //     // Assign value if found
        //     if ($value !== null) {
        //         $listing_destination_locations->$var = $value;
        //     }
        // }
        if ($request->has('Dest_Auction_Method') && $request->Dest_Auction_Method != null) {
            //         # code...
                    $listing_destination_locations->Dest_Auction_Method = $request->Dest_Auction_Method;
                } elseif ($request->has('Port_Dest_Auction_Method') && $request->Port_Dest_Auction_Method != null) {
                    $listing_destination_locations->Dest_Auction_Method = $request->Port_Dest_Auction_Method;
        
                } elseif ($request->has('Dealer_Dest_Auction_Method') && $request->Dealer_Dest_Auction_Method != null) {
                    $listing_destination_locations->Dest_Auction_Method = $request->Dealer_Dest_Auction_Method;
        
                }
                if ($request->has('Dest_Auction_Phone') && $request->Dest_Auction_Phone != null) {
                    $listing_destination_locations->Dest_Auction_Phone = $request->Dest_Auction_Phone;
        
                } elseif ($request->has('Dealer_Dest_Auction_Phone') && $request->Dealer_Dest_Auction_Phone != null) {
                    $listing_destination_locations->Dest_Auction_Method = $request->Dealer_Dest_Auction_Phone;
        
                } elseif ($request->has('Port_Dest_Auction_Phone') && $request->Port_Dest_Auction_Phone != null) {
                    $listing_destination_locations->Dest_Auction_Method = $request->Port_Dest_Auction_Phone;
        
                }
                if ($request->has('Dest_Stock_Number') && $request->Dest_Stock_Number != null) {
                    $listing_destination_locations->Dest_Stock_Number = $request->Dest_Stock_Number;
        
                } elseif ($request->has('Dealer_Dest_Stock_Number') && $request->Dealer_Dest_Stock_Number != null) {
                    $listing_destination_locations->Dest_Stock_Number = $request->Dealer_Dest_Stock_Number;
        
                } elseif ($request->has('Port_Dest_Stock_Number') && $request->Port_Dest_Stock_Number != null) {
                    $listing_destination_locations->Dest_Stock_Number = $request->Port_Dest_Stock_Number;
        
                }
        // dd($listing_destination_locations->toArray(), $request->toArray());

        // Assign non-numbered variables
        $nonNumberedVars = [
            'Destination_Location',
            'Dest_User_Name',
            'Dest_User_Email',
            'Dest_Local_Phone',
            'Dest_Location',
            'Dest_Business_Phone',
            'Dest_Business_Location'
            // Add other non-numbered variables here
        ];

        foreach ($nonNumberedVars as $var) {
            if ($request->has($var) && $request->$var !== null) {
                if ($var == 'Dest_Local_Phone') {
                    $listing_destination_locations->$var = implode(',', array_filter($request->$var, function($value) {
                        return $value !== null;
                    }));
                    // $listing_destination_locations->$var = implode(',', $request->$var);
                } else {
                    $listing_destination_locations->$var = $request->$var;
                }
                
            }
        }

        // dd($listing_destination_locations->Dest_Local_Phone);
    }

    /**
     * @param Request $request
     * @param ListingRoutes $ListingRoutes
     * @return void
     */
    public function ListingRoutes(Request $request, ListingRoutes $ListingRoutes): void
    {
        $ListingRoutes->Origin_Address = $request->Origin_Address;
        $ListingRoutes->Origin_Address_II = $request->Origin_Address_II;
        $ListingRoutes->Origin_ZipCode = $request->Origin_ZipCode;
        $ListingRoutes->Origin_City = $request->Origin_City ?? '';
        $ListingRoutes->Origin_State = $request->Origin_State ?? '';
        $ListingRoutes->Destination_Address = $request->Destination_Address;
        $ListingRoutes->Destination_City = $request->Dest_City ?? '';
        $ListingRoutes->Destination_State = $request->Dest_State ?? '';
        $ListingRoutes->Destination_Address_II = $request->Destination_Address_II;
        $ListingRoutes->Dest_ZipCode = $request->Dest_ZipCode;

        $From = Str::afterLast($request->Origin_ZipCode, ', ');
        $To = Str::afterLast($request->Dest_ZipCode, ', ');
        $ListingRoutes->Miles = DayDispatchHelper::twopoints_on_earth($From, $To);
    }

    /**
     * @param Request $request
     * @param ListingPaymentInfo $ListingPaymentInfo
     * @return void
     */
    public function PaymentInfo(Request $request, ListingPaymentInfo $ListingPaymentInfo): void
    {
        $ListingPaymentInfo->Order_Booking_Price = (int) $request->Booking_Price;
        $ListingPaymentInfo->Deposite_Amount = (int) $request->Deposite_Amount;
        $ListingPaymentInfo->Payment_Method_Mode = $request->Payment_Mode;
        $ListingPaymentInfo->Price_Pay_Carrier = (int) $request->Price_Pay;
        $ListingPaymentInfo->COD_Amount = (int) $request->COD_Amount;
        $ListingPaymentInfo->Balance_Amount = (int) $request->Bal_Amount;
        $ListingPaymentInfo->COD_Method_Mode = $request->COD_Payment_Mode;
        $ListingPaymentInfo->Bal_Method_Mode = $request->Balance_Payment_Mode;
        $ListingPaymentInfo->COD_Location_Amount = $request->Location_Mode;
        $ListingPaymentInfo->BAL_Payment_Time = $request->Bal_Payment_Time;
        $ListingPaymentInfo->BAL_Payment_Terms = $request->Payment_Terms;
        $ListingPaymentInfo->Payment_Desc = $request->Desc_For_Vehcile;
        $ListingPaymentInfo->PaymentInfo = $request->PaymentInfo ?? '';
        $ListingPaymentInfo->BalPaymentInfo = $request->BalPaymentInfo ?? '';
    }
}
