<?php

namespace App\Models;

use App\Models\Auth\AuthorizedUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory;

    protected $table = "customer_feedback";

    protected $fillable = ['feedback', 'user_id'];

    /**
     * Get the authorized_user that owns the AllListing
     *
     * @return BelongsTo
     */
    public function authorized_user(): BelongsTo
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id');
    }
}
