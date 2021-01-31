<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $fillable = ['order_id' ,'product_id' ,'unit_price' ,'quantity'];

       public function Order()
       {
			return $this->belongsTo('App\Models\Order', 'order_id', 'id');
		}
}
