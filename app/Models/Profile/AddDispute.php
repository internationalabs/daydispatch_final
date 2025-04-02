<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AddDispute extends Model
{
    use HasFactory;
    protected $table = "add_disputes";

    protected $fillable = ['Dispute_Comments', 'Profile_ID', 'rate_id', 'user_id'];

    /**
     * Get the ratings that owns the AddDispute
     *
     * @return BelongsTo
     */
    public function ratings()
    {
        return $this->belongsTo(MyRating::class, 'rate_id', 'user_id');
    }

    /**
     * Get all of the attachments for the AddDispute
     *
     * @return HasMany
     */
    public function attachments()
    {
        return $this->hasMany(DisputesFiles::class, 'dispute_id', 'user_id');
    }
}
