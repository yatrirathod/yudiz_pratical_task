<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['user_name' ,'contact_no' ,'email' ,'shipping_address','total','user_id'];

    
}
