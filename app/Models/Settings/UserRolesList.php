<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserRolesList extends Model
{
    use HasFactory;
    protected $table = "user_roles_lists";
    protected $fillable = ['User_Roles'];

    public function userRoles(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value,
            set: fn ($value) => Str::headline($value),
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
