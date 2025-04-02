<?php

namespace App\Services;

use App\Helpers\DayDispatchHelper;
use App\Models\Quote\Order;
use App\Models\Quote\CancelledOrders;
use App\Models\Quote\OrderAdditionalInfo;
use App\Models\Quote\OrderDestinationLocation;
use App\Models\Quote\OrderDryVans;
use App\Models\Quote\OrderDryVanServices;
use App\Models\Quote\OrderHeavyEquipment;
use App\Models\Quote\OrderOriginLocation;
use App\Models\Quote\OrderPaymentInfo;
use App\Models\Quote\OrderPickupDeliverInfo;
use App\Models\Quote\OrderRoute;
use App\Models\Quote\OrderVehicle;
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

class CreateUpdateQuote
{
    // Add New Listing For User

    public function AddNewQuote(Request $request): RedirectResponse
    {
        // dd( $request->toArray() );
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
        $user_id = $auth_user->id;
        $Order = new Order();
        $OrderPaymentInfo = new OrderPaymentInfo();
        $OrderAddtionalInfo = new OrderAdditionalInfo();
        $OrderPickupDeliverInfo = new OrderPickupDeliverInfo();
        $OrderRoutes = new OrderRoute();
        $OrderOriginLocation = new OrderOriginLocation();
        $order_destination_locations = new OrderDestinationLocation();

        $Order->user_id = $user_id;
        $Order->Listing_Status = 'New Quote';
        $Order->Ref_ID = $request->Ref_ID;
        $Order->Custom_Listing = is_null($request->Custom_Listing) ? 0 : 1;
        $Order->Private_Listing = is_null($request->Private_Listing) ? 0 : 1;
        $Order->Posted_Date = $request->Custom_Date;
        $Order->Listing_Type = $request->post_type;
        $Order->expire_at = Carbon::now()->addDays(5);
        $Order->vehicle_count = $vehicle_count;
        $Order->Customer_Name = $request->Customer_Name;
        $Order->Customer_Email = $request->Customer_Email;
        $Order->Customer_Phone = $request->Customer_Phone;
        $Order->hear_about_us = $request->Hear_about;
        $Order->Referred_By = $request->Referred_By  ? $request->Referred_By : null;
        // dd( $Order->Private_Listing );

        if ($Order->save()) {
            $OrderOriginLocation->user_id = $user_id;
            $OrderOriginLocation->order_id = $Order->id;
            $this->OriginLocation($request, $OrderOriginLocation);
            if ($OrderOriginLocation->save()) {
                $order_destination_locations->user_id = $user_id;
                $order_destination_locations->order_id = $Order->id;
                $this->DestinationLocation($request, $order_destination_locations);

                if ($order_destination_locations->save()) {
                    $OrderRoutes->user_id = $user_id;
                    $OrderRoutes->order_id = $Order->id;
                    $this->OrderRoutes($request, $OrderRoutes);

                    if ($OrderRoutes->save()) {
                        $flag = false;
                        if ($request->post_type === 1 || $request->post_type === '1') {
                            if (is_array($request->Vehcile_Year)) {
                                foreach ($request->Vehcile_Year as $key => $value) {
                                    $Reg_By = is_null($request->Vin_Number[$key]) ? 'YMM' : 'Vin Number';
                                    OrderVehicle::create([
                                        'Reg_By' => $Reg_By,
                                        'Vin_Number' => $request->Vin_Number[$key],
                                        'Vehcile_Year' => $request->Vehcile_Year[$key],
                                        'Vehcile_Make' => $request->Vehcile_Make[$key],
                                        'Vehcile_Model' => $request->Vehcile_Model[$key],
                                        'Vehcile_Color' => $request->Vehcile_Color[$key],
                                        'Vehcile_Type' => $request->Vehcile_Type[$key],
                                        'Vehcile_Condition' => $request->Vehcile_Condition[$key],
                                        'Trailer_Type' => $request->Trailer_Type[$key],
                                        'order_id' => $Order->id,
                                        'user_id' => $user_id,
                                    ]);
                                    $flag = true;
                                }
                            }

                            if (is_array($request->Vehcile_Year_ymm)) {
                                foreach ($request->Vehcile_Year_ymm as $key => $value) {
                                    $Reg_By = is_null($request->Vin_Number[$key]) ? 'YMM' : 'Vin Number';
                                    OrderVehicle::create([
                                        'Reg_By' => $Reg_By,
                                        'Vin_Number' => $request->Vin_Number[$key],
                                        'Vehcile_Year' => $request->Vehcile_Year_ymm[$key],
                                        'Vehcile_Make' => $request->Vehcile_Make_ymm[$key],
                                        'Vehcile_Model' => $request->Vehcile_Model_ymm[$key],
                                        'Vehcile_Color' => $request->Vehcile_Color[$key],
                                        'Vehcile_Type' => $request->Vehcile_Type[$key],
                                        'Vehcile_Condition' => $request->Vehcile_Condition[$key],
                                        'Trailer_Type' => $request->Trailer_Type[$key],
                                        'order_id' => $Order->id,
                                        'user_id' => $user_id,
                                    ]);
                                    $flag = true;
                                }
                            }
                        } else if ($request->post_type === 2 || $request->post_type === '2') {
                            foreach ($request->Equipment_Year as $key => $value) {
                                OrderHeavyEquipment::create([
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
                                    'order_id' => $Order->id,
                                    'user_id' => $user_id,
                                ]);
                                $flag = true;
                            }
                        } else if ($request->post_type === 3 || $request->post_type === '3') {
                            foreach ($request->Freight_Weight as $key => $value) {
                                OrderDryVans::create(
                                    [
                                        'Freight_Class' => $request->Freight_Class[$key],
                                        'Freight_Weight' => $request->Freight_Weight[$key],
                                        'is_hazmat_Check' => !empty($request->is_hazmat_Check[$key]) ? $request->is_hazmat_Check[$key] : 0,
                                        'Shipment_Preferences' => $request->Shipment_Preferences[$key],
                                        'Trailer_Type_Dry' => $request->Trailer_Type_Dry[$key],
                                        'order_id' => $Order->id,
                                        'user_id' => $user_id,
                                    ]
                                );
                                $flag = true;
                            }
                            // dd( $request->Pickup_Service );
                            if ($request->has('Pickup_Service') && count($request->Pickup_Service) > 0) {
                                foreach ($request->Pickup_Service as $key => $value) {
                                    OrderDryVanServices::create([
                                        'Pickup_Service' => $request->Pickup_Service[$key],
                                        'Delivery_Service' => $request->Delivery_Service[$key],
                                        'order_id' => $Order->id,
                                        'user_id' => $user_id
                                    ]);
                                    $flag = true;
                                }
                            }
                        }
                        if ($flag) {
                            $OrderPickupDeliverInfo->user_id = $user_id;
                            $OrderPickupDeliverInfo->order_id = $Order->id;
                            $OrderPickupDeliverInfo->Pickup_Date = $request->Pickup_Date;
                            $OrderPickupDeliverInfo->Pickup_Date_mode = $request->PickUp_mode;
                            $OrderPickupDeliverInfo->Delivery_Date = $request->Delivery_Date;
                            $OrderPickupDeliverInfo->Delivery_Date_mode = $request->Delivery_mode;
                            $OrderPickupDeliverInfo->Pickup_Start_Time = $request->Pickup_Start_Time;
                            $OrderPickupDeliverInfo->Pickup_End_Time = $request->Pickup_End_Time;
                            $OrderPickupDeliverInfo->Delivery_Start_Time = $request->Delivery_Start_Time;
                            $OrderPickupDeliverInfo->Delivery_End_Time = $request->Delivery_End_Time;
                            if ($OrderPickupDeliverInfo->save()) {
                                $this->PaymentInfo($request, $OrderPaymentInfo);
                                $OrderPaymentInfo->order_id = $Order->id;
                                $OrderPaymentInfo->user_id = $user_id;
                                if ($OrderPaymentInfo->save()) {
                                    $OrderAddtionalInfo->user_id = $user_id;
                                    $OrderAddtionalInfo->order_id = $Order->id;
                                    $OrderAddtionalInfo->Additional_Terms = $request->Additional_Terms;
                                    $OrderAddtionalInfo->Special_Instructions = $request->Special_Terms;
                                    $OrderAddtionalInfo->Notes_Customer = $request->Special_Notes;
                                    $OrderAddtionalInfo->Contract = $request->Listing_Contract;
                                    $OrderAddtionalInfo->Vehcile_Desc = $request->Vehcile_Desc;

                                    // Send Email to All Carriers
                                    $Lisiting = Order::with('vehicles', 'heavy_equipments', 'dry_vans')->where('id', $Order->id)->first();
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
                                    }

                                    if ($OrderAddtionalInfo->save()) {
                                        // dd( '1', $flag );
                                        if (!empty($request->Vehcile_Images)) {
                                            $flaga = false;
                                            $last_id = $Order->id;
                                            foreach ($request->file('Vehcile_Images') as $key => $ImageFile) {
                                                $imageGalleryName = $ImageFile->getClientOriginalName();
                                                $ImageFile->move(public_path('Uploads/Attachments/' . $last_id . '/'), $imageGalleryName);
                                                $FileName = 'Uploads/Attachments/' . $last_id . '/' . $imageGalleryName;
                                                $insertAttachment = "INSERT INTO `listing_attachments`(`Image_Name`, `order_id`, `user_id`) VALUES ('" . $FileName . "', '" . $Order->id . "', '" . $user_id . "')";
                                                DB::insert($insertAttachment);
                                                $flaga = true;
                                            }
                                            if ($flaga) {
                                                DB::commit();
                                                return redirect()->route('New.Order')->with('Success!', 'New Quote Inserted Successfully!');
                                            }
                                            DB::rollBack();
                                            return back()->with('Error!', 'Attachment are Not Attach to Listing');
                                        }
                                        $last_id = $Order->id;
                                        DB::commit();
                                        return redirect()->route('New.Order')->with('Success!', 'New Quote Inserted Successfully!');
                                    }

                                    DB::rollBack();
                                    return back()->with('Error!', 'Additional Info Not Inserted');
                                }
                                DB::rollBack();
                                return back()->with('Error!', 'Payment Info Not Inserted');
                            }
                            DB::rollBack();
                            return back()->with('Error!', 'Pick & Delivery Info Not Inserted');
                        }
                        DB::rollBack();
                        return back()->with('Error!', 'Vehicles Not Inserted');
                    }
                    DB::rollBack();
                    return back()->with('Error!', 'Listing Routes Not Inserted');
                }
                DB::rollBack();
                return back()->with('Error!', 'Destination Location Listing Not Inserted');
            }
            DB::rollBack();
            return back()->with('Error!', 'Origin Location Listing Not Inserted');
        }
        DB::rollBack();
        return back()->with('Error!', 'General User Listing Not Inserted');
    }

    public function updateQuote(Request $request): RedirectResponse
    {
        // dd($request->selectedName);
        // dd( $request->toArray() );
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
        // dd($Listed_ID);
        $OrderPaymentInfo = OrderPaymentInfo::where('order_id', $Listed_ID)->first();
        $OrderAddtionalInfo = OrderAdditionalInfo::where('order_id', $Listed_ID)->first();
        $OrderPickupDeliverInfo = OrderPickupDeliverInfo::where('order_id', $Listed_ID)->first();
        $OrderRoutes = OrderRoute::where('order_id', $Listed_ID)->first();
        $OrderOriginLocation = OrderOriginLocation::where('order_id', $Listed_ID)->first();
        $order_destination_locations = OrderDestinationLocation::where('order_id', $Listed_ID)->first();

        // $Record_Update = CancelledOrders::where( 'order_id', $Listed_ID )->first();

        $Order = Order::where('id', $Listed_ID)->first();
        $Order->vehicle_count = $vehicle_count;
        $Order->Customer_Name = $request->Customer_Name;
        $Order->Customer_Email = $request->Customer_Email;
        $Order->Customer_Phone = $request->Customer_Phone;
        $Order->hear_about_us = $request->Hear_about;
        $Order->Referred_By = $request->Referred_By;
        if($Order->Listing_Status === 'Book Order') {
            $Order->Listing_Status = 'Book Order';
        }
        else{
        $Order->Listing_Status = $request->selectedName ?? 'New Quote';
        }
        // dd('okok');
        $Order->save();
        $Order = Order::where('id', $Listed_ID)->first();
        $Order->Posted_Date = $request->Custom_Date;
        $Order->update();

        $date = Carbon::now();
        // if ( !empty( $Record_Update ) ) {
        //     $Order = Order::where( 'id', $Record_Update->order_id )->first();
        //     $Order->Listing_Status = 'New Quote';
        //     if ( $Order->update() ) {
        //         DayDispatchHelper::SendNotificationOnStatusChanged2( 'New Quote', $Listed_ID );
        //         $Record_Update->delete();
        //     }
        // }

        if (isset($request->isExpire) && $request->isExpire === '1') {
            $Order = Order::where('id', $Listed_ID)->first();

            // $Order->Listing_Status = 'New Quote';
            $Order->Listing_Status = $request->selectedName ?? 'New Quote';

            $Order->expire_at = $date->addDays(5);
            $Order->created_at = $date;
            if ($Order->update()) {
                DayDispatchHelper::SendNotificationOnStatusChanged2('New Quote', $Listed_ID);
            }
        }

        $this->OriginLocation($request, $OrderOriginLocation);
        if ($OrderOriginLocation->update()) {
            $this->DestinationLocation($request, $order_destination_locations);
            if ($order_destination_locations->update()) {
                $this->OrderRoutes($request, $OrderRoutes);
                if ($OrderRoutes->update()) {
                    $flag = false;
                    if ($request->postType === 1 || $request->postType === '1') {
                        if (is_array($request->Vehcile_Year)) {
                            foreach ($request->Vehcile_Year as $key => $value) {
                                $Reg_By = is_null($request->Vin_Number[$key]) ? 'YMM' : 'Vin Number';
                                if (!empty($request->Vehcile_ID[$key])) {
                                    OrderVehicle::where('id', $request->Vehcile_ID[$key])
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
                                    OrderVehicle::create(
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
                                    OrderVehicle::where('id', $request->Vehcile_ID[$key])
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
                                    OrderVehicle::create(
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
                                DayDispatchHelper::SendNotificationOnStatusChanged2('New Quote', $last_id);
                            } else {
                                DB::rollBack();
                                return back()->with('Error!', 'Attachment are Not Attach to Listing');
                            }
                        }
                    } else if ($request->postType === 2 || $request->postType === '2') {
                        foreach ($request->Equipment_Year as $key => $value) {
                            if (!empty($request->Vehcile_ID[$key])) {
                                OrderHeavyEquipment::where('id', $request->Vehcile_ID[$key])
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
                                OrderHeavyEquipment::create(
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
                                OrderDryVans::where('id', $request->Vehcile_ID[$key])
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
                                OrderDryVans::create(
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
                        $OrderPickupDeliverInfo->Pickup_Date = $request->Pickup_Date;
                        $OrderPickupDeliverInfo->Pickup_Date_mode = $request->PickUp_mode;
                        $OrderPickupDeliverInfo->Delivery_Date = $request->Delivery_Date;
                        $OrderPickupDeliverInfo->Delivery_Date_mode = $request->Delivery_mode;
                        $OrderPickupDeliverInfo->Pickup_Start_Time = $request->Pickup_Start_Time;
                        $OrderPickupDeliverInfo->Pickup_End_Time = $request->Pickup_End_Time;
                        $OrderPickupDeliverInfo->Delivery_Start_Time = $request->Delivery_Start_Time;
                        $OrderPickupDeliverInfo->Delivery_End_Time = $request->Delivery_End_Time;
                        if ($OrderPickupDeliverInfo->update()) {
                            $this->PaymentInfo($request, $OrderPaymentInfo);
                            if ($OrderPaymentInfo->update()) {
                                $OrderAddtionalInfo->Additional_Terms = $request->Additional_Terms;
                                $OrderAddtionalInfo->Special_Instructions = $request->Special_Terms;
                                $OrderAddtionalInfo->Notes_Customer = $request->Special_Notes;
                                $OrderAddtionalInfo->Contract = $request->Listing_Contract;
                                $OrderAddtionalInfo->Vehcile_Desc = $request->Vehcile_Desc;

                                $Order = Order::where('id', $Listed_ID)->first();
                                if ($Order) {
                                    $Order->touch();
                                    $Order->save();
                                }

                                if ($OrderAddtionalInfo->update()) {
                                    DB::commit();
                                    
                                    if ($Order->Listing_Status === 'Book Order') {
                                        return redirect()->route('Book.Order')->with('Success!', 'Your Quote Updated Successfully!');
                                    }

                                    return redirect()->route('New.Order')->with('Success!', 'Your Quote Updated Successfully!');
                                }
                                DB::rollBack();
                                return back()->with('Error!', 'Additional Info Not Inserted');
                            }
                            DB::rollBack();
                            return back()->with('Error!', 'Payment Info Not Inserted');
                        }
                        DB::rollBack();
                        return back()->with('Error!', 'Pick & Delivery Info Not Inserted');
                    }
                    DB::rollBack();
                    return back()->with('Error!', 'Vehicles Not Inserted');
                }
                DB::rollBack();
                return back()->with('Error!', 'Listing Routes Not Inserted');
            }
            DB::rollBack();
            return back()->with('Error!', 'Destination Location Listing Not Inserted');
        }
        DB::rollBack();
        return back()->with('Error!', 'Origin Location Listing Not Inserted');
    }

    public function OriginLocation(Request $request, OrderOriginLocation $OrderOriginLocation): void
    {
        $OrderOriginLocation->Orign_Location = $request->Orign_Location;
        $OrderOriginLocation->User_Name = $request->User_Name;
        $OrderOriginLocation->User_Email = $request->User_Email;
        $OrderOriginLocation->Local_Phone = implode(',', array_filter($request->Local_Phone, function($value) {
            return $value !== null;
        }));
        // $OrderOriginLocation->Local_Phone = $request->Local_Phone;
        $OrderOriginLocation->Location = $request->Location;

        if ($request->has('Auction_Method') && $request->Auction_Method != null) {

            $OrderOriginLocation->Auction_Method = $request->Auction_Method;

        } elseif ($request->has('Dealer_Auction_Method') && $request->Dealer_Auction_Method != null) {

            $OrderOriginLocation->Auction_Method = $request->Dealer_Auction_Method;
        }

        if ($request->has('Auction_Phone') && $request->Auction_Phone != null) {

            $OrderOriginLocation->Auction_Phone = $request->Auction_Phone;
            
        } elseif ($request->has('Dealer_Auction_Phone') && $request->Dealer_Auction_Phone != null) {

            $OrderOriginLocation->Auction_Phone = $request->Dealer_Auction_Phone;
        }

        if ($request->has('Stock_Number') && $request->Stock_Number != null) {

            $OrderOriginLocation->Stock_Number = $request->Stock_Number;
        } elseif ($request->has('Dealer_Stock_Number') && $request->Dealer_Stock_Number != null) {

            $OrderOriginLocation->Stock_Number = $request->Dealer_Stock_Number;
        }

        if ($request->has('Business_Phone') && $request->Business_Phone != null) {

            $OrderOriginLocation->Business_Phone = $request->Business_Phone;
        }

        if ($request->has('Business_Location') && $request->Business_Location != null) {

            $OrderOriginLocation->Business_Location = $request->Business_Location;
        }
    }

    public function DestinationLocation(Request $request, OrderDestinationLocation $order_destination_locations): void
    {
        $maxIndex = 15;

        // $numberedVars = [
        //     'Dest_Auction_Method',
        //     'Dest_Auction_Phone',
        //     'Dest_Stock_Number'
        // ];

        // foreach ( $numberedVars as $var ) {
        //     $value = null;

        //     for ( $i = 0; $i <= $maxIndex; $i++ ) {
        //         $variableName = $var . $i;
        //         if ( $request->has( $variableName ) && $request->$variableName !== null ) {
        //             $value = $request->$variableName;
        //             break;
        //             // Stop loop once a value is found
        //         }
        //     }

        //     // Assign value if found
        //     if ( $value !== null ) {
        //         $order_destination_locations->$var = $value;
        //     }
        // }

        // // Assign non-numbered variables
        // $nonNumberedVars = [
        //     'Destination_Location',
        //     'Dest_User_Name',
        //     'Dest_User_Email',
        //     'Dest_Local_Phone',
        //     'Dest_Location',
        //     'Dest_Business_Phone',
        //     'Dest_Business_Location'
        //     // Add other non-numbered variables here
        // ];

        // foreach ( $nonNumberedVars as $var ) {
        //     if ( $request->has( $var ) && $request->$var !== null ) {
        //         $order_destination_locations->$var = $request->$var;
        //     }
        // }
        $order_destination_locations->Destination_Location = $request->Destination_Location;
        $order_destination_locations->Dest_User_Name = $request->Dest_User_Name;
        $order_destination_locations->Dest_User_Email = $request->Dest_User_Email;
        $order_destination_locations->Dest_Local_Phone = implode(',', array_filter($request->Dest_Local_Phone, function($value) {
            return $value !== null;
        }));
        // $order_destination_locations->Dest_Local_Phone = $request->Dest_Local_Phone;

        $order_destination_locations->Dest_Location = $request->Dest_Location;
        if ($request->has('Auction_Method_def') && $request->Auction_Method_def != null) {
            # code...
            $order_destination_locations->Dest_Auction_Method = $request->Auction_Method_def;
        } elseif ($request->has('Port_Dest_Auction_Method') && $request->Port_Dest_Auction_Method != null) {
            $order_destination_locations->Dest_Auction_Method = $request->Port_Dest_Auction_Method;
        } elseif ($request->has('Dealer_Dest_Auction_Method') && $request->Dealer_Dest_Auction_Method != null) {
            $order_destination_locations->Dest_Auction_Method = $request->Dealer_Dest_Auction_Method;
        }
        if ($request->has('Dest_Auction_Phone') && $request->Dest_Auction_Phone != null) {
            $order_destination_locations->Dest_Auction_Phone = $request->Dest_Auction_Phone;
        } elseif ($request->has('Dealer_Dest_Auction_Phone') && $request->Dealer_Dest_Auction_Phone != null) {
            $order_destination_locations->Dest_Auction_Method = $request->Dealer_Dest_Auction_Phone;
        } elseif ($request->has('Port_Dest_Auction_Phone') && $request->Port_Dest_Auction_Phone != null) {
            $order_destination_locations->Dest_Auction_Method = $request->Port_Dest_Auction_Phone;
        }
        if ($request->has('Dest_Stock_Number') && $request->Dest_Stock_Number != null) {
            $order_destination_locations->Dest_Stock_Number = $request->Dest_Stock_Number;
        } elseif ($request->has('Dealer_Dest_Stock_Number') && $request->Dealer_Dest_Stock_Number != null) {
            $order_destination_locations->Dest_Stock_Number = $request->Dealer_Dest_Stock_Number;
        } elseif ($request->has('Port_Dest_Stock_Number') && $request->Port_Dest_Stock_Number != null) {
            $order_destination_locations->Dest_Stock_Number = $request->Port_Dest_Stock_Number;
        }

        if ($request->has('Dest_Business_Phone') && $request->Dest_Business_Phone != null) {

            $order_destination_locations->Dest_Business_Phone = $request->Dest_Business_Phone;
        }

        if ($request->has('Dest_Business_Location') && $request->Dest_Business_Location != null) {

            $order_destination_locations->Dest_Business_Location = $request->Dest_Business_Location;
        }
        $order_destination_locations->Dest_Stock_Number = $request->Dest_Stock_Number;
    }

    public function OrderRoutes($request, OrderRoute $OrderRoutes)
    {
        $OrderRoutes->Origin_Address = $request->Origin_Address;
        $OrderRoutes->Origin_Address_II = $request->Origin_Address_II;
        $OrderRoutes->Origin_ZipCode = $request->Origin_ZipCode;
        $OrderRoutes->Destination_Address = $request->Destination_Address;
        $OrderRoutes->Destination_Address_II = $request->Destination_Address_II;
        $OrderRoutes->Dest_ZipCode = $request->Dest_ZipCode;

        $From = Str::afterLast($request->Origin_ZipCode, ', ');
        $To = Str::afterLast($request->Dest_ZipCode, ', ');
        $OrderRoutes->Miles = DayDispatchHelper::twopoints_on_earth($From, $To);
    }

    public function PaymentInfo(Request $request, OrderPaymentInfo $OrderPaymentInfo): void
    {
        $OrderPaymentInfo->Order_Booking_Price = (int) $request->Booking_Price;
        $OrderPaymentInfo->Deposite_Amount = (int) $request->Deposite_Amount;
        $OrderPaymentInfo->Payment_Method_Mode = $request->Payment_Mode;
        $OrderPaymentInfo->Price_Pay_Carrier = (int) $request->Price_Pay;
        $OrderPaymentInfo->COD_Amount = (int) $request->COD_Amount;
        $OrderPaymentInfo->Balance_Amount = (int) $request->Bal_Amount;
        $OrderPaymentInfo->COD_Method_Mode = $request->COD_Payment_Mode;
        $OrderPaymentInfo->Bal_Method_Mode = $request->Balance_Payment_Mode;
        $OrderPaymentInfo->COD_Location_Amount = $request->Location_Mode;
        $OrderPaymentInfo->BAL_Payment_Time = $request->Bal_Payment_Time;
        $OrderPaymentInfo->BAL_Payment_Terms = $request->Payment_Terms;
        $OrderPaymentInfo->Payment_Desc = $request->Desc_For_Vehcile;
    }
}
