<?php

namespace App\Models\Profile;

use App\Models\Listing\AllUserListing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\AuthorizedUsers;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MyRating extends Model
{
    use HasFactory;
    protected $table = "my_ratings";

    /**
     * Get the authorized_user that owns the MyRating
     *
     * @return BelongsTo
     */
    public function authorized_user()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id');
    }

    public function all_listing()
    {
        return $this->belongsTo(AllUserListing::class, 'order_id');
    }

    /**
     * Get all of the disputes for the MyRating
     *
     * @return HasMany
     */
    public function disputes()
    {
        return $this->hasMany(AddDispute::class, 'rate_id', 'user_id');
    }

    /**
     * Get the CMP_user that owns the MyRating
     *
     * @return BelongsTo
     */
    public function rated_user(): BelongsTo
    {
        return $this->belongsTo(AuthorizedUsers::class, 'CMP_ID');
    }
}
