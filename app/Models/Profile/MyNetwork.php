<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\AuthorizedUsers;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MyNetwork extends Model
{
    use HasFactory;
    protected $table = "my_networks";

    /**
     * Get the authorized_user that owns the MyNetwork
     *
     * @return BelongsTo
     */
    public function authorized_user()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id');
    }
}
