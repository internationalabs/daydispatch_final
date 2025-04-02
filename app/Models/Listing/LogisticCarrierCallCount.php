<?php

namespace App\Models\Listing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Listing\AllUserListing;
use Illuminate\Database\Eloquent\Casts\Attribute;

class LogisticCarrierCallCount extends Model
{
    use HasFactory;
    protected $table = "logisticCarrierCallCount";
    
    protected $fillable = [
            "user_id",
            "company_id",
        ];
        
        
    public function user()
    {
        // return $this->belongsTo(AllUserListing::class);
    }
    public function company()
    {
        // return $this->belongsTo(AuthorizedUsers::class);
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
