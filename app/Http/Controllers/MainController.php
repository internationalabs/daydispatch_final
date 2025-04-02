<?php

namespace App\Http\Controllers;

use App\Helpers\DayDispatchHelper;
use App\Models\Auth\AuthorizedUsers;
use App\Models\Extras\BillOfLading;
use App\Models\Extras\Notification;
use App\Models\Listing\AllUserListing;
use App\Models\Listing\DeliverApprovals;
use App\Models\Listing\Dispatch;
use App\Models\Listing\PickUpApprovals;
use App\Models\Listing\PickupOrders;
use App\Models\Listing\CancelledOrders;
use App\Models\Listing\CompletedOrders;
use App\Models\Listing\DeliverdOrders;
use App\Models\Listing\WaitingForApproval;
use App\Models\Listing\WatchList;
use App\Models\Carrier\RequestBroker;
use App\Models\Extras\MiscellenousItems;
use App\Services\ListingServices;
// use Illuminate\Support\Facades\File;
use Exception;
use File;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use JsonException;
use RuntimeException;
use Throwable;
use Carbon\Carbon;
use App\Models\Extras\MessageNotifications;
use App\Models\chat;
use App\Models\Auth\AuthorizedAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    protected ListingServices $listingServices;

    public function __construct(ListingServices $listingServices)
    {
        $this->listingServices = $listingServices;
    }

    // Network Searching
    public function findNetwork(Request $request): string
    {
        return DB::transaction(static function () use ($request) {
            if ($request->ajax()) {
                $getQuery = trim($request->name);
                $output = '';

                if (!empty($getQuery)) {
                    $data = AuthorizedUsers::where('Company_Name', 'LIKE', $getQuery . '%')->get();
                    if ($data->count() > 0) {
                        $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                        foreach ($data as $row) {
                            $output .= '<li class="list-group-item">' . htmlspecialchars($row->Company_Name) . '<input hidden type="text" value="' . $row->id . '" ></li>';
                        }
                        $output .= '</ul>';
                    } else {
                        $output .= '<li class="list-group-item">No Data Found</li>';
                    }
                }
                return $output;
            }
            return 'Ajax Failed to Request!';
        });
    }

    // Company Searching From Search Bar
    public function searchCompanyName(Request $request): JsonResponse
    {
        return DB::transaction(static function () use ($request) {
            try {
                if ($request->ajax()) {
                    $getQuery = trim($request->name);
                    $data = AuthorizedUsers::where('Company_Name', 'LIKE', '%' . $getQuery . '%')
                        // ->where('admin_verify', '!=', 0)
                        ->get([
                            'id',
                            'profile_photo_path',
                            'Company_Name',
                            'Company_City',
                            'Company_State',
                            'usr_type',
                            'admin_verify'
                        ]);
                    // dd($data);
                    $countData = count($data);

                    $view = view('partials.search-results', ['data' => $data, 'countData' => $countData])->render();

                    return response()->json(['html' => $view]);
                }

                return response()->json(['error' => 'Ajax Failed to Request!'], 400);
            } catch (Exception $e) {
                Log::error($e->getMessage());
                return response()->json(['error' => $e->getMessage()], 500);
            }
        });
    }

    public function getDispatchCompanyName(Request $request): JsonResponse|string
    {
        return DB::transaction(static function () use ($request) {
            if ($request->ajax()) {
                $data = AuthorizedUsers::where('Company_Name', trim($request->name))->first();
                return response()->json($data);
            }
            return 'Ajax Failed to Request!';
        });
    }

    /**
     */
    public function getVinNumber(Request $request)
    {
        if ($request->ajax()) {
            $vin_no = trim($request->Vin_Number);

            try {
                DB::beginTransaction();

                $mydata = file_get_contents('https://vpic.nhtsa.dot.gov/api/vehicles/decodevin/' . $vin_no . '?format=json');
                $vindata = json_decode($mydata, false, 512, JSON_THROW_ON_ERROR);
                $year = '';
                $model = '';
                $make = '';
                $weight = '';

                if (empty($vindata)) {
                    return [
                        'Make' => $make,
                        'Model' => $model,
                        'Year' => $year,
                        'Weight' => $weight
                    ];
                }

                foreach ($vindata->Results as $key => $value) {
                    if ($value->Variable === 'Make') {
                        $make = $value->Value;
                    }
                    if ($value->Variable === 'Model') {
                        $model = $value->Value;
                    }
                    if ($value->Variable === 'Model Year') {
                        $year = $value->Value;
                    }
                    if ($value->Variable === 'Gross Vehicle Weight Rating From') {
                        $weight = $value->Value;
                    }
                }

                DB::commit();

                return [
                    'Make' => $make,
                    'Model' => $model,
                    'Year' => $year,
                    'Weight' => $weight
                ];
            } catch (Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                return response()->json(['error' => 'No Request Available'], 500);
            }
        }
    }

    public function getAllCarrierRequest(Request $request): string
    {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();

                $data = AllUserListing::with([
                    'request_broker_all' => [
                        'requested_user' => [
                            'insurance',
                            'certificates'
                        ]
                    ]
                ])->whereRelation('request_broker_all', 'order_id', '=', $request->Listed_ID)->first();

                DB::commit();

                return view('partials.listing.all_carrier_requests', ['data' => $data])->render();
            } catch (Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                return 'No Request Available';
            }
        }

        return 'Ajax Failed to Request!';
    }

    // Vehicle Make
    public function getVehcileMake(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $data = DB::table('makes')->where('title', 'LIKE', '%' . $request->input('query') . '%')->get();
            $Makes = $data->map(function ($row) {
                return $row->title;
            });

            DB::commit();

            return response()->json($Makes);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['error' => 'No Request Available'], 500);
        }
    }

    // Vehicle Model
    public function getVehcilModel(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $data = DB::table('make_models')->where('title', 'LIKE', '%' . $request->input('query') . '%')->get();
            $Makes = $data->map(function ($row) {
                return $row->title;
            });

            DB::commit();

            return response()->json($Makes);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['error' => 'No Request Available'], 500);
        }
    }

    // Bill Of Lading On Pickup Listing
    public function AttachBOLPickup(Request $request, ListingServices $listingServices): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $BillOfLading = $this->getLadingBasicInfo($request);
            $PickUpApprovals = new PickUpApprovals();

            $AllUserListing = AllUserListing::where('id', $request->get_Listed_ID)->first();
            $AllUserListing->Listing_Status = 'PickUp Approval';

            $RecordUpdate = Dispatch::where('order_id', $request->get_Listed_ID)->first();

            if ($BillOfLading->save()) {
                $this->BolAttachment($request, $BillOfLading);
                if ($AllUserListing->update()) {
                    $PickUpApprovals->user_id = $RecordUpdate->user_id;
                    $PickUpApprovals->order_id = $request->get_Listed_ID;
                    $PickUpApprovals->CMP_id = $RecordUpdate->CMP_id;

                    $listingServices->OrderHistory('PickUp Approval', null, null, $RecordUpdate->order_id, $RecordUpdate->user_id, $RecordUpdate->CMP_id);
                    if ($PickUpApprovals->save() && $RecordUpdate->delete()) {
                        $flag = DayDispatchHelper::SendNotificationOnStatusChanged('PickUp Approval', $request->get_Listed_ID);
                        if ($flag) {
                            DB::commit();
                            return redirect()->route('PickUp.Approval.Listing')->with('Success!', "Your Listing has been PickUp Successfully!");
                        }
                    } else {
                        throw new RuntimeException("Error in saving PickUpApprovals or deleting RecordUpdate");
                    }
                } else {
                    throw new RuntimeException("Error in updating AllUserListing");
                }
            } else {
                throw new RuntimeException("Error in saving BillOfLading");
            }
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->with('Error!', $e->getMessage());
        }

        return back()->with('Error!', "Bill of Lading Not Attached!.");
    }

    // Bill Of Lading On Deliver Listing
    public function AttachBOLDeliver(Request $request, ListingServices $listingServices): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $BillOfLading = $this->getLadingBasicInfo($request);
            // $DeliverApprovals = new DeliverApprovals();
            $DeliverdOrders = new DeliverdOrders();

            $AllUserListing = AllUserListing::where('id', $request->get_Listed_ID)->first();
            $AllUserListing->Listing_Status = 'Delivered';

            $RecordUpdate = PickupOrders::where('order_id', $request->get_Listed_ID)->first();

            if ($BillOfLading->save()) {
                $this->BolAttachment($request, $BillOfLading);
                if ($AllUserListing->update()) {
                    $DeliverdOrders->user_id = $RecordUpdate->user_id;
                    $DeliverdOrders->order_id = $request->get_Listed_ID;
                    $DeliverdOrders->CMP_id = $RecordUpdate->CMP_id;

                    $listingServices->OrderHistory('Delivered', null, null, $RecordUpdate->order_id, $RecordUpdate->user_id, $RecordUpdate->CMP_id);
                    if ($DeliverdOrders->save() && $RecordUpdate->delete()) {
                        $flag = DayDispatchHelper::SendNotificationOnStatusChanged('Delivered', $request->get_Listed_ID);
                        if ($flag) {
                            DB::commit();
                            return redirect()->route('Delivered.Listing')->with('Success!', "Your Listing has been Deliver Successfully!");
                        }
                    } else {
                        throw new RuntimeException("Error in saving DeliverdOrders or deleting RecordUpdate");
                    }
                } else {
                    throw new RuntimeException("Error in updating AllUserListing");
                }
            } else {
                throw new RuntimeException("Error in saving BillOfLading");
            }
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->with('Error!', $e->getMessage());
        }

        return back()->with('Error!', "Bill of Lading Not Attached!.");
    }
    public function getLadingBasicInfo(Request $request): BillOfLading
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        $BillOfLading = new BillOfLading();
        $BillOfLading->Meter_Reading = $request->Meter_Reading;
        $BillOfLading->Pickup_Location = $request->Pickup_Location;
        $BillOfLading->Pickup_Person = $request->Pickup_Person;
        $BillOfLading->Phone_Number = $request->Pickup_Phone;
        $BillOfLading->BOL_Name = $request->BOL_Name;
        $BillOfLading->BOL_Signature = $request->BOL_Sign;
        $BillOfLading->Bol_Type = $request->Bol_Type;
        $BillOfLading->Sign = $request->signatureShw;
        $BillOfLading->order_id = $request->get_Listed_ID;
        $BillOfLading->is_person_available = $request->is_person_available;
        $BillOfLading->user_id = $user_id;

        return $BillOfLading;
    }

    public function BolAttachment(Request $request, BillOfLading $BillOfLading): void
    {
        // if ($request->hasFile('Bill_Of_Lading')) {
        //     foreach ($request->file('Bill_Of_Lading') as $key => $file) {
        //         $imageGalleryName = $file->getClientOriginalName();
        //         $path = $file->storeAs('Uploads/Bills/' . $BillOfLading->id, $imageGalleryName, 'public');

        //         $insertData = [
        //             'Bill_Lading_Name' => $path,
        //             'bol_id' => $BillOfLading->id,
        //         ];

        //         DB::table('bol_attachments')->insert($insertData);
        //     }
        // }
        if ($request->hasFile('Bill_Of_Lading')) {
            foreach ($request->file('Bill_Of_Lading') as $key => $file) {
                // Create a custom path within the public directory
                $customPath = 'Uploads/Bills/' . $BillOfLading->id;
                $imageGalleryName = $file->getClientOriginalName();

                // Generate a unique file name to avoid overwriting existing files
                $uniqueFileName = $customPath . '/' . $imageGalleryName;
                while (File::exists(public_path($uniqueFileName))) {
                    $uniqueFileName = $customPath . '/' . time() . '_' . $imageGalleryName;
                }

                // Store the file in the public directory
                $file->move(public_path($customPath), $uniqueFileName);

                // Insert the file path into the database
                $insertData = [
                    'Bill_Lading_Name' => $uniqueFileName,
                    'bol_id' => $BillOfLading->id,
                ];

                DB::table('bol_attachments')->insert($insertData);
            }
        }
    }

    // Get All Notifications
    public function getNotification(Request $request): string
    {
        if ($request->ajax()) {
            $user_id = Auth::guard('Authorized')->user()->id;
            if ($user_id) {
                try {
                    DB::beginTransaction();
                    $data = Notification::where(function ($query) use ($user_id) {
                        $query->where('user_id', $user_id)
                            ->orWhereHas('order', static function ($query) use ($user_id) {
                                $query->where('user_id', $user_id)->where('is_read', 0);
                            });
                    })
                        ->where('is_read', 0)
                        ->latest('id')
                        ->limit(5)
                        ->get();

                    $msg = MessageNotifications::where('recipient_id', $user_id)
                        ->where('is_read', '0')
                        ->latest('id')
                        ->limit(5)
                        ->get();

                    $dataCount = Notification::where(function ($query) use ($user_id) {
                        $query->where('user_id', $user_id)
                            ->orWhereHas('order', static function ($query) use ($user_id) {
                                $query->where('user_id', $user_id)->where('is_read', 0);
                            });
                    })
                        ->where('is_read', 0)
                        ->latest('id')
                        ->count();

                    DB::commit();

                    return view('partials.notifications.notification-list', compact('data', 'user_id', 'msg', 'dataCount'))->render();
                } catch (QueryException $e) {
                    DB::rollBack();
                    Log::error($e->getMessage());
                    return 'Error: ' . $e->getMessage();
                }
            }
            return 'Authentication Required!';
        }
        return 'Ajax Failed to Request!';
    }

    // Get All Messages
    public function GetMessage(Request $request): string
    {
        if ($request->ajax()) {
            $user_id = Auth::guard('Authorized')->user()->id;
            if ($user_id) {
                try {
                    DB::beginTransaction();

                    $msgs = MessageNotifications::where('recipient_id', $user_id)
                        ->with('chat')
                        ->where('is_read', '0')
                        ->latest('id')
                        ->get();

                    DB::commit();

                    return view('partials.notifications.message-list', compact('user_id', 'msgs'))->render();
                } catch (QueryException $e) {
                    DB::rollBack();
                    Log::error($e->getMessage());
                    return 'Error: ' . $e->getMessage();
                }
            }
            return 'Authentication Required!';
        }
        return 'Ajax Failed to Request!';
    }

    public function getAdminNotification(Request $request): JsonResponse|string
    {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();

                $data = Notification::latest('id')->limit(5)->get();
                $msg = chat::where('touserId', Auth::guard('Admin')->user()->id)->latest('id')->limit(5)->get();

                if (count($data) > 0) {
                    $html = View::make('partials.notifications.admin.notifications', compact('data'))->render();
                } else {
                    $html = View::make('partials.notifications.admin.notification-not-found')->render();
                }

                // dd(Auth::guard('Authorized')->user()->id, $data, $msg, $request->toArray());
                if (count($msg) > 0) {
                    $htmlMsg = View::make('partials.notifications.admin.message', compact('msg'))->render();
                } else {
                    $htmlMsg = View::make('partials.notifications.admin.message-not-found')->render();
                }
                DB::commit();

                return response()->json(['success' => true, 'html' => $html, 'htmlMsg' => $htmlMsg]);
            } catch (QueryException $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
            }
        }

        return 'Ajax Failed to Request!';
    }

    public function SearchOrderID(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $data = DB::table('all_user_listings')->where('Ref_ID', 'LIKE', '%' . $request->input('query') . '%')->get();
            $Orders = $data->map(function ($row) {
                return $row->Ref_ID . ", " . $row->Listing_Status;
            });

            DB::commit();

            return response()->json($Orders);
        } catch (QueryException $e) {
            DB::rollBack();
            // Handle the exception
            return response()->json(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function getAllComparisonListing(Request $request): ?string
    {
        try {
            DB::beginTransaction();

            $miles = (float) Str::replace(['$ ', ','], "", $request->input('Listed_Miles'));
            $result = $this->previousComparisonListing($request, $miles);

            DB::commit();

            return $result;
        } catch (QueryException $e) {
            DB::rollBack();
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getAllPreviousListing(Request $request): string
    {
        try {
            DB::beginTransaction();

            $From_Origin = Str::afterLast($request->Origin_ZipCode, ', ');
            $To_Dest = Str::afterLast($request->Dest_ZipCode, ', ');
            $miles = DayDispatchHelper::twopoints_on_earth($From_Origin, $To_Dest);
            $result = $this->previousComparisonListing($request, $miles);

            DB::commit();

            return $result;
        } catch (QueryException $e) {
            DB::rollBack();
            return 'Error: ' . $e->getMessage();
        }
    }

    /**
     * @param Request $request
     * @param float $miles
     * @return string
     */
    private function previousComparisonListing(Request $request, float $miles): string
    {
        // dd($request->toArray());
        $data = AllUserListing::has('routes')->find($request->Listed_ID);
        $pickup = $data->routes->Origin_ZipCode;
        $destination = $data->routes->Dest_ZipCode;
        if ($request->ajax()) {
            try {
                DB::beginTransaction();

                $from = $miles - 200;
                $to = $miles + 200;

                $data = AllUserListing::whereHas('routes', static function ($query) use ($from, $to, $pickup, $destination) {
                    // $query->whereBetween('Miles', [$from, $to])->orWhereBetween('Miles', [$to, $from]);
                    $query->where('Origin_ZipCode', $pickup)->where('Dest_ZipCode', $destination);
                })
                    ->with('paymentinfo', 'routes', 'vehicles', 'heavy_equipments', 'dry_vans', 'dispatch_listing')
                    ->latest('id')
                    ->where('Listing_Type', $request->input('Listed_Type'))
                    ->limit(5)
                    ->get();

                DB::commit();

                return view('partials.listing.comparison-listing', compact('data', 'miles'))->render();
            } catch (QueryException $e) {
                DB::rollBack();
                return 'Error: ' . $e->getMessage();
            }
        }
        return 'Ajax Failed to Request!';
    }

    public function getOrderCounts(Request $request): JsonResponse|string
    {
        if ($request->ajax()) {
            try {
                $auth_user = Auth::guard('Authorized')->user();
                $verification = $auth_user->admin_verify && $auth_user->is_email_verified && $auth_user->Profile_Update;
                $orderCount = DayDispatchHelper::getOrderCounts($auth_user->id, $auth_user->usr_type);
                $orderQuoteCount = DayDispatchHelper::getQuoteOrderCounts($auth_user->id, $auth_user->usr_type);
                $dashboard = 'listing';
                // $html = view('partials.sidebar-menu', compact('orderCount', 'verification', 'auth_user', 'orderQuoteCount', 'dashboard'))->render();
                $html = view('partials.nav-bar', compact('orderCount', 'verification', 'auth_user', 'orderQuoteCount', 'dashboard'))->render();

                return response()->json(['success' => true, 'html' => $html]);
            } catch (Exception $e) {
                return response()->json(['error' => false, 'message' => $e->getMessage()]);
            }
        }
        return 'AJAX request failed!';
    }

    public function getQuoteCounts(Request $request): JsonResponse|string
    {
        if ($request->ajax()) {
            try {
                $auth_user = Auth::guard('Authorized')->user();
                $verification = $auth_user->admin_verify && $auth_user->is_email_verified && $auth_user->Profile_Update;
                $orderCount = DayDispatchHelper::getOrderCounts($auth_user->id, $auth_user->usr_type);
                $orderQuoteCount = DayDispatchHelper::getQuoteOrderCounts($auth_user->id, $auth_user->usr_type);
                $dashboard = 'Quote';
                // dd($dashboard);

                $html = view('partials.sidebarQuote-menu', compact('orderCount', 'verification', 'auth_user', 'orderQuoteCount', 'dashboard'))->render();

                return response()->json(['success' => true, 'html' => $html]);
            } catch (Exception $e) {
                return response()->json(['error' => false, 'message' => $e->getMessage()]);
            }
        }
        return 'AJAX request failed!';
    }

    public function getListingCounts(Request $request)
    {
        if ($request->has('UserID') && $request->UserID != null) {
            $auth_user = AuthorizedUsers::where('id', $request->UserID)->first();
            $usr_type = $auth_user->usr_type;
            $user_id = $auth_user->id;
        } else {
            $auth_user = Auth::guard('Authorized')->user();
            $usr_type = $auth_user->usr_type;
            $user_id = $auth_user->id;
        }
        // dd($usr_type, $user_id);
        $commonConditions = $usr_type === 'Carrier' ? 'CMP_id' : 'user_id';
        $Listed = $usr_type === 'Carrier' ? AllUserListing::whereBetween('created_at', [Carbon::parse($request->start_Date)->format('Y-m-d'), Carbon::parse($request->end_Date)->format('Y-m-d')])->get() : AllUserListing::where('user_id', $user_id)->whereBetween('created_at', [Carbon::parse($request->start_Date)->format('Y-m-d'), Carbon::parse($request->end_Date)->format('Y-m-d')])->get();

        return $data = json_encode([
            // 'Waiting_Approval' => WaitingForApproval::where($commonConditions, $user_id)
            //     ->withTrashed()->whereBetween('created_at', [Carbon::parse($request->start_Date)->format('Y-m-d'), Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
            'Waiting_Approval' => WaitingForApproval::where($commonConditions, $user_id)
                ->withTrashed()->whereBetween('created_at', [Carbon::parse($request->start_Date)->format('Y-m-d'), Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
            'Requested' => RequestBroker::where($commonConditions, $user_id)
                ->whereBetween('created_at', [Carbon::parse($request->start_Date)->format('Y-m-d'), Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
            'Dispatch' => Dispatch::where($commonConditions, $user_id)
                ->withTrashed()->whereBetween('created_at', [Carbon::parse($request->start_Date)->format('Y-m-d'), Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
            'Time_Quote' => AllUserListing::where('Custom_Listing', 1)->where('user_id', $user_id)
                ->whereBetween('created_at', [Carbon::parse($request->start_Date)->format('Y-m-d'), Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
            'Listed' => $Listed,
            'PickUp' => PickupOrders::where($commonConditions, $user_id)
                ->withTrashed()->whereBetween('created_at', [Carbon::parse($request->start_Date)->format('Y-m-d'), Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
            'PickUp_Approval' => PickUpApprovals::where($commonConditions, $user_id)
                ->withTrashed()->whereBetween('created_at', [Carbon::parse($request->start_Date)->format('Y-m-d'), Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
            'Deliver_Approval' => DeliverApprovals::where($commonConditions, $user_id)
                ->withTrashed()->whereBetween('created_at', [Carbon::parse($request->start_Date)->format('Y-m-d'), Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
            'Delivered' => DeliverdOrders::where($commonConditions, $user_id)
                ->withTrashed()->whereBetween('created_at', [Carbon::parse($request->start_Date)->format('Y-m-d'), Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
            'Archived' => AllUserListing::onlyTrashed()->where('user_id', $user_id)
                ->whereBetween('created_at', [Carbon::parse($request->start_Date)->format('Y-m-d'), Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
            'Completed' => CompletedOrders::where($commonConditions, $user_id)
                ->withTrashed()->whereBetween('created_at', [Carbon::parse($request->start_Date)->format('Y-m-d'), Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
            'Cancelled' => CancelledOrders::where($commonConditions, $user_id)
                ->whereBetween('created_at', [Carbon::parse($request->start_Date)->format('Y-m-d'), Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
            'Expired' => AllUserListing::expired()->where('user_id', $user_id)
                ->whereBetween('created_at', [Carbon::parse($request->start_Date)->format('Y-m-d'), Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
            'WatchList' => WatchList::where('user_id', $user_id)->whereHas('listing', function ($q) {
                $q->where('Listing_Status', 'Listed');
            })->whereBetween('created_at', [Carbon::parse($request->start_Date)->format('Y-m-d'), Carbon::parse($request->end_Date)->format('Y-m-d')])->get(), //count for My Watchlist
            'MiscItems' => MiscellenousItems::where('status', 0)->whereHas('all_listing', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })->whereBetween('created_at', [Carbon::parse($request->start_Date)->format('Y-m-d'), Carbon::parse($request->end_Date)->format('Y-m-d')])->get(), //count for Approve Misc Pay.
        ]);
    }

    public function getMiscCharges(Request $request): JsonResponse|string
    {
        if ($request->ajax()) {
            try {
                $auth_user = Auth::guard('Authorized')->user();
                // $verification = $auth_user->admin_verify && $auth_user->is_email_verified && $auth_user->Profile_Update;
                $data = MiscellenousItems::where('order_id', $request->Listed_ID)->get();

                $html = view('partials.fetch-all-misc', compact('data'))->render();
                // dd($html, $data->toArray());

                return response()->json(['success' => true, 'html' => $html]);
            } catch (Exception $e) {
                return response()->json(['error' => false, 'message' => $e->getMessage()]);
            }
        }
        return 'AJAX request failed!';
    }

    public function changePassword(Request $request)
    {
        // Validate the input
        $request->validate([
            // 'user_id' => 'required|exists:authorized_admins,id', // Ensure user_id exists in the table
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8',
        ]);

        // Find the user
        if (Auth::guard('Authorized')->user()) {
            $user = AuthorizedUsers::find($request->user_id);
        } elseif (Auth::guard('Admin')->user()->id) {
            $user = AuthorizedAdmin::find($request->user_id);
        }

        // Check if the current password matches the one in the database
        if (!Hash::check($request->currentPassword, $user->password)) {
            return response()->json([
                'message' => 'The current password is incorrect.',
            ], 400);
        }

        // Update the password
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return response()->json([
            'message' => 'Password changed successfully.',
        ], 200);
    }

    public function changeUserPassword(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:authorized_users,id',
            'newPassword' => 'required|min:8',
        ]);

        $user = AuthorizedUsers::find($request->user_id);
        $user->password = Hash::make($request->newPassword);
        $user->save();


        return back()->with('Success!', "Password changed!");
    }

    public function notifyCompany($Order_ID)
    {
        $user = Auth::guard('Authorized')->user();
        $AllUserListing = AllUserListing::where('id', $Order_ID)->first();
        $Notification = new Notification();
        $Notification->Notification = $user->name . ' is awaiting your response on #' . $AllUserListing->Ref_ID;
        $Notification->order_id = $AllUserListing->id;
        $Notification->user_id = $AllUserListing->user_id;

        if (!$Notification->save()) {
            throw new RuntimeException("Error saving notification");
        }

        return response()->json(['success' => true, 'message' => 'Notification sent successfully.']);
    }

    public function remindCompany(Request $request)
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email',
            'List_ID' => 'required', // Ensure List_ID is present
        ]);

        // $email = $request->email;
        $email = 'abst99856@gmail.com';
        $AllUserListing = AllUserListing::where('id', $request->List_ID)->first();
        $List_ID = $AllUserListing->Ref_ID;

        try {
            // Send the email
            Mail::send('emails.remind_carrier', ['List_ID' => $List_ID], function ($message) use ($email) {
                $message->to($email)
                    ->subject('Reminder: Action Required');
            });

            return response()->json([
                'success' => true,
                'data' => 'Reminder email sent successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => 'Failed to send the email. Please try again later.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
