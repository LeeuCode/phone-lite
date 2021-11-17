<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPrice extends Model
{
    protected $fillable = ['item_id', 'purchasing_price', 'selling_price', 'quantity'];
}
