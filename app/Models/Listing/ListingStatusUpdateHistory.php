<?php

namespace App\Models\Listing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\AuthorizedUsers;
use App\Models\Listing\AllUserListing;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListingStatusUpdateHistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'listing_status_update_history';

    protected $fillable = [
        'status',
        'main_reason',
        'detail_reason',
        'user_id',
        'list_id',
        'cmp_id'
    ];

    /**
     * Get the authorized_user that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function authorized_user()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id', 'id');
    }

    /**
     * Get the all_listing that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function all_listing()
    {
        return $this->belongsTo(AllUserListing::class, 'list_id', 'id');
    }

    /**
     * Get the authorized_user that cancels the Order
     *
     * @return BelongsTo
     */
    public function cancelled_By()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'status_by');
    }

    /**
     * Get the authorized_user that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function waiting_users()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'cmp_id', 'id');
    }
}
