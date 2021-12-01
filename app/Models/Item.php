<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['barcode', 'user_id','title', 'cat_id', 'unit_id', 'model',
    'warranty_period', 'purchasing_price', 'selling_price', 'average_price', 'store_balance',
    'expiration_date'];

    public function category()
    {
      return $this->belongsTo('App\Models\Taxonomy','cat_id', 'id');
    }

    public function models()
    {
      return $this->belongsTo('App\Models\Taxonomy','model', 'id');
    }

    public function unities()
    {
      return $this->belongsTo('App\Models\Taxonomy','unit_id', 'id');
    }
}
