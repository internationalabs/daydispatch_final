<?php

namespace App\Models\Extras;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\AuthorizedUsers;
use App\Models\Listing\AllUserListing;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MiscellenousItems extends Model
{
    use HasFactory;

    protected $table = "miscellenous_items";

    /**
     * Get the authorized_user that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function authorized_user(): BelongsTo
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id');
    }

    /**
     * Get the all_listing that owns the MiscellaneousItems
     *
     * @return BelongsTo
     */
    public function all_listing(): BelongsTo
    {
        return $this->belongsTo(AllUserListing::class, 'order_id');
    }
}
