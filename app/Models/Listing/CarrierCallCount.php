<?php

namespace App\Models\Listing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Listing\AllUserListing;

class CarrierCallCount extends Model
{
    use HasFactory;
    protected $table = "carrierCallCount";
    
    protected $fillable = [
            "user_id",
            "company_id",
            "type",
        ];
        
        
    public function user()
    {
        // return $this->belongsTo(AllUserListing::class);
    }
    public function company()
    {
        // return $this->belongsTo(AuthorizedUsers::class);
    }


}
