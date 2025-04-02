<?php

namespace App\Models\Listing;

use App\Models\Auth\AuthorizedUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class DispatchDriver extends Model
{
    use HasFactory;
    protected $table = "dispatch_drivers";
    protected $fillable = ['Driver_Name', 'Driver_Email', 'Driver_Phone', 'order_id', 'user_id'];

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
     * Get the all_listing that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function all_listing(): BelongsTo
    {
        return $this->belongsTo(AllUserListing::class, 'order_id', 'id');
    }
}
