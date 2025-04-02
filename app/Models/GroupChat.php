<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Auth\AuthorizedAdmin;

class GroupChat extends Model
{
    use HasFactory;
    
    protected $table = 'group_chats';
    public function group()
    {
        return $this->belongsTo(Group::class,'group_id','id');
    }
    public function user()
    {
        return $this->belongsTo(AuthorizedAdmin::class,'user_id','id');
    }
}
