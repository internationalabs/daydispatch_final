<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Settings\Permission;
use App\Models\Auth\AuthorizedAgent;

class AgentPermission extends Model
{
    use HasFactory;
    protected $table = "agent_permissions";
    protected $fillable = [
            'user_id',
            'permission_name',
            'allow',    //Allowed nos to view records
            'state',    //Allowed states to view records
        ];

    
    public function agent()
    {
        return $this->belongsTo(AuthorizedAgent::class, 'user_id');
    }
    
    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_name');
    }
}
