<?php

namespace App\Models\Listing;

use App\Models\Auth\AuthorizedUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\History\LogisticBrokerCallHistory;
use App\Models\Listing\LogisticBrokerCallCount;
use App\Models\Auth\AuthorizedAgent;
use Illuminate\Database\Eloquent\Casts\Attribute;

class LogisticBroker extends Model
{
    use HasFactory;
    protected $table = "broker_by_state";

    protected $fillable = [
        'user_id', // Add user_id here to allow mass assignment
        'company_name',
        'city',
        'phone',
        'Mc_Number',
        'Company_USDot',
    ];

    public function history($id)
    {
        $history = LogisticBrokerCallHistory::where('permission', $id)
            ->get();

        return $history;
    }

    public function lastStatus()
    {
        return $this->hasMany(LogisticBrokerCallHistory::class, 'permission')->latest('id');
    }

    public function callCount()
    {
        return $this->hasMany(LogisticBrokerCallCount::class, 'company_id');
    }

    public function agent()
    {
        return $this->belongsTo(AuthorizedAgent::class, 'user_id');
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