<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\AuthorizedUsers;

class NumberOfLogin extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function authorized_user_name()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id', 'id');
    }
}
