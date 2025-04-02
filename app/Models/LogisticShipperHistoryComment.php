<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\AuthorizedAdmin;
use App\Models\History\LogisticShipperCallHistory;

class LogisticShipperHistoryComment extends Model
{
    use HasFactory;

    protected $table = 'logisticShipperHistoryComment';

    protected $fillable = [
        'user_id',
        'history_id',
        'comment',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(AuthorizedAdmin::class,'user_id','id');
    }

    public function history()
    {
        return $this->belongsTo(LogisticShipperCallHistory::class,'history_id','id');
    }
}
