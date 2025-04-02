<?php

namespace App\Models\Support;

use App\Models\Auth\AuthorizedUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketComments extends Model
{
    use HasFactory;
    protected $table = "ticket_comments";

    public function authorized_user(): BelongsTo
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id');
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(ThreeWayTicket::class, 'user_id');
    }
}
