<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorizationFormImages extends Model
{
    protected $table = 'authorization_form_images';
    
    protected $fillable = [
            'form_id',
            'image',
            'status',
        ];
    
    public function form()
    {
        return $this->belongsTo(AuthorizationForm::class,'form_id','id');
    }
}