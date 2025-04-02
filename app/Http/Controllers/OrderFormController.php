<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderForm;
use App\Models\Quote\Order;
use Livewire\Component;
use App\Models\OrderFormSetting;
use App\Models\Auth\AuthorizedUsers;
use Auth;
use Illuminate\Support\Facades\Mail;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\NotifyAllUsers;
use App\Models\Extras\Notification;
use Illuminate\Support\Facades\File;


class OrderFormController extends Controller
{
    public function index($List_ID, $User_ID)
    {
        // dd($List_ID, $User_ID);
        $List_ID = base64_decode($List_ID);
        $User_ID = base64_decode($User_ID);
        // $slot = '';
        $settings = OrderFormSetting::where('user_id', $User_ID)->first();
        $item = Order::with('authorized_user', 'paymentinfo', 'additional_info', 'pickup_delivery_info', 'vehicles', 'heavy_equipments', 'dry_vans', 'dry_vans_services', 'routes', 'listingVehicle', 'listing_origin_location', 'listing_destination_locations')->where('id', $List_ID)->first();
        // dd($item);
        return view('livewire.backend.orderform.order_index', compact('item', 'settings'));
    } // End Method

    public function sendLinkEmail($id, $userid, Request $request)
    {
        // dd($id, $userid, $request->all());
        $validatedData = $request->validate([
            'email' => 'required|email',
            'generatedLink' => 'required|url',
        ]);

        $email = $validatedData['email'];
        $generatedLink = $validatedData['generatedLink'];

        $encodedId = base64_encode($id);
        $encodedUserid = base64_encode($userid);

        $link = route('order.form', ['List_ID' => $encodedId, 'User_ID' => $encodedUserid]);
        // $link = route('order.form', ['List_ID' => $id, 'User_ID' => $userid]);
        // dd($link);

        Mail::send([], [], function ($message) use ($email, $link) {
            $message->to($email)
                ->subject('Your Generated Link')
                ->html('Here is your generated link: <a href="' . $link . '">' . $link . '</a>');
        });

        return redirect()->back()->with('success', 'Email sent successfully!');
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'order_id' => 'required',
            'full_name' => 'required',
            'first_phone' => 'required',
            'second_phone' => 'nullable',
            'address' => 'required',
            'zip_code' => 'required',
            'email_address' => 'required|email',
            'carrier_type' => 'required',
            'vehicle_name' => 'required',
            'vehicle_runs' => 'required',
            'auction' => 'required',
            'auction_name' => 'required',
            'stock_number' => 'required',
            // 'pricing_payment' => 'required',
            'vehicle_first_available_date' => 'required',
            'origin_contact_name' => 'required',
            'origin_email' => 'required|email',
            'origin_first_phone' => 'required',
            'origin_second_phone' => 'nullable',
            'origin_address' => 'required',
            'origin_zip_code' => 'required',
            'destination_contact_name' => 'required',
            'destination_email' => 'required|email',
            'destination_first_phone' => 'required',
            'destination_second_phone' => 'nullable',
            'destination_address' => 'required',
            'destination_zip_code' => 'required',

        ]);
        // dd('ok');

        try {
            OrderForm::create([
                'order_id' => $request->order_id,
                'user_id' => $request->user_id,
                'full_name' => $request->full_name,
                'first_phone' => $request->first_phone,
                'second_phone' => $request->second_phone,
                'address' => $request->address,
                'zip_code' => $request->zip_code,
                'email_address' => $request->email_address,
                'carrier_type' => $request->carrier_type,
                'vehicle_name' => $request->vehicle_name,
                'vehicle_runs' => $request->vehicle_runs,
                'auction' => $request->auction,
                'auction_name' => $request->auction_name,
                'stock_number' => $request->stock_number,
                'pricing_payment' => $request->pricing_payment,
                'last_of_vin' => $request->last_of_vin,
                'key' => $request->key,
                'vehicle_first_available_date' => $request->vehicle_first_available_date,
                'origin_contact_name' => $request->origin_contact_name,
                'origin_email' => $request->origin_email,
                'origin_first_phone' => $request->origin_first_phone,
                'origin_second_phone' => $request->origin_second_phone,
                'origin_address' => $request->origin_address,
                'origin_city_zip_state' => $request->origin_zip_code,
                'destination_contact_name' => $request->destination_contact_name,
                'destination_email' => $request->destination_email,
                'destination_first_phone' => $request->destination_first_phone,
                'destination_second_phone' => $request->destination_second_phone,
                'destination_address' => $request->destination_address,
                'destination_city_zip_state' => $request->destination_zip_code,
                'additional_vehicle_information' => $request->additional_vehicle_information,
                'terms_condition' => $request->terms_condition,
                'your_name' => $request->your_name,
                'your_signature' => $request->your_signature,
            ]);

            Order::where('id', $request->order_id)->where('user_id', $request->user_id)->update(['Listing_Status' => 'Book Order']);

            return redirect()->back()->with('success', 'Order Form submitted successfully!');
        } catch (\Exception $e) {
            \Log::error('Order Form submission failed: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to submit the Order Form. Please try again.');
        }
    } // End Method

    public function MoveToLoardboard(Request $request, $List_ID, $User_ID)
    {
        // dd($request, $List_ID, $User_ID);

        $order = Order::with('paymentinfo', 'additional_info', 'pickup_delivery_info', 'vehicles', 'heavy_equipments', 'dry_vans', 'dry_vans_services', 'routes', 'listing_origin_location', 'listing_destination_locations', 'attachments')->where('id', $List_ID)->where('user_id', $User_ID)->first();
        // dd($order);

        if ($order) {
            $this->CreateNewListing($order);
        }

        return redirect()->route('User.Listing')->with('Success!', "New Listing Inserted Successfully!");
    }

    public function CreateNewListing($order)
    {
        // dd($order->listing_destination_locations->toArray());

        DB::beginTransaction();
        $auth_user = Auth::guard('Authorized')->user();
        $user_id = $order->user_id;
        $AllUserListing = new AllUserListing();
        $ListingPaymentInfo = new ListingPaymentInfo();
        $ListingAddtionalInfo = new ListingAdditionalInfo();
        $ListingPickupDeliverInfo = new ListingPickupDeliverInfo();
        $ListingRoutes = new ListingRoutes();
        $ListingOrignLocation = new ListingOrignLocation();
        $listing_destination_locations = new ListingDestinationLocation();

        $AllUserListing->user_id = $user_id;
        $AllUserListing->Listing_Status = 'Listed';
        $AllUserListing->Ref_ID = $order->Ref_ID;
        // $AllUserListing->Custom_Listing = is_null($order->Custom_Listing) ? 0 : 1;
        // $AllUserListing->Private_Listing = is_null($order->Private_Listing) ? 0 : 1;
        $AllUserListing->Custom_Listing = !is_null($order->Custom_Listing) ? $order->Custom_Listing : 0;
        $AllUserListing->Private_Listing = !is_null($order->Private_Listing) ? $order->Private_Listing : 0;
        $AllUserListing->Posted_Date = $order->Posted_Date;
        $AllUserListing->Listing_Type = $order->Listing_Type;
        $AllUserListing->expire_at = $order->expire_at;
        $AllUserListing->vehicle_count = $order->vehicle_count;
        $AllUserListing->order_id = $order->id;

        // dd($AllUserListing->Private_Listing);

        if ($AllUserListing->save()) {
            $ListingOrignLocation->user_id = $user_id;
            $ListingOrignLocation->order_id = $AllUserListing->id;
            $this->OriginLocation($order, $ListingOrignLocation);
            if ($ListingOrignLocation->save()) {
                $listing_destination_locations->user_id = $user_id;
                $listing_destination_locations->order_id = $AllUserListing->id;
                $this->DestinationLocation($order, $listing_destination_locations);
                if ($listing_destination_locations->save()) {
                    $ListingRoutes->user_id = $user_id;
                    $ListingRoutes->order_id = $AllUserListing->id;
                    $this->ListingRoutes($order, $ListingRoutes);

                    if ($ListingRoutes->save()) {
                        $flag = false;
                        if ($order->Listing_Type === 1 || $order->Listing_Type === '1') {
                            foreach ($order->vehicles as $vehicle) {
                                // Determine if the vehicle is registered by VIN or YMM
                                $Reg_By = is_null($vehicle->Vin_Number) ? 'YMM' : 'Vin Number';

                                // Create a new ListingVehicle record regardless of duplicates
                                ListingVehciles::create([
                                    'Reg_By' => $Reg_By,
                                    'Vin_Number' => $vehicle->Vin_Number,
                                    'Vehcile_Year' => $vehicle->Vehcile_Year,
                                    'Vehcile_Make' => $vehicle->Vehcile_Make,
                                    'Vehcile_Model' => $vehicle->Vehcile_Model,
                                    'Vehcile_Color' => $vehicle->Vehcile_Color,
                                    'Vehcile_Type' => $vehicle->Vehcile_Type,
                                    'Vehcile_Condition' => $vehicle->Vehcile_Condition,
                                    'Trailer_Type' => $vehicle->Trailer_Type,
                                    'order_id' => $AllUserListing->id,
                                    'user_id' => $user_id,
                                ]);
                                $flag = true;
                            }
                        } else if ($order->Listing_Type === 2 || $order->Listing_Type === '2') {
                            // Iterate over the heavy equipment related to the order
                            foreach ($order->heavy_equipments as $equipment) {
                                ListingHeavyEquipment::create([
                                    'Equipment_Year' => $equipment->Equipment_Year,
                                    'Equipment_Make' => $equipment->Equipment_Make,
                                    'Equipment_Model' => $equipment->Equipment_Model,
                                    'Equipment_Condition' => $equipment->Equipment_Condition,
                                    'Trailer_Type' => $equipment->Trailer_Type,
                                    'Equip_Length' => $equipment->Equip_Length,
                                    'Equip_Width' => $equipment->Equip_Width,
                                    'Equip_Height' => $equipment->Equip_Height,
                                    'Equip_Weight' => $equipment->Equip_Weight,
                                    'Shipment_Preferences' => $equipment->Shipment_Preferences,
                                    'order_id' => $AllUserListing->id,
                                    'user_id' => $user_id,
                                ]);
                                $flag = true;
                            }
                        } else if ($order->Listing_Type === 3 || $order->Listing_Type === '3') {
                            // Iterate over the dry vans related to the order
                            foreach ($order->dry_vans as $dryVan) {
                                ListingDryVan::create([
                                    'Freight_Class' => $dryVan->Freight_Class,
                                    'Freight_Weight' => $dryVan->Freight_Weight,
                                    'is_hazmat_Check' => !empty($dryVan->is_hazmat_Check) ? $dryVan->is_hazmat_Check : 0,
                                    'Shipment_Preferences' => $dryVan->Shipment_Preferences,
                                    'Trailer_Type_Dry' => $dryVan->Trailer_Type_Dry,
                                    'order_id' => $AllUserListing->id,
                                    'user_id' => $user_id,
                                ]);
                                $flag = true;
                            }

                            // Iterate over the dry van services related to the order
                            if ($order->dry_vans_services->isNotEmpty()) {
                                foreach ($order->dry_vans_services as $dryVanService) {
                                    ListingDryVanServices::create([
                                        'Pickup_Service' => $dryVanService->Pickup_Service,
                                        'Delivery_Service' => $dryVanService->Delivery_Service,
                                        'order_id' => $AllUserListing->id,
                                        'user_id' => $user_id,
                                    ]);
                                    $flag = true;
                                }
                            }
                        }
                        if ($flag) {
                            $ListingPickupDeliverInfo->user_id = $user_id;
                            $ListingPickupDeliverInfo->order_id = $AllUserListing->id;
                            $ListingPickupDeliverInfo->Pickup_Date = $order->pickup_delivery_info->Pickup_Date;
                            $ListingPickupDeliverInfo->Pickup_Date_mode = $order->pickup_delivery_info->Pickup_Date_mode;
                            $ListingPickupDeliverInfo->Delivery_Date = $order->pickup_delivery_info->Delivery_Date;
                            $ListingPickupDeliverInfo->Delivery_Date_mode = $order->pickup_delivery_info->Delivery_Date_mode;
                            $ListingPickupDeliverInfo->Pickup_Start_Time = $order->pickup_delivery_info->Pickup_Start_Time;
                            $ListingPickupDeliverInfo->Pickup_End_Time = $order->pickup_delivery_info->Pickup_End_Time;
                            $ListingPickupDeliverInfo->Delivery_Start_Time = $order->pickup_delivery_info->Delivery_Start_Time;
                            $ListingPickupDeliverInfo->Delivery_End_Time = $order->pickup_delivery_info->Delivery_End_Time;
                            if ($ListingPickupDeliverInfo->save()) {
                                $this->PaymentInfo($order, $ListingPaymentInfo);
                                $ListingPaymentInfo->order_id = $AllUserListing->id;
                                $ListingPaymentInfo->user_id = $user_id;
                                if ($ListingPaymentInfo->save()) {
                                    $ListingAddtionalInfo->user_id = $user_id;
                                    $ListingAddtionalInfo->order_id = $AllUserListing->id;
                                    $ListingAddtionalInfo->Additional_Terms = $order->additional_info->Additional_Terms;
                                    $ListingAddtionalInfo->Special_Instructions = $order->additional_info->Special_Instructions;
                                    $ListingAddtionalInfo->Notes_Customer = $order->additional_info->Notes_Customer;
                                    $ListingAddtionalInfo->Contract = $order->additional_info->Contract;
                                    $ListingAddtionalInfo->Vehcile_Desc = $order->additional_info->Vehcile_Desc;

                                    // Send Email to All Carriers
                                    $Lisiting = AllUserListing::with('vehicles', 'heavy_equipments', 'dry_vans')->where('id', $AllUserListing->id)->first();
                                    if ($Lisiting->Listing_Type === 1 || $Lisiting->Listing_Type === '1') {
                                        if ($Lisiting->vehicles) {
                                            if (count($Lisiting->vehicles) === 1) {
                                                $mailData['vehicle'] = $Lisiting->vehicles[0]->Vehcile_Year . ' ' . $Lisiting->vehicles[0]->Vehcile_Make . ' ' . $Lisiting->vehicles[0]->Vehcile_Model;
                                            } else {
                                                $mailData['vehicle'] = count($Lisiting->vehicles);
                                            }
                                        }
                                    } elseif ($Lisiting->Listing_Type === 2 || $Lisiting->Listing_Type === '2') {
                                        if ($Lisiting->heavy_equipments) {
                                            if (count($Lisiting->heavy_equipments) === 1) {
                                                $mailData['vehicle'] = $Lisiting->heavy_equipments[0]->Equipment_Year . ' ' . $Lisiting->heavy_equipments[0]->Equipment_Make . ' ' . $Lisiting->heavy_equipments[0]->Equipment_Model;
                                            } else {
                                                $mailData['vehicle'] = count($Lisiting->heavy_equipments);
                                            }
                                        }
                                    } elseif ($Lisiting->Listing_Type === 3 || $Lisiting->Listing_Type === '3') {
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
                                        if (!empty($order->attachments) && count($order->attachments) > 0) {
                                            $flaga = false;
                                            $last_id = $order->id;
                                            // foreach ($request->file('Vehcile_Images') as $key => $ImageFile) {
                                            //     $imageGalleryName = $ImageFile->getClientOriginalName();
                                            //     $ImageFile->move(public_path('Uploads/Attachments/' . $last_id . '/'), $imageGalleryName);
                                            //     $FileName = 'Uploads/Attachments/' . $last_id . '/' . $imageGalleryName;
                                            //     $insertAttachment = "INSERT INTO `listing_attachments`(`Image_Name`, `order_id`, `user_id`) VALUES ('" . $FileName . "', '" . $AllUserListing->id . "', '" . $user_id . "')";
                                            //     DB::insert($insertAttachment);
                                            //     $flaga = true;
                                            // }
                                            foreach ($order->attachments as $key => $attachment) {
                                                $imageGalleryName = $attachment->Image_Name;
                                                $destinationPath = public_path('Uploads/Attachments/' . $last_id . '/');
                                                if (file_exists(public_path($imageGalleryName))) {
                                                    $newFileName = $destinationPath . basename($imageGalleryName);
                                                    File::copy(public_path($imageGalleryName), $newFileName);
                                                }
                                                $FileName = 'Uploads/Attachments/' . $last_id . '/' . basename($imageGalleryName);
                                                $insertAttachment = "INSERT INTO `listing_attachments`(`Image_Name`, `order_id`, `user_id`) VALUES ('" . $FileName . "', '" . $AllUserListing->id . "', '" . $user_id . "')";
                                                DB::insert($insertAttachment);
                                                $flaga = true;
                                            }
                                            if ($flaga) {
                                                DayDispatchHelper::SendNotificationOnStatusChanged2('Listed', $last_id);
                                                DB::commit();
                                                // dd('2', $flaga, $request->toArray());
                                                return redirect()->route('User.Listing')->with('Success!', "New Listing Inserted Successfully!");
                                            }
                                            DB::rollBack();
                                            return back()->with('Error!', "Attachment are Not Attach to Listing");
                                        }
                                        // dd('3', $flag, $request->toArray());
                                        $last_id = $AllUserListing->id;
                                        DayDispatchHelper::SendNotificationOnStatusChanged2('Listed', $last_id);
                                        DB::commit();
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

    public function OriginLocation($order, ListingOrignLocation $ListingOrignLocation)
    {
        $ListingOrignLocation->Orign_Location = $order->listing_origin_location->Orign_Location;
        $ListingOrignLocation->User_Name = $order->listing_origin_location->User_Name;
        $ListingOrignLocation->User_Email = $order->listing_origin_location->User_Email;
        $ListingOrignLocation->Local_Phone = $order->listing_origin_location->Local_Phone;
        $ListingOrignLocation->Location = $order->listing_origin_location->Location;

        if (isset($order->listing_origin_location->Auction_Method) && $order->listing_origin_location->Auction_Method != null) {
            $ListingOrignLocation->Auction_Method = $order->listing_origin_location->Auction_Method;
        } elseif (isset($order->listing_origin_location->Dealer_Auction_Method) && $order->listing_origin_location->Dealer_Auction_Method != null) {
            $ListingOrignLocation->Auction_Method = $order->listing_origin_location->Dealer_Auction_Method;
        }

        if (isset($order->listing_origin_location->Auction_Phone) && $order->listing_origin_location->Auction_Phone != null) {
            $ListingOrignLocation->Auction_Phone = $order->listing_origin_location->Auction_Phone;
        } elseif (isset($order->listing_origin_location->Dealer_Auction_Phone) && $order->listing_origin_location->Dealer_Auction_Phone != null) {
            $ListingOrignLocation->Auction_Phone = $order->listing_origin_location->Dealer_Auction_Phone;
        }

        if (isset($order->listing_origin_location->Stock_Number) && $order->listing_origin_location->Stock_Number != null) {
            $ListingOrignLocation->Stock_Number = $order->listing_origin_location->Stock_Number;
        } elseif (isset($order->listing_origin_location->Dealer_Stock_Number) && $order->listing_origin_location->Dealer_Stock_Number != null) {
            $ListingOrignLocation->Stock_Number = $order->listing_origin_location->Dealer_Stock_Number;
        }

        if (isset($order->listing_origin_location->Business_Phone) && $order->listing_origin_location->Business_Phone != null) {
            $ListingOrignLocation->Business_Phone = $order->listing_origin_location->Business_Phone;
        }

        if (isset($order->listing_origin_location->Business_Location) && $order->listing_origin_location->Business_Location != null) {
            $ListingOrignLocation->Business_Location = $order->listing_origin_location->Business_Location;
        }
    }

    public function DestinationLocation($order, ListingDestinationLocation $listing_destination_locations)
    {
        // dd($order->listing_destination_locations->toArray());
        $listing_destination_locations->Destination_Location = $order->listing_destination_locations->Destination_Location;
        $listing_destination_locations->Dest_User_Name = $order->listing_destination_locations->Dest_User_Name;
        $listing_destination_locations->Dest_User_Email = $order->listing_destination_locations->Dest_User_Email;
        $listing_destination_locations->Dest_Local_Phone = $order->listing_destination_locations->Dest_Local_Phone;
        $listing_destination_locations->Dest_Location = $order->listing_destination_locations->Dest_Location;

        $destAuctionMethod = $order->listing_destination_locations->Dest_Auction_Method ?? $order->listing_destination_locations->Port_Dest_Auction_Method ?? $order->listing_destination_locations->Dealer_Dest_Auction_Method;

        if ($destAuctionMethod) {
            $listing_destination_locations->Dest_Auction_Method = $destAuctionMethod;
        }

        $destAuctionPhone = $order->listing_destination_locations->Dest_Auction_Phone ?? $order->listing_destination_locations->Dealer_Dest_Auction_Phone ?? $order->listing_destination_locations->Port_Dest_Auction_Phone;

        if ($destAuctionPhone) {
            $listing_destination_locations->Dest_Auction_Phone = $destAuctionPhone;
        }

        $destStockNumber = $order->listing_destination_locations->Dest_Stock_Number ?? $order->listing_destination_locations->Dealer_Dest_Stock_Number ?? $order->listing_destination_locations->Port_Dest_Stock_Number;

        if ($destStockNumber) {
            $listing_destination_locations->Dest_Stock_Number = $destStockNumber;
        }

        $listing_destination_locations->Dest_Business_Phone = $order->listing_destination_locations->Dest_Business_Phone ?? $listing_destination_locations->Dest_Business_Phone;

        $listing_destination_locations->Dest_Business_Location = $order->listing_destination_locations->Dest_Business_Location ?? $listing_destination_locations->Dest_Business_Location;
    }




    public function ListingRoutes($order, ListingRoutes $ListingRoutes)
    {
        // Assign values from the $order object to the $ListingRoutes instance
        $ListingRoutes->Origin_Address = $order->routes->Origin_Address;
        $ListingRoutes->Origin_Address_II = $order->routes->Origin_Address_II;
        $ListingRoutes->Origin_ZipCode = $order->routes->Origin_ZipCode;
        $ListingRoutes->Destination_Address = $order->routes->Destination_Address;
        $ListingRoutes->Destination_Address_II = $order->routes->Destination_Address_II;
        $ListingRoutes->Dest_ZipCode = $order->routes->Dest_ZipCode;
        $ListingRoutes->Miles = $order->routes->Miles;

        // Calculate miles based on zip codes
        // $From = Str::afterLast($order->Origin_ZipCode, ', ');
        // $To = Str::afterLast($order->Dest_ZipCode, ', ');
        // $ListingRoutes->Miles = DayDispatchHelper::twopoints_on_earth($From, $To);
    }


    public function PaymentInfo($order, ListingPaymentInfo $ListingPaymentInfo)
    {
        $ListingPaymentInfo->Order_Booking_Price = (int) $order->paymentinfo->Order_Booking_Price;
        $ListingPaymentInfo->Deposite_Amount = (int) $order->paymentinfo->Deposite_Amount;
        $ListingPaymentInfo->Payment_Method_Mode = $order->paymentinfo->Payment_Method_Mode;
        $ListingPaymentInfo->Price_Pay_Carrier = (int) $order->paymentinfo->Price_Pay_Carrier;
        $ListingPaymentInfo->COD_Amount = (int) $order->paymentinfo->COD_Amount;
        $ListingPaymentInfo->Balance_Amount = (int) $order->paymentinfo->Balance_Amount;
        $ListingPaymentInfo->COD_Method_Mode = $order->paymentinfo->COD_Method_Mode;
        $ListingPaymentInfo->Bal_Method_Mode = $order->paymentinfo->Bal_Method_Mode;
        $ListingPaymentInfo->COD_Location_Amount = $order->paymentinfo->COD_Location_Amount;
        $ListingPaymentInfo->BAL_Payment_Time = $order->paymentinfo->Bal_Payment_Time;
        $ListingPaymentInfo->BAL_Payment_Terms = $order->paymentinfo->BAL_Payment_Terms;
        $ListingPaymentInfo->Payment_Desc = $order->paymentinfo->Payment_Desc;
    }





    public function OrderFormSubmitted($List_ID, $User_ID)
    {
        $slot = '';
        $settings = OrderFormSetting::where('user_id', $User_ID)->first();
        $item = OrderForm::where('order_id', $List_ID)->where('user_id', $User_ID)->first();
        $data = Order::with(
            'authorized_user',
            'paymentinfo',
            'additional_info',
            'pickup_delivery_info',
            'vehicles',
            'heavy_equipments',
            'dry_vans',
            'dry_vans_services',
            'routes',
            'listingVehicle',
            'listing_origin_location',
            'listing_destination_locations'
        )->where('id', $List_ID)->first();
        // dd($item, $data);
        return view('livewire.backend.orderform.order_form_submitted', compact('slot', 'item', 'settings', 'data'));
    }

    // public function GenerateInvoice($List_ID, $User_ID)
    // {
    //     $set_invoice = Order::where('id', $List_ID)->where('user_id', $User_ID);
    //     $slot = '';
    //     $order = Order::with('paymentinfo', 'additional_info', 'pickup_delivery_info', 'vehicles', 'heavy_equipments', 'dry_vans', 'dry_vans_services', 'routes', 'listing_origin_location', 'listing_destination_locations', 'attachments')->where('id', $List_ID)->where('user_id', $User_ID)->first();
    //         // dd($order);
    //     return view('livewire.backend.quoteinvoice.invoice_generate', compact('order', 'slot'))->layout('layouts.authorizedQuote');
    // }

    public function GenerateInvoice($List_ID, $User_ID)
    {
        $slot = '';
        $setting = OrderFormSetting::where('user_id', $User_ID)->first();
        $order = Order::where('id', $List_ID)->where('user_id', $User_ID)->first();
        // dd($order->authorized_user);

        if ($order) {
            $order->increment('invoice_number');

            $order->refresh(); // Refresh the order instance to get updated values
        } else {
            return redirect()->back()->withErrors(['Order not found.']);
        }

        return view('livewire.backend.quoteinvoice.invoice_generate', compact('order', 'slot', 'setting'))->layout('layouts.authorizedQuote');
    }
}
