<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallmentMonth extends Model
{
    protected $fillable = ['installment_id','monthly_installment', 'state', 'renewal_date'];

    public function installment()
    {
      return $this->belongsTo('App\Models\Installment');
    }
}
