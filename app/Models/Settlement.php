<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    protected $fillable = ['customer_type', 'customer_id', 'amount', 'paid'];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
}
