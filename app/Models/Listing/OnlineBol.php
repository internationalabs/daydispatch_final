<?php

namespace App\Models\Listing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OnlineBolItemCondition;
use Illuminate\Database\Eloquent\Casts\Attribute;

class OnlineBol extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function online_bol_imgs() 
    {
        return $this->hasMany(OnlineBolMultiImg::class, 'onlinebol_id', 'id');
    }

    public function online_bol_items() 
    {
        return $this->hasMany(OnlineBolItemCondition::class, 'onlinebol_id', 'id');
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
