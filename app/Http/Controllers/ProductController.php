<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Response;


class ProductController extends Controller
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
    //LISTING
    public function index(){

    	$productData = Product::where('status','=','active')->get();
    	return view('product',['productData' => $productData]);
    }
    // STORE PRODUCT
    public function insert(Request $request)
    {

        $productInsert = new Product;
        $productInsert->name = $request->get('pname');
        $productInsert->price = $request->get('price');
        $productInsert->quantity = $request->get('quantity');
        $productInsert->status = $request->get('status');
        $productInsert->save();

    	$data['success'] = 'success';
    	$data['message'] =  'Inserted Successfully';
    	$data['productInsert']  = $productInsert;
    	return Response::json($data);
	}
    // SHOW EDIT DETAILS OF PRODUCT
    public function edit(Request $request){
        
        $prdID = $request->get('productID');

        $getProductDetails = Product::find($prdID);

        
        return Response::json($getProductDetails);
    }
    //UPDATE PRODUCT
    public function update(Request $request,$id)
    {
        $updateProductDetails = Product::find($id);
        $updateProductDetails->name = $request->get('editPrdName');
        $updateProductDetails->price = $request->get('editPrdPrice');
        $updateProductDetails->quantity = $request->get('editPrdQuantity');
        $updateProductDetails->save();

        $data['success'] = 'success';
        $data['message'] = 'Updated Successfully';
        $data['productUpdate'] = $updateProductDetails;
        
        return Response::json($data); 
    }
    //DELETE PRODUCT
    public function delete(Request $request)
    {
        $deleteProductDetails = Product::find($request->get('productID'))->delete();
       

        $data['success'] = 'success';
        $data['message'] = 'Deleted Successfully';
        $data['productDelete'] = $deleteProductDetails;
        
        return Response::json($data); 
    }
}
