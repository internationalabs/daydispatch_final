<?php

namespace App\Models\Profile;

use App\Models\Auth\AuthorizedUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\CertificateAssign;


class UserCertificates extends Model
{
    use HasFactory;
    protected $table = 'user_certificates';

    /**
     * Get the authorized_user that owns the UserCertificates
     *
     * @return BelongsTo
     */
    public function authorized_user()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id');
    }

    public function certificate_assigns()
    {
        return $this->hasMany(CertificateAssign::class, 'user_id', 'user_id');
    }
}
