<?php

namespace App\Models\Support;

use App\Models\Auth\AuthorizedUsers;
use App\Models\Listing\AllUserListing;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ThreeWayTicket extends Model
{
    use HasFactory;
    protected $table = "three_way_tickets";
    /**
     * Get the authorized_user that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function authorized_user(): BelongsTo
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id');
    }

    /**
     * Get the all_listing that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function all_listing(): BelongsTo
    {
        return $this->belongsTo(AllUserListing::class, 'order_id');
    }

    /**
     * Get the authorized_user that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function assigned_user(): BelongsTo
    {
        return $this->belongsTo(AuthorizedUsers::class, 'CMP_id');
    }

    public function ticket_by(): BelongsTo
    {
        return $this->belongsTo(AuthorizedUsers::class, 'created_by');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TicketComments::class, 'ticket_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(TicketAttachments::class, 'ticket_id');
    }

    public function scopeTicket($query)
    {
        return $query->with([
            'comments',
            'attachments',
            'authorized_user' => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')->with([
                    'insurance',
                    'certificates'
                ]);
            },
            'assigned_user' => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')->with([
                    'insurance',
                    'certificates'
                ]);
            },
            'ticket_by' => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')->with([
                    'insurance',
                    'certificates'
                ]);
            },
            'all_listing'
        ]);
    }

    public function status(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ($value === 0)? 'In-Progress' : 'Solved',
            set: fn ($value) => $value,
        );
    }

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('M d, Y H:i:s', strtotime($value)),
            set: fn ($value) => $value,
        );
    }

    public function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('M d, Y H:i:s', strtotime($value)),
            set: fn ($value) => $value,
        );
    }
}
