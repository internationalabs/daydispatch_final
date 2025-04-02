<?php

namespace App\Models\Payments;

use App\Models\Auth\AuthorizedUsers;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubscriptionFee extends Model
{
    use HasFactory;

    protected $table = "subscription_fees";

    public function authorized_user(): BelongsTo
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id');
    }

    public function method(): Attribute
    {
        return new Attribute(
            get: fn($value) => ($value === 1) ? 'Paypal' : 'Stripe',
            set: fn($value) => $value,
        );
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
            get: fn($value) => date('M d, Y', strtotime($value)),
            set: fn($value) => $value,
        );
    }
}
