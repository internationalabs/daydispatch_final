<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model
{
    use HasFactory;
    protected $table = "permissions";
    protected $fillable = [
            'name',
            'label',
        ];
}
