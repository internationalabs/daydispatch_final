<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\AuthorizedUsers;

class UserEquipmentType extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'equipment'];

    public function user()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id', 'id');
    }
}
