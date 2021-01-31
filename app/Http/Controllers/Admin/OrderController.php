<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Auth;
use DB;
class OrderController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getorderdetails()
    {

    	// $getorderdetails = Order::with('Order')->get();

    	$getorderdetails = DB::table('orders')
            ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
            ->leftJoin('products', 'order_details.id', '=', 'products.id')
            ->get();
        
    	return view('order',['getorderdetails' => $getorderdetails]);
    }
}
