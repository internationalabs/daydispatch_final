<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Settings\AgentPermission;
use Illuminate\Support\Facades\Auth;

class AuthorizedAgent extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $guard = "Agent";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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

    /**
     * Get the authorized_user that owns the AllListing
     *
     * @return HasMany
     */
    public function my_users()
    {
        return $this->hasMany(AuthorizedUsers::class, 'ref_code');
    }

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
    
    public function permissions($permission)
    {
        // return $this->hasMany(AgentPermission::class);
        $permissions = AgentPermission::where('user_id', Auth::guard('Agent')->user()->id)
            ->where('permission_name', $permission)
            ->first();
            
        return $permissions;
    }
}
