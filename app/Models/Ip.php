<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\AuthorizedUsers;

class Ip extends Model
{
    protected $table = 'ips';
    protected $fillable = [
        'ip_address',
        'status'
    ];
}
