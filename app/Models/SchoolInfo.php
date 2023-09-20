<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolInfo extends Model
{

    protected $table = 'school_info';
    public $timestamps = true;
    protected $guarded = [];
    use HasFactory;


    public function schoolInvoices(): HasMany
    {
        // return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'id')->select('id', 'invoice_id', 'month');
        return $this->hasMany(InvoiceDetail::class, 'school_id', 'id');
    }


}
