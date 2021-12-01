<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = ['user_id', 'agent_name', 'agent_phone', 'Device_type', 'model', 'imei',
    'malfunction', 'customer_complaint', 'receipt_notes', 'delivery_date', 'maintenance_status',
    'device_recipient', 'delivery_time', 'maintenance_cost', 'spare_parts_value',
    'paid', 'discount', 'residual'];

    public function types()
    {
      return $this->belongsTo('App\Models\Taxonomy','Device_type', 'id');
    }

    public function models()
    {
      return $this->belongsTo('App\Models\Taxonomy','model', 'id');
    }

    // public function models()
    // {
    //   return $this->belongsTo('App\Models\Taxonomy','model', 'id');
    // }

    public function malfunction()
    {
      return $this->belongsTo('App\Models\Taxonomy','malfunction', 'id');
    }
}
