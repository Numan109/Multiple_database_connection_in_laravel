<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceDetail extends Model
{
    
    protected $table = 'invoice_detail';
    public $timestamps = true;
    protected $guarded = [];

    use HasFactory;
    
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }


    public function school(): BelongsTo
    {
        return $this->belongsTo(SchoolInfo::class, 'school_id', 'id');
    }

}
