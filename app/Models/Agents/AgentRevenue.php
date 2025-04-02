<?php

namespace App\Models\Agents;

use App\Models\Auth\AuthorizedAgent;
use App\Models\Listing\AllUserListing;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class AgentRevenue extends Model
{
    use HasFactory;

    protected $table = "agent_revenues";
    protected $fillable = ['Agent_Reward', 'order_id', 'user_id'];

    /**
     * Get the authorized_user that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function authorized_user(): BelongsTo
    {
        return $this->belongsTo(AuthorizedAgent::class, 'user_id');
    }

    /**
     * Get the all_listing that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function all_listing(): BelongsTo
    {
        return $this->belongsTo(AllUserListing::class, 'order_id');
    }

    public function scopeCurrentMonth($query)
    {
        return $query->select('*')->whereMonth('created_at', Carbon::now()->month);
    }

    public function scopeLastMonth($query)
    {
        return $query->select('*')->whereMonth('created_at', Carbon::now()->month - 1);
    }

    public function scopeSecondLastMonth($query)
    {
        return $query->select('*')->whereMonth('created_at', Carbon::now()->month - 2);
    }

    public function scopeThirdLastMonth($query)
    {
        return $query->select('*')->whereMonth('created_at', Carbon::now()->month - 3);
    }

    public function scopeCurrentMonthSum($query)
    {
        return $query->select('*')->whereMonth('created_at', Carbon::now()->month)->select(DB::raw("SUM(Agent_Reward) as Sum"));
    }

    public function scopeLastMonthSum($query)
    {
        return $query->select('*')->whereMonth('created_at', Carbon::now()->month - 1)->select(DB::raw("SUM(Agent_Reward) as Sum"));;
    }

    public function scopeSecondLastMonthSum($query)
    {
        return $query->select('*')->whereMonth('created_at', Carbon::now()->month - 2)->select(DB::raw("SUM(Agent_Reward) as Sum"));;
    }

    public function scopeThirdLastMonthSum($query)
    {
        return $query->select('*')->whereMonth('created_at', Carbon::now()->month - 3)->select(DB::raw("SUM(Agent_Reward) as Sum"));;
    }
}
