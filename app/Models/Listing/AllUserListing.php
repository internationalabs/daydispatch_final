<?php

namespace App\Models\Listing;

use App\Models\Auth\AuthorizedUsers;
use App\Models\Broker\RequestCarrier;
use App\Models\Carrier\RequestBroker;
use App\Models\Extras\BillOfLading;
use App\Models\Extras\MiscellenousItems;
use App\Models\History\OrderHistory;
use App\Models\History\OrderUpdateHistoryActions;
use App\Models\Payments\DispatchOrderFee;
use App\Models\Profile\MyRating;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Profile\MyNetwork;
use App\Models\Listing\OnlineBol;

class AllUserListing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "all_user_listings";

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'updated_at'];

    protected $fillable = ['Listing_Status'];

    /**
     * @param int $type
     * @param string $relation
     * @param bool $flag
     * @return Collection|array
     * @return int $perPage|array
     */
    public function getListingByType(int $type, string $relation, bool $flag = false): Collection|array
    {
        $query = $this->with(
            [
                'authorized_user' => function ($q) {
                    $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')->with([
                        'insurance',
                        'certificates'
                    ]);
                },
                "paymentinfo",
                "additional_info" => function ($q) {
                    $q->select('id', 'order_id', 'Additional_Terms');
                },
                "pickup_delivery_info",
                $relation,
                "routes",
                "vehicles",
                "myrating",

            ]
        )
            ->latest('created_at')
            ->where('Listing_Status', 'Listed')
            ->where('Custom_Listing', 0)
            ->where('Listing_Type', $type);

        // // Check user_id in related tables
        // $query->whereHas('authorized_user', function ($q) use ($userId) {
        //     $q->where('user_id', $userId);
        // });

        if ($relation === 'heavy_equipments') {
            if ($flag) {
                $query->whereHas($relation, function ($q) {
                    $q->where('Shipment_Preferences', 'FTL');
                });
            } else {
                $query->whereDoesntHave($relation, function ($q) {
                    $q->where('Shipment_Preferences', 'FTL');
                });
            }
        }


        if ($relation === 'dry_vans') {
            if ($flag) {
                $query->whereHas($relation, function ($q) {
                    $q->where('Shipment_Preferences', 'FTL');
                });
            } else {
                $query->whereDoesntHave($relation, function ($q) {
                    $q->where('Shipment_Preferences', 'FTL');
                });
            }
        }

        // return $query->take(20)->get();
        return $query->get();
    }

    // /////////////////////////////////////////////////NEW WORK START//////////////////////////////////////////////



    public function getListingByTypeWithPagination(int $type, string $relation, bool $flag = false, int $perPage): LengthAwarePaginator|Collection
    {
        $query = $this->with([
            'authorized_user' => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')
                    ->with(['insurance', 'certificates']);
            },
            "paymentinfo",
            "additional_info" => function ($q) {
                $q->select('id', 'order_id', 'Additional_Terms');
            },
            "pickup_delivery_info",
            $relation,
            "routes",
        ])
            ->latest('created_at')
            ->where('Listing_Status', 'Listed')
            ->where('Custom_Listing', 0)
            ->where('Listing_Type', $type);

        if ($relation === 'heavy_equipments' || $relation === 'dry_vans') {
            if ($flag) {
                $query->whereHas($relation, function ($q) {
                    $q->where('Shipment_Preferences', 'FTL');
                });
            } else {
                $query->whereDoesntHave($relation, function ($q) {
                    $q->where('Shipment_Preferences', 'FTL');
                });
            }
        }

        // Return paginated results
        return $query->paginate($perPage);
    }

    // /////////////////////////////////////////////////NEW WORK END //////////////////////////////////////////////

    public function scopeActive($query)
    {
        // return $query->where('Listing_Status', 'Listed')->where('Custom_Listing', 0);
        return $query->where('Listing_Status', 'Listed');
    }

    public function scopeInActive($query)
    {
        return $query->where('Listing_Status', 'Listed')->where('Custom_Listing', 1);
    }

    public function scopeExpired($query)
    {
        return $query->where('Listing_Status', 'Expired');
    }

    public function scopeNotExpire($query)
    {
        return $query->whereNot('Listing_Status', 'Expired');
    }

    public function scopeArchived($query)
    {
        return $query->withTrashed();
    }

    public function scopeCarrierListing($query)
    {
        return $query->with([
            "authorized_user" => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'email');
            },
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
            "attachments",
            "request_carrier",
            "My_Network"
        ]);
    }

    public function scopeBrokerListing($query)
    {
        return $query->with([
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
            "attachments",
            "request_broker",
            "request_broker_all",
            "My_Network"
        ]);
    }

    /**
     * Get the authorized_user that owns the AllListing
     *
     * @return BelongsTo
     */
    public function authorized_user(): BelongsTo
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id');
    }

    /**
     * Get all of the paymentinfo for the AllListing
     *
     * @return hasOne
     */
    public function paymentinfo(): HasOne
    {
        return $this->hasOne(ListingPaymentInfo::class, 'order_id', 'id');
    }

    /**
     * Get the additional_info that owns the AllListing
     *
     * @return hasOne
     */
    public function additional_info(): HasOne
    {
        return $this->hasOne(ListingAdditionalInfo::class, 'order_id', 'id');
    }

    public function My_Network(): HasOne
    {
        return $this->hasOne(MyNetwork::class, 'CMP_ID', 'user_id');
    }

    /**
     * Get all of the pickup_delivery_info for the AllListing
     *
     * @return hasOne
     */
    public function pickup_delivery_info(): HasOne
    {
        return $this->hasOne(ListingPickupDeliverInfo::class, 'order_id', 'id');
    }

    public function dispatch_bol(): HasOne
    {
        return $this->hasOne(OnlineBol::class, 'order_id', 'id');
    }

    public function delivered_bol(): HasOne
    {
        return $this->hasOne(PickupOnlineBol::class, 'order_id', 'id');
    }

    /**
     * Get all of the vehicles for the AllListing
     *
     * @return HasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(ListingVehciles::class, 'order_id', 'id');
    }

    /**
     * Get all of the heavy_equipments for the AllListing
     *
     * @return HasMany
     */
    public function heavy_equipments(): HasMany
    {
        return $this->hasMany(ListingHeavyEquipment::class, 'order_id', 'id');
    }

    /**
     * Get all of the dry_vans for the AllListing
     *
     * @return HasMany
     */
    public function dry_vans(): HasMany
    {
        return $this->hasMany(ListingDryVan::class, 'order_id', 'id');
    }

    /**
     * Get the services that owns the ListingRoutes
     *
     * @return HasMany
     */
    public function dry_vans_services(): HasMany
    {
        return $this->hasMany(ListingDryVanServices::class, 'order_id', 'id');
    }

    /**
     * Get all of the routes for the AllListing
     *
     * @return hasOne
     */
    public function routes(): HasOne
    {
        return $this->hasOne(ListingRoutes::class, 'order_id', 'id');
    }

    /**
     * Get all of the routes for the AllListing
     *
     * @return hasOne
     */
    public function listingVehicle(): HasMany
    {
        return $this->hasMany(ListingVehciles::class, 'order_id', 'id');
    }

    /**
     * Get the listing_origin_location associated with the AllUserListing
     *
     * @return HasOne
     */
    public function listing_origin_location(): HasOne
    {
        return $this->hasOne(ListingOrignLocation::class, 'order_id', 'id');
    }

    /**
     * Get all of the listing_destination_locations for the AllListing
     *
     * @return HasOne
     */
    public function listing_destination_locations(): HasOne
    {
        return $this->hasOne(ListingDestinationLocation::class, 'order_id', 'id');
    }

    /**
     * Get all of the request_carrier for the AllListing
     *
     * @return HasMany
     */
    public function request_carrier(): HasMany
    {
        return $this->hasMany(RequestCarrier::class, 'order_id', 'id');
    }

    /**
     * Get all the request_broker for the AllUserListing
     *
     * @return HasOne
     */
    public function request_broker(): HasOne
    {
        return $this->hasOne(RequestBroker::class, 'order_id', 'id');
    }

    /**
     * Get all the request_broker for the AllUserListing
     *
     * @return HasMany
     */
    public function request_broker_all(): HasMany
    {
        return $this->hasMany(RequestBroker::class, 'order_id', 'id');
    }

    public function dispatch_fee(): HasOne
    {
        return $this->HasOne(DispatchOrderFee::class, 'order_id', 'id');
    }

    /**
     * Get all the dispatch_listing for the AllUserListing
     *
     * @return HasOne
     */
    public function dispatch_listing(): HasOne
    {
        return $this->HasOne(Dispatch::class, 'order_id', 'id')->withTrashed();
    }

    public function driver(): HasOne
    {
        return $this->HasOne(DispatchDriver::class, 'order_id', 'id');
    }

    /**
     * Get the waitings associated with the AllUserListing
     *
     * @return HasOne
     */
    public function waitings(): HasOne
    {
        return $this->hasOne(WaitingForApproval::class, 'order_id', 'id');
    }

    /**
     * Get the pickup_approve associated with the AllUserListing
     *
     * @return HasOne
     */
    public function pickup_approve(): HasOne
    {
        return $this->hasOne(PickUpApprovals::class, 'order_id', 'id');
    }

    /**
     * Get the pickup associated with the AllUserListing
     *
     * @return HasOne
     */
    public function pickup(): HasOne
    {
        return $this->hasOne(PickupOrders::class, 'order_id', 'id');
    }

    /**
     * Get the deliver_approve associated with the AllUserListing
     *
     * @return HasOne
     */
    public function deliver_approve(): HasOne
    {
        return $this->hasOne(DeliverApprovals::class, 'order_id', 'id');
    }

    /**
     * Get the delivery associated with the AllUserListing
     *
     * @return HasOne
     */
    public function deliver(): HasOne
    {
        return $this->hasOne(DeliverdOrders::class, 'order_id', 'id');
    }

    /**
     * Get the completed associated with the AllUserListing
     *
     * @return HasOne
     */
    public function completed(): HasOne
    {
        return $this->hasOne(CompletedOrders::class, 'order_id', 'id');
    }

    /**
     * Get the completed associated with the AllUserListing
     *
     * @return HasOne
     */
    public function archive(): HasOne
    {
        return $this->hasOne(ArchiveListing::class, 'order_id', 'id');
    }

    /**
     * Get the cancel associated with the AllUserListing
     *
     * @return HasOne
     */
    public function cancel(): HasOne
    {
        return $this->hasOne(CancelledOrders::class, 'order_id', 'id')->withTrashed();
    }

    /**
     * Get all the attachments for the AllUserListing
     *
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(ListingAttachments::class, 'order_id', 'id');
    }

    /**
     * Get the ladingBill associated with the AllUserListing
     *
     * @return HasMany
     */
    public function bol(): HasMany
    {
        return $this->hasMany(BillOfLading::class, 'order_id', 'id');
    }

    /**
     * Get all the miscellaneous for the AllUserListing
     *
     * @return HasMany
     */
    public function miscellenous(): HasMany
    {
        return $this->hasMany(MiscellenousItems::class, 'order_id', 'id');
    }

    /**
     * Get the agreement associated with the AllUserListing
     *
     * @return HasOne
     */
    public function agreement(): HasOne
    {
        return $this->hasOne(ListingAgreement::class, 'order_id', 'id');
    }

    public function history(): HasMany
    {
        return $this->hasMany(OrderHistory::class, 'order_id', 'id');
    }
    public function history_pick(): HasOne
    {
        return $this->hasOne(OrderHistory::class, 'order_id', 'id')->where('status','PickUp');
    }
    public function history_delivered(): HasOne
    {
        return $this->hasOne(OrderHistory::class, 'order_id', 'id')->where('status','Delivered');
    }
    public function history_dispatch(): HasOne
    {
        return $this->hasOne(OrderHistory::class, 'order_id', 'id')->where('status','Dispatch');
    }

    public function update_history(): HasMany
    {
        return $this->hasMany(OrderUpdateHistoryActions::class, 'order_id', 'id');
    }

    /**
     * Get the rating associated with the AllUserListing
     *
     * @return HasOne
     */
    public function myrating(): HasOne
    {
        return $this->hasOne(MyRating::class, 'order_id', 'id');
    }

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn($value) => date('M d, Y', strtotime($value)),
            set: fn($value) => $value,
        );
    }

    public function updatedAt(): Attribute
    {
        return new Attribute(
            // get: fn($value) => date('M d, Y H:i:s', strtotime($value)),
            get: fn($value) => date('M d, Y', strtotime($value)),
            set: fn($value) => $value,
        );
    }

    public function expireAt(): Attribute
    {
        return new Attribute(
            get: fn($value) => date('M d, Y', strtotime($value)),
            set: fn($value) => $value,
        );
    }
}
