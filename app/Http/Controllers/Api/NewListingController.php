<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Auth\AuthorizedUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyAllUsers;
use App\Models\Extras\Notification;

class NewListingController extends Controller
{
    public function create(Request $request)
    {
        try {

            // $frieght_class = explode('*^', $request->frieght_class);

            // return response()->json([
            //     'message' => 'down',
            //     'request' => $request->toArray(),
            // ], 200);

            $AllUserListing = AllUserListing::where('Ref_ID', $request->id)->first();
            $user_id = 14;

            if (is_null($AllUserListing)) {
                $AllUserListing = new AllUserListing;
                $AllUserListing->user_id = $user_id;
                $AllUserListing->Ref_ID = $request->id;
                $AllUserListing->Listing_Status = 'Listed';
                $AllUserListing->Custom_Listing = $request->Custom_Listing ? 1 : 0;
                $AllUserListing->Private_Listing = $request->Private_Listing ? 1 : 0;
                $AllUserListing->Posted_Date = $request->created_at;
                $AllUserListing->Listing_Type = $request->car_type;
                $AllUserListing->expire_at = Carbon::now()->addDays(5);
                $AllUserListing->save();

                $ListingOrignLocation = new ListingOrignLocation;
                $ListingOrignLocation->user_id  = $user_id;
                $ListingOrignLocation->order_id = $AllUserListing->id;
                $ListingOrignLocation->Orign_Location = $request->oaddress;
                $ListingOrignLocation->User_Name = $request->oname;
                $ListingOrignLocation->User_Email = $request->oemail;
                $ListingOrignLocation->Local_Phone = $request->phone;
                // $ListingOrignLocation->Location = $request->Location;
                $ListingOrignLocation->save();

                $listing_destination_locations = new ListingDestinationLocation;
                $listing_destination_locations->user_id  = $user_id;
                $listing_destination_locations->order_id = $AllUserListing->id;
                $listing_destination_locations->Destination_Location = $request->daddress;
                $listing_destination_locations->Dest_User_Name = $request->dname;
                $listing_destination_locations->Dest_User_Email = $request->demail;
                $listing_destination_locations->Dest_Local_Phone = $request->dphone;
                $listing_destination_locations->Dest_Location = $request->daddress;
                // $listing_destination_locations->Dest_Business_Phone = $request->Dest_Business_Phone;
                // $listing_destination_locations->Dest_Business_Location = $request->Dest_Business_Location;
                $listing_destination_locations->save();

                $ListingRoutes = new ListingRoutes;
                $ListingRoutes->user_id = $user_id;
                $ListingRoutes->order_id = $AllUserListing->id;
                $ListingRoutes->Origin_Address = $request->oaddress;
                $ListingRoutes->Origin_Address_II = $request->oaddress2;
                // $ListingRoutes->Origin_ZipCode = $request->originzsc;
                $ListingRoutes->Origin_ZipCode = preg_replace('/,(?!\s)/', ', ', $request->originzsc);
                $ListingRoutes->Destination_Address = $request->daddress;
                $ListingRoutes->Destination_Address_II = $request->daddress2;
                // $ListingRoutes->Dest_ZipCode = $request->destinationzsc;
                $ListingRoutes->Dest_ZipCode = preg_replace('/,(?!\s)/', ', ', $request->destinationzsc);
                $ListingRoutes->save();

                $ListingPickupDeliverInfo = new ListingPickupDeliverInfo();
                $ListingPickupDeliverInfo->user_id = $user_id;
                $ListingPickupDeliverInfo->order_id = $AllUserListing->id;
                $ListingPickupDeliverInfo->Pickup_Date = Carbon::createFromFormat('m/d/Y', $request->pickup_date)->format('Y-m-d');
                $ListingPickupDeliverInfo->Pickup_Date_mode = $request->pickup_when ?? 'ASAP';
                $ListingPickupDeliverInfo->Delivery_Date = Carbon::createFromFormat('m/d/Y', $request->delivery_date)->format('Y-m-d');
                $ListingPickupDeliverInfo->Delivery_Date_mode = $request->delivery_when ?? 'ASAP';
                // $ListingPickupDeliverInfo->Pickup_Start_Time = $request->Pickup_Start_Time;
                // $ListingPickupDeliverInfo->Pickup_End_Time = $request->Pickup_End_Time;
                // $ListingPickupDeliverInfo->Delivery_Start_Time = $request->Delivery_Start_Time;
                // $ListingPickupDeliverInfo->Delivery_End_Time = $request->Delivery_End_Time;
                $ListingPickupDeliverInfo->save();

                $ListingPaymentInfo = new ListingPaymentInfo();
                $ListingPaymentInfo->order_id = $AllUserListing->id;
                $ListingPaymentInfo->user_id = $user_id;
                $ListingPaymentInfo->Order_Booking_Price = $request->payment;
                $ListingPaymentInfo->COD_Amount = $request->cod_cop;

                $ListingPaymentInfo->Deposite_Amount = $request->balance;
                $ListingPaymentInfo->Bal_Method_Mode = $request->balance_method;
                // $ListingPaymentInfo->Bal_Method_Mode = $request->Price_Pay_Carrier ?? 0;
                // $ListingPaymentInfo->Bal_Method_Mode = $request->storage_fees ?? 0;
                // $ListingPaymentInfo->Price_Pay_Carrier = $request->listed_price;
                $ListingPaymentInfo->Price_Pay_Carrier = $request->driver_price;
                $ListingPaymentInfo->COD_Method_Mode = $request->payment_method;
                $ListingPaymentInfo->Balance_Amount = $request->balance;
                $ListingPaymentInfo->COD_Location_Amount = $request->cod_cop_loc;
                $ListingPaymentInfo->BAL_Payment_Time = $request->balance_time;
                $ListingPaymentInfo->BAL_Payment_Terms = $request->terms;
                // $ListingPaymentInfo->COD_Amount = 0;
                // $ListingPaymentInfo->COD_Location_Amount = $request->Location_Mode;
                // $ListingPaymentInfo->BAL_Payment_Time = $request->Bal_Payment_Time;
                // $ListingPaymentInfo->BAL_Payment_Terms = $request->Payment_Terms;
                // $ListingPaymentInfo->Payment_Desc = $request->Desc_For_Vehcile;
                $ListingPaymentInfo->save();


                $ListingAddtionalInfo = new ListingAdditionalInfo();
                $ListingAddtionalInfo->user_id = $user_id;
                $ListingAddtionalInfo->order_id = $AllUserListing->id;
                $ListingAddtionalInfo->Vehcile_Desc = $request->add_info;
                $ListingAddtionalInfo->save();
                // $ListingAddtionalInfo->Special_Instructions = $request->Special_Terms;
                // $ListingAddtionalInfo->Notes_Customer = $request->Special_Notes;
                // $ListingAddtionalInfo->Contract = $request->Listing_Contract;
                // $ListingAddtionalInfo->Vehcile_Desc = $request->Vehcile_Desc;

                $Vin_Number = explode('*^', $request->vin_num);
                $Vehcile_Year = explode('*^', $request->year);
                $Vehcile_Make = explode('*^', $request->make);
                $Vehcile_Model = explode('*^', $request->model);
                $Trailer_Type = explode('*^', $request->transport);

                foreach ($Trailer_Type as $key => $type) {
                    if (
                        $type == 1
                    ) {
                        $Trailer_Type[$key] = 'Open';
                    } elseif ($type == 2) {
                        $Trailer_Type[$key] = 'Enclosed';
                    } else {
                        $Trailer_Type[$key] = 'Open';
                    }
                }
                $Vehcile_Condition = explode('*^', $request->condition);

                foreach ($Vehcile_Condition as $key => $cond) {
                    if (
                        $cond == 1
                    ) {
                        $Vehcile_Condition[$key] = 'Running';
                    } elseif ($cond == 2) {
                        $Vehcile_Condition[$key] = 'Not Running';
                    } else {
                        $Vehcile_Condition[$key] = 'Running';
                    }
                }
                $Vehcile_Type = explode('*^', $request->type);
                $length_ft = explode('*^', $request->length_ft);
                $length_in = explode('*^', $request->length_in);
                $width_ft = explode('*^', $request->width_ft);
                $width_in = explode('*^', $request->width_in);
                $height_ft = explode('*^', $request->height_ft);
                $height_in = explode('*^', $request->height_in);
                $weight = explode('*^', $request->weight);

                if ($AllUserListing->Listing_Type === 1 || $AllUserListing->Listing_Type === '1') {
                    foreach ($Vehcile_Year as $key => $value) {
                        if (!isset($Vin_Number[$key], $Vehcile_Make[$key], $Vehcile_Model[$key], $Trailer_Type[$key], $Vehcile_Condition[$key], $Vehcile_Type[$key])) {
                            continue;
                        }

                        // return response()->json([
                        //     'message' => 'Down',
                        //     'request' => $request->toArray(),
                        //     'Vin_Number' => $Vin_Number,
                        //     'Vehcile_Year' => $Vehcile_Year,
                        //     'Vehcile_Make' => $Vehcile_Make,
                        //     'Vehcile_Model' => $Vehcile_Model,
                        //     'Trailer_Type' => $Trailer_Type, //    if 1 then store 'Open' elseif 2 then 'Enclosed'
                        //     'Vehcile_Condition' => $Vehcile_Condition,
                        //     'Vehcile_Type' => $Vehcile_Type,
                        //     'length_ft' => $length_ft,
                        //     'length_in' => $length_in,
                        //     'width_ft' => $width_ft,
                        //     'width_in' => $width_in,
                        //     'height_ft' => $height_ft,
                        //     'height_in' => $height_in,
                        //     'weight' => $weight,
                        // ], 200);

                        ListingVehciles::create([
                            'Reg_By' => empty($Vin_Number[$key]) ? 'YMM' : 'Vin Number',
                            'Vin_Number' => $Vin_Number[$key],
                            'Vehcile_Year' => $Vehcile_Year[$key],
                            'Vehcile_Make' => $Vehcile_Make[$key],
                            'Vehcile_Model' => $Vehcile_Model[$key],
                            'Vehcile_Color' => null,
                            'Vehcile_Type' => $Vehcile_Type[$key],
                            'Vehcile_Condition' => $Vehcile_Condition[$key],
                            'Trailer_Type' => $Trailer_Type[$key],
                            'order_id' => $AllUserListing->id,
                            'user_id' => 14,
                        ]);
                    }
                } else if ($AllUserListing->Listing_Type === 2 || $AllUserListing->Listing_Type === '2') {
                    // foreach ($Vehcile_Year as $key => $value) {

                    $heavy_Vehcile_Year = $Vehcile_Year[0];
                    $heavy_Vehcile_Make = $Vehcile_Make[0];
                    $heavy_Vehcile_Model = $Vehcile_Model[0];
                    $heavy_Vehcile_Condition = $Vehcile_Condition[0];
                    $heavy_Vehcile_Type = $Vehcile_Type[0];
                    $heavy_length_ft = $length_ft[0];
                    $heavy_length_in = $length_in[0];
                    $heavy_width_ft = $width_ft[0];
                    $heavy_width_in = $width_in[0];
                    $heavy_height_ft = $height_ft[0];
                    $heavy_height_in = $height_in[0];
                    $heavy_weight = $weight[0];

                    ListingHeavyEquipment::create([
                        'Equipment_Year' => $heavy_Vehcile_Year,
                        'Equipment_Make' => $heavy_Vehcile_Make,
                        'Equipment_Model' => $heavy_Vehcile_Model,
                        'Equipment_Condition' => $heavy_Vehcile_Condition,
                        'Trailer_Type' => $heavy_Vehcile_Type,
                        'Equip_Length' => $heavy_length_ft . $heavy_length_in,
                        'Equip_Width' => $heavy_width_ft . $heavy_width_in,
                        'Equip_Height' => $heavy_height_ft . $heavy_height_in,
                        'Equip_Weight' => $heavy_weight,
                        'Shipment_Preferences' => null,
                        'order_id' => $AllUserListing->id,
                        'user_id' => $user_id,
                    ]);
                    // }
                } else if ($AllUserListing->Listing_Type === 3 || $AllUserListing->Listing_Type === '3') {
                    // foreach ($weight as $key => $value) {
                    $FreightWeight = explode('*^', $request->weight);
                    $TrailerType_Dry = explode('*^', $request->transport);
                    $Freight_Weight = $FreightWeight[0];
                    $Trailer_Type_Dry = $TrailerType_Dry[0];
                    $Freight_Class = $request['freight']['frieght_class'];
                    $Shipment_Preferences = strtoupper($request['freight']['shipment_prefences']);
                    $Freight_Weight = $request['freight']['total_weight_lbs'];
                    $Trailer_Specification_Dry = $request['freight']['trailer_specification'];
                    $Trailer_Type_Dry = $request['freight']['equipment_type'];

                    // return response()->json([
                    //     'message' => 'up',
                    //     'requestFF' => $request->toArray(),
                    //     'AllUserListing' => $AllUserListing,
                    //     'Freight_Weight' => $Freight_Weight,
                    //     'Trailer_Type_Dry' => $Trailer_Type_Dry,
                    //     'FreightWeight' => $FreightWeight,
                    //     'TrailerType_Dry' => $TrailerType_Dry,
                    // ], 200);
                    ListingDryVan::create(
                        [
                            'Freight_Class' => $Freight_Class,
                            'Freight_Weight' => $Freight_Weight,
                            'is_hazmat_Check' => 0,
                            'Shipment_Preferences' => $Shipment_Preferences,
                            'Trailer_Type_Dry' => $Trailer_Type_Dry,
                            'Trailer_Specification_Dry' => $Trailer_Specification_Dry,
                            'order_id' => $AllUserListing->id,
                            'user_id' => $user_id,
                        ]
                    );

                    // }
                    // dd($request->Pickup_Service);
                    // if ($request->has('Pickup_Service') && count($request->Pickup_Service) > 0) {
                    //     foreach ($request->Pickup_Service as $key => $value) {
                    //         ListingDryVanServices::create([
                    //             'Pickup_Service' => $request->Pickup_Service[$key],
                    //             'Delivery_Service' => $request->Delivery_Service[$key],
                    //             'order_id' => $AllUserListing->id,
                    //             'user_id' => $user_id
                    //         ]);
                    //     }
                    // }
                }
            }

            return response()->json([
                'message' => 'Listing created sssuccessfully',
                'request' => $request->toArray(),
                'AllUserListing' => $AllUserListing,
            ], 200);
            DB::commit();
        } catch (\Exception $e) {
            return response()->json([
                'request' => $request->toArray(),
                'error' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }
}
