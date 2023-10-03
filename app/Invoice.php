<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'invoice_from',
        'invoice_for',
        'invoice_number',
        'invoice_link',
        'order_id',
        'vendor_company',
        'vendor_name',
        'vendor_street',
        'vendor_city',
        'vendor_state',
        'vendor_country',
        'vendor_postcode',
        'vendor_vat_number',
        'vendor_vat_rate',
        'customer_name',
        'customer_country',
        'description',
        'subtotal',
        'total',
        'note',
        'vat_amount',
        'vendor_id',
        'customer_id',
        'deleted_at'
    ];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
