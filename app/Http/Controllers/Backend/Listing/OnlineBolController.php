<?php

namespace App\Http\Controllers\Backend\Listing;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Backend\Listing\DeliverdListing;
use App\Http\Livewire\Backend\Listing\PickupApproval;
use Illuminate\Http\Request;


use App\Helpers\DayDispatchHelper;
use App\Models\Listing\DispatchDriver;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
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
use Carbon\Carbon;
use App\Models\Listing\OnlineBol;
use App\Models\Listing\OnlineBolMultiImg;

use App\Models\Listing\PickupOnlineBol;
use App\Models\Listing\PickupOnlineBolMultiImage;
use App\Mail\OnlineBolMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\PickupOnlineBolMail;
use App\Models\Listing\ListingAgreement;
use App\Models\OnlineBolItemCondition;
use App\Models\PickupOnlineBolItemCondition;
use Illuminate\Support\Str;
use App\Services\ListingServices;


class OnlineBolController extends Controller
{
    public function OnlineBol(Request $request)
    {
        $slot = '';
        $auth_user = Auth::guard('Authorized')->user();
        $Listed_ID = $request->List_ID;
        // $user_id = Auth::guard('Authorized')->user()->id;

        // $onlinebol = OnlineBol::where('order_id', $Listed_ID)->with('online_bol_img')->first(); //->with('online_bol_img')

        $onlinebol = OnlineBol::where('order_id', $Listed_ID)->with('online_bol_imgs', 'online_bol_items')->first();
        // dd($onlinebol);


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
            "listing_origin_location",
            "listing_destination_locations",
            "attachments",
        )->where('id', $Listed_ID)

            ->firstOrFail();
        // dd($Lisiting);

        $tracking_history = ListingAgreement::with([
            'all_listing' => [
                'paymentinfo',
                'additional_info',
                'pickup_delivery_info',
                'vehicles',
                'routes',
                'listing_origin_location',
                'listing_destination_locations',
                'attachments',
                'miscellenous',
                'bol' => [
                    'bol_attachments'
                ],
                'history',
                'cancel',
                'update_history',
                'driver'
            ],
            'authorized_user' => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'Address', 'Local_Phone', 'Mc_Number')->with([
                    'insurance',
                    'certificates'
                ]);
            },
            'agreement_user' => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'Address', 'Local_Phone', 'Mc_Number')->with([
                    'insurance',
                    'certificates'
                ]);
            }
        ])->where('order_id', $request->List_ID)->firstOrFail();


        $Pickup_Services = ($Lisiting->dry_vans_services)->map(function ($List) {
            return [
                Str::replace([' / ', ' ', '/'], "_", $List->Pickup_Service) => $List->Pickup_Service
            ];
        });
        $Delivery_Services = ($Lisiting->dry_vans_services)->mapWithKeys(function ($List) {
            return [
                Str::replace([' / ', ' ', '/'], "_", $List->Delivery_Service) => $List->Delivery_Service
            ];
        });

        $MyContract = MyContract::get(); //where('user_id', $user_id)->

        $currentRouteMatchesPattern = (\Illuminate\Support\Facades\Request::url() === url('Authorized/Expire-Listing-Re-Enlisted/' . $Listed_ID)) ? 1 : 0;

        // dd($Lisiting->toArray());

        return view('livewire.backend.listing.online-bol', compact('slot', 'Listed_ID', 'Lisiting', 'Pickup_Services', 'Delivery_Services', 'currentRouteMatchesPattern', 'MyContract', 'onlinebol', 'tracking_history','auth_user'))->layout('layouts.authorized');


        // return view('livewire.backend.listing.online-bol', compact('slot', 'Listed_ID', 'Lisiting', 'MyContract', 'req_user'));
    } // End Method


    public function StoreOnlineBol(Request $request)
    {

        $markedImgForm = $request->marked_img_form;
        $imgSources = explode('|||', $markedImgForm);
        $user_id = Auth::guard('Authorized')->user()->id;

        $existingOnlineBol = OnlineBol::where('order_id', $request->order_id)->first();

        if ($existingOnlineBol) {
            return redirect()->back()->with('error', 'An OnlineBol entry with this order ID already exists.');
        }

        // Insert data into the OnlineBol model and get the insert ID

        $insert_id = OnlineBol::insertGetId([
            'order_id' => $request->order_id,
            'user_id' => $user_id,
            'no_odometer' => $request->has('no_odometer') ? $request->no_odometer : null,
            'no_inspection_note' => $request->has('no_inspection_note') ? $request->no_inspection_note : null,
            'key' => $request->has('key') ? $request->key : null,
            'remote' => $request->has('remote') ? $request->remote : null,
            'headrests' => $request->has('headrests') ? $request->headrests : null,
            'drivable' => $request->has('drivable') ? $request->drivable : null,
            'windscreen' => $request->has('windscreen') ? $request->windscreen : null,
            'glass_all_intact' => $request->has('glass_all_intact') ? $request->glass_all_intact : null,
            'title' => $request->has('title') ? $request->title : null,
            'cargo_cover' => $request->has('cargo_cover') ? $request->cargo_cover : null,
            'spare_tire' => $request->has('spare_tire') ? $request->spare_tire : null,
            'radio' => $request->has('radio') ? $request->radio : null,
            'manual' => $request->has('manual') ? $request->manual : null,
            'navigation_disk' => $request->has('navigation_disk') ? $request->navigation_disk : null,
            'plugin_charger_cable' => $request->has('plugin_charger_cable') ? $request->plugin_charger_cable : null,
            'headphone' => $request->has('headphone') ? $request->headphone : null,
            'created_at' => Carbon::now(),
        ]);



        // Handle loose_items and number_condition
        $looseItems = $request->input('loose_items', []);
        $numberConditions = $request->input('number_condition', []);

        foreach ($looseItems as $index => $item) {
            OnlineBolItemCondition::create([
                'onlinebol_id' => $insert_id,
                'item_name' => $item,
                'condition' => $numberConditions[$index] ?? null,
            ]);
        }

        foreach ($imgSources as $key => $row) {
            OnlineBolMultiImg::insert([
                'onlinebol_id' => $insert_id,
                'photo_name' => $row,
            ]);
        }

        // Handle multiple image uploads
        // $images = [];
        // if ($request->hasFile('multi_img')) {
        //     foreach ($request->file('multi_img') as $file) {
        //         $make_name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
        //         $file->move(public_path('Uploads/onlinebol'), $make_name);
        //         $uploadPath = 'Uploads/onlinebol/' . $make_name;

        //         OnlineBolMultiImg::create([
        //             'onlinebol_id' => $insert_id,
        //             'photo_name' => $uploadPath,
        //             'created_at' => Carbon::now(),
        //         ]);

        //         $images[] = $uploadPath; // Collect image paths
        //     }
        // }

        // Email data
        // $emailData = [
        //     'order_id' => $request->order_id,
        //     'user_id' => $user_id,
        //     'key' => $request->key,
        //     'no_odometer' => $request->no_odometer,
        //     'no_inspection_note' => $request->no_inspection_note,
        //     'remote' => $request->remote,
        //     'headrests' => $request->headrests,
        //     'drivable' => $request->drivable,
        //     'windscreen' => $request->windscreen,
        //     'glass_all_intact' => $request->glass_all_intact,
        //     'title' => $request->title,
        //     'cargo_cover' => $request->cargo_cover,
        //     'spare_tire' => $request->spare_tire,
        //     'radio' => $request->radio,
        //     'manual' => $request->manual,
        //     'navigation_disk' => $request->navigation_disk,
        //     'plugin_charger_cable' => $request->plugin_charger_cable,
        //     'headphone' => $request->headphone,
        // ];

        // // Send the email
        // Mail::to('abst99856@gmail.com')->send(new OnlineBolMail($emailData, $images));

        if ($request->picked_up) {
            $listing_id = $request->order_id;
            $request->merge(['List_ID' => $listing_id]);

            $pickupApproval = new PickupApproval();
            $listingServices = app(ListingServices::class); // Resolve dependency

            return $pickupApproval->OrderPickup($request, $listingServices); // Pass both parameters
        }

        return redirect()->route('Dispatch.Listing')->with('success', 'OnlineBol entry created successfully!');
    } // End Method




    public function PickupOnlineBol(Request $request)
    {
        $slot = '';
        $auth_user = Auth::guard('Authorized')->user();
        $Listed_ID = $request->List_ID;
        // $user_id = Auth::guard('Authorized')->user()->id;

        // $onlinebol = OnlineBol::where('order_id', $Listed_ID)->with('online_bol_img')->first(); //->with('online_bol_img')

        // $onlinebol = OnlineBol::where('order_id', $Listed_ID)->with('online_bol_imgs')->first();
        $onlinebol = OnlineBol::where('order_id', $Listed_ID)->with('online_bol_imgs', 'online_bol_items')->first();

        $pickuponlinebol = PickupOnlineBol::where('order_id', $Listed_ID)->with('pickup_online_bol_imgs','pickup_online_bol_items')->first();


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
            "listing_origin_location",
            "listing_destination_locations",
            "attachments",
        )->where('id', $Listed_ID)

            ->firstOrFail();

        $tracking_history = ListingAgreement::with([
            'all_listing' => [
                'paymentinfo',
                'additional_info',
                'pickup_delivery_info',
                'vehicles',
                'routes',
                'listing_origin_location',
                'listing_destination_locations',
                'attachments',
                'miscellenous',
                'bol' => [
                    'bol_attachments'
                ],
                'history',
                'cancel',
                'update_history',
                'driver'
            ],
            'authorized_user' => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'Address', 'Local_Phone', 'Mc_Number')->with([
                    'insurance',
                    'certificates'
                ]);
            },
            'agreement_user' => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'Address', 'Local_Phone', 'Mc_Number')->with([
                    'insurance',
                    'certificates'
                ]);
            }
        ])->where('order_id', $request->List_ID)->firstOrFail();

        $Pickup_Services = ($Lisiting->dry_vans_services)->map(function ($List) {
            return [
                Str::replace([' / ', ' ', '/'], "_", $List->Pickup_Service) => $List->Pickup_Service
            ];
        });
        $Delivery_Services = ($Lisiting->dry_vans_services)->mapWithKeys(function ($List) {
            return [
                Str::replace([' / ', ' ', '/'], "_", $List->Delivery_Service) => $List->Delivery_Service
            ];
        });

        $MyContract = MyContract::get(); //where('user_id', $user_id)->

        $currentRouteMatchesPattern = (\Illuminate\Support\Facades\Request::url() === url('Authorized/Expire-Listing-Re-Enlisted/' . $Listed_ID)) ? 1 : 0;

        // dd($Lisiting->toArray());

        return view('livewire.backend.listing.pickup-online-bol', compact('slot', 'Listed_ID', 'Lisiting', 'Pickup_Services', 'Delivery_Services', 'currentRouteMatchesPattern', 'MyContract', 'onlinebol', 'pickuponlinebol', 'tracking_history','auth_user'))->layout('layouts.authorized');
    } //end method

    public function PickupStoreOnlineBol(Request $request)
    {

        $markedImgForm = $request->marked_img_form;
        $imgSources = explode('|||', $markedImgForm);
        $order_id = $request->order_id;
        $onlinebol_id = $request->onlinebol_id;
        $user_id = Auth::guard('Authorized')->user()->id;

        $existingPickupOnlineBol = PickupOnlineBol::where('order_id', $request->order_id)->first();

        if ($existingPickupOnlineBol) {
            return redirect()->back()->with('error', 'An Pickup OnlineBol entry with this order ID already exists.');
        }

        $insert_id = PickupOnlineBol::insertGetId([
            'order_id' => $order_id,
            'user_id' => $user_id,
            'deliver_no_odometer' => isset($request->deliver_no_odometer) ? $request->deliver_no_odometer : '',
            'deliver_no_inspection_note' => isset($request->deliver_no_inspection_note) ? $request->deliver_no_inspection_note : '',
            'created_at' => Carbon::now(),
        ]);

        // Handle loose_items and number_condition
        $looseItems = $request->input('loose_items', []);
        $numberConditions = $request->input('number_condition', []);

        foreach ($looseItems as $index => $item) {
            PickupOnlineBolItemCondition::create([
                'onlinebol_id' => $insert_id,
                'item_name' => $item,
                'condition' => $numberConditions[$index] ?? null,
            ]);
        }

        foreach ($imgSources as $key => $row) {

            PickupOnlineBolMultiImage::insert([
                'pickup_online_bol_id' => $insert_id,
                'photo_name' => $row,
            ]);

        }

        // Prepare email data
        $emailData = [
            'order_id' => $order_id,
        ];

        // Send email
        Mail::to('abst99856@gmail.com')->send(new PickupOnlineBolMail($emailData));

        if ($request->delivered) {
            $listing_id = $request->order_id;
            $request->merge(['List_ID' => $listing_id]);

            $DeliveredApproval = new DeliverdListing();
            $listingServices = app(ListingServices::class); // Resolve dependency

            return $DeliveredApproval->OrderDelivered($request, $listingServices); // Pass both parameters
        }


        return redirect()->back()->with('success', 'Pickup OnlineBol entry created successfully!');

    } // End Method

    public function FinalOnlineBol($List_ID)
    {
        $slot = '';

        $Listed_ID = $List_ID;

        // $user_id = Auth::guard('Authorized')->user()->id;

        // $onlinebol = OnlineBol::where('order_id', $Listed_ID)->with('online_bol_img')->first(); //->with('online_bol_img')

        // $onlinebol = OnlineBol::where('order_id', $Listed_ID)->with('online_bol_imgs')->first();
        $onlinebol = OnlineBol::where('order_id', $Listed_ID)->with('online_bol_imgs', 'online_bol_items')->first();

        $pickuponlinebol = PickupOnlineBol::where('order_id', $Listed_ID)->with('pickup_online_bol_imgs')->first();
        // dd($pickuponlinebol);

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
            "listing_origin_location",
            "listing_destination_locations",
            "attachments",
        )->where('id', $Listed_ID)
            ->firstOrFail();

        $tracking_history = ListingAgreement::with([
            'all_listing' => [
                'paymentinfo',
                'additional_info',
                'pickup_delivery_info',
                'vehicles',
                'routes',
                'listing_origin_location',
                'listing_destination_locations',
                'attachments',
                'miscellenous',
                'bol' => [
                    'bol_attachments'
                ],
                'history',
                'cancel',
                'update_history',
                'driver'
            ],
            'authorized_user' => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'Address', 'Local_Phone', 'Mc_Number')->with([
                    'insurance',
                    'certificates'
                ]);
            },
            'agreement_user' => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'Address', 'Local_Phone', 'Mc_Number')->with([
                    'insurance',
                    'certificates'
                ]);
            }
        ])->where('order_id', $Listed_ID)->firstOrFail();

        // $Pickup_Services = ($Lisiting->dry_vans_services)->map(function ($List) {
        //    return [
        //        Str::replace([' / ', ' ', '/'], "_", $List->Pickup_Service) => $List->Pickup_Service
        //    ];
        // });
        // $Delivery_Services = ($Lisiting->dry_vans_services)->mapWithKeys(function ($List) {
        //     return [
        //         Str::replace([' / ', ' ', '/'], "_", $List->Delivery_Service) => $List->Delivery_Service
        //     ];
        // });

        // $MyContract = MyContract::get(); //where('user_id', $user_id)->

        // $currentRouteMatchesPattern = (\Illuminate\Support\Facades\Request::url() === url('Authorized/Expire-Listing-Re-Enlisted/'.$Listed_ID))? 1 : 0;

        // dd($Lisiting->toArray());

        // return view('livewire.backend.listing.final-online-bol', compact('slot', 'Listed_ID', 'Lisiting', 'Pickup_Services', 'Delivery_Services', 'currentRouteMatchesPattern', 'MyContract', 'onlinebol', 'pickuponlinebol', 'tracking_history'))->layout('layouts.authorized');

        return view('livewire.backend.listing.final-online-bol', compact('slot', 'Lisiting', 'onlinebol', 'pickuponlinebol', 'tracking_history'))->layout('layouts.authorized');
    }


}
