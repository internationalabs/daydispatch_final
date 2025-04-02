<?php

namespace App\Models\Extras;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\AuthorizedUsers;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class HeavyTruckSpace extends Model
{
    use HasFactory;
    protected $table = "heavy_truck_spaces";


    /**
     * Get the authorized_user that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function authorized_user()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id');
    }

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('F d, Y', strToTime($value)),
            set: fn ($value) => $value,
        );
    }

    public function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('F d, Y', strToTime($value)),
            set: fn ($value) => $value,
        );
    }
}
