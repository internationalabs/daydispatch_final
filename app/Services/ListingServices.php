<?php

namespace App\Services;

use App\Helpers\DayDispatchHelper;
use App\Models\Auth\AuthorizedUsers;
use App\Models\Carrier\RequestBroker;
use App\Models\History\OrderHistory;
use App\Models\Listing\AllUserListing;
use App\Models\Listing\ArchiveListing;
use App\Models\Listing\CancelledOrders;
use App\Models\Listing\CompletedOrders;
use App\Models\Listing\DeliverApprovals;
use App\Models\Listing\DeliverdOrders;
use App\Models\Listing\Dispatch;
use App\Models\Listing\ListingAgreement;
use App\Models\Listing\PickUpApprovals;
use App\Models\Listing\PickupOrders;
use App\Models\Listing\WaitingForApproval;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Listing\ListingStatusUpdateHistory;

class ListingServices
{
    public function getOrderRequests(): Collection|array
    {
        return RequestBroker::active()->with(
            relations: [
                'all_listing' => [
                    'authorized_user' => function ($q) {
                        $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')->with([
                            'insurance',
                            'certificates'
                        ]);
                    },
                    'request_broker' => [
                        'requested_user' => function ($q) {
                            $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')->with([
                                'insurance',
                                'certificates'
                            ]);
                        },
                    ],
                    'request_broker_all' => [
                        'requested_user' => function ($q) {
                            $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')->with([
                                'insurance',
                                'certificates'
                            ]);
                        },
                    ],
                    "paymentinfo",
                    "additional_info" => function ($q) {
                        $q->select('id', 'order_id', 'Additional_Terms');
                    },
                    "pickup_delivery_info",
                    "vehicles",
                    "heavy_equipments",
                    "dry_vans",
                    "dry_vans_services",
                    "routes",
                    "attachments"
                ],
                'requested_user' => function ($q) {
                    $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')->with([
                        'insurance',
                        'certificates'
                    ]);
                }
            ]
        )->orderBy('updated_at', 'DESC')->get();
    }

    public function getOrderRequestsSearch($User_ID, $Search): Collection|array
    {
        return RequestBroker::active()->where('user_id', $User_ID)->with(
            relations: [
                'all_listing' => [
                    'authorized_user' => function ($q) {
                        $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')->with([
                            'insurance',
                            'certificates'
                        ]);
                    },
                    'request_broker' => [
                        'requested_user' => function ($q) use ($Search) {
                            $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')
                                ->where('Company_Name', 'LIKE', '%' . $Search . '%')
                                ->with([
                                    'insurance',
                                    'certificates'
                                ]);
                        },
                    ],
                    'request_broker_all' => [
                        'requested_user' => function ($q) {
                            $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')->with([
                                'insurance',
                                'certificates'
                            ]);
                        },
                    ],
                    "paymentinfo",
                    "additional_info" => function ($q) {
                        $q->select('id', 'order_id', 'Additional_Terms');
                    },
                    "pickup_delivery_info",
                    "vehicles",
                    "heavy_equipments",
                    "dry_vans",
                    "dry_vans_services",
                    "routes",
                    "attachments"
                ],
                'requested_user' => function ($q) {
                    $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')
                        ->with([
                            'insurance',
                            'certificates'
                        ]);
                }
            ]
        )->orderBy('updated_at', 'DESC')->get();
    }

    public function getWaitingOrders(): Collection|array
    {
        
        $query = ListingStatusUpdateHistory::where('status', 'Waiting Approval')->with(
                relations: [
                    'all_listing' => [
                        'authorized_user' => function ($q) {
                            $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'email')->with([
                                'insurance',
                                'certificates'
                            ]);
                        },
                        'waitings' => [
                            'waiting_users' => function ($q) {
                                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'email')->with([
                                    'insurance',
                                    'certificates'
                                ]);
                            }
                        ],
                        "paymentinfo",
                        "additional_info" => function ($q) {
                            $q->select('id', 'order_id', 'Additional_Terms');
                        },
                        "pickup_delivery_info",
                        "vehicles",
                        "heavy_equipments",
                        "dry_vans",
                        "dry_vans_services",
                        "routes",
                        "request_broker",
                        "attachments"
                    ],
                ]
            )->has('all_listing')
            ->orderBy('updated_at', 'DESC');

            if (Auth::guard('Admin')->check()) {
                return $query
                ->withTrashed()
                ->get();
            }else{
                return $query
                ->whereDoesntHave('all_listing.agreement')
                ->get();
            }       
    }

    public function getDispatchesOrders(): Collection|array
    {
        $query = ListingStatusUpdateHistory::where('status', 'Dispatch')->with([
            'all_listing' => function ($query) {
                $query->with([
                    'authorized_user' => function ($q) {
                        $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'email')
                            ->with([
                                'insurance',
                                'certificates'
                            ]);
                    },
                    'dispatch_listing' => [
                        'waiting_users' => function ($q) {
                            $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'email')->with([
                                'insurance',
                                'certificates'
                            ]);
                        },
                    ],
                    "paymentinfo",
                    "additional_info" => function ($q) {
                        $q->select('id', 'order_id', 'Additional_Terms');
                    },
                    "pickup_delivery_info",
                    "vehicles",
                    "heavy_equipments",
                    "dry_vans",
                    "dry_vans_services",
                    "routes",
                    "request_broker",
                    "attachments"
                ]);
            }
        ])->has('all_listing')->orderBy('updated_at', 'DESC');
        
        if (Auth::guard('Admin')->check()) {
            return $query
            ->withTrashed()
            ->get();
        }else{
            return $query
            ->get();
        }
    }

    public function getDispatchesOrdersSearch($user_id, $Search): Collection|array
    {
        return Dispatch::where('user_id', $user_id)->with(
            relations: [
                'dispatch_user' => function ($q) use ($Search) {
                    $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')
                        ->where('Company_Name', 'LIKE', '%' . $Search . '%');
                },
            ]
        )->orderBy('updated_at', 'DESC')->get();
    }

    public function getPickupApprovalOrders(): Collection|array
    {
        return PickUpApprovals::with(
            relations: [
                'all_listing' => [
                    'authorized_user' => function ($q) {
                        $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')->with([
                            'insurance',
                            'certificates'
                        ]);
                    },
                    'pickup_approve' => [
                        'pickup_approval_user' => function ($q) {
                            $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')->with([
                                'insurance',
                                'certificates'
                            ]);
                        },
                    ],
                    "paymentinfo",
                    "additional_info" => function ($q) {
                        $q->select('id', 'order_id', 'Additional_Terms');
                    },
                    "pickup_delivery_info",
                    "vehicles",
                    "heavy_equipments",
                    "dry_vans",
                    "dry_vans_services",
                    "routes",
                    "request_broker",
                    "attachments"
                ]
            ]
        )->has('all_listing')->orderBy('updated_at', 'DESC')->get();
    }

    public function getPickupOrders(): Collection|array
    {
        $query =  ListingStatusUpdateHistory::where('status', 'Pickup')->with(
            relations: [
                'all_listing' => [
                    'authorized_user' => function ($q) {
                        $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'email')->with([
                            'insurance',
                            'certificates'
                        ]);
                    },
                    'waitings' => [
                        'waiting_users' => function ($q) {
                            $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'email')->with([
                                'insurance',
                                'certificates'
                            ]);
                        }
                    ],
                    "paymentinfo",
                    "additional_info" => function ($q) {
                        $q->select('id', 'order_id', 'Additional_Terms');
                    },
                    "pickup_delivery_info",
                    "vehicles",
                    "heavy_equipments",
                    "dry_vans",
                    "dry_vans_services",
                    "routes",
                    "request_broker",
                    "attachments"
                ],
            ]
        )->has('all_listing')->orderBy('updated_at', 'DESC');
        if (Auth::guard('Admin')->check()) {
            return $query
            ->withTrashed()
            ->get();
        }else{
            return $query
            ->get();
        }
    }

    public function getDeliverApprovalOrders(): Collection|array
    {
        return DeliverApprovals::with(
            relations: [
                'all_listing' => [
                    'authorized_user' => function ($q) {
                        $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')->with([
                            'insurance',
                            'certificates'
                        ]);
                    },
                    'deliver_approve' => [
                        'deliver_approval_user' => function ($q) {
                            $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')->with([
                                'insurance',
                                'certificates'
                            ]);
                        },
                    ],
                    "paymentinfo",
                    "additional_info" => function ($q) {
                        $q->select('id', 'order_id', 'Additional_Terms');
                    },
                    "pickup_delivery_info",
                    "vehicles",
                    "heavy_equipments",
                    "dry_vans",
                    "dry_vans_services",
                    "routes",
                    "request_broker",
                    "attachments"
                ]
            ]
        )->orderBy('updated_at', 'DESC')->get();
    }

    public function getDeliveredOrders(): Collection|array
    {

        if(Auth::guard('Admin')->check()){

            return ListingStatusUpdateHistory::where('status', 'Delivered')->with(
                relations: [
                    'all_listing' => [
                        'authorized_user' => function ($q) {
                            $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'email')->with([
                                'insurance',
                                'certificates'
                            ]);
                        },
                        'deliver' => [
                            'waiting_users' => function ($q) {
                                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'email')->with([
                                    'insurance',
                                    'certificates'
                                ]);
                            },
                        ],
                        "paymentinfo",
                        "additional_info" => function ($q) {
                            $q->select('id', 'order_id', 'Additional_Terms');
                        },
                        "pickup_delivery_info",
                        "vehicles",
                        "heavy_equipments",
                        "dry_vans",
                        "dry_vans_services",
                        "routes",
                        "request_broker",
                        "attachments"
                    ]
                ]
            )->whereHas('all_listing')
                // ->whereHas('all_listing', function ($q) {
                //     $q->where('Listing_Status', '!=', 'Archived');
                // })
                ->withTrashed()
                ->orderBy('updated_at', 'DESC')->get();

        }else{

            $authUser = Auth::guard('Authorized')->user();
            $authUserId = $authUser->id;

            if ($authUser->usr_type === 'Broker') {
                $archivedListingIds = ArchiveListing::where('user_id', $authUserId)->pluck('order_id')->toArray();
            }
            else {
                $archivedListingIds = ArchiveListing::where('user_id', $authUserId)->pluck('order_id')->toArray();
            }

            return ListingStatusUpdateHistory::where('status', 'Delivered')->with(
                relations: [
                    'all_listing' => [
                        'authorized_user' => function ($q) {
                            $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'email')->with([
                                'insurance',
                                'certificates'
                            ]);
                        },
                        'deliver' => [
                            'waiting_users' => function ($q) {
                                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'email')->with([
                                    'insurance',
                                    'certificates'
                                ]);
                            },
                        ],
                        "paymentinfo",
                        "additional_info" => function ($q) {
                            $q->select('id', 'order_id', 'Additional_Terms');
                        },
                        "pickup_delivery_info",
                        "vehicles",
                        "heavy_equipments",
                        "dry_vans",
                        "dry_vans_services",
                        "routes",
                        "request_broker",
                        "attachments"
                    ]
                ]
            )->whereHas('all_listing')
                // ->whereHas('all_listing', function ($q) {
                //     $q->where('Listing_Status', '!=', 'Archived');
                // })
                ->whereNotIn('list_id', $archivedListingIds)
                ->orderBy('updated_at', 'DESC')->get();
        }

    }

    public function getCompletedOrders(): Collection|array
    {
        $query =  ListingStatusUpdateHistory::where('status', 'Completed')->with(
            relations: [
                'all_listing' => [
                    'authorized_user' => function ($q) {
                        $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'email')->with([
                            'insurance',
                            'certificates'
                        ]);
                    },
                    'completed' => [
                        'waiting_users' => function ($q) {
                            $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'email')->with([
                                'insurance',
                                'certificates'
                            ]);
                        },
                    ],
                    "paymentinfo",
                    "additional_info" => function ($q) {
                        $q->select('id', 'order_id', 'Additional_Terms');
                    },
                    "pickup_delivery_info",
                    "vehicles",
                    "heavy_equipments",
                    "dry_vans",
                    "dry_vans_services",
                    "routes",
                    "request_broker",
                    "attachments"
                ]
            ]
        )->whereHas('all_listing')
            // ->whereHas('all_listing', function ($q) {
            //     $q->where('Listing_Status', '!=', 'Archived');
            // })
            ->orderBy('updated_at', 'DESC');
            if (Auth::guard('Admin')->check()) {
                return $query
                ->withTrashed()
                ->get();
            }else{
                return $query
                ->get();
            }
    }

    public function getCancelledOrders(): Collection|array
    {
        $query =  ListingStatusUpdateHistory::where('status', 'Cancelled')
    ->with([
        'all_listing' => function ($query) {
            $query->with([
                'authorized_user' => function ($q) {
                    $q->select('id', 'Company_Name', 'email', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')
                        ->with(['insurance', 'certificates']);
                },
                'cancel' => function ($q) {
                    $q->with([
                        'waiting_users' => function ($q) {
                            $q->select('id', 'Company_Name', 'email', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')
                                ->with(['insurance', 'certificates']);
                        },
                    ]);
                },
                'paymentinfo',
                'additional_info' => function ($q) {
                    $q->select('id', 'order_id', 'Additional_Terms');
                },
                'pickup_delivery_info',
                'vehicles',
                'heavy_equipments',
                'dry_vans',
                'dry_vans_services',
                'routes',
                'request_broker',
                'attachments',
            ]);
        },
        'cancelled_By' => function ($q) {
            $q->select('id', 'Company_Name', 'email', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
        },
    ])
    ->orderBy('updated_at', 'DESC');
    if (Auth::guard('Admin')->check()) {
        return $query
        ->withTrashed()
        ->get();
    }else{
        return $query
        ->get();
    }
    }

    public function getProfileCompleteList($User_ID): Collection|array
    {
        $User = AuthorizedUsers::where('id', $User_ID)->firstOrFail();
        if ($User->usr_type === 'Carrier') {
            return ListingStatusUpdateHistory::where('status', 'Delivered')->with(
                [
                    'all_listing' => [
                        'authorized_user' => function ($q) {
                            $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
                        },
                    ]

                ]
            )->where('cmp_id', $User_ID)->get();
        } else {
            return ListingStatusUpdateHistory::where('status', 'Delivered')->with(
                [
                    'waiting_users' => function ($q) {
                        $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
                    },
                ]
            )->where('user_id', $User_ID)->get();
        }
    }

    public function getProfileCompCompleteList($User_ID, $Search): Collection|array
    {
        $User = AuthorizedUsers::where('id', $User_ID)->firstOrFail();
        if ($User->usr_type === 'Carrier') {
            return ListingStatusUpdateHistory::where('status', 'Completed')->with(
                [
                    'all_listing' => [
                        'authorized_user' => function ($q) use ($Search) {
                            $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')
                                ->where('Company_Name', 'LIKE', '%' . $Search . '%');
                        },
                    ]

                ]
            )->where('cmp_id', $User_ID)->get();
        } else {
            return ListingStatusUpdateHistory::where('status', 'Completed')->with(
                [
                    'waiting_users' => function ($q) use ($Search) {
                        $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')
                            ->where('Company_Name', 'LIKE', '%' . $Search . '%');
                    },
                ]
            )->where('user_id', $User_ID)->get();
        }
    }

    public function assignDispatch(): string
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        // $Dispatch = new Dispatch();
        $Dispatch = new ListingStatusUpdateHistory();
        $ListingAgreement = new ListingAgreement();

        $AllUserListing = AllUserListing::where('id', Session::get('order_id'))->first();
        $AllUserListing->Listing_Status = 'Dispatch';

        $RecordUpdate = ListingStatusUpdateHistory::where('status', 'Waiting Approval')->where('list_id', Session::get('order_id'))->first();

        RequestBroker::where('order_id', Session::get('order_id'))
            ->where('user_id', $user_id)
            ->update([
                'is_cancel' => 1
            ]);

        $Dispatch->user_id = $RecordUpdate->user_id;
        $Dispatch->list_id = Session::get('order_id');
        $Dispatch->cmp_id = $RecordUpdate->CMP_id;
        $Dispatch->status = 'Dispatch';

        $ListingAgreement->Agreement_Name = Session::get('Agreement_Name');
        $ListingAgreement->Agreement_Signature = Session::get('Agreement_Signature');
        $ListingAgreement->Sign = Session::get('Sign');
        $ListingAgreement->user_id = Session::get('user_id');
        $ListingAgreement->order_id = Session::get('order_id');
        $ListingAgreement->CMP_id = $user_id;

        if ($AllUserListing->update() && $ListingAgreement->save()) {
            // $this->OrderHistory('Dispatch', null, null, Session::get('order_id'), $RecordUpdate->user_id, $RecordUpdate->CMP_id);
            if ($Dispatch->save() && $RecordUpdate->delete()) {
                $flag = DayDispatchHelper::SendNotificationOnStatusChanged('Dispatch', Session::get('order_id'));
                if ($flag) {
                    return redirect()->route('Dispatch.Listing')->with('Success!', "Your Listing has been Dispatch Successfully!");
                }
            }
            return back()->with('Error!', "Your Listing hasn't Waiting's!");
        }
        return back()->with('Error!', "Listing not Updated!");
    }

    // public function OrderHistory($status, $is_cancel, $is_archived, $order_id, $user_id, $CMP_id): void
    // {

    //     OrderHistory::create([
    //         'status' => $status,
    //         'cancel_by' => $is_cancel,
    //         'archived_by' => $is_archived,
    //         'order_id' => $order_id,
    //         'user_id' => $user_id,
    //         'CMP_id' => $CMP_id
    //     ]);
    // }

    // public function RemoveOrderHistory($status, $order_id, $user_id, $CMP_id): void
    // {
    //     OrderHistory::where([
    //         'status' => $status,
    //         'order_id' => $order_id,
    //         'user_id' => $user_id,
    //         'CMP_id' => $CMP_id
    //     ])->delete();
    // }

    public function UpdateUserSubscription($Package_Name, $User_ID): bool
    {
        if ($Package_Name === 'Heavy Load Subscription') {
            AuthorizedUsers::where('id', $User_ID)
                ->update(array(
                    'is_heavy_subscribe' => 1
                ));
            return true;
        }
        if ($Package_Name === 'Dry Van Load Subscription') {
            AuthorizedUsers::where('id', $User_ID)
                ->update(array(
                    'is_dry_van_subscribe' => 1
                ));
            return true;
        }
        return false;
    }
}
