<?php

namespace App\Models\Extras;

use App\Models\Auth\AuthorizedUsers;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Message;

class MessageNotifications extends Model
{
    use HasFactory;
    
    protected $table = "message_notifications";
    
    protected $fillable = [
            'notification',
            'is_read',
            'chat_id',
            'user_id',
            'recipient_id',
        ];

    /**
     * Get the authorized_user that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id');
    }
    public function recipient()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'recipient_id');
    }
    public function chat()
    {
        return $this->belongsTo(Message::class, 'chat_id');
    }
}
