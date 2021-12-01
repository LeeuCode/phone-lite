<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class usedDevice extends Model
{
    protected $fillable = ['user_id','agent_name', 'agent_phone', 'Device_type',
    'model', 'imei', 'purchase_price', 'sale_price', 'state', 'receipt_notes'];

    public function type()
    {
      return $this->belongsTo('App\Models\Taxonomy','Device_type', 'id');
    }

    public function models()
    {
      return $this->belongsTo('App\Models\Taxonomy','model', 'id');
    }
}
