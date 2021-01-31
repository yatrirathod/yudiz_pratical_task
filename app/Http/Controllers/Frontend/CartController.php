<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;

class CartController extends Controller
{
	public function index()
    {
        $cookieData = stripslashes(Cookie::get('shopping_cart'));
        $cartData = json_decode($cookieData, true);

        return view('frontend.cart',['cartData' => $cartData]);
    }
    public function addtocart(Request $request)
    {

        $prod_id = $request->get('product_id');
        $quantity = $request->get('quantity');

        if(Cookie::get('shopping_cart')) //checking shopping cart items is there or not 
        {
            $cookieData = stripslashes(Cookie::get('shopping_cart'));
            $cartData = json_decode($cookieData, true);
        }
        else
        {
            $cartData = array();
        }

        $itemIdList = array_column($cartData, 'item_id');
        $prodIdIsThere = $prod_id;

        if(in_array($prodIdIsThere, $itemIdList))
        {
            foreach($cartData as $keys => $values)
            {
                if($cartData[$keys]["item_id"] == $prod_id)
                {
                    $cartData[$keys]["item_quantity"] = $request->get('quantity');
                    $item_data = json_encode($cartData);
                    $minutes = 10; //cart exprie time 10 minutes
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    return response()->json(['status'=>'"'.$cartData[$keys]["item_name"].'" Already Added to Cart','status2'=>'2']);
                }
            }
        }
        else
        {
            $products = Product::find($prod_id);
            $prodName = $products->name;
            $priceval = $products->price;

            if($products)
            {
                $item_array = array(
                    'item_id' => $prod_id,
                    'item_name' => $prodName,
                    'item_quantity' => $quantity,
                    'item_price' => $priceval 
                );
                $cartData[] = $item_array;

                $item_data = json_encode($cartData);
                $minutes = 10;
                //item added in cookie shopping cart
                Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));

                return response()->json(['status'=>'"'.$prodName.'" Added to Cart']);
            }
        }
    }
    //VIEW CART WITH PRODUCT DETAILS
    public function cartload()
    {
    	//GETTING COOKIE DATA FOR COUNT
        if(Cookie::get('shopping_cart'))
        {
            $cookieData = stripslashes(Cookie::get('shopping_cart'));
            $cartData = json_decode($cookieData, true);
            $totalcart = count($cartData);

            echo json_encode(array('totalcart' => $totalcart)); die;
            return;
        }
        else
        {
            $totalcart = "0";
            echo json_encode(array('totalcart' => $totalcart)); die;
            return;
        }
    }
    //UPDATING CART QTY AND PRICE
    public function updatetocart(Request $request)
    {
        $prod_id = $request->get('product_id');
        $quantity = $request->get('quantity');

        if(Cookie::get('shopping_cart'))
        {
            $cookieData = stripslashes(Cookie::get('shopping_cart'));
            $cartData = json_decode($cookieData, true);

            $itemIdList = array_column($cartData, 'item_id');
            $prodIdIsThere = $prod_id;

            if(in_array($prodIdIsThere, $itemIdList))
            {
                foreach($cartData as $keys => $values)
                {
                    if($cartData[$keys]["item_id"] == $prod_id)
                    {
                        $cartData[$keys]["item_quantity"] =  $quantity;
                        $item_data = json_encode($cartData);
                        $minutes = 10;
                        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                        return response()->json(['status'=>'"'.$cartData[$keys]["item_name"].'" Quantity Updated','qty' => $cartData[$keys]["item_quantity"]]);
                    }
                }
            }
        }
    }
    public function deletefromcart(Request $request)
    {
        $prod_id = $request->get('product_id');

        $cookieData = stripslashes(Cookie::get('shopping_cart'));
        $cartData = json_decode($cookieData, true);

        $itemIdList = array_column($cartData, 'item_id');
        $prodIdIsThere = $prod_id;

        if(in_array($prodIdIsThere, $itemIdList))
        {
            foreach($cartData as $keys => $values)
            {
                if($cartData[$keys]["item_id"] == $prod_id)
                {
                    unset($cartData[$keys]);
                    $item_data = json_encode($cartData);
                    $minutes = 10;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    return response()->json(['status'=>'Item Removed from Cart']);
                }
            }
        }
    }
    public function clearcart()
    {
        Cookie::queue(Cookie::forget('shopping_cart'));
        return response()->json(['status'=>'Your Cart is Cleared']);
    }
}
