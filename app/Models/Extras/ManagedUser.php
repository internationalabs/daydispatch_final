<?php

namespace App\Models\Extras;

use App\Models\Auth\AuthorizedUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagedUser extends Model
{
    use HasFactory;
    
    protected $table = "managed_companies";
    
    protected $fillable = [
            'dispatcher_id',
            'user_id',
            'status',
        ];
        
    public function user()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id');
    }
        
    public function dispatcher()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'dispatcher_id');
    }
}
