<?php

namespace App\Console\Commands\Listing;

use App\Models\Carrier\RequestBroker;
use Exception;
use Illuminate\Console\Command;
use App\Models\Listing\AllUserListing;
use App\Helpers\DayDispatchHelper;
use Carbon\Carbon;

class IsExpiredListing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws Exception
     */
    public function handle(): int
    {
        info("Expired Listing Cron Job is Running at " . now());

        $listings = AllUserListing::where('Custom_Listing', 0)
            ->where('Listing_Status', 'Listed')
            ->where('user_id', '!=', 14)
            ->get();

        if ($listings->isEmpty()) {
            return Command::SUCCESS;
        }

        $user14Listings = AllUserListing::where('user_id', 14)->get();
        if (!$user14Listings->isEmpty()) {
            AllUserListing::where('user_id', 14)->update(['created_at' => now()]);
        }
        

        $expiredListings = [];
        $expiredRequests = [];

        foreach ($listings as $listing) {
            $listingDays = DayDispatchHelper::getDaysFromTwoDates($listing->updated_at);

            if ($listingDays >= 5) {
                $expiredListings[] = $listing->id;
                $expiredRequests[] = $listing->id;
            }
        }

        if (!empty($expiredListings)) {
            AllUserListing::whereIn('id', $expiredListings)
                ->update(['Listing_Status' => 'Expired']);

            RequestBroker::whereIn('order_id', $expiredRequests)
                ->update(['is_cancel' => 1]);

            foreach ($expiredListings as $listingId) {
                DayDispatchHelper::SendNotificationOnStatusChanged2('Expired', $listingId);
            }
        }

        $customListings = AllUserListing::where('Custom_Listing', 1)
            ->where('Listing_Status', 'Listed')
            ->get();

        foreach ($customListings as $listing) {
            $date = Carbon::parse($listing->Posted_Date);

            if ($date->isToday()) {
                AllUserListing::where('id', $listing->id)
                    ->update([
                        'Custom_Listing' => 0,
                        'created_at' => now()
                    ]);
            }
        }
        return Command::SUCCESS;
    }
}
