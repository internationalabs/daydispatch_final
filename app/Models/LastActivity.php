<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\AuthorizedUsers;

class LastActivity extends Model
{
    protected $table = 'last_activities';
    protected $fillable = [
        'name',
        'ip',
        'location',
        'activity'
    ];
}
