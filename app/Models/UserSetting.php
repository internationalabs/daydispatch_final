<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    protected $table = 'user_settings';

    protected $fillable = [
        'user_id',
        'email_notification',
        'custom_notification',
        'prefer_vehicle',
        'prefer_heavy',
        'prefer_dryvan',
    ];

    public function user()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id', 'id');
    }
}
