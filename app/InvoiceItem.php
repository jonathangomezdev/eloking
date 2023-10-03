<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'item_number',
        'description',
        'qty',
        'unit_price',
        'total',
        'invoice_id'
    ];
}
