<?php

namespace App\Models\Extras;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\AuthorizedUsers;
use App\Models\Listing\AllUserListing;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['Notification', 'is_read', 'order_id', 'user_id'];
    // protected $fillable = ['type', 'data', 'read_at', 'notifiable'];

    protected $table = "notifications";

    /**
     * Get the user that owns the notification.
     */
    public function user()
    {
        return $this->belongsTo(AuthorizedUsers::class);
    }
    public function order()
    {
        return $this->belongsTo(AllUserListing::class);
    }
}
