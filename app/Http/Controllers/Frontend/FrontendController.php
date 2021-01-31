<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Product;
use Response;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    //LISTING
    public function index(){

    	$productData = Product::where('status','=','active')->get();
    	return view('frontend.productList',['productData' => $productData]);
    }
}
