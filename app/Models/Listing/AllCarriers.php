<?php

namespace App\Models\Listing;

use App\Models\Auth\AuthorizedUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\History\CarrierCallHistory;
use App\Models\Listing\CarrierCallCount;
use App\Models\Auth\AuthorizedAgent;

class AllCarriers extends Model
{
    use HasFactory;
    protected $table = "carriers_company";

    protected $fillable = [
        'user_id',
        'type_1',  // Added type_1 (tinyint in DB)
        'typev',
        'company_name',
        'state',  // Added state (exists in DB)
        'address',
        'main_number',
        'local_number',
        'truck',
        'other_details', // Added other_details (exists in DB)
        'equipment',
        'route_description'
    ];

    public function history($id)
    {
        $history = CarrierCallHistory::where('permission', $id)
            ->get();

        return $history;
    }

    public function lastStatus()
    {
        return $this->hasMany(CarrierCallHistory::class, 'permission')->latest('id');
    }

    public function callCount()
    {
        return $this->hasMany(CarrierCallCount::class, 'company_id');
    }

    public function agent()
    {
        return $this->belongsTo(AuthorizedAgent::class, 'user_id');
    }

}
