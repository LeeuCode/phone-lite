<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = ['invoice_id', 'item_id', 'purchasing_price', 'selling_price',
    'store_balance', 'quantity', 'total', 'type'];


    public function item()
    {
      return $this->belongsTo('App\Models\Item');
    }
}
