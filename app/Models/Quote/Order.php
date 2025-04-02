<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\AuthorizedUsers;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Quote\OrderOriginLocation;
use App\Models\Listing\ListingAttachments;
use App\Models\OrderForm;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'Listing_Status',
        'Ref_ID',
        'Custom_Listing',
        'Private_Listing',
        'Posted_Date',
        'Listing_Type',
        'Is_Rate',
        'user_id',
        'vehicle_count',
        'expire_at',
        'Customer_Name',
        'Customer_Email',
        'Customer_Phone',
        'invoice_number',
        'Referred_By',
    ];

    protected $dates = ['deleted_at', 'expire_at'];

    public function authorized_user()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id');
    }

    public function paymentinfo()
    {
        return $this->hasOne(OrderPaymentInfo::class, 'order_id', 'id');
    }

    public function additional_info()
    {
        return $this->hasOne(OrderAdditionalInfo::class, 'order_id', 'id');
    }

    public function pickup_delivery_info()
    {
        return $this->hasOne(OrderPickupDeliverInfo::class, 'order_id', 'id');
    }

    public function dispatch_bol()
    {
        return $this->hasOne(OnlineBol::class, 'order_id', 'id');
    }

    public function vehicles()
    {
        return $this->hasMany(OrderVehicle::class, 'order_id', 'id');
    }

    public function heavy_equipments()
    {
        return $this->hasMany(OrderHeavyEquipment::class, 'order_id', 'id');
    }

    public function dry_vans()
    {
        return $this->hasMany(OrderDryVans::class, 'order_id', 'id');
    }

    public function dry_vans_services()
    {
        return $this->hasMany(OrderDryVanServices::class, 'order_id', 'id');
    }

    public function routes()
    {
        return $this->hasOne(OrderRoute::class, 'order_id', 'id');
    }

    public function listingVehicle()
    {
        return $this->hasMany(OrderVehicle::class, 'order_id', 'id');
    }

    public function listing_origin_location()
    {
        return $this->hasOne(OrderOriginLocation::class, 'order_id', 'id');
    }

    public function listing_destination_locations()
    {
        return $this->hasOne(OrderDestinationLocation::class, 'order_id', 'id');
    }

    public function request_carrier()
    {
        return $this->hasMany(RequestCarrier::class, 'order_id', 'id');
    }

    // public function request_broker()
    // {
    //     return $this->hasOne(RequestBroker::class, 'order_id', 'id');
    // }

    // public function request_broker_all()
    // {
    //     return $this->hasMany(RequestBroker::class, 'order_id', 'id');
    // }

    public function dispatch_fee()
    {
        return $this->HasOne(DispatchOrderFee::class, 'order_id', 'id');
    }

    public function dispatch_order()
    {
        return $this->HasOne(Dispatch::class, 'order_id', 'id');
    }

    public function driver()
    {
        return $this->HasOne(DispatchDriver::class, 'order_id', 'id');
    }

    public function waitings()
    {
        return $this->hasOne(WaitingForApproval::class, 'order_id', 'id');
    }

    public function pickup_approve()
    {
        return $this->hasOne(PickUpApprovals::class, 'order_id', 'id');
    }

    public function pickup()
    {
        return $this->hasOne(PickupOrders::class, 'order_id', 'id');
    }

    public function deliver_approve()
    {
        return $this->hasOne(DeliverApprovals::class, 'order_id', 'id');
    }

    public function deliver()
    {
        return $this->hasOne(DeliverdOrders::class, 'order_id', 'id');
    }

    public function completed()
    {
        return $this->hasOne(CompletedOrders::class, 'order_id', 'id');
    }

    public function cancel()
    {
        return $this->hasOne(CancelledOrders::class, 'order_id', 'id')->withTrashed();
    }

    public function attachments()
    {
        return $this->hasMany(ListingAttachments::class, 'order_id', 'id');
    }

    public function bol()
    {
        return $this->hasMany(BillOfLading::class, 'order_id', 'id');
    }

    public function miscellenous()
    {
        return $this->hasMany(MiscellenousItems::class, 'order_id', 'id');
    }

    public function agreement()
    {
        return $this->hasOne(ListingAgreement::class, 'order_id', 'id');
    }

    public function history()
    {
        return $this->hasMany(OrderHistory::class, 'order_id', 'id');
    }

    public function update_history()
    {
        return $this->hasMany(OrderUpdateHistoryActions::class, 'order_id', 'id');
    }

    public function quote_history()
    {
        return $this->hasMany(OrderQuoteStatus::class, 'order_id', 'id');
    }

    public function myrating()
    {
        return $this->hasOne(MyRating::class, 'order_id', 'id');
    }

    public function orderForm()
    {
        return $this->hasOne(OrderForm::class, 'order_id');
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
