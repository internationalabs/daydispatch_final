<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserInsurrance extends Model
{
    use HasFactory;
    protected $table = 'user_insurrances';

    /**
     * Get the authorized_user that owns the UserInsurrance
     *
     * @return BelongsTo
     */
    public function authorized_user()
    {
        return $this->belongsTo(AuthorizedUsers::class, );
    }
}
