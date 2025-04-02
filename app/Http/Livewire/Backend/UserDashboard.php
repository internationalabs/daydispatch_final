<?php

namespace App\Http\Livewire\Backend;

use App\Helpers\DayDispatchHelper;
use App\Models\Listing\AllUserListing;
use App\Models\Listing\Dispatch;
use App\Models\Listing\PickupOrders;
use App\Models\Listing\DeliverdOrders;
use App\Models\Profile\AddressBook;
use App\Models\Listing\WaitingForApproval;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Quote\Order;
use App\Models\SidebarOption;
use App\Models\TaskCalendar;
use App\Models\Filter;
use App\Services\ListingServices;
use Illuminate\Support\Carbon;
use App\Models\Profile\MyRating;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
class UserDashboard extends Component
{
    protected ListingServices $listingServices;

    public function mount(ListingServices $listingServices): void
    {
        $this->listingServices = $listingServices;
    }

    public function render()
    {
        $currentUser = Auth::guard('Authorized')->user();
        $currentUser_Id = Auth::guard('Authorized')->id();
        $User_Info = AddressBook::where('user_id', $currentUser_Id)->orderBy('id', 'DESC')->take(5)->get();
        // dd($User_Info);
        $orderCount = DayDispatchHelper::getOrderCounts($currentUser->id, $currentUser->usr_type);
        $dispatch = $this->listingServices->getDispatchesOrders();
        $pickup = $this->listingServices->getPickupOrders();
        $delivered = $this->listingServices->getDeliveredOrders();
        $waiting = $this->listingServices->getWaitingOrders();
        $dispatch = Dispatch::with('all_listing')->orderBy('updated_at', 'DESC')->get();
        $pickup = PickupOrders::with('all_listing')->orderBy('updated_at', 'DESC')->get();
        $delivered = DeliverdOrders::with('all_listing')->orderBy('updated_at', 'DESC')->get();
        $waiting = WaitingForApproval::whereDoesntHave('all_listing.agreement')->with('all_listing')->orderBy('updated_at', 'DESC')->get();
        if ($currentUser->usr_type === 'Carrier') {
            $dispatch = $dispatch->where('CMP_id', $currentUser->id)->take(5);
            $pickup = $pickup->where('CMP_id', $currentUser->id)->take(5);
            $delivered = $delivered->where('CMP_id', $currentUser->id)->take(5);
            $waiting = $waiting->where('CMP_id', $currentUser->id)->take(5);
        } else {
            $dispatch = $dispatch->where('user_id', $currentUser->id)->take(5);
            $pickup = $pickup->where('user_id', $currentUser->id)->take(5);
            $delivered = $delivered->where('user_id', $currentUser->id)->take(5);
            $waiting = $waiting->where('user_id', $currentUser->id)->take(5);
        }

        $LisitingCount = AllUserListing::where('Private_Listing', 0)
            ->active()
            ->whereHas('My_Network', fn($q) => $q->where('status', '!=', 1))
            ->carrierlisting()
            ->notExpire()
            ->count();

        $stats = AllUserListing::with([
            'paymentinfo',
            'deliver' => function ($query) {
                $query->withTrashed();  // Include soft-deleted records
            }
        ])
            ->where('Listing_Status', '!=', 'Archived')
            ->has('paymentinfo')
            ->has('deliver')
            ->where('user_id', $currentUser->id)
            ->get();

        $monthlyStats = $stats->pluck('paymentinfo')
            ->flatten()
            ->groupBy(function ($payment) {
                return Carbon::parse($payment['all_listing']['deliver']['created_at'])->format('Y-m'); // Group by Year-Month
            });

        // $stats2 = AllUserListing::with([
        //     'paymentinfo',
        //     'deliver' => function ($query) {
        //         $query->withTrashed();  // Include soft-deleted records
        //     }
        // ])
        //     // ->where('Listing_Status', '!=', 'Archived')
        //     ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
        //     ->has('paymentinfo')
        //     ->get();

        // $monthlyStats2 = $stats2->pluck('paymentinfo')
        //     ->flatten()
        //     ->groupBy(function ($payment) {
        //         return Carbon::parse($payment['all_listing']['created_at'])->format('Y-m'); // Group by Year-Month
        //     });

        // $revenue_growth = $monthlyStats2->map(function ($payments, $month) {
        //     $numericPayments = $payments->filter(function ($payment) {
        //         return is_numeric($payment->Price_Pay_Carrier);
        //     });
        //     return [
        //         'month' => $month,
        //         'total_price' => $numericPayments->sum(function ($payment) {
        //             return (float) $payment->Price_Pay_Carrier; // Explicitly cast to float to ensure numeric sum
        //         }),
        //         'no_of_orders' => $numericPayments->count(),
        //         'average' => $numericPayments->count() > 0
        //             ? $numericPayments->sum(function ($payment) {
        //                 return (float) $payment->Price_Pay_Carrier;
        //             }) / $numericPayments->count()
        //             : 0,
        //     ];
        // });

        $stats2 = AllUserListing::with([
            'paymentinfo',
            'deliver' => function ($query) {
                $query->withTrashed();
            }
        ])
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth()) // Only last 12 months
            ->has('paymentinfo')
            ->get();

        // Define start and end range (last 12 months)
        $startDate = now()->subMonths(11)->startOfMonth();
        $endDate = now()->endOfMonth();

        // Filter `paymentinfo` to include only last 12 months
        $monthlyStats2 = $stats2->pluck('paymentinfo')
            ->flatten()
            ->filter(fn($payment) => Carbon::parse($payment['created_at'])->between($startDate, $endDate)) // Filter last 12 months
            ->groupBy(fn($payment) => Carbon::parse($payment['created_at'])->format('M Y'));

        // Generate last 12 months keys (ensuring correct order)
        $months = collect(range(0, 11))->mapWithKeys(fn($i) => [
            now()->subMonths(11 - $i)->format('M Y') => null
        ]);

        // Merge the filtered months to ensure only last 12 months exist
        $revenue_growth = $months->merge(
            $monthlyStats2->map(function ($payments, $month) {
                $numericPayments = $payments->filter(fn($payment) => is_numeric($payment->Price_Pay_Carrier));

                return [
                    'month' => $month,
                    'total_price' => $numericPayments->sum(fn($payment) => (float) $payment->Price_Pay_Carrier),
                    'no_of_orders' => $numericPayments->count(),
                    'average' => $numericPayments->count() > 0
                        ? $numericPayments->sum(fn($payment) => (float) $payment->Price_Pay_Carrier) / $numericPayments->count()
                        : 0,
                ];
            })
        );

        // Convert empty months from `null` to a default format
        $revenue_growth = $revenue_growth->map(fn($value, $month) => $value ?? [
            'month' => $month,
            'total_price' => null,
            'no_of_orders' => null,
            'average' => null,
        ]);

        // $revenue_summary = $monthlyStats->map(function ($payments, $month) {
        //     return [
        //         'month' => $month,
        //         'carrier_price' => $payments->filter(fn($payment) => is_numeric($payment['Price_Pay_Carrier']))
        //             ->sum(fn($payment) => (float) $payment['Price_Pay_Carrier']),
        //         'billing' => $payments
        //             ->filter(fn($payment) => is_numeric($payment['COD_Amount']) && is_numeric($payment['Price_Pay_Carrier'])
        //                 && $payment['COD_Amount'] < $payment['Price_Pay_Carrier'])
        //             ->sum(fn($payment) => (float) $payment['Balance_Amount']),
        //         'owned' => $payments
        //             ->filter(fn($payment) => is_numeric($payment['COD_Amount']) && is_numeric($payment['Price_Pay_Carrier'])
        //                 && $payment['COD_Amount'] > $payment['Price_Pay_Carrier'])
        //             ->sum(fn($payment) => (float) $payment['Balance_Amount']),
        //         'gross' => $payments->sum(function ($payment) {
        //             return max(
        //                 is_numeric($payment['COD_Amount']) ? (float) $payment['COD_Amount'] : 0,
        //                 is_numeric($payment['Price_Pay_Carrier']) ? (float) $payment['Price_Pay_Carrier'] : 0
        //             );
        //         }),
        //     ];
        // });

        // $revenue_summary = $monthlyStats->map(function ($payments, $month) {
        //     return [
        //         'month' => $month,
        //         'carrier_price' => $payments->sum(fn($payment) => floatval($payment['Price_Pay_Carrier'] ?? 0)),
        //         'billing' => $payments
        //             ->filter(fn($payment) => floatval($payment['COD_Amount'] ?? 0) < floatval($payment['Price_Pay_Carrier'] ?? 0))
        //             ->sum(fn($payment) => floatval($payment['Balance_Amount'] ?? 0)),
        //         'owned' => $payments
        //             ->filter(fn($payment) => floatval($payment['COD_Amount'] ?? 0) > floatval($payment['Price_Pay_Carrier'] ?? 0))
        //             ->sum(fn($payment) => floatval($payment['Balance_Amount'] ?? 0)),
        //         'gross' => $payments
        //             ->filter(fn($payment) => is_numeric($payment['COD_Amount']) || is_numeric($payment['Price_Pay_Carrier']))
        //             ->sum(fn($payment) => max(floatval($payment['COD_Amount'] ?? 0), floatval($payment['Price_Pay_Carrier'] ?? 0))),
        //     ];
        // });

        $revenue_summary = $monthlyStats->map(function ($payments, $month) {
            return [
                'month' => $month,
                'carrier_price' => $payments->sum(fn($payment) => floatval(str_replace(',', '', $payment['Price_Pay_Carrier'] ?? 0))),
                'billing' => $payments
                    ->filter(fn($payment) => floatval(str_replace(',', '', $payment['COD_Amount'] ?? 0)) < floatval(str_replace(',', '', $payment['Price_Pay_Carrier'] ?? 0)))
                    ->sum(fn($payment) => floatval(str_replace(',', '', $payment['Balance_Amount'] ?? 0))),
                'owned' => $payments
                    ->filter(fn($payment) => floatval(str_replace(',', '', $payment['COD_Amount'] ?? 0)) > floatval(str_replace(',', '', $payment['Price_Pay_Carrier'] ?? 0)))
                    ->sum(fn($payment) => floatval(str_replace(',', '', $payment['Balance_Amount'] ?? 0))),
                'gross' => $payments
                    ->filter(fn($payment) => is_numeric(str_replace(',', '', $payment['COD_Amount'])) || is_numeric(str_replace(',', '', $payment['Price_Pay_Carrier'])))
                    ->sum(fn($payment) => max(floatval(str_replace(',', '', $payment['COD_Amount'] ?? 0)), floatval(str_replace(',', '', $payment['Price_Pay_Carrier'] ?? 0)))),
            ];
        });

        // dd($revenue_summary->toArray());

        // $revenue_summary = $monthlyStats->map(function ($payments, $month) {
        //     $hasDeliver = $payments->filter(fn($payment) => $payment->relationLoaded('deliver') && $payment->deliver !== null);

        //     return [
        //         'month' => $month,
        //         'carrier_price' => $payments->filter(fn($payment) => is_numeric($payment['Price_Pay_Carrier']))
        //             ->sum(fn($payment) => (float) $payment['Price_Pay_Carrier']),
        //         'billing' => $payments
        //             ->filter(fn($payment) => is_numeric($payment['COD_Amount']) && is_numeric($payment['Price_Pay_Carrier'])
        //                 && $payment['COD_Amount'] < $payment['Price_Pay_Carrier'])
        //             ->sum(fn($payment) => (float) $payment['Balance_Amount']),
        //         'owned' => $payments
        //             ->filter(fn($payment) => is_numeric($payment['COD_Amount']) && is_numeric($payment['Price_Pay_Carrier'])
        //                 && $payment['COD_Amount'] > $payment['Price_Pay_Carrier'])
        //             ->sum(fn($payment) => (float) $payment['Balance_Amount']),
        //         'gross' => $payments->sum(function ($payment) {
        //             return max(
        //                 is_numeric($payment['COD_Amount']) ? (float) $payment['COD_Amount'] : 0,
        //                 is_numeric($payment['Price_Pay_Carrier']) ? (float) $payment['Price_Pay_Carrier'] : 0
        //             );
        //         }),
        //         'has_deliver' => $hasDeliver->isNotEmpty(), // Check if there's any deliver
        //     ];
        // });

        // ->has('paymentinfo')
        // ->where('user_id', $currentUser->id)
        // ->get()->toArray(), $currentUser->id, $stats->toArray(), $monthlyStats->toArray(), $revenue_growth->toArray(), $revenue_summary->toArray());

        $monthsRevGrowth = $revenue_growth->pluck('month')->toArray();
        $totals = $revenue_growth->pluck('total_price')->toArray();

        $currentDate = Carbon::now();

        $startDate = $currentDate->copy()->subMonths(11)->startOfMonth();

        $months = collect();
        for ($i = 0; $i < 12; $i++) {
            $months->put($startDate->copy()->addMonths($i)->format('M Y'), [
                'dispatch' => 0,
                'pickup' => 0,
                'deliver' => 0,
                'cancel' => 0,
            ]);
        }

        $dispatch_listingGraph = AllUserListing::withTrashed()
            ->with('dispatch_listing')
            ->where('user_id', $currentUser->id)
            ->whereHas('dispatch_listing', function ($q) use ($startDate, $currentDate) {
                $q->withTrashed();
                // ->whereBetween('created_at', [$startDate, $currentDate]);
            })->get();

        $pickupGraph = AllUserListing::withTrashed()
            ->with('pickup')
            ->where('user_id', $currentUser->id)
            ->whereHas('pickup', function ($q) use ($startDate, $currentDate) {
                $q->withTrashed();
                // ->whereBetween('created_at', [$startDate, $currentDate]);
            })->get();

        $deliverGraph = AllUserListing::withTrashed()
            ->with('deliver')
            ->where('user_id', $currentUser->id)
            ->whereHas('deliver', function ($q) use ($startDate, $currentDate) {
                $q->withTrashed();
                // ->whereBetween('created_at', [$startDate, $currentDate]);
            })->get();

        $cancelGraph = AllUserListing::withTrashed()
            ->with('cancel')
            ->where('user_id', $currentUser->id)
            ->whereHas('cancel', function ($q) use ($startDate, $currentDate) {
                $q->withTrashed();
                // ->whereBetween('created_at', [$startDate, $currentDate]);
            })->get();

        function getMonthlyCounts($data, $relation)
        {
            return collect($data)->groupBy(function ($item) use ($relation) {
                // Ensure the related model is loaded and not a builder
                $relatedItem = $item->$relation()->withTrashed()->first();  // Use first() to get the related model instance

                // Check if the related model exists before accessing its 'created_at'
                if ($relatedItem) {
                    return Carbon::parse($relatedItem->created_at)->format('M Y');  // Format the 'created_at' date
                }
                return null; // Return null if no related model exists
            })->filter(function ($group) {
                // Filter out null groups that could have been returned if the related model doesn't exist
                return $group->first() !== null;
            })->map(function ($group) {
                return $group->count(); // Return the count per group (month)
            });
        }

        // Correctly pass the related relation names to the function
        $dispatchCounts = getMonthlyCounts($dispatch_listingGraph, 'dispatch_listing');
        $pickupCounts = getMonthlyCounts($pickupGraph, 'pickup');
        $deliverCounts = getMonthlyCounts($deliverGraph, 'deliver');
        $cancelCounts = getMonthlyCounts($cancelGraph, 'cancel');

        $todo = TaskCalendar::where('user_id', $currentUser->id)
            ->orderBy('updated_at', 'DESC')
            ->take(10)
            ->get();
        $savedFilters = Filter::where('user_id', $currentUser->id)
            ->orderBy('updated_at', 'DESC')
            ->take(5)
            ->get();
        // $recentRatings = MyRating::where('user_id', $currentUser->id)
        //     ->selectRaw('MAX(updated_at) as latest_updated_at, CMP_ID', 'Rating_Comments')
        //     ->groupBy('CMP_ID')
        //     ->orderBy('latest_updated_at', 'DESC')
        //     ->take(10)
        //     ->get();.
        // $recentRatings = MyRating::where('user_id', $currentUser->id)
        //     // ->selectRaw('CMP_ID, MAX(updated_at) as latest_updated_at')
        //     // ->groupBy('CMP_ID')
        //     ->orderBy('updated_at', 'DESC')
        //     ->take(5)
        //     ->get()
        //     ->map(function ($rating) {
        //         $rating->Rating_Comments = MyRating::where('CMP_ID', $rating->CMP_ID)
        //             ->where('updated_at', $rating->latest_updated_at)
        //             ->value('Rating_Comments');
        //         return $rating;
        //     });

        $recentRatings = MyRating::where('user_id', $currentUser->id)
        ->orderBy('updated_at', 'DESC')
        ->with('all_listing')
        ->take(5)
        ->get();

        // dd($recentRatings->toArray());

        // dd($dispatch_listing->toArray(), $pickup->toArray(), $deliver->toArray(), $cancel->toArray(), $dispatchCounts->toArray(), $pickupCounts->toArray(), $deliverCounts->toArray(), $cancelCounts->toArray());

        return view('livewire.backend.user-dashboard', compact('User_Info', 'orderCount', 'months', 'totals', 'currentUser', 'dispatch', 'pickup', 'delivered', 'waiting', 'LisitingCount', 'revenue_growth', 'revenue_summary', 'dispatchCounts', 'pickupCounts', 'deliverCounts', 'cancelCounts', 'todo', 'savedFilters', 'recentRatings', 'monthsRevGrowth'))->layout('layouts.authorized');
    }

    public function QuoteDashboard()
    {
        $slot = '';
        $currentUser = Auth::guard('Authorized')->user();
        $sidebarOptions = SidebarOption::where('user_id', $currentUser->id)->get();

        $sidebarOptionsWithCount = $sidebarOptions->map(function ($option) {
            $optionCount = Order::where('Listing_Status', $option->name)->count();
            $option->count = $optionCount > 0 ? $optionCount : 0; // Assign count or default to 0
            return $option;
        });

        $orderCount = DayDispatchHelper::getQuoteOrderCounts($currentUser->id, $currentUser->usr_type);

        $stats = Order::with('paymentinfo')
            ->has('paymentinfo')
            ->where('user_id', $currentUser->id)
            ->get();

        // Group the data by month
        $monthlyStats = $stats->pluck('paymentinfo')
            ->flatten()
            ->groupBy(function ($payment) {
                return Carbon::parse($payment['created_at'])->format('Y-m'); // Group by Year-Month
            });

        // Calculate monthly sums
        $monthlyData = $monthlyStats->map(function ($payments, $month) {
            return [
                'month' => $month,
                'carrier_price' => $payments->sum('Price_Pay_Carrier'),
                'billing' => $payments
                    ->filter(fn($payment) => $payment['COD_Amount'] < $payment['Price_Pay_Carrier'])
                    ->sum('Balance_Amount'),
                'owned' => $payments
                    ->filter(fn($payment) => $payment['COD_Amount'] > $payment['Price_Pay_Carrier'])
                    ->sum('Balance_Amount'),
            ];
        });

        // Convert to an array for the graph
        $monthlyDataArray = $monthlyData->values()->toArray();
        // dd($monthlyDataArray);
        $monthlyDataArray = json_encode($monthlyDataArray);

        // Conversion_Rate
        $currentMonthOrders = Order::where('user_id', $currentUser->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->get();

        $currentMonthBookedOrders = Order::where('Listing_Status', 'Book Order')
            ->where('user_id', $currentUser->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->get();

        $previousMonthOrders = Order::where('user_id', $currentUser->id)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->get();

        $previousMonthBookedOrders = Order::where('Listing_Status', 'Book Order')
            ->where('user_id', $currentUser->id)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->get();

        // Calculate current month percentage
        $currentMonthTotal = $currentMonthOrders->count();
        $currentMonthBooked = $currentMonthBookedOrders->count();

        $currentMonthPercentage = $currentMonthTotal > 0 ? ($currentMonthBooked / $currentMonthTotal) * 100 : 0;

        // Calculate previous month percentage
        $previousMonthTotal = $previousMonthOrders->count();
        $previousMonthBooked = $previousMonthBookedOrders->count();

        $previousMonthPercentage = $previousMonthTotal > 0 ? ($previousMonthBooked / $previousMonthTotal) * 100 : 0;

        // Determine the direction of the percentage change (up or down)
        $percentageChange = $currentMonthPercentage - $previousMonthPercentage;
        $arrowDirection = $percentageChange > 0 ? 'up' : ($percentageChange < 0 ? 'down' : 'none');
        $percentageChange = abs($percentageChange);

        // Conversion Value
        // Current Month: Calculate total value of booked orders
        $currentMonthBookedOrdersTotal = $currentMonthBookedOrders->sum(function ($order) {
            return $order->paymentinfo->Order_Booking_Price;
        });

        $previousMonthBookedOrdersTotal = $previousMonthBookedOrders->sum(function ($order) {
            return $order->paymentinfo->Order_Booking_Price;
        });

        // Calculate percentage change
        $totalValueChange = $currentMonthBookedOrdersTotal - $previousMonthBookedOrdersTotal;
        $arrowDirectionTotalValue = $totalValueChange > 0 ? 'up' : ($totalValueChange < 0 ? 'down' : 'none');
        $totalValueChange = abs($totalValueChange);
        // Conversion Value End

        // Conversion Order
        $currentMonthBookedOrdersWithTrashed = Order::withTrashed()
            ->where('Listing_Status', 'Book Order')
            ->where('user_id', $currentUser->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->get();

        // Total Booked Orders (including soft-deleted ones) for the Previous Month
        $previousMonthBookedOrdersWithTrashed = Order::withTrashed()
            ->where('Listing_Status', 'Book Order')
            ->where('user_id', $currentUser->id)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->get();

        // Count of Booked Orders for the Current Month
        $currentMonthBookedWithTrashed = $currentMonthBookedOrdersWithTrashed->count();

        // Count of Booked Orders for the Previous Month
        $previousMonthBookedWithTrashed = $previousMonthBookedOrdersWithTrashed->count();

        // Calculate the percentage of conversion for the current month
        $currentMonthTotalWithTrashed = Order::withTrashed()
            ->where('user_id', $currentUser->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Calculate the percentage for the previous month
        $previousMonthTotalWithTrashed = Order::withTrashed()
            ->where('user_id', $currentUser->id)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();

        $currentMonthPercentageWithTrashed = $currentMonthTotalWithTrashed > 0
            // ? ($currentMonthBookedWithTrashed / $currentMonthTotalWithTrashed) * 100
            ? $currentMonthBookedWithTrashed / $currentMonthTotalWithTrashed
            : 0;

        $previousMonthPercentageWithTrashed = $previousMonthTotalWithTrashed > 0
            // ? ($previousMonthBookedWithTrashed / $previousMonthTotalWithTrashed) * 100
            ? $previousMonthBookedWithTrashed / $previousMonthTotalWithTrashed
            : 0;

        // Determine the direction of the percentage change
        $percentageChangeWithTrashed = $currentMonthPercentageWithTrashed - $previousMonthPercentageWithTrashed;
        $arrowDirectionWithTrashed = $percentageChangeWithTrashed > 0
            ? 'up'
            : ($percentageChangeWithTrashed < 0 ? 'down' : 'none');
        $percentageChangeWithTrashed = abs($percentageChangeWithTrashed);

        // Total value calculations (same as your code)
        $currentMonthBookedOrdersTotalWithTrashed = $currentMonthBookedOrdersWithTrashed->sum(function ($order) {
            return $order->paymentinfo->Order_Booking_Price;
        });

        $previousMonthBookedOrdersTotalWithTrashed = $previousMonthBookedOrdersWithTrashed->sum(function ($order) {
            return $order->paymentinfo->Order_Booking_Price;
        });

        $totalValueChangeWithTrashed = $currentMonthBookedOrdersTotalWithTrashed - $previousMonthBookedOrdersTotalWithTrashed;
        $arrowDirectionTotalValueWithTrashed = $totalValueChangeWithTrashed > 0
            ? 'up'
            : ($totalValueChangeWithTrashed < 0 ? 'down' : 'none');
        $totalValueChangeWithTrashed = abs($totalValueChangeWithTrashed);
        // dd($currentMonthBookedWithTrashed, $previousMonthBookedWithTrashed);
        // Conversion Order End

        // Subscribers Gained
        // Count of unique customers for the current and previous month
        $currentMonthUniqueCustomers = Order::where('user_id', $currentUser->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->distinct('Customer_Phone')
            ->count('Customer_Phone');

        $previousMonthUniqueCustomers = Order::where('user_id', $currentUser->id)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->distinct('Customer_Phone')
            ->count('Customer_Phone');

        // Calculate percentage change
        $percentageChange = 0;
        $arrowDirection = 'none';

        if ($previousMonthUniqueCustomers > 0) {
            $percentageChange = (($currentMonthUniqueCustomers - $previousMonthUniqueCustomers) / $previousMonthUniqueCustomers) * 100;
            $arrowDirection = $percentageChange > 0 ? 'up' : ($percentageChange < 0 ? 'down' : 'none');
        }

        $percentageChange = abs($percentageChange);

        //Website Analytics Start from here =====================> =============================>//

        $currentMonth = Carbon::now();
        $monthsAnalytics = [];
        $Website_Analytics_Total = [];
        $Website_Analytics_Booked = [];
        $Website_Analytics_Cancelled = [];


        for ($i = 0; $i < 12; $i++) {
            $month = $currentMonth->copy()->subMonthsNoOverflow($i)->format('Y m');
            $monthsAnalytics[] = $month;
        }


        $orders = Order::with('paymentinfo')
            ->has('paymentinfo')
            ->where('user_id', $currentUser->id)
            ->whereBetween('created_at', [
                $currentMonth->copy()->subMonths(11)->startOfMonth(),
                $currentMonth->endOfMonth(),
            ])
            ->get()
            ->groupBy(fn ($order) => $order->created_at->format('Y m'));

        foreach ($monthsAnalytics as $date) {
            $ordersInMonth = $orders[$date] ?? collect(); // Use formatted date as key

            // Count orders based on status
            $Website_Analytics_Total[] = $ordersInMonth->count();
            $Website_Analytics_Booked[] = $ordersInMonth->where('Listing_Status', 'Book Order')->count();
            $Website_Analytics_Cancelled[] = $ordersInMonth->where('Listing_Status', 'Cancelled')->count();
        }
        //Website Analytics End =======================================================================>//


        return view('livewire.backend.quote-dashboard', compact(
            'orderCount',
            'currentUser',
            'slot',
            'sidebarOptionsWithCount',
            'monthlyDataArray',
            'currentMonthPercentage',
            'percentageChange',
            'arrowDirection',
            'currentMonthBookedOrdersTotal',
            'totalValueChange',
            'arrowDirectionTotalValue',
            'previousMonthBookedOrdersTotal',
            'currentMonthPercentageWithTrashed',
            'arrowDirectionWithTrashed',
            'percentageChangeWithTrashed',
            'currentMonthUniqueCustomers',
            'arrowDirection',
            'percentageChange',
            'currentMonthBookedWithTrashed',
            'Website_Analytics_Total',
            'Website_Analytics_Booked',
            'Website_Analytics_Cancelled',
            'monthsAnalytics',
        ));
    }

    public function getListingStats(Request $request): JsonResponse
    {
        $year = $request->input('year', date('Y'));

        $listingsData = AllUserListing::whereYear('created_at', $year)
            ->selectRaw('Listing_Status, COUNT(*) as count')
            ->groupBy('Listing_Status')
            ->pluck('count', 'Listing_Status')
            ->toArray(); // Ensure JSON-friendly format

        return response()->json(['listingsData' => $listingsData ?? []]);
    }

    public function getTrafficSource(Request $request)
    {
        $year = $request->input('year', now()->year); // Get year or default to current year

        // Fetch data based on the selected year
        $data = Order::whereYear('created_at', $year)
            ->selectRaw("DATE_FORMAT(created_at, '%b %Y') as month, COUNT(*) as total")
            ->groupBy('month')
            ->get();

        $categories = $data->pluck('month')->toArray();
        $series = [
            [
                "name" => "Reference (with name)",
                "data" => $data->pluck('total')->toArray()
            ],
            [
                "name" => "Organic",
                "data" => $data->pluck('total')->toArray()
            ]
        ];

        return response()->json([
            'categories' => $categories,
            'series' => $series
        ]);
    }


    public function Quote_inactive_customer(Request $request)
    {
        $auth_user = Auth::guard('Authorized')->user();
        $user_id = $auth_user->id;

        $inactiveUsers = Order::select(
            'user_id',
            'Customer_Name',
            'Customer_Phone',
            DB::raw("DATEDIFF(CURDATE(), MAX(created_at)) as days_inactive")
        )
            ->where('user_id', $user_id)
            ->where('created_at', '<', Carbon::now()->subMonths(3)) // Customers inactive for 3+ months
            ->groupBy('user_id', 'Customer_Name', 'Customer_Phone')
            ->paginate(10);

        return response()->json($inactiveUsers);
    }

    public function Quote_CustomerDistribution(Request $request)
    {
        $year = $request->year ?? now()->year; // Get selected year, default to current year
        $auth_user = Auth::guard('Authorized')->user();
        $user_id = $auth_user->id;

        $customersByState = DB::table('order_routes')
            ->where('user_id', $user_id) // Filter by authenticated user
            ->whereYear('created_at', $year) // Filter by year
            ->select(DB::raw("SUBSTRING_INDEX(Origin_ZipCode, ',', -2) as state"), DB::raw("COUNT(*) as customer_count"))
            ->groupBy('state')
            ->orderByDesc('customer_count')
            ->get();

        return response()->json($customersByState);
    }








}
