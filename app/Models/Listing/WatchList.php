<?php

namespace App\Models\Listing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Listing\AllUserListing;
use App\Models\Auth\AuthorizedUsers;
use Illuminate\Database\Eloquent\Casts\Attribute;

class WatchList extends Model
{
    use HasFactory;
    protected $table = "watch_list";

    protected $fillable = [
        "user_id",
        "listing_id",
        "status",
    ];


    public function listing()
    {
        return $this->belongsTo(AllUserListing::class);
    }
    public function user()
    {
        return $this->belongsTo(AuthorizedUsers::class);
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

}
