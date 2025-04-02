<?php

namespace App\Models\Profile;

use App\Models\Listing\AllUserListing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\AuthorizedUsers;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MyRating extends Model
{
    use HasFactory;
    protected $table = "my_reports";
}
