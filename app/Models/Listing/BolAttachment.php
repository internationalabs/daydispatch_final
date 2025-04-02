<?php

namespace App\Models\Listing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BolAttachment extends Model
{
    use HasFactory;
    protected $table = "bol_attachments";

    /**
     * Get the ladings that owns the BolAttachment
     *
     * @return BelongsTo
     */
    public function ladings()
    {
        return $this->belongsTo(BillOfLading::class, 'bol_id', 'id');
    }
}
