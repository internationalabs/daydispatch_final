<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCalendar extends Model
{
    // use HasFactory;

    // protected $guarded = [];

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'task_time' => 'datetime', // Cast task_time to datetime type (Carbon instance)
        'end_task_time' => 'datetime',
    ];

    /**
     * The attributes that are dates and should be treated as Carbon instances.
     *
     * @var array
     */
    protected $dates = [
        'task_date', // Specify other date fields if needed
        'end_task_date',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dateFormat = 'Y-m-d H:i:s'; // Specify the date format if needed

    // Add your custom methods or relationships below if any
}
