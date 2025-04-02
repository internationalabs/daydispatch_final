<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AddressBook extends Model
{
    use HasFactory;
    protected $table = "address_books";

    /**
     * Get the authorized_user that owns the AddressBook
     *
     * @return BelongsTo
     */
    public function authorized_user()
    {
        return $this->belongsTo(AuthorizedUsers::class, );
    }
}
