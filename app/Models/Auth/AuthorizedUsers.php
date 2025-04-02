<?php

namespace App\Models\Auth;

use App\Models\Carrier\RequestBroker;
use App\Models\Extras\TruckSpace;
use App\Models\Extras\HeavyTruckSpace;
use App\Models\Extras\TruckSpaceDry;

use App\Models\Extras\ManagedUser;
use App\Models\History\OrderHistory;
use App\Models\Listing\AllUserListing;
use App\Models\Listing\Dispatch;
use App\Models\Payments\UserInvoices;
use App\Models\Payments\UserRegFee;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;

use App\Models\Profile\UserCertificates;
use App\Models\Profile\UserInsurrance;
use App\Models\Profile\MyNetwork;
use App\Models\Profile\MyContract;
use App\Models\Profile\AddressBook;
use App\Models\Profile\MyRating;
use App\Models\Listing\WatchList;
use App\Models\Message;
use App\Models\UserEquipmentType;
use App\Models\UserSetting;
use App\Models\NumberOfLogin;

class AuthorizedUsers extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $guard = "Authorized";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'usr_type',
        'is_email_verified'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the authorized_user that owns the MyRating
     *
     * @return BelongsTo
     */
    public function authorized_agent()
    {
        return $this->belongsTo(AuthorizedAgent::class, 'ref_code');
    }



    /**
     * Get the authorized_user that owns the MyRating
     *
     * @return HasOne
     */
    public function user_reg_fee(): HasOne
    {
        return $this->hasOne(UserRegFee::class, 'user_id');
    }

    /**
     * Get the authorized_user that owns the MyRating
     *
     * @return HasMany
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(UserInvoices::class, 'user_id');
    }

    /**
     * Get all of the insurance for the Carrier
     *
     * @return HasOne
     */
    public function insurance(): HasOne
    {
        return $this->hasOne(UserInsurrance::class, 'user_id');
    }

    /**
     * Get all of the certificates for the Carrier
     *
     * @return HasOne
     */
    public function certificates(): HasOne
    {
        return $this->hasOne(UserCertificates::class, 'user_id');
    }

    /**
     * Get all of the certificates for the Carrier
     *
     * @return HasOne
     */
    public function order_history(): HasOne
    {
        return $this->hasOne(OrderHistory::class, 'user_id');
    }

    /**
     * Get all of the address_Book for the Carrier
     *
     * @return HasMany
     */
    public function address_Book(): HasMany
    {
        return $this->hasMany(AddressBook::class, 'user_id');
    }

    /**
     * Get all of the address_Book for the Carrier
     *
     * @return HasMany
     */
    public function my_watch_check($listing_id)
    {
        $check = WatchList::where('user_id', Auth::guard('Authorized')->user()->id)
            ->where('listing_id', $listing_id)
            ->first();

        return $check;
    }

    /**
     * Get all of the address_Book for the Carrier
     *
     * @return HasMany
     */
    public function my_watch_list(): HasMany
    {
        return $this->hasMany(WatchList::class, 'user_id');
    }

    /**
     * Get all of the contract for the Carrier
     *
     * @return HasMany
     */
    public function contract(): HasOne
    {
        return $this->hasOne(MyContract::class, 'user_id');
    }

    /**
     * Get all of the contract for the Carrier
     *
     * @return HasMany
     */
    public function myContracts(): HasMany
    {
        return $this->hasMany(MyContract::class, 'user_id');
    }

    /**
     * Get all of the network for the Carrier
     *
     * @return HasMany
     */
    public function network()
    {
        // return $this->hasMany(MyNetwork::class, 'user_id')->where('user_id', '!=', Auth::guard('Authorized')->user()->id());
        return $this->hasMany(MyNetwork::class, 'user_id');
    }

    /**
     * Get all of the ratings for the Carrier
     *
     * @return HasMany
     */
    public function ratings()
    {
        return $this->hasMany(MyRating::class, 'user_id');
    }

    /**
     * Get all of the ratings for the Carrier
     *
     * @return HasMany
     */
    public function ratingsAvg()
    {
        return $this->hasMany(MyRating::class, 'CMP_ID');
    }

    /**
     * Get all of the all_listing for the Broker
     *
     * @return HasMany
     */
    public function all_listing(): HasMany
    {
        return $this->hasMany(AllUserListing::class, 'user_id');
    }
    /**
     * Get all of the paymentinfo for the AllListing
     *
     * @return HasMany
     */
    public function paymentinfo()
    {
        return $this->hasMany(ListingPaymentInfo::class, 'order_id', 'user_id');
    }

    /**
     * Get the additional_info that owns the AllListing
     *
     * @return HasMany
     */
    public function additional_info()
    {
        return $this->hasMany(ListingAddtionalInfo::class, 'order_id', 'user_id');
    }

    /**
     * Get all of the pickup_delivery_info for the AllListing
     *
     * @return HasMany
     */
    public function pickup_delivery_info()
    {
        return $this->hasMany(ListingPickupDeliverInfo::class, 'order_id', 'user_id');
    }

    /**
     * Get all of the vehciles for the AllListing
     *
     * @return HasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(ListingVehciles::class, 'order_id', 'user_id');
    }

    /**
     * Get all of the routes for the AllListing
     *
     * @return HasMany
     */
    public function routes()
    {
        return $this->hasMany(ListingRoutes::class, 'order_id', 'user_id');
    }

    /**
     * Get all of the origin for the AllListing
     *
     * @return HasMany
     */
    public function listing_orign_locations()
    {
        return $this->hasMany(ListingOrignLocation::class, 'order_id', 'user_id');
    }

    /**
     * Get all of the listing_destination_locations for the AllListing
     *
     * @return HasMany
     */
    public function listing_destination_locations()
    {
        return $this->hasMany(ListingDestinationLocation::class, 'order_id', 'user_id');
    }

    /**
     * Get all of the dispatch_listing for the AllUserListing
     *
     * @return HasOne
     */
    public function dispatch_listing()
    {
        return $this->hasOne(Dispatch::class, 'order_id', 'CMP_id');
    }

    /**
     * Get all of the request_list for the AuthorizedUsers
     *
     * @return HasMany
     */
    public function request_list(): HasMany
    {
        return $this->hasMany(RequestBroker::class, 'order_id', 'user_id');
    }

    /**
     * Get all of the truck_spaces for the AuthorizedUsers
     *
     * @return HasMany
     */
    public function truck_spaces(): HasMany
    {
        return $this->hasMany(TruckSpace::class, 'user_id', 'id');
    }

    /**
     * Get all of the truck_spaces for the AuthorizedUsers
     *
     * @return HasMany
     */
    public function heavy_truck_spaces(): HasMany
    {
        return $this->hasMany(HeavyTruckSpace::class, 'user_id', 'id');
    }

    /**
     * Get all of the truck_spaces for the AuthorizedUsers
     *
     * @return HasMany
     */
    public function truck_spaces_dry(): HasMany
    {
        return $this->hasMany(TruckSpaceDry::class, 'user_id', 'id');
    }

    public function message()
    {
        // $message = Message::where('user_id', Auth::guard('Authorized')->user()->id)
        //     // ->where('recipient_id', $recipient_id)
        //     ->get();

        // return $message;

        return $this->hasMany(Message::class, 'user_id', 'id');
    }

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn($value) => date('F d, Y', strToTime($value)),
            set: fn($value) => $value,
        );
    }

    public function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn($value) => date('F d, Y', strToTime($value)),
            set: fn($value) => $value,
        );
    }

    public function managedUsers()
    {
        return $this->hasOne(ManagedUser::class, 'user_id');
    }

    public function setting()
    {
        return $this->hasOne(UserSetting::class, 'user_id');
    }

    public function numberOfLogin()
    {
        return $this->hasOne(NumberOfLogin::class, 'user_id');
    }

    public function owner()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'owner_id');
    }

    public function subUsers()
    {
        return $this->hasMany(AuthorizedUsers::class, 'owner_id');
    }

    public function dispatcher()
    {
        return $this->hasMany(ManagedUser::class, 'dispatcher_id');
    }

    public function myNetworks()
    {
        return $this->hasMany(MyNetwork::class, 'user_id');
    }

    public function myEquipments()
    {
        return $this->hasMany(UserEquipmentType::class, 'user_id');
    }
}
