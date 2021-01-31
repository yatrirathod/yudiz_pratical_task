<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Auth;

class CheckoutController extends Controller
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
    public function checkouttocart(Request $request)
    {
    	$cookieData = stripslashes(Cookie::get('shopping_cart'));
        $cartData = json_decode($cookieData, true);
        $total = 0;
        if($cartData){
	    		foreach ($cartData as $key => $value) {
	    			$price = str_replace(',','',$value['item_price']);
	    			$total += ($price * $value['item_quantity']);
	    		} 
        	}
	        $storeOrderData = new Order;
	        $storeOrderData->user_name = $request->get('userName');
	        $storeOrderData->contact_no = $request->get('phone');
	        $storeOrderData->email = $request->get('email');
	        $storeOrderData->shipping_address = $request->get('address');
	        $storeOrderData->total = number_format($total,2);
	        $storeOrderData->payment_status = 'Pending';
	        $storeOrderData->user_id = Auth()->user()->id;
	    	$storeOrderData->save();
	    	$id = $storeOrderData->id;
	    	if($cartData){
	    		foreach ($cartData as $key => $value) {
	    			$OrderDetail = new OrderDetail;
	    			$OrderDetail->product_id = $value['item_id'];
	    			$OrderDetail->unit_price = $value['item_price'];
	    			$OrderDetail->quantity = $value['item_quantity'];
	    			$OrderDetail->order_id = $id;
	    			$OrderDetail->save();
	    		} 
        	}
        return response()->json(['status'=>'Order is done Successfully']);
        }
}
