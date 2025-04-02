<?php

namespace App\Models;

use Illuminate\Notifications\DatabaseNotification as BaseNotification;

class ListingNotification extends BaseNotification
{
    protected $table = 'listing_notifications';
}