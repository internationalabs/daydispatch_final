<?php

namespace App\Models\Listing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PickupOnlineBolItemCondition;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PickupOnlineBol extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pickup_online_bol_imgs()
    {
        return $this->hasMany(PickupOnlineBolMultiImage::class, 'pickup_online_bol_id', 'id');
    }

    public function pickup_online_bol_items()
    {
        return $this->hasMany(PickupOnlineBolItemCondition::class, 'onlinebol_id', 'id');
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
