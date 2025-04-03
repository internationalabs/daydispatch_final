<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing\AllUserListing;
use App\Models\Listing\CompletedOrders;
use App\Models\Listing\Dispatch;
use App\Models\Carrier\RequestBroker;
use App\Models\Listing\WaitingForApproval;
use App\Models\Listing\PickUpApprovals;
use App\Models\Listing\PickupOrders;
use App\Models\Listing\DeliverApprovals;
use App\Models\Listing\DeliverdOrders;
use App\Models\Listing\CancelledOrders;
use App\Models\Listing\ListingStatusUpdateHistory;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\SidebarOption;
use App\Models\Quote\Order;
use Illuminate\Support\Facades\DB;

class GlobalSearchController extends Controller
{
    public function search(Request $request)
    {
        // dd($request->toArray());
        $auth_user = Auth::guard('Authorized')->user();
        $auth_id = $auth_user->id;
        $searchQuery = $request->input('search_query');
        $limit = $request->input('limit', 20);
        $slot = '';
        $checkType = $auth_user->usr_type === 'Carrier' ? 'cmp_id' : 'user_id';
        $commonConditions = $auth_user->usr_type;

        $criteria = $request->input('search_criteria');
        $isNewRequest = request()->has('new_listing');

        $orderIds = [];

        // CompletedOrders
        $completed = ListingStatusUpdateHistory::where($checkType, $auth_id)->where('status', 'Completed')->withTrashed()->pluck('list_id')->toArray();
        $orderIds = array_merge($orderIds, $completed);

        // Dispatch
        $dispatched = ListingStatusUpdateHistory::where($checkType, $auth_id)->where('status', 'Dispatch')->withTrashed()->pluck('list_id')->toArray();
        $orderIds = array_merge($orderIds, $dispatched);

        // RequestBroker
        $requested = RequestBroker::active()->where($checkType, $auth_id)->pluck('order_id')->toArray();
        $orderIds = array_merge($orderIds, $requested);

        // WaitingForApproval
        $waitingForApproval = ListingStatusUpdateHistory::where($checkType, $auth_id)->where('status', 'Waiting Approval')->withTrashed()->pluck('list_id')->toArray();
        $orderIds = array_merge($orderIds, $waitingForApproval);

        // PickUpApprovals
        // $pickupApproval = PickUpApprovals::where($checkType, $auth_id)->pluck('order_id')->toArray();
        // $orderIds = array_merge($orderIds, $pickupApproval);

        // PickupOrders
        $pickupOrders = ListingStatusUpdateHistory::where($checkType, $auth_id)->where('status', 'Pickup')->withTrashed()->pluck('list_id')->toArray();
        $orderIds = array_merge($orderIds, $pickupOrders);

        // DeliverApprovals
        // $deliverApprovalListing = DeliverApprovals::where($checkType, $auth_id)->pluck('order_id')->toArray();
        // $orderIds = array_merge($orderIds, $deliverApprovalListing);

        // DeliverdOrders
        $deliverdOrders = ListingStatusUpdateHistory::where($checkType, $auth_id)->where('status', 'Delivered')->withTrashed()->pluck('list_id')->toArray();
        $orderIds = array_merge($orderIds, $deliverdOrders);

        // CancelledOrders
        $cancelledOrders = ListingStatusUpdateHistory::where($checkType, $auth_id)->where('status', 'Cancelled')->withTrashed()->pluck('list_id')->toArray();
        $orderIds = array_merge($orderIds, $cancelledOrders);

        $Lisiting = AllUserListing::withTrashed()->has('paymentinfo');
        // dd($request->toArray() , $Lisiting->where('id', 'LIKE', '%' . 100 . '%')->get()->toArray());

        if ($request->Search_vehicleType && $request->Search_vehicleType != null) {
            if ($request->Search_vehicleType == 'vehicles') {
                $Lisiting = $Lisiting->with('vehicles')->where('Listing_Type', 1);
            } elseif ($request->Search_vehicleType == 'heavy_equipments') {
                $Lisiting = $Lisiting->with('heavy_equipments')->where('Listing_Type', 2);
            } elseif ($request->Search_vehicleType == 'dry_vans') {
                $Lisiting = $Lisiting->with('dry_vans')->where('Listing_Type', 3);
            }
        }

        if ($request->Time_Frame && $request->Time_Frame != null) {
            switch ($request->Time_Frame) {
                case 2:
                    $Lisiting = $Lisiting->where('created_at', '>=', now()->subMonths(3));
                    break;
                case 3:
                    $Lisiting = $Lisiting->where('created_at', '>=', now()->subMonths(6));
                    break;
                case 4:
                    $Lisiting = $Lisiting->where('created_at', '>=', now()->subYear());
                    break;
                case 5:
                    $Lisiting = $Lisiting->where('created_at', '>=', now()->subYears(3));
                    break;
                default:
                    break;
            }
        }

        if ($commonConditions == 'Carrier') {
            $Lisiting = $Lisiting
                ->carrierlisting()
                ->where(function ($query) use ($isNewRequest, $completed, $dispatched, $requested, $waitingForApproval, $pickupOrders, $deliverdOrders, $cancelledOrders, $auth_id) {
                    if ($isNewRequest && $isNewRequest != null) {
                        $query->where('Listing_Status', 'Listed')
                            ->where('Private_Listing', 0)
                            ->where('created_at', '>=', Carbon::now()->subHours(12));
                    } else {
                        $query->orWhereIn('id', $completed)
                            ->orWhereIn('id', $dispatched)
                            ->orWhereIn('id', $requested)
                            ->orWhereIn('id', $waitingForApproval)
                            // ->orWhereIn('id', $pickupApproval)
                            ->orWhereIn('id', $pickupOrders)
                            // ->orWhereIn('id', $deliverApprovalListing)
                            ->orWhereIn('id', $deliverdOrders)
                            ->orWhereIn('id', $cancelledOrders)
                            ->orWhere('user_id', $auth_id)
                            ->orWhere('Listing_Status', 'Listed');
                    }
                })
                ->where(function ($query) use ($criteria, $searchQuery) {
                    if ($criteria == 1) {
                        $query->where('Ref_ID', 'like', '%' . $searchQuery . '%');
                    } elseif ($criteria == 2) {
                        $query->orWhereHas('routes', function ($q) use ($searchQuery) {
                            $city = explode(',', $searchQuery)[0];
                            $q->where('Origin_ZipCode', 'like', $city . '%');
                        });
                    } elseif ($criteria == 3) {
                        $query->orWhereHas('routes', function ($q) use ($searchQuery) {
                            $q->where('Origin_ZipCode', 'like', '%, ' . $searchQuery . ',%');
                        });
                    } elseif ($criteria == 4) {
                        $query->orWhereHas('routes', function ($q) use ($searchQuery) {
                            $q->where('Dest_ZipCode', 'like', $searchQuery . '%');
                        });
                    } elseif ($criteria == 5) {
                        $query->orWhereHas('routes', function ($q) use ($searchQuery) {
                            $q->where('Dest_ZipCode', 'like', '%, ' . $searchQuery . ',%');
                        });
                    } elseif ($criteria == 6) {
                        $query->orWhereHas('authorized_user', function ($q) use ($searchQuery) {
                            $q->where('Company_Name', 'like', '%' . $searchQuery . '%');
                        });
                    } elseif ($criteria == 7) {
                        $query->orWhereHas('vehicles', function ($q) use ($searchQuery) {
                            $q->where('Vehcile_Year', 'like', '%' . $searchQuery . '%')
                                ->orWhere('Vehcile_Make', 'like', '%' . $searchQuery . '%')
                                ->orWhere('Vehcile_Model', 'like', '%' . $searchQuery . '%');
                        });
                    }
                })
                ->get();
        } else {
            $Lisiting = $Lisiting
                ->where(function ($query) use ($isNewRequest, $completed, $dispatched, $requested, $waitingForApproval, $pickupOrders, $deliverdOrders, $cancelledOrders, $auth_id) {
                    if ($isNewRequest && $isNewRequest !== null) {
                        $query->where('created_at', '>=', Carbon::now()->subHours(12))
                            ->whereHas('authorized_user', function ($q) use ($auth_id) {
                                $q->where('user_id', $auth_id);
                            });
                    } else {
                        $query->orWhere('user_id', $auth_id)
                            ->orWhereIn('id', $completed)
                            ->orWhereIn('id', $dispatched)
                            ->orWhereIn('id', $requested)
                            ->orWhereIn('id', $waitingForApproval)
                            // ->orWhereIn('id', $pickupApproval)
                            ->orWhereIn('id', $pickupOrders)
                            // ->orWhereIn('id', $deliverApprovalListing)
                            ->orWhereIn('id', $deliverdOrders)
                            ->orWhereIn('id', $cancelledOrders);
                    }
                })
                ->where(function ($query) use ($criteria, $searchQuery) {
                    if ($criteria == 1) {
                        $query->where('Ref_ID', 'like', '%' . $searchQuery . '%');
                    } elseif ($criteria == 2) {
                        $query->orWhereHas('routes', function ($q) use ($searchQuery) {
                            $city = explode(',', $searchQuery)[0];
                            $q->where('Origin_ZipCode', 'like', $city . '%');
                        });
                    } elseif ($criteria == 3) {
                        $query->orWhereHas('routes', function ($q) use ($searchQuery) {
                            $q->where('Origin_ZipCode', 'like', '%, ' . $searchQuery . ',%');
                        });
                    } elseif ($criteria == 4) {
                        $query->orWhereHas('routes', function ($q) use ($searchQuery) {
                            $q->where('Dest_ZipCode', 'like', $searchQuery . '%');
                        });
                    } elseif ($criteria == 5) {
                        $query->orWhereHas('routes', function ($q) use ($searchQuery) {
                            $q->where('Dest_ZipCode', 'like', '%, ' . $searchQuery . ',%');
                        });
                    } elseif ($criteria == 6) {
                        $query->orWhereHas('dispatch_listing', function ($q) use ($searchQuery) {
                            $q->whereHas('dispatch_user', function ($subQ) use ($searchQuery) {
                                $subQ->where('Company_Name', 'like', '%' . $searchQuery . '%');
                            });
                        });
                        // $query->orWhereHas('authorized_user', function ($q) use ($searchQuery) {
                        //     $q->where('Company_Name', 'like', '%' . $searchQuery . '%');
                        // });
                    } elseif ($criteria == 7) {
                        $query->orWhereHas('vehicles', function ($q) use ($searchQuery) {
                            $q->where('Vehcile_Year', 'like', '%' . $searchQuery . '%')
                                ->orWhere('Vehcile_Make', 'like', '%' . $searchQuery . '%')
                                ->orWhere('Vehcile_Model', 'like', '%' . $searchQuery . '%');
                        });
                    }
                })
                ->where('Private_Listing', 0)
                ->get();
        }
        
        return view('globalSearch.index', compact('Lisiting', 'auth_user', 'slot'));
    }

    public function QuoteSearch(Request $request)
    {
        // dd($request->toarray());
        $slot = '';
        $auth_user = Auth::guard('Authorized')->user();
        $auth_id = $auth_user->id;
        $OptionName = SidebarOption::where('user_id', $auth_id)->get();

        // Start building the query
        $Lisiting = Order::with([
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
            "attachments"
        ])->where('user_id', $auth_id)->withTrashed();

        if ($request->filled('search_criteria') && $request->filled('search_query')) {
            $search_query = $request->input('search_query');

            switch ($request->input('search_criteria')) {
                case 1: // Order ID
                    $Lisiting->where('Ref_ID', 'LIKE', '%' . $search_query . '%');
                    break;
                case 2: // Pickup City
                    $Lisiting->whereHas('routes', function ($query) use ($search_query) {
                        $query->where('Origin_ZipCode', 'LIKE', '%' . $search_query . '%');
                    });
                    break;
                case 3: // Pickup State
                    $allStates = DB::table('zip_codes')
                        ->where('statefull', 'LIKE', '%' . $search_query . '%')
                        ->first();
                    // dd($allStates);
                    if (isset($allStates) && $allStates != null) {
                        $temp = $allStates->state;
                        $search_query = $temp;
                    }
                    // dd($search_query);
                    $Lisiting->whereHas('routes', function ($query) use ($search_query) {
                        $query->where('Origin_ZipCode', 'LIKE', '%' . $search_query . '%');
                    });
                    break;
                case 4: // Delivery City
                    $Lisiting->whereHas('routes', function ($query) use ($search_query) {
                        $query->where('Dest_ZipCode', 'LIKE', '%' . $search_query . '%');
                    });
                    break;
                case 5: // Delivery State
                    $allStates = DB::table('zip_codes')
                        ->where('statefull', 'LIKE', '%' . $search_query . '%')
                        ->first();

                    if (isset($allStates) && $allStates != null) {
                        $temp = $allStates->state;
                        $search_query = $temp;
                    }
                    // dd($search_query);
                    $Lisiting->whereHas('routes', function ($query) use ($search_query) {
                        $query->where('Dest_ZipCode', 'LIKE', '%' . $search_query . '%');
                    });
                    break;
                case 6: // VIN Number
                    $Lisiting->whereHas('vehicles', function ($query) use ($search_query) {
                        $query->where('Vin_Number', 'LIKE', '%' . $search_query . '%');
                    });
                    break;
                case 7: // Vehicle Make
                    $Lisiting->whereHas('vehicles', function ($query) use ($search_query) {
                        $query->where('Vehcile_Make', 'LIKE', '%' . $search_query . '%');
                    })->orWhereHas('heavy_equipments', function ($query) use ($search_query) {
                        $query->where('Equipment_Make', 'LIKE', '%' . $search_query . '%');
                    });
                    break;
                case 8: // Customer Name
                    $Lisiting->where('Customer_Name', 'LIKE', '%' . $search_query . '%');
                    break;
                case 9: // Customer Email
                    $Lisiting->where('Customer_Email', 'LIKE', '%' . $search_query . '%');
                    break;
                case 10: // Pickup ZipCode
                    $Lisiting->whereHas('routes', function ($query) use ($search_query) {
                        $query->where('Origin_ZipCode', 'LIKE', '%' . $search_query . '%');
                    });
                    break;
                case 11: // Delivery ZipCode
                    $Lisiting->whereHas('routes', function ($query) use ($search_query) {
                        $query->where('Dest_ZipCode', 'LIKE', '%' . $search_query . '%');
                    });
                    break;
                case 12: // Customer Phone
                    $Lisiting->where('Customer_Phone', 'LIKE', '%' . $search_query . '%');
                    break;
            }
        }

        if ($request->filled('Search_vehicleType')) {
            if ($request->Search_vehicleType == 'vehicles') {
                $Lisiting = $Lisiting->where('Listing_Type', 1)->whereHas('vehicles');
            } elseif ($request->Search_vehicleType == 'heavy_equipments') {
                $Lisiting = $Lisiting->where('Listing_Type', 2)->whereHas('heavy_equipments');
            } elseif ($request->Search_vehicleType == 'dry_vans') {
                $Lisiting = $Lisiting->where('Listing_Type', 3)->whereHas('dry_vans');
            }
        }

        if ($request->Time_Frame && $request->Time_Frame != null) {
            switch ($request->Time_Frame) {
                case 2:
                    $Lisiting = $Lisiting->where('created_at', '>=', now()->subMonths(3));
                    break;
                case 3:
                    $Lisiting = $Lisiting->where('created_at', '>=', now()->subMonths(6));
                    break;
                case 4:
                    $Lisiting = $Lisiting->where('created_at', '>=', now()->subYear());
                    break;
                case 5:
                    $Lisiting = $Lisiting->where('created_at', '>=', now()->subYears(3));
                    break;
                default:
                    break;
            }
        }

        $Lisiting = $Lisiting->get();

        return view('quoteglobalSearch.index', compact('Lisiting', 'auth_user', 'slot', 'OptionName'));
    }
}
