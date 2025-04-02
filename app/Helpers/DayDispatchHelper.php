<?php

namespace App\Helpers;

use App\Mail\EmailNotification;
use App\Models\Auth\AuthorizedUsers;
use App\Models\Carrier\RequestBroker;
use App\Models\Extras\Notification;
use App\Models\Listing\AllUserListing;
use App\Models\Listing\CancelledOrders;
use App\Models\Listing\CompletedOrders;
use App\Models\Listing\DeliverApprovals;
use App\Models\Listing\DeliverdOrders;
use App\Models\Listing\Dispatch;
use App\Models\Listing\PickUpApprovals;
use App\Models\Listing\PickupOrders;
use App\Models\Listing\WaitingForApproval;
use App\Models\Listing\WatchList;
use App\Models\Extras\MiscellenousItems;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RuntimeException;
use App\Mail\NotifyAllUsers;
use App\Models\Quote\Order;

class DayDispatchHelper
{
    // Get Miles From Zip Codes
    public static function twopoints_on_earth($OriginZipCode, $DestinationZipCode): float
    {
        $From = DB::table('zip_codes')
            ->where('zipcode', $OriginZipCode)
            ->whereNotNull('latitude')
            ->first();
        $To = DB::table('zip_codes')
            ->where('zipcode', $DestinationZipCode)
            ->whereNotNull('latitude')
            ->first();

        $latitudeFrom = $From->latitude;
        $longitudeFrom = $From->longitude;
        $latitudeTo = $To->latitude;
        $longitudeTo = $To->longitude;

        $long1 = deg2rad($longitudeFrom);
        $long2 = deg2rad($longitudeTo);
        $lat1 = deg2rad($latitudeFrom);
        $lat2 = deg2rad($latitudeTo);

        //Haversine Formula
        $dlong = $long2 - $long1;
        $dlati = $lat2 - $lat1;

        $val =
            (sin($dlati / 2) ** 2) +
            cos($lat1) * cos($lat2) * (sin($dlong / 2) ** 2);

        $res = 2 * asin(sqrt($val));

        $radius = 3958.756;
        return $res * $radius;
    }

    // Get Difference From Two Dates

    /**
     * @throws Exception
     */
    public static function getDaysFromTwoDates($fromDate): string
    {
        $datetime1 = new DateTime($fromDate);
        $datetime2 = new DateTime();
        //now do whatever you like with $days
        return $datetime1->diff($datetime2)->format('%a');
    }

    // Return Zipcode Record with Route Info
    public static function getZipCodeStateCity(string $OriginZipCode, int $type = 1)
    {
        $ZipCode = Str::afterLast($OriginZipCode, ', ');
        $From = DB::table('zip_codes')
            ->select('statefull')
            ->where('zipcode', $ZipCode)
            ->first();

        if ($From) {
            // $type = 2 => return City
            if ($type === 2) {
                return $From->city;
            }
            // $type = 3 => return Zipcode
            if ($type === 3) {
                return $From->zipcode;
            }
            // $type = 1 => return State
            return $From->statefull;
        }
        return null;
    }

    // Return Zipcode Record with Route Info
    public static function VehicleCount($Vehicle, $heavy_equipments, $dry_vans): int
    {
        if (count($Vehicle) > 0) {
            return count($Vehicle);
        }
        if (count($heavy_equipments) > 0) {
            return count($heavy_equipments);
        }
        if (count($dry_vans) > 0) {
            return count($dry_vans);
        }
        return 0;
    }

    // Global Function of Email & Notifications
    public static function SendNotificationOnStatusChanged(string $Status, int $List_ID): bool
    {
        try {
            DB::beginTransaction();
            
            $auth_user = Auth::guard('Authorized')->user();
            if ($auth_user === null) {
                return false;
            }
            
            $mailData = self::getListingData($Status, $List_ID);
            // $userNotify = AuthorizedUsers::whereIn('id', [$mailData['Cmp_ID'], $mailData['User_ID']])->select(['is_custom_notify', 'is_email_notify'])->get()->toArray();
            // dd($mailData, $Status, $List_ID);
            $userNotify = AuthorizedUsers::with('setting')->has('setting')->whereIn('id', [$mailData['Cmp_ID'], $mailData['User_ID']])->get();
            // if (count($userNotify) <= 0) {
            //     return false;
            // }
            
            // dd($userNotify->toArray());
            if (count($userNotify) > 0) {
            foreach ($userNotify as $notify) {
                if ($notify->setting && $notify->setting->custom_notification == 1) {
                    $notificationSent = self::Notification($mailData['Cmp_ID'], $Status, $List_ID, $mailData['Ref_ID'], $mailData['User_ID']);
                    if (!$notificationSent) {
                        throw new RuntimeException("Error sending email notifications");
                    }
                }
                
                if ($auth_user->setting && $auth_user->setting->email_notification == 1) {
                    $emailSent = self::sendEmailNotifications($mailData, $List_ID);
                    if (!$emailSent) {
                        throw new RuntimeException("Error sending email notifications");
                    }
                }
                // if ($notify['is_custom_notify']) {
                //     $notificationSent = self::Notification($mailData['Cmp_ID'], $Status, $List_ID, $mailData['Ref_ID'], $mailData['User_ID']);
                //     if (!$notificationSent) {
                //         throw new RuntimeException("Error sending email notifications");
                //     }
                // }

                // if ($auth_user['is_email_notify']) {
                //     $emailSent = self::sendEmailNotifications($mailData, $List_ID);
                //     if (!$emailSent) {
                //         throw new RuntimeException("Error sending email notifications");
                //     }
                // }
            }
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Exception occurred: ' . $e->getMessage());
            return false;
        }
    }

    public static function SendNotificationOnStatusChanged2(string $Status, int $List_ID): bool
    {
        try {
            $auth_user = Auth::guard('Authorized')->user();
            if ($auth_user === null) {
                return false;
            }

            $relationship = [
                'authorized_user' => function ($q) {
                    $q->select('id', 'email');
                },
                'paymentinfo' => function ($q) {
                    $q->select('id', 'order_id', 'Order_Booking_Price');
                },
            ];

            if ($Status === 'Expired') {
                $Listing = AllUserListing::expired()->with($relationship)->where('id', $List_ID)->first();
            } elseif ($Status === 'Deleted') {
                $Listing = AllUserListing::withTrashed()->where('Listing_Status', 'Deleted')->where('id', $List_ID)->first();
            } elseif ($Status === 'Archived') {
                $Listing = AllUserListing::with($relationship)->where('id', $List_ID)->first();
            } elseif ($Status === 'Listed' || $Status === 'Cancelled') {
                $Listing = AllUserListing::with($relationship)->where('id', $List_ID)->first();
            } else {
                return false;
            }

            if (!$Listing) {
                return false;
            }

            $mailData = [
                'Ref_ID' => $Listing->Ref_ID,
                'Status' => $Listing->Listing_Status,
                'Created_At' => $Listing->updated_at,
                'Assign_User_Email' => $Listing->authorized_user->email,
                'Listed_Price' => $Listing->paymentinfo->Order_Booking_Price,
                'Listed_User_Name' => $Listing->authorized_user->email,
                'Payment_Method' => $Listing->paymentinfo->Order_Booking_Price,
            ];

            // if ($auth_user->is_custom_notify) {
            if ($auth_user->setting && $auth_user->setting->custom_notification == 1) {
                $notificationSent = self::Notification2(0, $Status, $List_ID, $Listing->Ref_ID, $Listing->user_id);
                // if (!$notificationSent) {
                //     throw new RuntimeException("Error sending email notifications");
                // }
            } else {
                return true;
            }

            // if ($auth_user->is_email_notify) {
            if ($auth_user->setting && $auth_user->setting->email_notification == 1) {
                $emailSent = Mail::to($mailData['Assign_User_Email'])->send(new EmailNotification($mailData, $List_ID));
                if (isset($mailData['Listed_User_Email'])) {
                    $emailSent = Mail::to($mailData['Listed_User_Email'])->send(new EmailNotification($mailData, $List_ID));
                }

                if (!$emailSent) {
                    throw new RuntimeException("Error sending email notifications");
                }
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Exception occurred: ' . $e->getMessage());
            return false;
        }
    }

    // Global Notification
    public static function Notification(int $CMP_id, string $Status, int $List_ID, string $Order_ID, int $user_id): bool
    {
        try {
            $Notification = new Notification();
            $Notification->Notification = 'Your Order #' . $Order_ID . ' Has Been Assign In ' . $Status . ' Successfully!';
            $Notification->order_id = $List_ID;
            $Notification->user_id = $user_id;

            if (!$Notification->save()) {
                throw new RuntimeException("Error saving notification");
            }

            if ($CMP_id !== 0) {
                $Notification = new Notification();
                $Notification->Notification = 'Your Order #' . $Order_ID . ' Has Been Assign In ' . $Status . ' Successfully!';
                $Notification->order_id = $List_ID;
                $Notification->user_id = $CMP_id;

                if (!$Notification->save()) {
                    throw new RuntimeException("Error saving notification");
                }
            }

            return true;
        } catch (Exception $e) {
            Log::error('Exception occurred: ' . $e->getMessage());
            return false;
        }
    }

    public static function Notification2(int $CMP_id, string $Status, int $List_ID, string $Order_ID, int $user_id): bool
    {
        try {
            $Notification = new Notification();
            $Notification->Notification = 'Your Order #' . $Order_ID . ' Has Been ' . $Status . '!';
            $Notification->order_id = $List_ID;
            $Notification->user_id = $user_id;

            if (!$Notification->save()) {
                throw new RuntimeException("Error saving notification");
            }

            if ($CMP_id !== 0) {
                $Notification = new Notification();
                $Notification->Notification = 'Your Order #' . $Order_ID . ' Has Been ' . $Status . '!';
                $Notification->order_id = $List_ID;
                $Notification->user_id = $CMP_id;

                if (!$Notification->save()) {
                    throw new RuntimeException("Error saving notification");
                }
            }

            return true;
        } catch (Exception $e) {
            Log::error('Exception occurred: ' . $e->getMessage());
            return false;
        }
    }

    private static function prepareRelationships(): array
    {
        return [
            'Waiting For Approval' => 'all_listing.waitings.waiting_users',
            'Requested' => 'all_listing.request_broker.requested_user',
            'Dispatch' => 'all_listing.dispatch_listing.dispatch_user',
            'PickUp Approval' => 'all_listing.pickup_approve.pickup_approval_user',
            'PickUp' => 'all_listing.pickup.pickup_user',
            'Deliver Approval' => 'all_listing.deliver_approve.deliver_approval_user',
            'Delivered' => 'all_listing.deliver.delivered_user',
            'Completed' => 'all_listing.completed.completed_user',
            'Cancelled' => 'all_listing.cancel.cancel_user',
        ];
    }

    private static function getListingData(string $status, int $listID): bool|array
    {
        $relationships = self::prepareRelationships();

        if (!array_key_exists($status, $relationships)) {
            return false;
        }

        if ($status === 'Waiting For Approval') {
            $Listing = WaitingForApproval::with($relationships[$status])
                ->where('order_id', $listID)
                ->first();

            if (!$Listing) {
                return false;
            }

            $data = [
                'Listed_User_Name' => $Listing->all_listing->waitings->waiting_users->Company_Name,
                'Listed_User_Phone' => $Listing->all_listing->waitings->waiting_users->Contact_Phone,
                'Listed_User_Email' => $Listing->all_listing->waitings->waiting_users->email,
            ];
            return array_merge(self::prepareMailData($Listing), $data);
        }

        if ($status === 'Requested') {
            $Listing = RequestBroker::with($relationships[$status])
                ->where('order_id', $listID)
                ->first();

            if (!$Listing) {
                return false;
            }
            $data = [
                'Listed_User_Name' => $Listing->all_listing->request_broker->requested_user->Company_Name,
                'Listed_User_Phone' => $Listing->all_listing->request_broker->requested_user->Contact_Phone,
                'Listed_User_Email' => $Listing->all_listing->request_broker->requested_user->email,
            ];
            return array_merge(self::prepareMailData($Listing), $data);
        }

        if ($status === 'Dispatch') {
            $Listing = Dispatch::with($relationships[$status])
                ->where('order_id', $listID)
                ->first();

            if (!$Listing) {
                return false;
            }

            RequestBroker::where([
                'order_id' => $listID,
                'user_id' => $Listing->user_id,
                'CMP_id' => $Listing->CMP_id
            ])->update([
                        'is_cancel' => 1
                    ]);

            $data = [
                'Listed_User_Name' => $Listing->all_listing->dispatch_listing->dispatch_user->Company_Name,
                'Listed_User_Phone' => $Listing->all_listing->dispatch_listing->dispatch_user->Contact_Phone,
                'Listed_User_Email' => $Listing->all_listing->dispatch_listing->dispatch_user->email,
            ];
            return array_merge(self::prepareMailData($Listing), $data);
        }

        if ($status === 'PickUp Approval') {
            $Listing = PickUpApprovals::with($relationships[$status])
                ->where('order_id', $listID)
                ->first();

            if (!$Listing) {
                return false;
            }

            $data = [
                'Listed_User_Name' => $Listing->all_listing->pickup_approve->pickup_approval_user->Company_Name,
                'Listed_User_Phone' => $Listing->all_listing->pickup_approve->pickup_approval_user->Contact_Phone,
                'Listed_User_Email' => $Listing->all_listing->pickup_approve->pickup_approval_user->email,
            ];
            return array_merge(self::prepareMailData($Listing), $data);
        }

        if ($status === 'PickUp') {
            $Listing = PickupOrders::with($relationships[$status])
                ->where('order_id', $listID)
                ->first();

            if (!$Listing) {
                return false;
            }

            $data = [
                'Listed_User_Name' => $Listing->all_listing->pickup->pickup_user->Company_Name,
                'Listed_User_Phone' => $Listing->all_listing->pickup->pickup_user->Contact_Phone,
                'Listed_User_Email' => $Listing->all_listing->pickup->pickup_user->email,
            ];
            return array_merge(self::prepareMailData($Listing), $data);
        }

        if ($status === 'Deliver Approval') {
            $Listing = DeliverApprovals::with($relationships[$status])
                ->where('order_id', $listID)
                ->first();

            if (!$Listing) {
                return false;
            }

            $data = [
                'Listed_User_Name' => $Listing->all_listing->deliver_approve->deliver_approval_user->Company_Name,
                'Listed_User_Phone' => $Listing->all_listing->deliver_approve->deliver_approval_user->Contact_Phone,
                'Listed_User_Email' => $Listing->all_listing->deliver_approve->deliver_approval_user->email,
            ];
            return array_merge(self::prepareMailData($Listing), $data);
        }

        if ($status === 'Delivered') {
            $Listing = DeliverdOrders::with($relationships[$status])
                ->where('order_id', $listID)
                ->first();

            if (!$Listing) {
                return false;
            }

            $data = [
                'Listed_User_Name' => $Listing->all_listing->deliver->delivered_user->Company_Name,
                'Listed_User_Phone' => $Listing->all_listing->deliver->delivered_user->Contact_Phone,
                'Listed_User_Email' => $Listing->all_listing->deliver->delivered_user->email,
            ];
            return array_merge(self::prepareMailData($Listing), $data);
        }

        if ($status === 'Completed') {
            $Listing = CompletedOrders::with($relationships[$status])
                ->where('order_id', $listID)
                ->first();

            if (!$Listing) {
                return false;
            }

            $data = [
                'Listed_User_Name' => $Listing->all_listing->completed->completed_user->Company_Name,
                'Listed_User_Phone' => $Listing->all_listing->completed->completed_user->Contact_Phone,
                'Listed_User_Email' => $Listing->all_listing->completed->completed_user->email,
            ];
            return array_merge(self::prepareMailData($Listing), $data);
        }

        if ($status === 'Cancelled') {
            $Listing = CancelledOrders::with($relationships[$status])
                ->where('order_id', $listID)
                ->first();

            if (!$Listing) {
                return false;
            }

            $data = [
                'Listed_User_Name' => $Listing->all_listing->cancel->cancel_user->Company_Name,
                'Listed_User_Phone' => $Listing->all_listing->cancel->cancel_user->Contact_Phone,
                'Listed_User_Email' => $Listing->all_listing->cancel->cancel_user->email,
            ];
            return array_merge(self::prepareMailData($Listing), $data);
        }
        return false;
    }

    private static function prepareMailData($Listing): array
    {
        return [
            'Ref_ID' => $Listing->all_listing->Ref_ID,
            'Status' => $Listing->all_listing->Listing_Status,
            'Created_At' => $Listing->all_listing->updated_at,
            'Assign_User_Name' => $Listing->all_listing->authorized_user->Company_Name,
            'Assign_User_Phone' => $Listing->all_listing->authorized_user->Contact_Phone,
            'Assign_User_Email' => $Listing->all_listing->authorized_user->email,
            'Listed_Price' => $Listing->all_listing->paymentinfo->Order_Booking_Price,
            'Payment_Method' => $Listing->all_listing->paymentinfo->Payment_Method_Mode,
            'Carrier_Price' => $Listing->all_listing->paymentinfo->Price_Pay_Carrier,
            'COD_Amount' => $Listing->all_listing->paymentinfo->COD_Amount,
            'Origin_Address' => $Listing->all_listing->routes->Origin_Address,
            'Origin_Address_II' => $Listing->all_listing->routes->Origin_Address_II,
            'Origin_ZipCode' => $Listing->all_listing->routes->Origin_ZipCode,
            'Destination_Address' => $Listing->all_listing->routes->Destination_Address,
            'Destination_Address_II' => $Listing->all_listing->routes->Destination_Address_II,
            'Dest_ZipCode' => $Listing->all_listing->routes->Dest_ZipCode,
            'Cmp_ID' => $Listing->CMP_id,
            'User_ID' => $Listing->user_id,
        ];
    }

    private static function sendEmailNotifications(array $mailData, int $List_ID): bool
    {
        return Mail::to($mailData['Assign_User_Email'])->send(new EmailNotification($mailData, $List_ID)) &&
            Mail::to($mailData['Listed_User_Email'])->send(new EmailNotification($mailData, $List_ID));
    }

    // Price Per Miles Function
    public static function PricePerMiles($Price, $Miles): int|string
    {
        if ($Price === 0.0 || $Price === '') {
            return 0;
        }

        if ($Miles === 0 || $Miles === '' || $Miles === '0' || $Miles === 0.0 || $Miles == '0.0') {
            return 0;
        }
        $Price = (float) Str::replace(['$ ', ','], "", $Price);
        $Miles = (float) Str::replace(['$ ', ','], "", $Miles);
        $Total = $Price / $Miles;
        return number_format($Total, 2, '.', '');
    }

    // Order Cancel
    public static function OrderCancel(string $Status, string $Order_ID, int $User_ID, int $CMP_ID): bool
    {
        if ($Status === 'Dispatch') {
            Dispatch::where([
                'order_id' => $Order_ID,
                'user_id' => $User_ID,
                'CMP_id' => $CMP_ID
            ])->delete();
            return true;
        }

        if ($Status === 'PickUp Approval') {
            PickUpApprovals::where([
                'order_id' => $Order_ID,
                'user_id' => $User_ID,
                'CMP_id' => $CMP_ID
            ])->delete();
            return true;
        }

        if ($Status === 'PickUp') {
            PickupOrders::where([
                'order_id' => $Order_ID,
                'user_id' => $User_ID,
                'CMP_id' => $CMP_ID
            ])->delete();
            return true;
        }

        if ($Status === 'Deliver Approval') {
            DeliverApprovals::where([
                'order_id' => $Order_ID,
                'user_id' => $User_ID,
                'CMP_id' => $CMP_ID
            ])->delete();
            return true;
        }

        if ($Status === 'Delivered') {
            DeliverdOrders::where([
                'order_id' => $Order_ID,
                'user_id' => $User_ID,
                'CMP_id' => $CMP_ID
            ])->delete();
            return true;
        }

        return false;
    }

    public static function getOrderCounts(int $user_id, string $usr_type): array
    {
        $commonConditions = $usr_type === 'Carrier' ? 'CMP_id' : 'user_id';
        $listingCount = $usr_type === 'Carrier' ? AllUserListing::where('Custom_Listing', 0)->where('Private_Listing', 0)->where('Listing_Status', 'Listed')->count() : AllUserListing::where('Custom_Listing', 0)->where('Private_Listing', 0)->where('Listing_Status', 'Listed')->where('user_id', $user_id)->count();

        return [
            'Waiting_Approval' => WaitingForApproval::with('all_listing')->has('all_listing')->where($commonConditions, $user_id)->count(),
            'Requested' => RequestBroker::with('all_listing')->has('all_listing')->where($commonConditions, $user_id)->where('is_cancel', 0)->count(),
            'Dispatch' => Dispatch::with('all_listing')->has('all_listing')->where($commonConditions, $user_id)->count(),
            'Time_Quote' => AllUserListing::where('Custom_Listing', 1)->where('Listing_Status', 'Listed')->where('user_id', $user_id)->count(),
            'pvt_Listing' => AllUserListing::where('Private_Listing', 1)->where('Listing_Status', 'Listed')->where('user_id', $user_id)->count(),
            'Listed' => $listingCount,
            'PickUp' => PickupOrders::with('all_listing')->has('all_listing')->where($commonConditions, $user_id)->count(),
            'PickUp_Approval' => PickUpApprovals::where($commonConditions, $user_id)->count(),
            'Deliver_Approval' => DeliverApprovals::where($commonConditions, $user_id)->count(),
            'Delivered' => DeliverdOrders::where($commonConditions, $user_id)->count(),
            'Archived' => AllUserListing::withTrashed()->where('Listing_Status', 'Archived')->where('user_id', $user_id)->count(),
            'Completed' => CompletedOrders::where($commonConditions, $user_id)->count(),
            'Cancelled' => CancelledOrders::withTrashed()->where($commonConditions, $user_id)->count(),
            'Expired' => AllUserListing::expired()->where('user_id', $user_id)->count(),
            'Deleted' => AllUserListing::withTrashed()->where('Listing_Status', 'Deleted')->where('user_id', $user_id)->count(),
            'WatchList' => WatchList::where('user_id', $user_id)->whereHas('listing', function ($q) {
                $q->where('Listing_Status', 'Listed');
            })->count(), //count for My Watchlist
            'MiscItems' => MiscellenousItems::where('status', 0)->whereHas('all_listing', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })->count(), //count for Approve Misc Pay.
        ];
    }

    public static function getQuoteOrderCounts(int $user_id, string $usr_type): array
    {
        // Fetch all statuses for the given user
        $statuses = Order::where('user_id', $user_id)
            ->pluck('Listing_Status')
            ->toArray();

        // Initialize an array to store counts for each status
        $statusCounts = [];

        foreach (array_unique($statuses) as $status) {
            $count = $usr_type === 'Carrier'
                ? Order::where('Custom_Listing', 0)
                    ->where('Listing_Status', $status)
                    ->count()
                : Order::where('Custom_Listing', 0)
                    ->where('Listing_Status', $status)
                    ->where('user_id', $user_id)
                    ->count();

            // Store the count with the corresponding status
            $statusCounts[$status] = $count;
        }
        return [
            'statusCounts' => $statusCounts,
            'Book_Order' => Order::where('Listing_Status', 'Book Order')->where('user_id', $user_id)->count(),
            'Deleted' => Order::withTrashed()->where('Listing_Status', 'Deleted')->where('user_id', $user_id)->count(),
            'Cancelled' => Order::withTrashed()->where('Listing_Status', 'Cancelled')->where('user_id', $user_id)->count(),
        ];
    }

    public static function getAdminCounts(): array
    {
        $allListings = AllUserListing::get();

        return [
            'Waiting_Approval' => $allListings->where('Listing_Status', 'Waiting For Approval')->count(),
            'Requested' => AllUserListing::where('Listing_Status', 'Waiting For Approval')
                ->whereRelation('request_broker', 'is_cancel', 0)
                ->count(),
            'Dispatch' => $allListings->where('Listing_Status', 'Dispatch')->count(),
            'Time_Quote' => $allListings->where('Custom_Listing', 1)->count(),
            'Listed' => $allListings->where('Custom_Listing', 0)->count(),
            'PickUp' => $allListings->where('Listing_Status', 'PickUp')->count(),
            'PickUp_Approval' => $allListings->where('Listing_Status', 'PickUp Approval')->count(),
            'Deliver_Approval' => $allListings->where('Listing_Status', 'Deliver Approval')->count(),
            'Delivered' => $allListings->where('Listing_Status', 'Delivered')->count(),
            'Archived' => AllUserListing::withTrashed()->count(),
            'Completed' => $allListings->where('Listing_Status', 'Completed')->count(),
            'Cancelled' => $allListings->where('Listing_Status', 'Cancelled')->count(),
            'Expired' => $allListings->where('Listing_Status', 'Expired')->count(),
        ];
    }

    public static function getAgentCounts($agent_code): array
    {
        $allListings = AllUserListing::whereRelation('authorized_user', 'ref_code', $agent_code)->get();

        return [
            'Waiting_Approval' => $allListings->where('Listing_Status', 'Waiting For Approval')->count(),
            'Dispatch' => $allListings->where('Listing_Status', 'Dispatch')->count(),
            'Time_Quote' => $allListings->where('Custom_Listing', 1)->count(),
            'Listed' => $allListings->where('Custom_Listing', 0)->count(),
            'PickUp' => $allListings->where('Listing_Status', 'PickUp')->count(),
            'PickUp_Approval' => $allListings->where('Listing_Status', 'PickUp Approval')->count(),
            'Deliver_Approval' => $allListings->where('Listing_Status', 'Deliver Approval')->count(),
            'Delivered' => $allListings->where('Listing_Status', 'Delivered')->count(),
            'Archived' => AllUserListing::withTrashed()->whereRelation('authorized_user', 'ref_code', $agent_code)->count(),
            'Completed' => $allListings->where('Listing_Status', 'Completed')->count(),
            'Cancelled' => $allListings->where('Listing_Status', 'Cancelled')->count(),
            'Expired' => $allListings->where('Listing_Status', 'Expired')->count(),
            'User_Count' => AuthorizedUsers::where('ref_code', $agent_code)->count(),
        ];
    }


}
