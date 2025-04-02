<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSheet extends Model
{
    use HasFactory;
    protected $table = 'user_sheets';
    protected $fillable = [
        'type',
        'name',
        'phone_one',
        'phone_two',
        'phone_three',
        'state',
        'address',
        'email',
        'description',
    ];
}
