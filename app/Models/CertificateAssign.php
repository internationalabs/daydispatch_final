<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\AuthorizedUsers;
// use App\Models\CertificateAssign;
use App\Models\Profile\UserCertificates;


class CertificateAssign extends Model
{
    use HasFactory;

    protected $table = 'certificates_assigns'; // Table ka naam yahan set karein

    protected $guarded = []; // Sab fields fillable hain

    
    public function certificate_assigns()
    {
        return $this->hasMany(UserCertificates::class, 'user_id', 'id');
    }

    public function authorized_user()
    {
        return $this->hasMany(AuthorizedUsers::class, 'user_id', 'id');
    }
}
