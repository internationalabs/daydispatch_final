<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;
    
    protected $table = 'groups';

    public function users()
    {
        return $this->hasMany(GroupUser::class,'group_id','id');
    }

    public function chatOne()
    {
        return $this->hasOne(GroupChat::class,'group_id','id')->orderBy('id','DESC');
    }

    public function chatCount()
    {
        return $this->hasMany(GroupChat::class,'group_id','id');
    }
}
