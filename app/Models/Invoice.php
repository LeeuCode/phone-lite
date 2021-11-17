<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['user_id', 'invoice_type', 'movement_type', 'total', 'discount_amount', 'discount_percentage', 'total_discount', 'tax_rate', 'tax_value', 'total_tax', 'total_bill', 'paid', 'residual'];

    public function items()
    {
      return $this->hasMany('App\Models\InvoiceItem');
    }
}
