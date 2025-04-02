<?php

namespace App\Models\History;

use App\Models\Auth\AuthorizedUsers;
use App\Models\Listing\AllUserListing;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderUpdateHistoryActions extends Model
{
    use HasFactory;
    protected $table = "order_update_history_actions";
    protected $fillable = ['Order_Actions', 'order_id', 'user_id', 'Old_Meta_Data', 'New_Meta_Data'];

    public function all_listing(): BelongsTo
    {
        return $this->belongsTo(AllUserListing::class, 'order_id');
    }

    public function authorized_user(): BelongsTo
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id');
    }

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('M d, Y', strtotime($value)),
            set: fn ($value) => $value,
        );
    }

    public function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('M d, Y', strtotime($value)),
            set: fn ($value) => $value,
        );
    }
}
