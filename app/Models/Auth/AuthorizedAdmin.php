<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Settings\AdminRolePermissions;

class AuthorizedAdmin extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $guard = "Admin";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'password',
        'usr_type',
        'is_email_verified'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('F d, Y', strToTime($value)),
            set: fn ($value) => $value,
        );
    }

    public function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('F d, Y', strToTime($value)),
            set: fn ($value) => $value,
        );
    }
    
    // public function role()
    // {
    //     // return $this->belongsTo(AdminRolePermissions::class);
    //     return $this->hasOne(AdminRolePermissions::class, 'role');
    // }
    public function role()
    {
        return $this->belongsTo(AdminRolePermissions::class, 'role_id');
    }
}

// Admin Panel Permissions
// 1 - Listing
// 2 - Manage Users
// 3 - Manage Payments
// 4 - Managed Companies
// 5 - History
// 6 - Filter Agent Call
// 7 - More
// 8 - All Listing
// 9 - Deliver Approval
// 10 - Waiting For Approvals
// 11 - Delivered
// 12 - Requested
// 13 - Completed
// 14 - Dispatches
// 15 - Cancelled
// 16 - PickUp Approval
// 17 - Expired
// 18 - PickUp
// 19 - Archived
// 20 - Users List
// 21 - Agents List
// 22 - Permissions
// 23 - Manage Agent Permissions
// 24 - Users Invoices
// 25 - Payment Settings
// 26 - Dispatcher List
// 27 - Managed Users
// 28 - Carrier History
// 29 - Logistic Carrier History
// 30 - Logistic Broker History
// 31 - Logistic Shipper History
// 32 - 3-Way Supports
// 33 - Website Leads
// 34 - System Settings
// 35 - All Companies
// 36 - Total Orders
// 37 - Miscellaneous Items
// 38 - User Roles
// 39 - New User
// 40 - Manage Permissions
// 41 - Admins List
// 42 - IP
// 43 - IP Add New
