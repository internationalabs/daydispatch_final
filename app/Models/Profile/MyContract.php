<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MyContract extends Model
{
    use HasFactory;
    protected $table = "my_contracts";

    /**
     * Get the authorized_user that owns the MyContract
     *
     * @return BelongsTo
     */
    public function authorized_user()
    {
        return $this->belongsTo(AuthorizedUsers::class, );
    }
}
