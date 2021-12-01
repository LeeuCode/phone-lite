<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $fillable = ['user_id', 'customer_id', 'item_id', 'balance', 'quantity',
    'purchasing_price', 'installment_selling_price', 'number_months', 'advance_purchase',
    'premiums_paid', 'interest_value', 'remaining_installments', 'monthly_installment',
    'date'
  ];

    public function item()
    {
      return $this->belongsTo('App\Models\Item');
    }

    public function customer()
    {
      return $this->belongsTo('App\Models\Customer');
    }

    public function months()
    {
      return $this->hasMany('App\Models\InstallmentMonth');
    }
}
