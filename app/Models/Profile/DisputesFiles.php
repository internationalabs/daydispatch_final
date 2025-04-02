<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DisputesFiles extends Model
{
    use HasFactory;
    protected $table = "disputes_files";

    protected $fillable = ['Dispute_Files', 'dispute_id', 'user_id'];

    /**
     * Get the add_disputes that owns the DisputesFiles
     *
     * @return BelongsTo
     */
    public function add_disputes()
    {
        return $this->belongsTo(AddDispute::class, 'dispute_id', 'user_id');
    }
}
