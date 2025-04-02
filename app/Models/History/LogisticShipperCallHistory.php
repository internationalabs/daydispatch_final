<?php

namespace App\Models\History;

use App\Models\Auth\AuthorizedAgent;
use App\Models\Listing\AllUserListing;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogisticShipperCallHistory extends Model
{
    use HasFactory;
    protected $table = "logistic_shipper_history";
    protected $fillable = ['user_id', 'permission', 'connectStatus', 'comment'];

    /**
     * Get the authorized_user that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(AuthorizedAgent::class, 'user_id');
    }
}
